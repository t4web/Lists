<?php

namespace T4webLists\Controller\Admin;

use Zend\Mvc\Controller\AbstractActionController;
use T4webBase\Domain\Service\BaseFinder;
use T4webLists\Controller\ViewModel\ShowViewModel;
use T4webList\ObjectList\Type;

class ListController extends AbstractActionController
{

    /**
     * @var BaseFinder
     */
    private $finder;

    /**
     * @var ShowViewModel
     */
    private $view;

    public function __construct(BaseFinder $finder, ShowViewModel $view)
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
        $lists = $this->finder->findMany(['T4webLists' => ['ObjectList' => [
            'type' => $type,
        ]]]);

        $this->view->setLists($lists);

        return $this->view;
    }

}
