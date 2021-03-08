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
    public function traerPrecio()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT producto.id_Producto FROM producto INNER JOIN lista_de_precios ON producto.idListaPrecios=lista_de_precios.id WHERE lista_de_precios.fechaHasta IS NULL OR lista_de_precios.fechaHasta>NOW()");
        $results = $query->getResultObject();
       
        if($results)
		{
			foreach($results as $item)
			{
				$return_id = $item->id_Producto;
			}
		}
     
		return $return_id;
        
    }
    public function buscarProducto($row)
    {
        $idProd = $row;
        $db = \Config\Database::connect();
        if(is_object($row)){
        $idProd = $row->id_Producto;
        };
       
        $query = $db->query("SELECT nombre FROM producto WHERE id_Producto='$idProd'");
       
        $result = $query->getResultObject()[0]->nombre;
      
        
        return  $result;
    } 
    public function buscarPrecioXNomb($nombre)
    {
       
        $db = \Config\Database::connect();
       
        $query = $db->query("SELECT lista_de_precios.precio, producto.cod_barras FROM producto INNER JOIN lista_de_precios ON producto.idListaPrecios=lista_de_precios.id WHERE producto.nombre='$nombre' AND (lista_de_precios.fechaHasta IS NULL OR lista_de_precios.fechaHasta>NOW())");
       
        $result = $query->getResultObject()[0];
        
        return  $result;
    } 
    public function buscarListaProductos()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT nombre FROM producto");
        
        $result = $query->getResultObject();
        $productos = array(); 

        foreach($result as $value){
            array_push($productos,$value->nombre);
        }
 
        return  $productos;
    } 
    public function buscarCodBarra($row){
        $db = \Config\Database::connect();
        $idProd = $row->id_Producto;
        $query = $db->query("SELECT cod_barras FROM producto WHERE id_Producto='$idProd'");
        $result = $query->getResultObject()[0]->cod_barras;
        
        return  $result;
    }

    

}
