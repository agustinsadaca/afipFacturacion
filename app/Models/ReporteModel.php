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
    public function getVentaMensual()
    {
        /* -------------------------------------------------------------------------- */
        /*                     conexion a base de datos y consulta                    */
        /* -------------------------------------------------------------------------- */

        $principioMes = date('Y-m-01 00:00:00');
        $FinalMes = date('Y-m-t 23:59:59');
        $db = \Config\Database::connect();
        $queryVentasMensuales = $db->query("SELECT SUM(f.total) AS Total,
		MONTH(f.date) AS Mes,
       CASE WHEN MONTH(f.date) = 1 THEN 'enero'
        WHEN MONTH(f.date) = 2 THEN 'febrero'
        WHEN MONTH(f.date) = 3 THEN 'marzo'
        WHEN MONTH(f.date) = 4 THEN 'abril'
        WHEN MONTH(f.date) = 5 THEN 'mayo'
        WHEN MONTH(f.date) = 6 THEN 'junio'
        WHEN MONTH(f.date) = 7 THEN 'julio'
        WHEN MONTH(f.date) = 8 THEN 'agosto'
        WHEN MONTH(f.date) = 9 THEN 'septiembre'
        WHEN MONTH(f.date) = 10 THEN 'octubre'
        END AS MesNombre
        FROM factura f
        GROUP BY Mes");
        $resultsMensual = $queryVentasMensuales->getResultObject();
        // echo '<pre>';
        // var_dump($resultsMensual);die;
        $queryVentasDiarias = $db->query("SELECT SUM(f.total) AS Total,
		DAY(f.date) AS DayOfMonth
        FROM factura f
        WHERE
            f.date BETWEEN '$principioMes' AND  '$FinalMes'
        GROUP BY DayOfMonth;");
        $resultsDiarias = $queryVentasDiarias->getResultObject();
        $ventas = array();
        array_push( $ventas,$resultsMensual,$resultsDiarias);

        return $ventas;
    }

 

}

