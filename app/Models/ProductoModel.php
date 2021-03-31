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


    

    public function traerPrecioProd($value,$row){
        $idProd = $row->id_Producto;

        $db = \Config\Database::connect();
        $query1 = $db->query("SELECT precio FROM producto INNER JOIN lista_de_precios ON producto.id_Producto=lista_de_precios.id_Producto WHERE producto.id_Producto='$idProd' AND (lista_de_precios.fechaHasta IS NULL OR lista_de_precios.fechaHasta>NOW())");
        $precioProd = $query1->getResultObject()[0]->precio;

        return $precioProd;
    }
    public function añadirProducto($stateparameters)
    {
        
        $db = \Config\Database::connect();
        
        $id = $stateparameters->insertId;
  
        $codigo_barras = $stateparameters->data['cod_barras'];
        $query1 = $db->query("SELECT producto.cod_barras FROM producto WHERE cod_barras='$codigo_barras'");
        $isCodBarra = $query1->getResultObject();
   
        //crear producto
        $query5 = $db->query("SELECT MAX(id_Producto) AS id_Producto FROM producto");
        $results5 = $query5->getResultObject();
        $idProducto = $results5[0]->id_Producto + 1;

        $nombre = $stateparameters->data['nombre'];
       
        $query5 = $db->query("INSERT INTO `producto`(`id_Producto`, `nombre`, `cod_barras`) VALUES ($idProducto,'$nombre',$codigo_barras)");
        //setear si existe fecha hasta ultimo precio para ese prod
        try {
             $buscarPrecioDesac =  $db->query("SELECT * FROM lista_de_precios INNER JOIN producto ON lista_de_precios.id_Producto=producto.id_Producto WHERE producto.id");
        } catch (\Throwable $th) {

        }
     
        // crear listaprecio
        $query2 = $db->query("SELECT MAX(id) AS id FROM lista_de_precios");
        $results2 = $query2->getResultObject();
        $idListaPrecio = $results2[0]->id + 1;
        $precio = $stateparameters->data['precio'];

        $query = $db->query("INSERT INTO `lista_de_precios`(`id`, `fechaDesde`, `fechaHasta`, `precio`,`id_Producto`) VALUES ($idListaPrecio,NOW(),NULL,$precio,$idProducto)");
        
        //crear lote
        $query3 = $db->query("SELECT MAX(id) AS id FROM lote");
        $results3 = $query3->getResultObject();
        $idLote = $results3[0]->id + 1;
     
        $fechaVencimiento = str_replace("/","-",$stateparameters->data['fechaVencimiento']);
        $fechaVenc = explode(" ",$fechaVencimiento);
        $fechaVen = explode("-",$fechaVenc[0]);
        $fechaVe = $fechaVen[2]."-".$fechaVen[1]."-".$fechaVen[0]." ".$fechaVenc[1];
      
        $cantidad = floatval($stateparameters->data['Cantidad']);
        // var_dump($cantidad);die;
        $query4 = $db->query("INSERT INTO `lote`(`id`, `fechaCompra`, `fechaVencimiento`, `cantidad`, `id_Producto`) VALUES ($idLote,NOW(),'$fechaVe',$cantidad,$idProducto)");
       
		return $idProducto;
        
    }

    // public function traerPrecio()
    // {
    //     $db = \Config\Database::connect();
    //     $query = $db->query("SELECT producto.id_Producto FROM producto INNER JOIN lista_de_precios ON producto.idListaPrecios=lista_de_precios.id WHERE lista_de_precios.fechaHasta IS NULL OR lista_de_precios.fechaHasta>NOW()");
    //     $results = $query->getResultObject();
       
    //     if($results)
	// 	{
	// 		foreach($results as $item)
	// 		{
	// 			$return_id = $item->id_Producto;
	// 		}
	// 	}
     
	// 	return $return_id;
        
    // }
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
       
        $query = $db->query("SELECT lista_de_precios.precio, producto.cod_barras FROM producto INNER JOIN lista_de_precios ON producto.id_Producto=lista_de_precios.id_Producto WHERE producto.nombre='$nombre' AND (lista_de_precios.fechaHasta IS NULL OR lista_de_precios.fechaHasta>NOW())");
      
        // $query1= $db->query("SELECT lista_de_precios.precio, producto.cod_barras FROM producto INNER JOIN lista_de_precios ON producto.id_Producto=lista_de_precios.id_Producto WHERE producto.nombre='$nombre' AND (lista_de_precios.fechaHasta IS NULL OR lista_de_precios.fechaHasta>NOW())");
       
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
