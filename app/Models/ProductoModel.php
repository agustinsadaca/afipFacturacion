<?php namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table      = 'producto';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
 
    protected $useTimestamps = false;
 

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    

    public function traerPrecioActualizado()
    {
        $db = \Config\Database::connect();

        $query = $db->query("SELECT producto.id_Producto, producto.nombre, lista_de_precios.precio FROM producto INNER JOIN lista_de_precios ON producto.idListaPrecios=lista_de_precios.id WHERE lista_de_precios.fechaHasta IS NULL OR lista_de_precios.fechaHasta>NOW()");
        // var_dump($query);die;
    
        $results = $query->getResultObject();

        $productos = array_column($results, 'nombre');
        $precios = array_column($results, 'precio');
        $result = array();
        $n = 0;
        foreach($productos as $valor){
               
                array_push($result,$valor.'##$'.$precios[$n]);
                $n += 1;       
        }

 
        return  $result;
    } 
    public function buscarProducto($row)
    {
        $db = \Config\Database::connect();
        $idProd = $row->id_Producto;
        $query = $db->query("SELECT nombre FROM producto WHERE id_Producto='$idProd'");
       
        $result = $query->getResultObject()[0]->nombre;
     
        return  $result;
    } 

    

}
