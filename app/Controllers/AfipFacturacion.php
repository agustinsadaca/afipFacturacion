<?php

namespace App\Controllers;
use App\Libraries\GroceryCrud;
use App\Models\FacturaModel;
use App\Models\FacturaAfipModel;
use Afip;
// include '../..//src/Afip.php';
use App\Config\Validation;




class AfipFacturacion extends AdminLayout
{
    public function afip()
	{
        global $fD;
        global $fH;
        
        
        $crud = new GroceryCrud();
        
        $arrayColumns = [
            'id','fecha_creacion','total','nro_cae','nro_comprobante','id_cliente','id_tipo_comprobante','estado_factura'
        ];
        $arrayAddEdit = [
            'id','fecha_creacion','total','nro_cae','id_cliente','id_tipo_comprobante','nro_comprobante'
        ];

        //// SETS GENERALES
        $crud->setTheme('datatableCheckBox');
        $crud->setTable('factura_afip');
        $crud->displayAs('fecha_creacion','Fecha de creación');
        $crud->displayAs('id_tipo_comprobante','Tipo de Comprobante');
        $crud->displayAs('id','Id');
        $crud->displayAs('estado_factura','Estado Factura');
        $crud->setSubject('Factura Afip');
        $crud->columns($arrayColumns);
        $crud->editFields($arrayAddEdit);
        $crud->addFields($arrayAddEdit);
        $crud->setRelation('id_cliente', 'cliente', '{nombre} {apellido}');
        $crud->setRelation('id_tipo_comprobante', 'tipo_comprobante', 'nombre_tipo');
        $crud->requiredFields(['fecha_creacion','total','id_tipo_comprobante']);
        $crud->setRule('total','total','greater_than[0]'); 
        $crud->setRule('id_cliente','id_cliente','agregarCliente[id_cliente]'); 
        $crud->setRule('nro_comprobante', 'nro_comprobante', 'agregarComprobante[id_tipo_comprobante,id_cliente]');
              
        $crud->callbackColumn('estado_factura', function ($value, $row) {
        
            $buscarEstadosFacturas = new FacturaAfipModel();
            $resultado =  $buscarEstadosFacturas->buscarEstadosFacturas($row);
           
            switch ($resultado) {
                case 'creada con exito':
                    return  '<p class="btn btn-success">'.$resultado.'</p>';
                    break;
                
                case 'procesando':
                    return  '<p class="btn btn-warning">'.$resultado.'</p>';
                    break;
                case 'error':
                    return  '<p class="btn btn-danger">'.$resultado.'</p>';
                    break;
            }
            
        });
        if ($crud->getState() == 'add') 
        {
            $crud->displayAs('nro_comprobante','Nro Comprobante(solo para notas de crédito y débito)');
            $crud->fieldType('id', 'hidden'); 
            $crud->fieldType('nro_cae', 'hidden'); 
        }
        if ($crud->getState() == 'edit') 
        {
            $crud->fieldType('id', 'readonly'); 
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
           try {
                session()->set('fechaDesde',$_POST['fechaDesde']);
                session()->set('fechaHasta',$_POST['fechaHasta']);
            } catch (\Throwable $th) {    
           }
        }
        $fD = session()->get('fechaDesde');
        $fH = session()->get('fechaHasta') ;

        $fechaDesde = $this->convertirFecha($fD);
        $fechaHasta = $this->convertirFecha($fH);

        
        if($fechaHasta!=""){
            $crud->where(
                "factura_afip.fecha_creacion<=$fechaHasta"
            );   
        }
        if($fechaDesde!=""){
            $crud->where(
                "factura_afip.fecha_creacion>=$fechaDesde"
            );
        }

        
        $statusAfipServer = json_encode($this->getStatusServer());
        $this->buscarFacturasAfipEnviar();
        
        $data = array();
        $data['serverStatus'] = $statusAfipServer;
        $data['view'] = 'afip.php';
        $data['grocery'] = $crud;
        return $this->render($data);
    }
    function required_without($str , string $fields, array $data): bool
    {
        var_dump($str);
        var_dump($fields);
        var_dump($data);die;
        return false;
    
    }
    public function convertirFecha($fecha)
    {
        try {
            $fechaResult = explode('/',$fecha);
            $fechaResult = $fechaResult[2].$fechaResult[0].$fechaResult[1];
        } catch (\Throwable $th) {
            return $fechaResult="";
        }
        return $fechaResult;
    }
    public function getStatusServer()
    {   
        try {
            $afip = new Afip(array('CUIT' => 23213764519,'production'=>False));
            $server_status = $afip->ElectronicBilling->GetServerStatus();
            
            if($server_status->AppServer == "OK")
            {
                return true;
            }else{
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    
    }
    public function guardarFacturasSeleccionadasAfip()
    {
        $idFacturasAfip = json_decode($_POST['resultado']);
        if($idFacturasAfip[0]=="on"){
            unset($idFacturasAfip[0]);
        }
        $buscarFacturas = new FacturaAfipModel();
        $resultado =  $buscarFacturas->buscarFacturasSeleccionadas($idFacturasAfip);

        header('Location:'.base_url().'/AfipFacturacion/afip/');
        exit;
        
    }

    public function buscarFacturasAfipEnviar()
    {
        $buscarFacturas = new FacturaAfipModel();
        $resultado =  $buscarFacturas->buscarFacturasAfipEnviar();
        $this->generarFacturaAfip($resultado);
        return;
    }
    public function generarFacturaAfip($facturasEnviar)
    {
        // echo '<pre>';
        // var_dump($facturasEnviar);die;
        foreach($facturasEnviar as $factura)
        {
        // var_dump($factura);die;
        
        $neto = round(intval($factura->total)/ 1.21, 2);
        $iva =  round($neto * 0.21, 2);
        $tipoComprobante = intval($factura->id_tipo_comprobante);
        $data = array(
            'CantReg' 		=> 1, // Cantidad de comprobantes a registrar
            'PtoVta' 		=> 1, // Punto de venta
            'CbteTipo' 		=> $tipoComprobante, // Tipo de comprobante (ver tipos disponibles) 
            'Concepto' 		=> 1, // Concepto del Comprobante: (1)Productos, (2)Servicios, (3)Productos y Servicios
            'DocTipo' 		=> 99, // Tipo de documento del comprador (ver tipos disponibles)
            'DocNro' 		=> 0, // Numero de documento del comprador
            'CbteDesde' 	=> 1, // Numero de comprobante o numero del primer comprobante en caso de ser mas de uno
            'CbteHasta' 	=> 1, // Numero de comprobante o numero del ultimo comprobante en caso de ser mas de uno
            'CbteFch'  		=> intval(date('Ymd')), // (Opcional) Fecha del comprobante (yyyymmdd) o fecha actual si es nulo
            'ImpTotal' 		=> intval($factura->total), // Importe total del comprobante
            'ImpTotConc' 	=> 0, // Importe neto no gravado
            'ImpNeto' 		=> $neto, // Importe neto gravado
            'ImpOpEx' 		=> 0, // Importe exento de IVA
            'ImpIVA' 		=> $iva, //Importe total de IVA
            'ImpTrib' 		=> 0, //Importe total de tributos
            'FchServDesde' 	=> NULL, // (Opcional) Fecha de inicio del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
            'FchServHasta' 	=> NULL, // (Opcional) Fecha de fin del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
            'FchVtoPago' 	=> NULL, // (Opcional) Fecha de vencimiento del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
            'MonId' 		=> 'PES', //Tipo de moneda usada en el comprobante (ver tipos disponibles)('PES' para pesos argentinos) 
            'MonCotiz' 		=> 1, // Cotización de la moneda usada (1 para pesos argentinos)  
            // 'CbtesAsoc' 	=> array( // (Opcional) Comprobantes asociados
                // array(
                //     'Tipo' 		=> 8, // Tipo de comprobante (ver tipos disponibles) 
                //     'PtoVta' 	=> 1, // Punto de venta
                //     'Nro' 		=> 44, // Numero de comprobante
                //     // 'Cuit' 		=> 20111111112 // (Opcional) Cuit del emisor del comprobante
                //     )
                // ),
       
        );
        
        $ivaArray =  array( // (Opcional) Alícuotas asociadas al comprobante
                array(
                    'Id' 		=> 5, // Id del tipo de IVA (ver tipos disponibles) 
                    'BaseImp' 	=> $neto, // Base imponible
                    'Importe' 	=> $iva // Importe 
                ));
        $data['Iva'] = $ivaArray;

        if($tipoComprobante == 2 || $tipoComprobante == 3 || $tipoComprobante == 7 || $tipoComprobante == 8)
        {
            $compAsociado= array( // (Opcional) Comprobantes asociados
                array(
                    'Tipo' 		=> $tipoComprobante, // Tipo de comprobante (ver tipos disponibles) 
                    'PtoVta' 	=> 1, // Punto de venta
                    'Nro' 		=> intval($factura->nro_comprobante), // Numero de comprobante
                    // 'Cuit' 		=> 20111111112 // (Opcional) Cuit del emisor del comprobante
                    )
                );
            $data['CbtesAsoc'] = $compAsociado;

        }
        
        if(!is_null($factura->id_cliente))
        {
            $data['DocTipo'] = 80;
            $data['DocNro'] = intval($factura->cuit);
        }

        try {
            $afip = new Afip(array('CUIT' => 23213764519,'production'=>False));
            $res = $afip->ElectronicBilling->CreateNextVoucher($data);
            // echo '<pre>'    ;
            // var_dump($res);die;
          
            $last = $afip->ElectronicBilling->GetLastVoucher(1,1); //Devuelve el número del último comprobante creado para el punto de venta 1 y el tipo de comprobante 6 
            $voucher_info = $afip->ElectronicBilling->GetVoucherInfo($last,1,8); //Devuelve la información del comprobante 1 para el punto de venta 1 y el tipo de comprobante 6 (Factura B)
          
            $asignarCae = new FacturaAfipModel();
            $resultado =  $asignarCae->asignarCaeFacturaAfip($res,$factura);
           
        } catch (\Throwable $th) {
            $asignarCae = new FacturaAfipModel();
            $res ="";
            echo '<pre>'    ;
            var_dump($th);die;
            $resultado =  $asignarCae->asignarCaeFacturaAfip($res,$factura);  
        }    
        }
        return;

    }
    public function generarFacturaAfip123123213()
    {
        
        $data = array(
            'CantReg' 		=> 1, // Cantidad de comprobantes a registrar
            'PtoVta' 		=> 1, // Punto de venta
            'CbteTipo' 		=> 6, // Tipo de comprobante (ver tipos disponibles) 
            'Concepto' 		=> 1, // Concepto del Comprobante: (1)Productos, (2)Servicios, (3)Productos y Servicios
            'DocTipo' 		=> 99, // Tipo de documento del comprador (ver tipos disponibles)
            'DocNro' 		=> 0, // Numero de documento del comprador
            'CbteDesde' 	=> 1, // Numero de comprobante o numero del primer comprobante en caso de ser mas de uno
            'CbteHasta' 	=> 1, // Numero de comprobante o numero del ultimo comprobante en caso de ser mas de uno
            'CbteFch'  		=> intval(date('Ymd')), // (Opcional) Fecha del comprobante (yyyymmdd) o fecha actual si es nulo
            'ImpTotal' 		=> 10, // Importe total del comprobante
            'ImpTotConc' 	=> 0, // Importe neto no gravado
            'ImpNeto' 		=> 8.26, // Importe neto gravado
            'ImpOpEx' 		=> 0, // Importe exento de IVA
            'ImpIVA' 		=> 1.73, //Importe total de IVA
            'ImpTrib' 		=> 0, //Importe total de tributos
            'FchServDesde' 	=> NULL, // (Opcional) Fecha de inicio del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
            'FchServHasta' 	=> NULL, // (Opcional) Fecha de fin del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
            'FchVtoPago' 	=> NULL, // (Opcional) Fecha de vencimiento del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
            'MonId' 		=> 'PES', //Tipo de moneda usada en el comprobante (ver tipos disponibles)('PES' para pesos argentinos) 
            'MonCotiz' 		=> 1, // Cotización de la moneda usada (1 para pesos argentinos)  
            // 'CbtesAsoc' 	=> array( // (Opcional) Comprobantes asociados
            //     array(
            //         'Tipo' 		=> 8, // Tipo de comprobante (ver tipos disponibles) 
            //         'PtoVta' 	=> 1, // Punto de venta
            //         'Nro' 		=> 13, // Numero de comprobante
            //         // 'Cuit' 		=> 20111111112 // (Opcional) Cuit del emisor del comprobante
            //         )
            //     ),
            // 'Tributos' 		=> array( // (Opcional) Tributos asociados al comprobante
            // 	array(
            // 		'Id' 		=>  99, // Id del tipo de tributo (ver tipos disponibles) 
            // 		'Desc' 		=> 'Ingresos Brutos', // (Opcional) Descripcion
            // 		'BaseImp' 	=> 150, // Base imponible para el tributo
            // 		'Alic' 		=> 5.2, // Alícuota
            // 		'Importe' 	=> 7.8 // Importe del tributo
            // 	)
            // ), 
            'Iva' 			=> array( // (Opcional) Alícuotas asociadas al comprobante
                array(
                    'Id' 		=> 5, // Id del tipo de IVA (ver tipos disponibles) 
                    'BaseImp' 	=> 8.26, // Base imponible
                    'Importe' 	=> 1.73 // Importe 
                )
            // ), 
            // 'Opcionales' 	=> array( // (Opcional) Campos auxiliares
            // 	array(
            // 		'Id' 		=> 17, // Codigo de tipo de opcion (ver tipos disponibles) 
            // 		'Valor' 	=> 2 // Valor 
            // 	)
            // ), 
            // 'Compradores' 	=> array( // (Opcional) Detalles de los clientes del comprobante 
            // 	array(
            // 		'DocTipo' 		=> 80, // Tipo de documento (ver tipos disponibles) 
            // 		'DocNro' 		=> 20111111112, // Numero de documento
            // 		'Porcentaje' 	=> 100 // Porcentaje de titularidad del comprador
            // 	)
            )
        );
        // phpinfo();die;
        $afip = new Afip(array('CUIT' => 23213764519,'production'=>False));
        $neto = round(10 / 1.21, 2);
        $iva =  round($neto * 0.21, 2);
        // var_dump($iva);die;
        // $server_status = $afip->ElectronicBilling->GetVoucherTypes();
        // echo '<pre>';
        // var_dump($server_status);die;
        
        $last = $afip->ElectronicBilling->GetLastVoucher(1,8); //Devuelve la información del comprobante 1 para el punto de venta 1 y el tipo de comprobante 6 (Factura B)
        $voucher_info = $afip->ElectronicBilling->GetVoucherInfo($last,1,6); //Devuelve la información del comprobante 1 para el punto de venta 1 y el tipo de comprobante 6 (Factura B)

        if($voucher_info === NULL){
            echo 'El comprobante no existe';
        }
        else{
            echo 'Esta es la información del comprobante:';
            echo '<pre>';
            print_r($voucher_info);die;
            echo '</pre>';
        }
      
        $res = $afip->ElectronicBilling->CreateNextVoucher($data);
        $res['CAE']; //CAE asignado el comprobante
        $res['CAEFchVto']; //Fecha de vencimiento del CAE (yyyy-mm-dd)
        $res['voucher_number'];
        var_dump($res);die;
    }


}
