<?php

namespace App\Controllers;
use App\Models\ProductoModel;
use App\Libraries\GroceryCrud;
use App\Models\FacturaModel;
use App\Models\ReporteModel;


class Reportes extends AdminLayout
{

    public function getReportes()
    {
        //SETS DATA TO VIEW
        $data = array();
        // $data['view'] = 'AdminLTE-3.1.0-rc/pages/charts/chartjs.html';
        $masVendidoMesActual = $this->getProductoMasVendidoMesActual();
        $masVendidoMesAnterior = $this->getProductoMasVendidoMensualAnterior();
        $ventasMensualesYDiaria = $this->getVentaMensualYDiaria();
        $data['view'] = 'reportes';
        $data['masVendidoMesActual'] = $masVendidoMesActual;
        $data['masVendidoMesAnterior'] = $masVendidoMesAnterior;
        $data['ventasMensualesYDiaria'] = $ventasMensualesYDiaria;
        return $this->render($data);

    }

    public function getProductoMasVendidoMesActual(){
        $reporte = new ReporteModel();
        $resultado =  $reporte->buscarProductosMasVendidosMesActual();
        //  echo json_encode($resultado);
        return $resultado;
    }
    function getProductoMasVendidoMensualAnterior(){
        $reporte = new ReporteModel();
        $resultado =  $reporte->buscarProductosMasVendidosMesAnterior();
        // return json_encode($resultado);
        return $resultado;
    }
    function getVentaMensualYDiaria(){
        $reporte = new ReporteModel();
        $resultado =  $reporte->getVentaMensualYDiaria();
        // return json_encode($resultado);
        return $resultado;
    }
}
