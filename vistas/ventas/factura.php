<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../modelos/Venta.php';
require '../../modelos/Detalle.php';
require '../../modelos/Cliente.php';
    try {
        $id = $_GET['venta_id'];
        $venta = new Venta();

        $factura = $venta->factura($id);

 
        // $productos = $detalle->buscar();
        // echo "<pre>";
        // var_dump($ventas);
        // echo "</pre>";
        // echo "<pre>";
        // var_dump($productos);
        // echo "</pre>";
        // exit;
        // // $error = "NO se guardó correctamente";
        $subtotal = 0;
        $cantidad = 0;
    } catch (PDOException $e) {
        $error = $e->getMessage();
    } catch (Exception $e2){
        $error = $e2->getMessage();
    }
?>
<?php include_once '../../includes/header.php'?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>FACTURA</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 table-responsive">
            <table class="table table-bordered">
    <thead>
        <tr class="text-center table-dark">
            <th colspan="3">DETALLE DE LA FACTURA.</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><strong>FECHA:</strong></td>
            <?php foreach ($factura as $key => $venta) : ?>
                <td><?= $venta['VENTA_FECHA'] ?></td>
            <?php endforeach ?>
        </tr>
        <tr>
            <td><strong>NOMBRE:</strong></td>
            <?php foreach ($factura as $key => $venta) : ?>
                <td><?= $venta['CLIENTE_NOMBRE'] ?></td>
            <?php endforeach ?>
        </tr>
        <tr>
            <td><strong>NIT:</strong></td>
            <?php foreach ($factura as $key => $venta) : ?>
                <td><?= $venta['CLIENTE_NIT'] ?></td>
            <?php endforeach ?>
        </tr>
        <?php if (count($factura) == 0) : ?>
            <tr>
                <td colspan="3">NO EXISTEN REGISTROS</td>
            </tr>
        <?php endif ?>
    </tbody>
</table>
            </div>
        </div>

        <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 table-responsive">
                <table class="table table-bordered">
                    <thead >
                        <tr class="text-center table-dark">
                            <th colspan="7">PRODUCTOS</th>
                        </tr>
                    <thead class="table-dark">
                        <tr>
                            <th>NO.</th>
                            <th>PRODUCTO</th>
                            <th>PRECIO</th>
                            <th>CANTIDAD</th>
                            <th>SUBTOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($factura) > 0) : ?>
                            <?php foreach ($factura as $key => $venta) : ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $venta ['PRODUCTO_NOMBRE'] ?></td>
                                    <td><?= $venta['PRODUCTO_PRECIO'] ?></td>
                                    <td><?= $venta['DETALLE_CANTIDAD'] ?></td>
                                    <td><?= $venta['TOTAL'] ?></td>
                                    
                                </tr>
                            <?php endforeach ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="8">NO EXISTEN REGISTROS</td>
                            </tr>
                        <?php endif ?>
                        <tr>
                        <td colspan="4">Total:</td>
                        <td><?= $venta['TOTAL'] ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-4">
                <a href="/crud_practica9/vistas/ventas/buscar.php" class="btn btn-info w-100">Volver al formulario</a>
            </div>
        </div>
    </div>
</body>
</html>