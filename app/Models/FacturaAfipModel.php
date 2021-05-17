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
			$idFactura = $row->id;
			try {
				$buscarFactura = $db->query("SELECT factura_estado.nombre_estado 
				FROM  factura_estado_fecha 
				INNER JOIN factura_estado ON factura_estado_fecha.id_factura_estado=factura_estado.id
				WHERE factura_estado.id_factura=$idFactura AND fecha_hasta is NULL ");
				$resultado = $buscarFactura->getResultObject()[0];
				var_dump($resultado);die;
			} catch (\Throwable $th) {
				return '';
			}
			return $resultado;
		}

    

}
