<?php namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table      = 'cliente';
    protected $primaryKey = 'id';
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    // public function buscarClientes()
    // {
        
    //     $db = \Config\Database::connect();

    //     $query = $db->query("SELECT nombre_completo FROM cliente");
    //     $result = $query->getResultObject();
        
    //     $clientes = array(); 

    //     foreach($result as $value){
    //         array_push($clientes,$value->nombre_completo);
    //     }
  
    //     return $clientes;
    // }

 

}
