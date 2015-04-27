<?php

namespace T4webLists;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\Mvc\Controller\ControllerManager;
use Zend\Console\Adapter\AdapterInterface as ConsoleAdapterInterface;
use Zend\ServiceManager\ServiceManager;
use T4webBase\Domain\Service\Create as ServiceCreate;
use T4webBase\Domain\Service\Update as ServiceUpdate;
use T4webBase\Domain\Service\Delete as ServiceDelete;
use T4webBase\Domain\Service\BaseFinder as ServiceFinder;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface,
    ControllerProviderInterface, ConsoleUsageProviderInterface,
    ServiceProviderInterface
{
    public function getConfig($env = null)
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConsoleUsage(ConsoleAdapterInterface $console)
    {
        return array(
            'lists init' => 'Initialize module',
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'T4webLists\ObjectList\Service\Create' => function (ServiceManager $sm) {
                    $eventManager = $sm->get('EventManager');
                    $eventManager->addIdentifiers('T4webLists\ObjectList\Service\Create');

                    return new ServiceCreate(
                        $sm->get('T4webLists\ObjectList\InputFilter\Create'),
                        $sm->get('T4webLists\ObjectList\Repository\DbRepository'),
                        $sm->get('T4webLists\ObjectList\Factory\EntityFactory'),
                        $eventManager
                    );
                },

                'T4webLists\ObjectList\Service\Update' => function (ServiceManager $sm) {
                    $eventManager = $sm->get('EventManager');
                    $eventManager->addIdentifiers('T4webLists\ObjectList\Service\Update');

                    return new ServiceUpdate(
                        $sm->get('T4webLists\ObjectList\InputFilter\Update'),
                        $sm->get('T4webLists\ObjectList\Repository\DbRepository'),
                        $sm->get('T4webLists\ObjectList\Criteria\CriteriaFactory'),
                        $eventManager
                    );
                },

                'T4webLists\ObjectList\Service\Delete' => function (ServiceManager $sm) {
                    $eventManager = $sm->get('EventManager');
                    $eventManager->addIdentifiers('T4webLists\ObjectList\Service\Delete');

                    return new ServiceDelete(
                        $sm->get('T4webLists\ObjectList\Repository\DbRepository'),
                        $sm->get('T4webLists\ObjectList\Criteria\CriteriaFactory'),
                        $eventManager
                    );
                },

                'T4webLists\ObjectList\Service\Finder' => function (ServiceManager $sm) {
                    return new ServiceFinder(
                        $sm->get('T4webLists\ObjectList\Repository\DbRepository'),
                        $sm->get('T4webLists\ObjectList\Criteria\CriteriaFactory')
                    );
                },

                'T4webLists\ObjectList\Form\Create' => function (ServiceManager $sm) {
                    $form = new \T4webLists\ObjectList\Form\Create();
                    $form->setInputFilter($sm->get('T4webLists\ObjectList\InputFilter\Create'));
                    return $form;
                }
            ),
            'invokables' => array(
                'T4webLists\Controller\Admin\ViewModel\ListViewModel' => 'T4webLists\Controller\Admin\ViewModel\ListViewModel',
                'T4webLists\Controller\Admin\ViewModel\AddViewModel' => 'T4webLists\Controller\Admin\ViewModel\AddViewModel',

                'T4webLists\ObjectList\InputFilter\Create' => 'T4webLists\ObjectList\InputFilter\Create',
                'T4webLists\ObjectList\InputFilter\Update' => 'T4webLists\ObjectList\InputFilter\Update',
            ),
        );
    }

    public function getControllerConfig()
    {
        return array(
            'factories' => array(
                'T4webLists\Controller\Console\Init' => function (ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();

                    return new Controller\Console\InitController($sl->get('Zend\Db\Adapter\Adapter'));
                },
                'T4webLists\Controller\Admin\List' => function (ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();
                    return new Controller\Admin\ListController(
                        $sl->get('T4webLists\ObjectList\Service\Finder'),
                        $sl->get('T4webLists\Controller\Admin\ViewModel\ListViewModel')
                    );
                },
                'T4webLists\Controller\Admin\Add' => function (ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();

                    return new Controller\Admin\AddController(
                        $sl->get('T4webLists\ObjectList\Form\Create'),
                        $sl->get('T4webLists\ObjectList\Service\Finder'),
                        $sl->get('T4webLists\ObjectList\Service\Create'),
                        $sl->get('T4webLists\ObjectList\Service\Delete'),
                        $sl->get('T4webLists\Controller\Admin\ViewModel\AddViewModel')
                    );
                },
            ),
        );
    }
}
