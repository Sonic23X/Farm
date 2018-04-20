<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buy extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Product_model');
    $this->load->model('Buy_model');
  }

  function obtenerProductos()
  {
    $categoria = $this->input->post('categoria');

    $id = $this->Product_model->getCategoria($categoria);
    $productos = $this->Product_model->getProductos($id);

    ?>
    <option style="Display:none">&nbsp;</option>
    <?php
    foreach ($productos->result() as $row)
    {
    ?>
    <option value="<?=$row->Nombre?>"><?=$row->Nombre?></option>
    <?php
    }
  }

  function InsertProduct()
  {
    $item = $this->input->post('producto');
    $count = $this->input->post('cantidad');

    $data['id'] = $this->input->post('idcompra');
    $data['item'] = $this->Product_model->GetId($item);
    $data['monto'] = $count;

    $this->Buy_model->SetItem($data);

    $precio = $this->Product_model->GetPrecio($item);
    $id = $this->Product_model->GetId($item);

    $total = $precio * $count;

    echo "<tr id=t$id>
            <td>". $item ."</td>
            <td>". $count ."</td>
            <td>$". $total ."</td>
            <td><button name ='$id' type = 'button' class = 'close borrar' onclick='borrar($id)'>&times;</button></td>
          </tr>";
  }

  function GetStock()
  {
    $categoria = $this->input->post('producto');

    $info = $this->Product_model->GetStock($categoria);

    echo $info;
  }

  function CreateBuy()
  {
    $info = $this->Buy_model->CreateBuy();
    echo $info;
  }

  function DeleteBuy()
  {
    $id = $this->input->post('id');

    $this->Buy_model->DeleteBuyItem($id);
    $this->Buy_model->DeleteBuy($id);

  }

  function DeleteItem()
  {
    $data['item'] = $this->input->post('item');
    $data['folio'] = $this->input->post('folio');

    $this->Buy_model->DeleteItem($data);

    echo $data['item'];
  }

  function GetMonto()
  {
    $folio = $this->input->post('folio');

    $productos = $this->Buy_model->GetMonto($folio);

    //print_r($productos);

    $total = 0;

    foreach ($productos as $fila ) {
        $precio =  $fila->Precio;
        $can = $fila->Cantidad;
        $max = $precio * $can;
        $total = $total + $max;
    }
    echo $total;
  }

  function SetPrice()
  {
    $data['folio'] = $this->input->post('folio');
    $data['total'] = $this->input->post('total');

    $this->Buy_model->SetPrice($data);

  }

  function UpdateStock()
  {
    $folio = $this->input->post('folio');

    $producto = $this->Buy_model->GetItem($folio);

    foreach ($producto as $fila )
    {
      $item = $fila->idProducto;
      $stock = $fila->Stock;
      $compra = $fila->Cantidad;

      $restante = $stock - $compra;

      $data['nuevo'] = $restante;
      $data['item'] = $item;

      $this->Buy_model->UpdateStock($data);
    }

  }

}
