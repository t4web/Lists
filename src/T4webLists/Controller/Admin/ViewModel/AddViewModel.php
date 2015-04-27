<?php

namespace T4webLists\Controller\Admin\ViewModel;

use T4webLists\ObjectList;
use Zend\View\Model\ViewModel;

class AddViewModel extends ViewModel
{

    /**
     * @var \Zend\Form\Form
     */
    protected $form;

    /**
     * @return \Zend\Form\Form
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param \Zend\Form\Form $form
     */
    public function setForm($form)
    {
        $this->form = $form;
    }


}
