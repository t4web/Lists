<?php

namespace T4webLists\ObjectList\InputFilter;

use T4webBase\InputFilter\InputFilter;
use T4webBase\InputFilter\Element\Id;
use T4webBase\InputFilter\Element\Int;
use T4webBase\InputFilter\Element\Text;

class Update extends InputFilter
{

    public function __construct()
    {
        // id
        $id = new Id('id');
        $id->setRequired(true);
        $this->add($id);

        // name
        $name = new Text('name', 0, 250);
        $name->setRequired(false);
        $this->add($name);

        // type
        $type = new Int('type');
        $type->setRequired(false);
        $this->add($type);

    }
}
