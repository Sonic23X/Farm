<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buy_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
  }

  function CreateBuy()
  {
    $id = $this->session->userdata('id');

    $SQL = "INSERT INTO venta(Fecha, Hora, _idUsuario) VALUES (curdate(),curtime(),'$id')";
    $result = $this->db->query($SQL);

    $SQL = "SELECT * FROM venta ORDER BY idVenta DESC LIMIT 1";
    $result = $this->db->query($SQL);

    if($result->num_rows() > 0)
      return $result->row('idVenta');
    else
      return null;

  }

  function SetItem($data = null)
  {
    if($data != null)
    {
      $id = $data['id'];
      $idpro = $data['item'];
      $monto = $data['monto'];

      $SQL = "INSERT INTO venta_contiene_producto VALUES ($id,$idpro,$monto)";
      $result = $this->db->query($SQL);

    }

  }

  function DeleteBuy($id = null)
  {
    if($id != null)
    {

      $SQL = "DELETE FROM venta WHERE idVenta = ".$id;

      if($this->db->query($SQL))
      {
        return "DELETE FROM venta WHERE idVenta = ".$id;
      }
    }
    return false;
  }

  function DeleteBuyItem($id = null)
  {
    if($id != null)
    {
      $SQL = "DELETE FROM venta_contiene_producto WHERE _idVenta = ".$id;
      if($this->db->query($SQL))
      {
        return "DELETE FROM venta WHERE idVenta = ".$id;
      }
    }
    return false;
  }

  function DeleteItem($data = null)
  {
    if($data != null)
    {
      $venta = $data['folio'];
      $producto = $data['item'];

      $SQL = "DELETE FROM venta_contiene_producto WHERE _idVenta = ".$venta." and _idProducto =".$producto;
      $this->db->query($SQL);

    }
  }

  function GetMonto($id = null)
  {
    if($id != null)
    {
      $SQL = "select P.Precio, VC.Cantidad from venta_contiene_producto as VC, producto as P
              where vc._idVenta = $id AND VC._idProducto = P.idProducto";

      $result = $this->db->query($SQL);

      return $result->result();

    }
  }

  function SetPrice($data = null)
  {
    if($data != null)
    {
      $folio = $data['folio'];
      $precio = $data['total'];

      $SQL = "UPDATE venta SET Total = $precio WHERE idVenta = $folio";

      $this->db->query($SQL);


    }
  }

  function GetItem($id = null)
  {
    if($id != null)
    {
      $SQL = "select P.idProducto, VC.Cantidad, P.Stock from venta_contiene_producto as VC, producto as P
              where vc._idVenta = $id AND VC._idProducto = P.idProducto";

      $result = $this->db->query($SQL);

      return $result->result();

    }
  }

  function UpdateStock($data = null)
  {
    if($data != null)
    {
      $restante = $data['nuevo'];
      $id = $data['item'];

      $SQL = "UPDATE producto SET Stock = $restante WHERE idProducto = $id";

      $this->db->query($SQL);
    }
  }

}
