<?php
$CI =& get_instance();
  if($this->uri->segment(3)==0){
    $producto[0]['idCategoria']="";
    $producto[0]['Nombre']="";
    $producto[0]['Descripcion']="";
    $producto[0]['Precio']="";
    $producto[0]['Stock']="";
    $producto[0]['Imagen'] = "";
    $producto[0]['Status'] = "";

  }else {
    $CI->db->where('idProducto',$this->uri->segment(3));
    $producto = $CI->db->get('producto')->result_array();
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
    <title>Productos</title>
</head>
<body>
        <div class ="row" >
            <div class = "col-md-4" >
                <div class= "panel panel-default">
                     <div class= "panel-heading" >Agregar Productos</div>
                     <div class = "panel-body">

                        <form action="<?=base_url('Inventary/guardar');?>" method="POST">


                        <div class="col-md-12 form-group input-group">
                                <label for="" class ="input-group-addon" >Categoria</label>
                                <select class= "form-control" name="idCategoria" >
                                        <option value="1">Medicamento</option>
                                        <option value="2">antibiótico</option>

                                </select>
                            </div>

                            <div class="col-md-12 form-group input-group">
                                <label for="" class ="input-group-addon" >Nombre</label>
                                <input type="text" name="Nombre" class="form-control"  >
                            </div>

                            <div class="col-md-12 form-group input-group">
                                <label for="" class ="input-group-addon" >Descripcion</label>
                                <input type="text" name="Descripcion" class="form-control" >
                            </div>

                            <div class="col-md-12 form-group input-group">
                                <label for="" class ="input-group-addon" >Precio</label>
                                <input type="text" name="Precio" class="form-control" >
                            </div>
                            <div class="col-md-12 form-group input-group">
                                <label for="" class ="input-group-addon" >Stock</label>
                                <input type="text" name="Stock" class="form-control" >
                            </div>

                            <div class="col-md-12 form-group input-group">
                                <label for="" class ="input-group-addon" >Imagen</label>
                                <input type="text" name="Imagen" class="form-control"  >
                            </div>

                            <div class="col-md-12 form-group input-group">
                                <label for="" class ="input-group-addon" >Status</label>
                                <input type="text" name="Status" class="form-control"  >
                            </div>



                            <div class="col-md-12 text-center">

                            <a href="<?=base_url('Inventary/guardar/0');?>"
                             class ="btn btn-primary">Nuevo Producto</a>

                            <button type="submit" class= "btn btn-success" >Guardar Producto</button>

                            </div>

                        </form>
                </div>
             </div>
        </div>

        <div class ="col-md-8" >
            <div class="panel panel-default" >
                <div class= "panel-heading" >Productos</div>
                <div class="panel-body" >

                        <table class = "table table-hover table-striped">
                            <thead>

                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Imagen</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                            <?php
                                $CI =& get_instance();
                                $producto = $CI->db->get('producto')->result_array();

                                foreach ($producto as $producto) {
                                    $rutaEditar = base_url("Inventary/guardar/{$producto['idProducto']}");
                                    $rutaBorrar = base_url("Inventary/borrar?borrar={$producto['idProducto']}");
                                    echo "<tr>

                                            <td>{$producto['Nombre']}</td>
                                            <td>{$producto['Descripcion']}</td>
                                            <td>{$producto['Precio']}</td>
                                            <td>{$producto['Stock']}</td>
                                            <td>{$producto['Imagen']}</td>
                                            <td>{$producto['Status']}</td>

                                            <td>
                                            <a href= '{$rutaEditar}' class= 'btn btn-info'>Editar</a>
                                            <a href= '{$rutaBorrar}' class= 'btn btn-danger'>Borrar</a>

                                        </td>
                                        </tr>
                                        ";
                                       }

                           ?>

                            </tbody>
        </table>

</div>

            </div>

        </div>
</div>


</body>
</html>
