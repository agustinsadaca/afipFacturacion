<?php namespace App\Models;

use CodeIgniter\Model;

class LoteModel extends Model
{
    /* -------------------------------------------------------------------------- */
    /*                  Parametros para conexión a base de datos                  */
    /* -------------------------------------------------------------------------- */
    protected $table      = 'lote';
    protected $primaryKey = 'id';
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function agregarProductoAlLote($stateparameters,$idProducto)
    {
        /* -------------------------------------------------------------------------- */
        /*                     conexion a base de datos y consulta                    */
        /* -------------------------------------------------------------------------- */
        $idProducto = intval($idProducto);
        $idLote = intval($stateparameters->insertId);
        $db = \Config\Database::connect();
        $query = $db->query("UPDATE `lote` SET `id_Producto`=$idProducto WHERE 
        id=$idLote");

        return True;
    }

 

}
