<?php
namespace Anuncio\Form;

use Zend\Form\Form;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Adapter;

class AnuncioForm extends Form
{
    
    protected $adapter;
    
    public function __construct(AdapterInterface $dbAdapter)
    {
        
        $this->adapter = $dbAdapter;
        
        // Nos iremos ignorar o nome passado
        parent::__construct('anuncio');
        
        $this->setAttribute('method', 'post');
        
        $this->add(array(
            'name' => 'cdBarra',
            'type' => 'Text',
            'attributes' => array(
                'placeholder' => 'Código de Barras',
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'nmMat',
            'type' => 'Text',
            'attributes' => array(
                'placeholder' => 'Nome',
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'marca',
            'type' => 'Text',
            'attributes' => array(
                'placeholder' => 'Marca',
                'class' => 'form-control',
                
            ),
        ));
        $this->add(array(
            'name' => 'embalagem',
            'type' => 'Text',
            'attributes' => array(
                'placeholder' => 'Embalagem',
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'type' => 'Select',
            'name' => 'tpUnMedida',
            'tabindex' =>2,
            'options' => array(
                'empty_option' => 'Unidade de Medida',
                'value_options' => $this->getOptionsUnMedida(),
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'qtUnMedida',
            'type' => 'Text',
            'attributes' => array(
                'placeholder' => 'Quantidade Unidade de Medida',
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'preco',
            'type' => 'Text',
            'attributes' => array(
                'placeholder' => 'Preço',
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'latitude',
            'type' => 'Text',
            'attributes' => array(
                'placeholder' => 'Latitude',
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'longitude',
            'type' => 'Text',
            'attributes' => array(
                'placeholder' => 'Longitude',
                'class' => 'form-control',
            ),
        ));
        
        $this->add(array(
            'type' => 'Button',
            'name' => 'submit',
            'options' => array(
                'label' => 'Incluir',
            ),
            'attributes' => array(
                'type'  => 'button',
                'class' => 'btn btn-default',
                'id' => 'incluir'
             )
        ));
    }
    
    public function getOptionsUnMedida()
    {
        $dbAdapter = $this->adapter;
        $sql       = 'SELECT cd_un_med, nm_un_med, alias_un_medida FROM t003 ORDER BY alias_un_medida';
        $statement = $dbAdapter->query($sql);
        $result    = $statement->execute();

        $selectData = array();

        foreach ($result as $res) {
            $selectData[$res['cd_un_med']] = $res['alias_un_medida'];
        }
        return $selectData;
    }
}