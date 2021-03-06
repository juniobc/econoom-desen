<?php

namespace Anuncio;

use Anuncio\Model\Anuncio;
use Anuncio\Model\AnuncioTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;


class Module implements AutoloaderProviderInterface, ConfigProviderInterface{

    public function getAutoloaderConfig(){
        
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig(){
        
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Anuncio\Model\AnuncioTable' =>  function($sm) {
                    $tableGateway = $sm->get('AnuncioTableGateway');
                    $table = new AnuncioTable($tableGateway);
                    return $table;
                },
                'AnuncioTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Anuncio());
                    return new TableGateway('t001', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}