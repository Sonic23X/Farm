<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model("User_model");
  }

	public function Index()
	{
		if(!$this->session->userdata('login'))
			header("Location: ". base_url('Home/Login'));
		else
			header("Location: ". base_url('Home/Central'));
	}

	public function Login()
	{
		if(!$this->session->userdata('login')){
      $data = array('title' => 'Iniciar Sesión');
  		$this->load->view('body/head', $data);

  		$this->load->view('body/nav');

      $this->load->view('users/login');

      $this->load->view('body/footer');
    }
    else {
      header("Location: ". base_url('Home/Central'));
    }
	}

	public function Central()
	{
		if($this->session->userdata('login')){

      $info = $this->User_model->GetUserId($this->session->userdata('id'));

      $data = array('title' => 'Farmacia X');
  		$this->load->view('body/head', $data);

      $data = array('usuario' => $info->Nick);
			$this->load->view('body/nav', $data);

      if($info->Tipo == "Administrador")
      {
        $activos = array('inicio' => true, 'inventario' => false,
  			'reporte' => false, 'usuarios' => false,
        'ver' => true);
      }
      else
      {
        $activos = array('inicio' => true, 'inventario' => false,
        'reporte' => false, 'usuarios' => false,
        'ver' => false);
      }

			//barra lateral
			$this->load->view('body/sidebar', $activos);

			//cuerpo
			$this->load->view('body/home');

			//modales
			$this->load->view('options/buy');
			$this->load->view('options/about');

      $this->load->view('body/footer');
    }
    else {
      header("Location: ". base_url('Home/Login'));
    }
	}

}
?>
