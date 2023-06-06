<?php
require_once 'Conexion.php';

class Venta extends Conexion{
    public $venta_id;
    public $venta_cliente;
    public $venta_fecha;
    public $venta_situacion;


    public function __construct($args = [] )
    {
        $this->venta_id = $args['venta_id'] ?? null;
        $this->venta_cliente = $args['venta_cliente'] ?? '';
        $this->venta_fecha = $args['venta_fecha'] ?? '';
        $this->venta_situacion = $args['venta_situacion'] ?? '';
    }

    public function guardar(){
        $sql = "INSERT INTO ventas(venta_cliente, venta_fecha) values('$this->venta_cliente','$this->venta_fecha')";
        $resultado = self::ejecutar($sql);
        return $resultado;
    }

        public function buscar(){
            $sql = "SELECT detalle_id, cliente_nombre, venta_fecha, producto_nombre, producto_precio, detalle_cantidad, (producto_precio * detalle_cantidad) as total from ventas inner join clientes on venta_cliente = cliente_id  
             INNER JOIN detalle_ventas ON venta_id = detalle_venta
             INNER JOIN productos ON detalle_producto = producto_id
            where venta_situacion= 1 ";

        if($this->venta_cliente != ''){
            $sql .= " and venta_cliente = $this->venta_cliente ";
        }

        if($this->venta_fecha != ''){
            $sql .= " and extend(venta_fecha, year to day) = '$this->venta_fecha' ";
        }
        if($this->venta_id != null){
            $sql .= " and venta_id = $this->venta_id ";
        }


        $resultado = self::servir($sql);
        return $resultado;
    }

    
    public function factura($id){
        $sql = "SELECT detalle_id, cliente_nombre, venta_fecha, cliente_nit, producto_nombre, producto_precio, detalle_cantidad, (producto_precio * detalle_cantidad) as total from ventas inner join clientes on venta_cliente = cliente_id  
         INNER JOIN detalle_ventas ON venta_id = detalle_venta
         INNER JOIN productos ON detalle_producto = producto_id
        where venta_situacion= 1 and detalle_id= $id ";

   


    $resultado = self::servir($sql);
    return $resultado;
}

    



}