<?php
namespace Anuncio\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\AbstractTableGateway;

class AnuncioTable extends AbstractTableGateway
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function geAnuncio($cdBarra)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('cd_barra' => $cdBarra));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Não foi possivel encontrar o código de barra $cdBarra");
        }
        return $row;
    }

    public function atualizaAlbum(Anuncio $anuncio)
    {
        $data = array(
            'nm_mat' => $anuncio->nmMat,
            'marca_mat'  => $anuncio->marca,
            'cd_emb'  => $anuncio->embalagem,
            'cd_un_med'  => $anuncio->tpUnMedida,
            'qt_un_medida'  => $anuncio->qtUnMedida,
            'preco_mat'  => $anuncio->preco,
            'lat_mat'  => $anuncio->latitude,
            'long_mat'  => $anuncio->longitude,
        );

        
        if ($this->geAnuncio($anuncio['cdBarra'])) {
            $this->tableGateway->update($data, array('cdBarra' => $anuncio['cdBarra']));
        } else {
            throw new \Exception('Anuncio não existe!');
        }
        
    }
    
    public function insereAnuncio(Anuncio $anuncio){
        
        $data = array(
            'cd_barra' => $anuncio->cdBarra,
            'nm_mat' => $anuncio->nmMat,
            'marca_mat'  => $anuncio->marca,
            'cd_emb'  => $anuncio->embalagem,
            'cd_un_med'  => $anuncio->tpUnMedida,
            'qt_un_medida'  => $anuncio->qtUnMedida,
            'preco_mat'  => $anuncio->preco,
            'lat_mat'  => $anuncio->latitude,
            'long_mat'  => $anuncio->longitude,
        );
        
        $this->tableGateway->insert($data);
        
    }

    public function deletaAlbum($cdBarra)
    {
        $this->tableGateway->delete(array('cdBarra' => $cdBarra));
    }
}