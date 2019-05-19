<?php
/**
 * Module Contact - Create Contact Us Email Template
 * @package MODULE\Contact
 */
declare(strict_types=1);

namespace Module\Contact\Setup\Patch\Data;

use Magento\Email\Model\ResourceModel\Template as TemplateResource;
use Magento\Email\Model\TemplateFactory;
use Magento\Framework\App\TemplateTypesInterface;
use Magento\Framework\Filesystem\Driver\File as Filesystem;
use Magento\Framework\Module\Dir\Reader;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Class CreateModuleContactEmail
 * @package Module\Contact\Setup\Patch\Data
 */
class CreateModuleContactEmail implements DataPatchInterface
{
    private const MODULE_CONTACTUS_TEMPLATE = 'module_submitted_form.html';

    /**
     * Template factory
     *
     * @var TemplateFactory
     */
    private $templateFactory;

    /**
     * @var TemplateResource
     */
    private $templateResource;

    /**
     * @var Reader
     */
    private $moduleReader;

    /**
     * @var Filesystem
     */
    private $fileSystemDriver;

    /**
     * CreateModuleContactEmail constructor.
     * @param TemplateFactory $templateFactory
     * @param TemplateResource $templateResource
     * @param Reader $moduleReader
     * @param Filesystem $fileSystemDriver
     */
    public function __construct(
        TemplateFactory $templateFactory,
        TemplateResource $templateResource,
        Reader $moduleReader,
        Filesystem $fileSystemDriver
    ) {
        $this->templateFactory = $templateFactory;
        $this->templateResource = $templateResource;
        $this->moduleReader = $moduleReader;
        $this->fileSystemDriver = $fileSystemDriver;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $template = $this->templateFactory->create();
        $template->setTemplateCode('Module Contact Form');
        $template->setTemplateText($this->getEmailTemplate());
        $template->setTemplateType(TemplateTypesInterface::TYPE_HTML);
        $template->setTemplateSubject(
            '{{trans "Module Contact Form"}}'
        );
        $template->setOrigTemplateCode('module_contact_email_email_template');
        // @codingStandardsIgnoreLine
        $template->setOrigTemplateVariables('{"var data.comment": "Comment","var data.firstname": "First Name","var data.lastname": "Last Name","var data.email": "Sender Email","var data.subject": "Subject"}');
        $this->templateResource->save($template);
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    private function getEmailTemplate()
    {
        $viewDir = $this->getDirectory();
        $templateContent = $this->fileSystemDriver->fileGetContents($viewDir . self::MODULE_CONTACTUS_TEMPLATE);

        return $templateContent;
    }

    /**
     * @return string
     */
    private function getDirectory()
    {
        $viewDir = $this->moduleReader->getModuleDir(
            \Magento\Framework\Module\Dir::MODULE_VIEW_DIR,
            'Module_Contact'
        );

        return $viewDir . '/frontend/email/';
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
