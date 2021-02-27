<?php namespace App\Models;

use CodeIgniter\Model;

class FacturaModel extends Model
{
    protected $table      = 'factura';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
 
    protected $useTimestamps = false;
 

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    public function creaFactura()
    {
        
        $db = \Config\Database::connect();

        $query = $db->query("INSERT INTO establecimiento SET numero_establecimiento = '$nroEstablecimiento';");

        $results = $this->db->insertId();
    }

    public function actualizarUsuario($email)
    {
        $db = \Config\Database::connect();

        $query = $db->query("UPDATE usuario SET categoria_id = '2' WHERE email = '$email';");

    } 

}
