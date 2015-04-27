<?php

namespace T4webLists\View\Helper;

use Zend\Form\View\Helper\FormElementErrors as BaseErrors;

class FormElementErrors extends BaseErrors {
    /**@+
     * @var string Templates for the open/close/separators for message tags
     */
    protected $messageCloseString     = '</span>';
    protected $messageOpenFormat      = '<span%s>';
    protected $messageSeparatorString = '';
    /**@-*/

}