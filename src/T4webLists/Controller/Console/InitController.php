<?php

namespace T4webLists\Controller\Console;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Ddl;
use Zend\Db\Sql\Ddl\Column;
use Zend\Db\Sql\Ddl\Constraint;
use Zend\Db\Sql\Sql;
use PDOException;

class InitController extends AbstractActionController
{

    /**
     * @var Adapter
     */
    private $dbAdapter;

    public function __construct(Adapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
    }

    public function runAction()
    {
        $this->createTable();

        return "Success completed" . PHP_EOL;
    }

    private function createTable()
    {
        $table = new Ddl\CreateTable('lists');

        $id = new Column\Integer('id');
        $id->setOption('AUTO_INCREMENT', 1);

        $table->addColumn($id);
        $table->addColumn(new Column\Varchar('name', 50));
        $table->addColumn(new Column\Integer('type', false, 1));

        $table->addConstraint(new Constraint\PrimaryKey('id'));

        $sql = new Sql($this->dbAdapter);

        try {
            $this->dbAdapter->query(
                $sql->getSqlStringForSqlObject($table),
                Adapter::QUERY_MODE_EXECUTE
            );
        } catch (PDOException $e) {
            return $e->getMessage() . PHP_EOL;
        }
    }

}
