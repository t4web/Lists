<?php

namespace T4webLists\View\Helper;

use Zend\View\Helper\AbstractHelper;

class RenderForm extends AbstractHelper {
    
    public function __invoke($form) {

        $form->prepare();
        $html = $this->view->form()->openTag($form) . PHP_EOL;
        $html .= '<div class="box-body">';
        $html .= $this->renderElements($form->getElements());
        $html .= '</div>';
        $html .= $this->renderControls();
        $html .= $this->view->form()->closeTag($form) . PHP_EOL;
        return $html;
    }

    public function renderElements($elements) {
        $html = '';
        foreach ($elements as $element) {
            $html .= $this->renderElement($element);
        }
        return $html;
    }

    public function renderElement($element) {
        if($element->getAttribute('type') == 'hidden') {
            return $this->view->formElement($element) . PHP_EOL;
        }

        $errorClass = '';
        if (count($element->getMessages()) > 0) {
            $errorClass = 'has-error';
        }
        // FORM ROW
        $html = '<div class="form-group ' . $errorClass . '">';

        // LABEL
        $html .= '<label for="' . $element->getAttribute('id') . '">' . $element->getLabel() . '</label>'; # add translation here

        $html .= $this->view->formElement($element);

        // ERROR MESSAGES
        $html .= $this->view->formElementErrors($element, array('class' => 'help-block'));


        $html .= '</div>'; # /.row

        return $html . PHP_EOL;
    }

    public function renderControls() {

        $html = '<div class="box-footer">' . PHP_EOL;

        $html .= '<button type="submit" class="btn btn-primary">Submit</button>' . PHP_EOL;
        $html .= '<a class="btn btn-default" href="' . $this->view->url('admin-lists') . '">Cancel and return to lists</a>' . PHP_EOL;

        $html .= '</div>'; # /.row

        return $html . PHP_EOL;
    }
}