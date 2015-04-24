<?php

namespace T4webLists\Controller\Admin\ViewModel;

use T4webLists\ObjectList;
use Zend\View\Model\ViewModel;

class ListViewModel extends ViewModel
{
    /**
     * @var ObjectList\CalendarCollection
     */
    private $lists;

    /**
     * @return ObjectList\CalendarCollection
     */
    public function getLists()
    {
        return $this->lists;
    }

    /**
     * @param ObjectList\CalendarCollection $lists
     */
    public function setLists($lists)
    {
        $this->lists = $lists;
    }

    /**
     * @return mixed
     */
    public function getTypes() {
        return ObjectList\Type::getAll();
    }

}
