<?php namespace App\Models;

use CodeIgniter\Model;

class DetalleFacturaModel extends Model
{
    protected $table      = 'detalle_factura';
    protected $primaryKey = 'id_detalle_factura';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
 
    protected $useTimestamps = false;
 

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function guardarProducto1($stateparameter,$idFactura){

        $db = \Config\Database::connect();

        $query3 = $db->query("SELECT MAX(id_detalle_factura) AS id_detalle FROM detalle_factura");
        $results3 = $query3->getResultObject();
        $idDetalleF = $results3[0]->id_detalle + 1;

        $results2 = intval($stateparameter->data['id_Producto']);
        $cantidad = $stateparameter->data['num'];
       
        $query1 = $db->query("SELECT lista_de_precios.precio FROM producto INNER JOIN lista_de_precios ON producto.id_Producto=lista_de_precios.id_Producto WHERE producto.id_Producto='$results2' AND (lista_de_precios.fechaHasta IS NULL OR lista_de_precios.fechaHasta>NOW())");
        $precio = floatval($query1->getResultObject()[0]->precio);
        
        $subtotal =  $cantidad *  $precio;

        $query5 = $db->query("INSERT INTO `detalle_factura`(`id_detalle_factura`, `id_Producto`, `cantidad`, `subtotal`,`id_factura`) VALUES ('$idDetalleF','$results2','$cantidad',' $subtotal', '$idFactura')"); 
        
        return TRUE;
    }

    public function editarProductoDetalle($stateparameter,$idFactura){
        $th=TRUE;
        $db = \Config\Database::connect();
        // try {
            $idDetalleF = intval($stateparameter->primaryKeyValue);
  
            $results2 = intval($stateparameter->data['id_Producto']);
            $cantidad = floatval($stateparameter->data['num']);
            
            $query1 = $db->query("SELECT lista_de_precios.precio FROM producto INNER JOIN lista_de_precios ON producto.id_Producto=lista_de_precios.id_Producto WHERE producto.id_Producto='$results2' AND (lista_de_precios.fechaHasta IS NULL OR lista_de_precios.fechaHasta>NOW())");
            $precio = floatval($query1->getResultObject()[0]->precio);
       
            $subtotal =  $cantidad *  $precio;
           
            $query5 = $db->query("UPDATE `detalle_factura` SET `id_Producto`=$results2,`cantidad`=$cantidad,`subtotal`=$subtotal,`id_factura`=$idFactura WHERE id_detalle_factura=$idDetalleF"); 
       
            // } catch (\Throwable $th) {
        //    var_dump($res);die;
        // }
        // var_dump( $stateparameter);die;
      
        return $th;
    }

    public function guardarProducto($stateparameter,$idFactura)
    {
        $db = \Config\Database::connect();
   
 

        $th = NULL;
        // try {
            $query1 = $db->query("SELECT producto.id_Producto, producto.nombre, lista_de_precios.precio FROM producto INNER JOIN lista_de_precios ON producto.idListaPrecios=lista_de_precios.id WHERE lista_de_precios.fechaHasta IS NULL OR lista_de_precios.fechaHasta>NOW()");
            $results1 = $query1->getResultObject();
            $productos = array_column($results1, 'nombre');
            $nombProducto = $productos[$stateparameter->data['productos']];
            var_dump( $nombProducto);die;

            $query2 = $db->query("SELECT id_Producto FROM producto WHERE nombre='$nombProducto'");
            $results2 = (int)$query2->getResultObject()[0]->id_Producto;
            $nombProducto = $productos[$stateparameter->data['productos']];
        
            $query2 = $db->query("SELECT id_Producto FROM producto WHERE nombre='$nombProducto'");
            $results2 = (int)$query2->getResultObject()[0]->id_Producto;
    
            $cantidad = (float)$stateparameter->data['num'];
    
            $query3 = $db->query("SELECT MAX(id_detalle_factura) AS id_detalle FROM detalle_factura");
            $results3 = $query3->getResultObject();
            $idDetalleF = $results3[0]->id_detalle + 1;
    
            $query4 = $db->query("SELECT lista_de_precios.precio FROM producto INNER JOIN lista_de_precios ON producto.idListaPrecios=lista_de_precios.id WHERE (lista_de_precios.fechaHasta IS NULL OR lista_de_precios.fechaHasta>NOW()) AND producto.nombre='$nombProducto'");
            $precio = $query4->getResultObject()[0]->precio;
           
            $subtotal =  $cantidad *  $precio;
    
            $query5 = $db->query("INSERT INTO `detalle_factura`(`id_detalle_factura`, `id_Producto`, `cantidad`, `subtotal`,`id_factura`) VALUES ('$idDetalleF','$results2','$cantidad',' $subtotal', '$idFactura')
            "); 
        // } catch (\Throwable $th) {
           
        // }
      

        if(!isset($th)){
            return(TRUE);
        }else{
            return(FALSE);
        }
    } 
    public function agregarDetalleAutomatico($codBarra,$id)
    {
        $db = \Config\Database::connect();
        $detalleId = $db->query("SELECT MAX(id_detalle_factura) AS id_detalle FROM detalle_factura");
        $resultDetalleId = $detalleId->getResultObject();
        $idDetalleF = $resultDetalleId[0]->id_detalle + 1;
        
        $idProducto = $db->query("SELECT id_Producto FROM producto WHERE cod_barras='$codBarra'");
        $resultsIdProducto = (int)$idProducto->getResultObject()[0]->id_Producto;
   
        $precioProd = $db->query("SELECT lista_de_precios.precio FROM producto INNER JOIN lista_de_precios ON producto.id_Producto=lista_de_precios.id_Producto WHERE (lista_de_precios.fechaHasta IS NULL OR lista_de_precios.fechaHasta>NOW()) AND producto.id_Producto='$resultsIdProducto'");
        
        $precio = $precioProd->getResultObject()[0]->precio;
        $subtotal =  1 *  $precio;
        

        $query5 = $db->query("INSERT INTO `detalle_factura`(`id_detalle_factura`, `id_Producto`, `cantidad`, `subtotal`,`id_factura`) VALUES ('$idDetalleF','$resultsIdProducto','1',' $subtotal', '$id')
        "); 
        header('Location:'.base_url().'/PuntoVenta/carrito/'.$id);
        exit;
        return ;
        ;
       
    }
    public function buscarDetalleProducto($primaryKeyValue){
        $db = \Config\Database::connect();
        
        $detalleProd = $db->query("SELECT producto.nombre FROM detalle_factura INNER JOIN producto ON detalle_factura.id_Producto=producto.id_Producto WHERE id_detalle_factura='$primaryKeyValue'");
        $resultProdNomb = $detalleProd->getResultObject()[0]->nombre;
  
        return $resultProdNomb;
    }
    
    public function buscarCantidadDetalle($primaryKey){

        $db = \Config\Database::connect();
        
        $cantidad = $db->query("SELECT cantidad FROM detalle_factura WHERE id_detalle_factura=$primaryKey");
        $resultCantidad= $cantidad->getResultObject()[0]->cantidad;
        return $resultCantidad;
    }
    public function obtenerTotal($id){

        $db = \Config\Database::connect();
  
        $total = $db->query("SELECT subtotal FROM detalle_factura WHERE id_factura=$id");
        $resultTotal= $total->getResultObject();
        $totalFactura = 0;
        foreach($resultTotal as $value){
           
            $totalFactura += intval($value->subtotal);
        }
        return  $totalFactura;
    }
}
