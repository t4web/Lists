<?php

namespace T4webLists\Controller\Admin;

use Zend\Mvc\Controller\AbstractActionController;
use T4webBase\Domain\Service\BaseFinder;
use T4webBase\Domain\Service\Create;
use T4webBase\Domain\Service\Delete;
use T4webLists\Controller\Admin\ViewModel\AddViewModel;
use Zend\Form\Form;

class AddController extends AbstractActionController
{

    /**
     * @var Form
     */
    private $form;

    private $createService;
    private $deleteService;

    private $finderService;

    /**
     * @var ListViewModel
     */
    private $view;

    public function __construct(Form $form, BaseFinder $finderService, Create $createService, Delete $deleteService, AddViewModel $view)
    {

        $view->setForm($form);
        $this->form = $form;
        $this->createService = $createService;
        $this->deleteService = $deleteService;
        $this->finderService = $finderService;
        $this->view = $view;
    }

    /**
     * @return AddViewModel
     */
    public function defaultAction()
    {

        $id = $this->params('id');

        $data = $this->finderService->find(['T4webLists' => ['ObjectList' => [
            'id' => $id,
        ]]]);

        if($data) {
            $this->form->setData($data->extract());
        }

        if($this->getRequest()->isPost()) {

            $this->form->setData($this->getRequest()->getPost());
            if($this->form->isValid()) {
                $data = $this->form->getData();
                $this->createService->create($this->form->getData());

                return $this->redirect()->toRoute('admin-lists', ['type' => $data['type']]);
            } else {
                return $this->view;
            }
        }

        $this->view->form = $this->form;

        return $this->view;
    }

    public function deleteAction() {
        $id = $this->params('id');

        if(empty($id)) {
            return $this->redirect()->toRoute('admin-lists');
        }

        $this->deleteService->delete($id);

        return $this->redirect()->toRoute('admin-lists');
    }

}
