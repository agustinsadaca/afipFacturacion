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
    public function finalizarCompra($idFactura,$totalFact,$pagaCon)
    {
        $db = \Config\Database::connect();

        $idFactura = intval($idFactura);
        $totalFact = floatval($totalFact);
        $pagaCon = floatval($pagaCon);
        $vuelto = floatval($pagaCon - $totalFact);

        $query = $db->query("UPDATE `factura` SET `total`=$totalFact,`paga_con`=$pagaCon,`vuelto`=$vuelto WHERE id=$idFactura");

        header('Location:'.base_url().'/PuntoVenta/venta');
        exit;
        
    }
    

}
