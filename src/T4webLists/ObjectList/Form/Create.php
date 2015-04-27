<?php

namespace T4webLists\ObjectList\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class Create extends Form
{

    public function __construct($name = null)
    {
        parent::__construct('list');

        $this->setAttributes(array(
            'method' => 'post',
            ));

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Name:',

            ),
        ));

        $types = \T4webLists\ObjectList\Type::getAll();
        if(count($types) > 1) {
            $type = new Element\Select('type');
            $type->setLabel('Type:');
            $type->setValueOptions($types);
            $type->setAttribute('class', 'form-control');

            $this->add($type);
        } else {
            $this->add(array(
                'name' => 'type',
                'attributes' => array(
                    'type'  => 'hidden',
                    'value'  => \T4webLists\ObjectList\Type::BASE,
                ),
            ));
        }

    }
}