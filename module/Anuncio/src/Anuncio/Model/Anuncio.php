<?php
namespace Anuncio\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Anuncio
{
    public $cdBarra;
    public $nmMat;
    public $marca;
    public $embalagem;
    public $tpUnMedida;
    public $qtUnMedida;
    public $preco;
    public $latitude;
    public $longitude;
    
    protected $inputFilter;

    public function exchangeArray($data){
        
        if(isset($data['cd_barra'])){
            
            $dataAux = array();
            
            $dataAux['cdBarra'] = $data['cd_barra'];
            $dataAux['nmMat'] = $data['nm_mat'];
            $dataAux['marca'] = $data['marca_mat'];
            $dataAux['embalagem'] = $data['cd_emb'];
            $dataAux['tpUnMedida'] = $data['cd_un_med'];
            $dataAux['qtUnMedida'] = $data['qt_un_medida'];
            $dataAux['preco'] = $data['preco_mat'];
            $dataAux['latitude'] = $data['lat_mat'];
            $dataAux['longitude'] = $data['long_mat'];
            
            $data = $dataAux;
            
        }
        
        if(trim($data['cdBarra']) != ""){
            $this->cdBarra = (isset($data['cdBarra'])) ? $data['cdBarra'] : null;
        }else $this->cdBarra = null;
        
        if(trim($data['nmMat']) != ""){
            $this->nmMat = (isset($data['nmMat'])) ? strtolower($data['nmMat']) : null;
        }else $this->nmMat = null;
        
        if(trim($data['marca']) != ""){
            $this->marca = (isset($data['marca'])) ? strtolower($data['marca']) : null;
        }else $this->marca = null;
        
        if(trim($data['embalagem']) != ""){
            $this->embalagem = (isset($data['embalagem'])) ? $data['embalagem'] : null;
        }else $this->embalagem = null;
        
        if(trim($data['tpUnMedida']) != ""){
            $this->tpUnMedida = (isset($data['tpUnMedida'])) ? $data['tpUnMedida'] : null;
        }else $this->tpUnMedida = null;
        
        if(trim($data['qtUnMedida']) != ""){
            $this->qtUnMedida = (isset($data['qtUnMedida'])) ? $data['qtUnMedida'] : null;
        }else $this->qtUnMedida = null;
        
        if(trim($data['preco']) != ""){
            $this->preco = (isset($data['preco'])) ? $data['preco'] : null;
        }else $this->preco = null;
        
        if(trim($data['latitude']) != ""){
            $this->latitude = (isset($data['latitude'])) ? $data['latitude'] : null;
        }else $this->latitude = null;
        
        if(trim($data['longitude']) != ""){
            $this->longitude = (isset($data['longitude'])) ? $data['longitude'] : null;
        }else $this->longitude = null;
        
        
    }
    
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
    
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name'     => 'cdBarra',
                'required' => true,
                'validators'  => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'nmMat',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'marca',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 50,
                        ),
                    ),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'embalagem',
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'Int',
                    ),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'tpUnMedida',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'Int',
                    ),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'qtUnMedida',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'Float',
                    ),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'preco',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'Float',
                    ),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'latitude',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 20,
                        ),
                    ),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'longitude',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 20,
                        ),
                    ),
                ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
    
}