<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model{

  public $variable;
    public function __contruct()
    {
        parent::__contruct();
        $this->load->database();
    }

  function guardar($post)
  {
        $datosVenta = array();

        $datosVenta['Fecha'] = $post['Fecha'];
        $datosVenta['Hora'] = $post['Hora'];
        $datosVenta['Total'] = $post['Total'];
        $datosVenta['_idUsuario'] = $post['_idUsuario'];



          $this->db->insert('venta',$datosVenta);
          $ruta = base_url('Inventary');
          echo "<script>
              alert('El producto ha sido guardada correctamente.');
              windows.locaion = '{$ruta}';

          </script>";

    }

    function borrar($get){
        $this->db->where('idVenta',$get['borrar']);
        $this->db->delete('venta');
  }

}
