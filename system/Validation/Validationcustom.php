<?php
namespace CodeIgniter\Validation;


class ValidationCustom
{ 

  public function agregarComprobante(string $str, string $fields = NULL, array $data = NULL, string &$error = NULL) : bool{            
   
    if($data['id_tipo_comprobante'] != 1 && $data['id_tipo_comprobante'] != 6 && ($str=="" || $data['id_cliente'] =="") ){
      //  var_dump($str);
      // var_dump($fields);
      // var_dump($data);die;
      return false;
    }else{
      return true;
    }
  }
  public function agregarCliente(string $str, string $fields = NULL, array $data = NULL, string &$error = NULL) : bool{            
  
    if(($data['id_tipo_comprobante'] ==1 || $data['id_tipo_comprobante'] ==2 || $data['id_tipo_comprobante'] ==3)  && $str=="" ){
     return false;
    }else{
      return true;
    }
  }

}
?>