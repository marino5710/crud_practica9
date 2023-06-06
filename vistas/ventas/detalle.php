<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../../modelos/Venta.php';
require '../../modelos/Detalle.php';
    try {
        $id = $_GET['venta_id'];
        $venta = new Venta($_GET);
        $detalle = new Detalle([
            'detalle_venta' => $id
        ]);

        $ventas = $venta->buscar();
        $productos = $detalle->buscar();
        echo "<pre>";
        var_dump($ventas);
        echo "</pre>";
        echo "<pre>";
        var_dump($productos);
        echo "</pre>";
        exit;
        // $error = "NO se guardó correctamente";
    } catch (PDOException $e) {
        $error = $e->getMessage();
    } catch (Exception $e2){
        $error = $e2->getMessage();
    }
?>