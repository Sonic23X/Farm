<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function getCategoria($categoria = null)
  {
    if($categoria != null)
    {
      $SQL = "SELECT idCategoria FROM categoria WHERE categoria = '".$categoria."'";
      $result = $this->db->query($SQL);
      if($result->num_rows() > 0)
      {
        return $result->row('idCategoria');
      }
    }
  }

  public function getProductos($categoria = null)
  {
    if($categoria != null)
    {
      $SQL = "SELECT * FROM producto WHERE idcategoria = ".$categoria." HAVING Stock > 0";
      $result = $this->db->query($SQL);
      return $result;
    }
  }

  public function InsertProduct($Prodcut = null)
  {

  }

  public function GetStock($producto = null)
  {
    if($producto != null)
    {
      $SQL = "SELECT Stock FROM producto WHERE Nombre = '".$producto."'";
      $result = $this->db->query($SQL);
      return $result->row('Stock');
    }
  }

  public function GetPrecio($producto = null)
  {
    if($producto != null)
    {
      $SQL = "SELECT Precio FROM producto WHERE Nombre = '".$producto."'";
      $result = $this->db->query($SQL);
      return $result->row('Precio');
    }
  }

  public function GetID($producto = null)
  {
    if($producto != null)
    {
      $SQL = "SELECT idProducto FROM producto WHERE Nombre = '".$producto."'";
      $result = $this->db->query($SQL);
      return $result->row('idProducto');
    }
  }

}
