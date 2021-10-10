<?php namespace App\Models;

use CodeIgniter\Model;

class ReporteModel extends Model
{
    /* -------------------------------------------------------------------------- */
    /*                  Parametros para conexión a base de datos                  */
    /* -------------------------------------------------------------------------- */
    protected $table      = 'producto';
    protected $primaryKey = 'id';
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function buscarProductosMasVendidosMesActual()
    {
        /* -------------------------------------------------------------------------- */
        /*                     conexion a base de datos y consulta                    */
        /* -------------------------------------------------------------------------- */
        $principioMes = date('Y-m-01 00:00:00');
        $FinalMes = date('Y-m-t 23:59:59');
        
        $db = \Config\Database::connect();
        $query = $db->query("SELECT  prod.id_Producto,prod.nombre,
        SUM(detF.cantidad) AS totalVenta
        FROM
            factura
        INNER JOIN detalle_factura detF ON
            (detF.id_factura = factura.id)
        INNER JOIN producto prod ON
            (
                prod.id_Producto = detF.id_Producto
            )
        WHERE
            factura.date BETWEEN '$principioMes' AND  '$FinalMes'
        GROUP BY
            prod.id_Producto
        ORDER BY
            totalVenta
        DESC
        LIMIT 6");
       
        
        $results = $query->getResultObject();
        // var_dump( $results);die;

        return $results;
    }
    public function buscarProductosMasVendidosMesAnterior()
    {
        /* -------------------------------------------------------------------------- */
        /*                     conexion a base de datos y consulta                    */
        /* -------------------------------------------------------------------------- */
        $principioMes = date('Y-m-01 00:00:00',strtotime('last month'));
        $FinalMes = date('Y-m-t 23:59:59',strtotime('last month'));
        
        $db = \Config\Database::connect();
        $query = $db->query("SELECT  prod.id_Producto,prod.nombre,
        SUM(detF.cantidad) AS totalVenta
        FROM
            factura
        INNER JOIN detalle_factura detF ON
            (detF.id_factura = factura.id)
        INNER JOIN producto prod ON
            (
                prod.id_Producto = detF.id_Producto
            )
        WHERE
            factura.date BETWEEN '$principioMes' AND  '$FinalMes'
        GROUP BY
            prod.id_Producto
        ORDER BY
            totalVenta
        DESC
        LIMIT 6");
       
       
        $results = $query->getResultObject();

        return $results;
    }
    public function getVentaMensualYDiaria()
    {
        /* -------------------------------------------------------------------------- */
        /*                     conexion a base de datos y consulta                    */
        /* -------------------------------------------------------------------------- */
        $principioMes = date('Y-m-01 00:00:00');
        $FinalMes = date('Y-m-t 23:59:59');
        
        $comienzoDia = date('Y-m-d 00:00:00');
        $FinalDia = date('Y-m-d 23:59:59');
        
        $db = \Config\Database::connect();
        $query = $db->query("SELECT  
        SUM(factura.total) AS ventaMensual
        FROM
            factura
    
        WHERE
            factura.date BETWEEN '$principioMes' AND  '$FinalMes'
   
        ");
        $resultsMensual = $query->getResultObject()[0];
        $queryVentaDiaria = $db->query("SELECT  
        SUM(factura.total) AS ventaDiaria
        FROM
            factura
    
        WHERE
            factura.date BETWEEN '$comienzoDia' AND  '$FinalDia'
   
        ");
        $resultsDiario = $queryVentaDiaria->getResultObject()[0];
        
        $ventas = array();
        array_push( $ventas,$resultsMensual,$resultsDiario);

        return json_encode($ventas);
    }

 

}
