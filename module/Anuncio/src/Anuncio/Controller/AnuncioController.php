<?php

namespace Anuncio\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Anuncio\Model\Anuncio;
use Anuncio\Form\AnuncioForm;

class AnuncioController extends AbstractActionController{
    
    protected $anuncioTable;
    
    public function indexAction(){
        
        return new ViewModel(array(
            'anuncios' => $this->getAnuncioTable()->fetchAll(),
        ));
        
    }
    
    public function addAction(){
        
        $response   = $this->getResponse();
        
        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $form = new AnuncioForm ($dbAdapter);
        
        $form->get('submit')->setValue('Incluir');

        $request = $this->getRequest();
        
        if ($request->isPost()) {
            
            $anuncio = new Anuncio();
            $form->setInputFilter($anuncio->getInputFilter());
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
               
                $anuncio->exchangeArray($form->getData());
                $this->getAnuncioTable()->insereAnuncio($anuncio);
                
                header('Content-type: application/json');
                return $response->setContent(\Zend\Json\Json::encode(array(
                    'cdMsg' => 1,
                    'msg' => $form->getMessages()
                )));

                //return $this->redirect()->toRoute('anuncio');
                
            }else{
                header('Content-type: application/json');
                return $response->setContent(\Zend\Json\Json::encode(array(
                    'cdMsg' => 0,
                    'msg' => $form->getMessages()
                )));
            }
        }
        
        return array('form' => $form);
    }
    
    public function addImagemAction(){
        
        $response = $this->getResponse();
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            
            $nome_img = $request->getPost('cdBarra');
    
            $data = $request->getPost('imgMat');
            $pos  = strpos($data, ';');
            $type = explode(':', substr($data, 0, $pos))[1];
            
        	$img = str_replace('data:'.$type.';base64,', '', $img);
        	$img = str_replace(' ', '+', $img);
        	$data = base64_decode($img);
        	$file = "img/anuncio/" . $nome_img . ".".explode('/',$type)[1];
        	$success = file_put_contents($file, $data);
        	
        	
        
            return $response->setContent(\Zend\Json\Json::encode(array(
                'cdMsg' => 0,
                'msg' => $file   
            )));
        	
            
        }else{
            return $this->redirect()->toRoute('anuncio');
        }
        
        return $response;
        
    }
    
    public function getAnuncioTable()
    {
        if (!$this->anuncioTable) {
            $sm = $this->getServiceLocator();
            $this->anuncioTable = $sm->get('Anuncio\Model\AnuncioTable');
        }
        return $this->anuncioTable;
    }
    
}