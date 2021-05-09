<?php namespace App\Models;

use CodeIgniter\Model;

class FacturaAfipModel extends Model
{
    protected $table      = 'factura_afip';
    protected $primaryKey = 'id';
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    public function buscarFacturasSeleccionadas($ids)
    {
        var_dump($ids);die;
        $db = \Config\Database::connect();

        $query = $db->query("SELECT ");

    }

    

}
