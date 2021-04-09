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
        if(empty($isCodBarra)){
            $isCodBarra='';
        }
       
        //crear producto
        $query5 = $db->query("SELECT MAX(id_Producto) AS id_Producto FROM producto");
        $results5 = $query5->getResultObject();
        $idProducto = $results5[0]->id_Producto + 1;

        $nombre = $stateparameters->data['nombre'];
     
       
        $query5 = $db->query("INSERT INTO `producto`(`id_Producto`, `nombre`, `cod_barras`) VALUES ($idProducto,'$nombre','$isCodBarra')");
       
        // crear listaprecio
        $query2 = $db->query("SELECT MAX(id) AS id FROM lista_de_precios");
        $results2 = $query2->getResultObject();
        $idListaPrecio = intval($results2[0]->id + 1);
        $precio = $stateparameters->data['precio'];
        if($precio==""){
            $precio=0;
        }
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
    public function buscarCantTotalLotes($row)
    {
        $db = \Config\Database::connect();
        $idProd = $row->id_Producto;

        $LotesxProd = $db->query("SELECT cantidad FROM lote WHERE id_Producto=$idProd");
        $LotesxProd = $LotesxProd->getResultObject();
        $cant=0;
        foreach ($LotesxProd as $cantidad ) {
            $cant+=$cantidad->cantidad;
        }
        return $cant;
    }
    public function editarProducto($stateparameters)
    {
        $db = \Config\Database::connect();
        $idProd =  intval($stateparameters->primaryKeyValue);
        $nombre = $stateparameters->data['nombre'];
        $codBarra = $stateparameters->data['cod_barras'];
        $precio = floatval($stateparameters->data['precio']);

        //update producto
        $editProd = $db->query("UPDATE `producto` SET `nombre`=$nombre,`cod_barras`=$codBarra WHERE `id_Producto`=$idProd");

        //eliminar(soft) ultimo precio
        $ultPrecio = $db->query("SELECT id FROM lista_de_precios WHERE id_Producto=$idProd AND fechaHasta IS NULL");
        $ultPrecio = intval($ultPrecio->getResultObject()[0]->id);
        $elimPrecio =  $db->query("UPDATE `lista_de_precios` SET `fechaHasta`= NOW() WHERE id=$ultPrecio");
        //crear nuevo precio
        $query2 = $db->query("SELECT MAX(id) AS id FROM lista_de_precios");
        $results2 = $query2->getResultObject();
        $idListaPrecio = intval($results2[0]->id + 1);
        $nuevoPrecio = $db->query("INSERT INTO `lista_de_precios`(`id`, `fechaDesde`, `fechaHasta`, `precio`, `id_Producto`) VALUES ($idListaPrecio,NOW(),NULL,$precio,$idProd)");
        
        return;
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
    public function buscarPrecioActual($row)
    {
        $db = \Config\Database::connect();
        $idProd = $row->id_Producto;
        $precioActual = $db->query("SELECT precio FROM lista_de_precios WHERE id_Producto=$idProd AND fechaHasta IS NULL");
        try {
            $result = $precioActual->getResultObject()[0]->precio;
        } catch (\Throwable $th) {
           return 0;
        }
        $result = $precioActual->getResultObject()[0]->precio;
        return $result;
    }
    public function UltimaFechaCambioPrecio($row)
    {
        $db = \Config\Database::connect();
        $idProd = $row->id_Producto;
        $UltimaFechaCambPrecio= $db->query("SELECT fechaHasta FROM lista_de_precios WHERE id_Producto=$idProd AND fechaHasta IS NOT NULL ORDER BY fechaHasta desc");
        try {
            $result = $UltimaFechaCambPrecio->getResultObject()[0]->fechaHasta;
            //  var_dump($result);die;
        } catch (\Throwable $th) {
           return NULL;
        }
        // $result = $precioActual->getResultObject()[0]->precio;
       
        return $result;
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
