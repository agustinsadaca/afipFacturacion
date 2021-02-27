<?php namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table      = 'menu';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'email'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    function getMenues()
    {
        $menu = $this->where('parent', null)->findAll();
        return $menu;      
    }

    function getSubMenues($id_parent)
    {
        $sub_menues = $this->where('parent', $id_parent)->findAll();
        return $sub_menues;
    }

    function parseMenues(){
        $result_menues = array();
        
        
        $menues = $this->getMenues();

        foreach ($menues as $key => $menu) {
            $aux = array();
            $aux['menu'] = $menu;
            $aux['submenu'] = $this->getSubMenues($menu['id']);
            $result_menues[$menu['nombre']] = $aux;
        }

        return $result_menues;


    }
}