<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

  function InsertUser($datos = null)
  {
    if($datos != null)
    {
      $nick = $datos['nick'];
      $contra = $datos['contrasena'];
      $tipo = $datos['tipo'];

      $SQL = "INSERT INTO usuario(Nick, Contrasenia, Tipo) VALUES
      ('$nick','$contra','$tipo');";

      if($this->db->query($SQL))
      {
        return TRUE;
      }
    }
    return false;
  }

  function GetUser($nick = null)
  {
    if($nick != null)
    {
      $result = $this->db->query("Select * from usuario where Nick = '".$nick."'");
      if($result->num_rows() > 0)
      {
        return $result->row();
      }
    }
      return null;
  }

  function GetUserId($id = null)
  {
    if($id != null)
    {
      $result = $this->db->query("Select * from usuario where idUsuario = '".$id."'");
      if($result->num_rows() > 0)
      {
        return $result->row();
      }
    }
      return null;
  }

  function GetAllUser()
  {
    $result = $this->db->query("Select * from usuario");
    if($result->num_rows() > 0)
    {
      return $result;
    }
    else
    {
      return null;
    }
  }

  /*
  function getImage($usuario = null)
  {
    if ($usuario != null)
    {
      $sql = "SELECT imagen FROM usuario WHERE idusuario = '$usuario' ";
      $resultado = $this->db->query($sql);
      if($resultado->num_rows() == 1)
      {
        return $resultado->row()->imagen;
      }
    }
    return false;
  }
  */

  function Update($usuario = null)
  {
    if($usuario != null)
    {
      $id = $usuario['Id'];
      $nick = $usuario['Nick'];
      $tipo = $usuario['Tipo'];

      $SQL = "UPDATE usuario SET Nick = '$nick', Tipo = '$tipo'
              WHERE idUsuario = '$id'";

      if($this->db->query($SQL))
      {
        return TRUE;
      }
    }
    return FALSE;
  }

  function UpdatePass($usuario = null)
  {
    if($usuario != null)
    {
      $id = $usuario['id'];
      $pass = $usuario['pass'];

      $SQL = "UPDATE usuario SET Contrasenia = '$pass' WHERE idUsuario = '$id'";

      if($this->db->query($SQL))
      {
        return TRUE;
      }
    }
    return FALSE;
  }

  function Delete($nick = null)
  {
    if($nick != null)
    {
      $SQL = "DELETE FROM usuario WHERE Nick = '$nick'";

      if($this->db->query($SQL))
      {
        return true;
      }
    }
    return false;
  }

/*
  function newImage($id = null, $imagen = null)
  {
    if($id != null && $imagen != null )
    {
      $this->db->where('idusuario',$id);
      $data['imagen'] = $imagen;
      $bool = $this->db->update('usuario', $data);
      if($bool)
        return true;
    }
    return false;
  }
*/
}
