<?php
$CI =& get_instance();
  if($this->uri->segment(3)==0){
    $producto[0]['Fecha']="";
    $producto[0]['Hora']="";
    $producto[0]['Total']="";
    $producto[0]['_idUsuario']="";


  }else {
    $CI->db->where('idProducto',$this->uri->segment(3));
    $producto = $CI->db->get('venta')->result_array();
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
                                <label for="" class ="input-group-addon" >Fecha</label>
                                <input type="date" name="Nombre" class="form-control"  >
                            </div>

                            <div class="col-md-12 form-group input-group">
                                <label for="" class ="input-group-addon" >Hora</label>
                                <input type="time" name="Descripcion" class="form-control" >
                            </div>

                            <div class="col-md-12 form-group input-group">
                                <label for="" class ="input-group-addon" >Total</label>
                                <input type="text" name="Precio" class="form-control" >
                            </div>
                          



                            <div class="col-md-12 text-center">

                            <a href="<?=base_url('Report/guardar/0');?>"
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

                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Total</th>
                                <th>Usuario</th>

                            </thead>
                            <tbody>
                            <?php
                                $CI =& get_instance();
                                $producto = $CI->db->get('venta')->result_array();

                                foreach ($producto as $producto) {
                                    $rutaEditar = base_url("Report/guardar/{$producto['idVenta']}");
                                    $rutaBorrar = base_url("Report/borrar?borrar={$producto['idVenta']}");
                                    echo "<tr>

                                            <td>{$producto['Fecha']}</td>
                                            <td>{$producto['Hora']}</td>
                                            <td>{$producto['Total']}</td>
                                            <td>{$producto['_idUsuario']}</td>


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
