<?php
/**
 * Module Contact Post Controller
 * @package MODULE\Contact
 */
declare(strict_types=1);

namespace Module\Contact\Controller\Index;

use Magento\Contact\Model\ConfigInterface;
use Magento\Contact\Model\MailInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\DataObjectFactory;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;
use Module\Contact\Model\Config\Source\Subject;

class Post extends \Magento\Contact\Controller\Index\Post
{
    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var Context
     */
    private $context;

    /**
     * @var MailInterface
     */
    private $mail;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var Subject
     */
    private $subject;

    /**
     * @var DataObjectFactory
     */
    private $dataObjectFactory;

    /**
     * Post constructor.
     * @param Context $context
     * @param ConfigInterface $contactsConfig
     * @param MailInterface $mail
     * @param DataPersistorInterface $dataPersistor
     * @param LoggerInterface|null $logger
     * @param Subject $subject
     * @param DataObjectFactory $dataObjectFactory
     */
    public function __construct(
        Context $context,
        ConfigInterface $contactsConfig,
        MailInterface $mail,
        DataPersistorInterface $dataPersistor,
        LoggerInterface $logger = null,
        Subject $subject,
        DataObjectFactory $dataObjectFactory
    ) {
        $this->context = $context;
        $this->mail = $mail;
        $this->dataPersistor = $dataPersistor;
        $this->logger = $logger ?: ObjectManager::getInstance()->get(LoggerInterface::class);
        $this->subject = $subject;
        $this->dataObjectFactory = $dataObjectFactory;
        parent::__construct($context, $contactsConfig, $mail, $dataPersistor, $logger);
    }

    /**
     * Post user question
     *
     * @return Redirect
     */
    public function execute()
    {
        if (!$this->getRequest()->isPost()) {
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }
        try {
            $this->validateParams();
            $params = $this->getRequest()->getParams();
            $this->sendEmail($params);
            $this->messageManager->addSuccessMessage(
                __('Thanks for contacting us with your comments and questions. We\'ll respond to you very soon.')
            );
            $this->dataPersistor->clear('contact_us');
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            $this->dataPersistor->set('contact_us', $this->getRequest()->getParams());
        } catch (\Exception $e) {
            $this->logger->critical($e);
            $this->messageManager->addErrorMessage(
                __('An error occurred while processing your form. Please try again later.')
            );
            $this->dataPersistor->set('contact_us', $this->getRequest()->getParams());
        }
        return $this->resultRedirectFactory->create()->setPath('contact/index');
    }

    /**
     * @param array $post Post data from contact form
     * @return void
     */
    private function sendEmail($post)
    {
        $subject = $this->subject->toArray()[$post['subject']];
        $post['subject'] = $subject->getText();
        $postData = ['data' => $this->dataObjectFactory->create([
            'data' => $post
        ])];
        $this->mail->send(
            $post['email'],
            $postData
        );
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function validateParams()
    {
        $request = $this->getRequest();
        if (trim($request->getParam('firstname')) === '') {
            throw new LocalizedException(__('Enter the First Name.'));
        }
        if (trim($request->getParam('lastname')) === '') {
            throw new LocalizedException(__('Enter the Last Name.'));
        }
        if (false === \strpos($request->getParam('email'), '@')) {
            throw new LocalizedException(__('The email address is invalid. Verify the email address and try again.'));
        }
        if (trim($request->getParam('subject')) == 0) {
            throw new LocalizedException(__('You must select a subject.'));
        }
        if (trim($request->getParam('comment')) === '') {
            throw new LocalizedException(__('Enter the comment and try again.'));
        }
    }
}
