<?php

namespace T4webLists\Controller\Admin;

use Zend\Mvc\Controller\AbstractActionController;
use T4webBase\Domain\Service\BaseFinder;
use T4webLists\Controller\Admin\ViewModel\ListViewModel;
use T4webLists\ObjectList\Type;

class ListController extends AbstractActionController
{

    /**
     * @var BaseFinder
     */
    private $finder;

    /**
     * @var ListViewModel
     */
    private $view;

    public function __construct(BaseFinder $finder, ListViewModel $view)
    {
        $this->finder = $finder;
        $this->view = $view;
    }

    /**
     * @return ShowViewModel
     */
    public function defaultAction()
    {
        $type = $this->params('type', Type::BASE);

        /* @var $lists \T4webLists\ObjectList\ObjectListCollection */
        $lists = $this->finder->findMany(['T4webLists' =>['ObjectList' => [
            'type' => $type,
        ]]]);

        $this->view->setLists($lists);

        return $this->view;
    }

}
