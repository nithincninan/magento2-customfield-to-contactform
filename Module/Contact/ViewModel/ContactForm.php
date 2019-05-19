<?php
/**
 * Module Contact ViewModel
 * @package MODULE\Contact
 */
declare(strict_types=1);

namespace Module\Contact\ViewModel;

use Module\Contact\Model\Config\Source\Subject;

/**
 * Module contact form ViewModel
 */
class ContactForm implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     * @var Subject
     */
    private $subject;

    /**
     * ContactForm constructor.
     */
    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return array
     */
    public function getSubject()
    {
        $subject = $this->subject->toOptionArray();
        return $subject;
    }
}
