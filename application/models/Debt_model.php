<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Debt_model extends CI_Model{

  function InsertNota($data = null)
  {
    if($data != null)
    {
      $nombre = $data['Nombre'];
      $monto = $data['Monto'];

      $SQL = "INSERT INTO deudas(Nombre, Monto) VALUES ('$nombre','$monto')";

      $this->db->query($SQL);
    }
  }

  function GetNotas()
  {
    $result = $this->db->query("Select * from deudas");
    if($result->num_rows() > 0)
    {
      return $result;
    }
    else
    {
      return null;
    }
  }

  function GetDeuda($folio = null)
  {
    if($folio != null)
    {
      $result = $this->db->query("Select * from deudas where idDeuda = '".$folio."'");
      if($result->num_rows() > 0)
      {
        return $result->row();
      }
    }
      return null;
  }

  function Update($data = null)
  {
    if($data != null)
    {
      $id = $data['ID'];
      $monto = $data['Monto'];

      $SQL = "UPDATE deudas SET Monto = '$monto' WHERE idDeuda = '$id'";

      if($this->db->query($SQL))
      {
        return TRUE;
      }
    }
    return false;
  }

  function Delete($folio = null)
  {
    if($folio != null)
    {
      $SQL = "DELETE FROM deudas WHERE idDeuda = '$folio'";

      if($this->db->query($SQL))
      {
        return true;
      }
    }
    return false;
  }

}
