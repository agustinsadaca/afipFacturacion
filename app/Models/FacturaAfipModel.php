<?php namespace App\Models;

use CodeIgniter\Model;

class FacturaAfipModel extends Model
{
    protected $table      = 'factura_afip';
    protected $primaryKey = 'id';
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    public function buscarFacturasSeleccionadas($ids)
    {
        $db = \Config\Database::connect();

        foreach($ids as $factura){
					try {
						$idFactura = intval($factura);
						$buscarFactura = $db->query("SELECT * FROM  factura_estado_fecha WHERE id_factura=$factura AND fecha_hasta is NULL ");
						$resultado = $buscarFactura->getResultObject()[0];

						if(!empty($resultado) && ($resultado->id_factura_estado) != '1' && ($resultado->id_factura_estado) != '5'){
							//cambiar estado anterior
							$idFacturaEstadoFecha = intval($resultado->id);
							$cambiarEstado = $db->query("UPDATE `factura_estado_fecha` SET `fecha_desde`= CURDATE(),`id_factura`=$idFactura,`id_factura_estado`= 1  WHERE `id`= $idFacturaEstadoFecha");
						}
					}catch(\Throwable $th) 
					{
						$cambiarEstado = $db->query("INSERT INTO `factura_estado_fecha`(`fecha_desde`, `fecha_hasta`, `id_factura`, `id_factura_estado`) 
						VALUES (CURDATE(),null,$idFactura,1)");
					}				
        }
				$buscarTodasFacturas = $db->query("SELECT factura_afip.id , factura_afip.total ,factura_afip.id_cliente,factura_afip.id_tipo_comprobante 
				FROM  factura_afip INNER JOIN factura_estado_fecha 
				ON factura_afip.id=factura_estado_fecha.id_factura 
				WHERE factura_estado_fecha.id_factura_estado=1");
				$buscarTodasFacturas = $buscarTodasFacturas->getResultObject();

				return $buscarTodasFacturas;
    }
		public function buscarEstadosFacturas($row)
		{
			$db = \Config\Database::connect();
			$idFactura = intval($row->id);

			try {
				$buscarFactura = $db->query("SELECT factura_estado.nombre_estado 
				FROM  factura_estado_fecha 
				INNER JOIN factura_estado ON factura_estado_fecha.id_factura_estado=factura_estado.id
				WHERE factura_estado_fecha.id_factura=$idFactura AND fecha_hasta is NULL ");
				$resultado = $buscarFactura->getResultObject()[0]->nombre_estado;
			
			} catch (\Throwable $th) {
				
				return '';

			}
	
			return $resultado;
		}
		public function buscarFacturasAfipEnviar()
		{
			$db = \Config\Database::connect();
			$buscarFacturas = $db->query("SELECT *,factura_estado_fecha.id FROM factura_estado_fecha 
			INNER JOIN factura_afip on factura_afip.id=factura_estado_fecha.id_factura 
			LEFT JOIN cliente on  factura_afip.id_cliente=cliente.id
			WHERE factura_estado_fecha.id_factura_estado=1");
			$buscarFacturas = $buscarFacturas->getResultObject();
	
			return $buscarFacturas;
			
		}
		public function asignarCaeFacturaAfip($resCae,$factura)
		{
			// var_dump($resCae);
			// var_dump($factura);die;
			try {
				$db = \Config\Database::connect();
				if($resCae["CAE"] != "")
				{
					$cae = $resCae["CAE"];
					$cambiarEstadoExito = $db->query("UPDATE `factura_estado_fecha` 
					SET `fecha_desde`=CURDATE(),`id_factura_estado`=5 
					WHERE id= $factura->id
					");
					$agregarCae = $db->query("UPDATE `factura_afip` 
					SET `nro_cae`= $cae WHERE id = $factura->id_factura
					");
					return;

				}
			} catch (\Throwable $th) {
				$cambiarEstadoError = $db->query("UPDATE `factura_estado_fecha` 
				SET `fecha_desde`=CURDATE(),`id_factura_estado`=2 
				WHERE id= $factura->id
				");
				return;
				
			}

		}

    

}
