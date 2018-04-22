<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventary_model extends CI_Model{

  public $variable;
    public function __contruct()
    {
        parent::__contruct();
        $this->load->database();
    }

	function guardar($post)
	{
        $datosProducto = array();

        $datosProducto['idCategoria'] = $post['idCategoria'];
        $datosProducto['Nombre'] = $post['Nombre'];
        $datosProducto['Descripcion'] = $post['Descripcion'];
        $datosProducto['Precio'] = $post['Precio'];
        $datosProducto['Stock'] = $post['Stock'];
        $datosProducto['Imagen'] = $post['Imagen'];
        $datosProducto['Status'] = $post['Status'];


          $this->db->insert('producto',$datosProducto);
          $ruta = base_url('Inventary');
          echo "<script>
              alert('El producto ha sido guardada correctamente.');
              windows.locaion = '{$ruta}';

          </script>";



    }

    function borrar($get){
        $this->db->where('idProducto',$get['borrar']);
        $this->db->delete('producto');
	}

}
