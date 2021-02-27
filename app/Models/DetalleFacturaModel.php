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


    

    public function guardarProducto($stateparameter,$idFactura)
    {
        $db = \Config\Database::connect();
       
        $query1 = $db->query("SELECT producto.id_Producto, producto.nombre, lista_de_precios.precio FROM producto INNER JOIN lista_de_precios ON producto.idListaPrecios=lista_de_precios.id WHERE lista_de_precios.fechaHasta IS NULL OR lista_de_precios.fechaHasta>NOW()");
        $results1 = $query1->getResultObject();
        $productos = array_column($results1, 'nombre');
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

        return($nombProducto);
    } 
    

}
