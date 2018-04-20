<?php
class User extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('User_model');
  }

  function index()
  {
    if($this->session->userdata('login')){

      $info = $this->User_model->GetUserId($this->session->userdata('id'));

      $data = array('title' => 'Usuarios');
  		$this->load->view('body/head', $data);

      $data = array('usuario' => $info->Nick);
      $this->load->view('body/nav', $data);

      if($info->Tipo == "Administrador")
      {
        $activos = array('inicio' => false, 'inventario' => false,
  			'reporte' => false, 'usuarios' => true,
        'ver' => true);
      }
      else
      {
        $activos = array('inicio' => false, 'inventario' => false,
        'reporte' => false, 'usuarios' => true,
        'ver' => false);
      }

			//barra lateral
			$this->load->view('body/sidebar', $activos);

      //cuerpo
      $data['user'] = $this->User_model->GetAllUser();
      $this->load->view('users/users', $data);

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

  function UserUp()
  {
    $this->load->library('encryption');

    $post = $this->input->post();

    $password = $post['nueva'];
    $rpassword = $post['rnueva'];

    if($password == $rpassword)
    {
      $data['nick'] = $post['nick'];
      $data['contrasena'] = $this->encryption->encrypt($password);
      $data['tipo'] = $post['tip'];

      if($this->User_model->InsertUser($data))
        echo "¡Usuario registrado con exito!";
      else
        echo "No se pudo dar de alta el usuario";
    }
    else
    {
      echo "Las contraseñas no coinciden, intentelo de nuevo";
    }
  }

  function Start() //listo
  {
    $this->load->library('encryption');

    $nick = $this->input->post('nick');
    $contrasenia = $this->input->post('password');

    $info = $this->User_model->GetUser($nick);

    if($info != null)
    {
      $contra = $this->encryption->decrypt($info->Contrasenia);
      if($contra == $contrasenia)
      {
        $data = array(
          'id' => $info->idUsuario,
          'login' => true,
        );
        $this->session->set_userdata($data);
        echo base_url('Home/Central');
      }
      else {
        echo "Las contraseñas no coinciden, intentelo de nuevo";
      }
    }
    else {
        echo "El usuario no existe, intentelo de nuevo";
    }
  }

  function End()
  {
    $this->session->sess_destroy();
    header("Location: ".base_url());
  }

  function GetInfo()
  {

    $nick = $this->input->post('user');
    $info = $this->User_model->GetUser($nick);

    if($info != null)
      echo $info->idUsuario ."_". $info->Tipo;
  }

  function UpdateInfo()
  {

    $post = $this->input->post();

    $data['Id'] = $post['id'];
    $data['Nick'] = $post['nick'];
    $data['Tipo'] = $post['tipo'];

    $val = $this->User_model->Update($data);

    if($val)
    {
      echo "si subi";
    }
  }

  function UpdatePass()
  {
    $this->load->library('encryption');

    $post = $this->input->post();

    $id = $post['id'];
    $vieja = $post['actual'];
    $nueva = $post['nueva'];
    $rnueva = $post['rnueva'];

    $info = $this->User_model->GetUserId($id);

    $contra = $this->encryption->decrypt($info->Contrasenia);

    if($contra == $vieja)
    {
      if($nueva == $rnueva)
      {
        $data['pass'] = $this->encryption->encrypt($nueva);
        $data['id'] = $id;

        $val = $this->User_model->UpdatePass($data);

        if($val)
        {
          echo "si subi prra";
        }
        else
          echo ":'v";
      }
      else
        echo "Las cantraseñas no coinciden, verifiquelas por favor";
    }
    else
      echo "La contraseña actual es incorrecta";

  }

  function DeleteThis()
  {

    $datos = $this->input->post();

    $nick = $datos['user'];
    $id = $datos['id'];

    $bool = $this->User_model->Delete($nick);

    if($bool)
      echo $id;

  }

  /*function UpImage()
  {
    $this->load->model('User_model');


    $config['upload_path'] = './resources/images/';
    $config['allowed_types'] = 'gif|jpg|png';

    $file_name = null;

    $this->upload->initialize($config);

    if($this->upload->do_upload("idimagen"))
    {
      $imagen = $this->User_model->GetImage($this->session->userdata('id'));

      if($imagen != 'system/default.jpg')
      {
        unlink('./resources/images/'.$imagen);
      }

      $file_name = $this->upload->data();
      $file_name = $file_name['file_name'];
    }
    else
    {
      $error = $errores = array('error' => $this->upload->display_errors());
      $this->load->view('errors/efile',$error);
    }

    $user = $this->input->post();
    $bool = $this->User_model->NewImage($user['id'],$file_name);
    if($bool)
    {
      echo base_url('resources/images/').$file_name;
    } else
    {
      echo false;
    }
    return;
  }
  */
}
