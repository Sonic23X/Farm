<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventary extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('User_model');
  }

  function Index()
  {
    if($this->session->userdata('login')){

      $info = $this->User_model->GetUserId($this->session->userdata('id'));

      $data = array('title' => 'Inventario');
  		$this->load->view('body/head', $data);

      $data = array('usuario' => $info->Nick);
      $this->load->view('body/nav', $data);

      if($info->Tipo == "Administrador")
      {
        $activos = array('inicio' => false, 'inventario' => true,
  			'reporte' => false, 'usuarios' => false,
        'ver' => true);
      }
      else
      {
        $activos = array('inicio' => false, 'inventario' => true,
        'reporte' => false, 'usuarios' => false,
        'ver' => false);
      }

			//barra lateral
			$this->load->view('body/sidebar', $activos);

      //cuerpo


      //modales
			$this->load->view('options/buy');
			$this->load->view('options/about');

  		$this->load->view('body/footer');
    }
    else
    {
      header("Location: ".base_url('Login'));
    }
  }

  function GetItems()
  {

  }

  function GetItemsByLetter()
  {
    # code...
  }

  function SearchItem()
  {
    # code...
  }

  function NewItem()
  {
    # code...
  }

  function ChangeItem()
  {
    # code...
  }

  function DeleteItem()
  {
    # code...
  }

}
