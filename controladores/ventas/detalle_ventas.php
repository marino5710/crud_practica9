<?php

require_once '../../modelos/Venta.php';

try {
    $_GET['venta_fecha'] = $_GET['venta_fecha'] != '' ? date('Y-m-d', strtotime($_GET['venta_fecha'])) : '';
    $venta = new Venta($_GET);
    
    $ventas = $venta->buscar();
} catch (PDOException $e) {
    $error = $e->getMessage();
} catch (Exception $e2) {
    $error = $e2->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Resultado de ventas</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>NO.</th>
                            <th>CLIENTE</th>
                            <th>FECHA</th>
                            <th>PRODUCTO</th>
                            <th>PRECIO UNITARIO</th>
                            <th>CANTIDAD</th>
                            <th>TOTAL</th>
                            <th>DETALLE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($ventas) > 0) : ?>
                            <?php foreach ($ventas as $key => $venta) : ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $venta['CLIENTE_NOMBRE'] ?></td>
                                    <td><?= $venta['VENTA_FECHA'] ?></td>
                                    <td><?= $venta ['PRODUCTO_NOMBRE'] ?></td>
                                    <td><?= $venta['PRODUCTO_PRECIO'] ?></td>
                                    <td><?= $venta['DETALLE_CANTIDAD'] ?></td>
                                    <td><?= $venta['TOTAL'] ?></td>
                                    <td><a class="btn btn-info w-100" href="/crud_practica9/vistas/ventas/factura.php?venta_id=<?php echo $venta['DETALLE_ID'] ?>">VER DETALLE</a></td>
                                </tr>
                            <?php endforeach ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="8">NO EXISTEN REGISTROS</td>
                            </tr>
                        <?php endif ?>
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