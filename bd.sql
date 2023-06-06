Create table productos (
    producto_id serial primary key,
    producto_nombre varchar (60) not null,
    producto_precio decimal (8,2) not null,
    producto_situacion char (1) DEFAULT '1'
);

Create table clientes (
    cliente_id serial primary key,
    cliente_nombre varchar (60) not null,
    cliente_nit varchar (10) not null,
    cliente_situacion char (1) DEFAULT '1'
);

Create table detalle_ventas (
    detalle_id serial not null,
    detalle_venta integer not null,
    detalle_producto integer not null,
    detalle_cantidad smallint not null,
    detalle_situacion char (1) DEFAULT '1',
    primary key (detalle_id),
    foreign key (detalle_venta) REFERENCES ventas (venta_id),
    foreign key (detalle_producto) REFERENCES productos (producto_id)
);

Create table ventas (
    venta_id serial not null,
    venta_cliente integer not null,
    venta_fecha datetime year to minute not null,
    venta_situacion char (1) DEFAULT '1',
    primary key (venta_id),
    foreign key (venta_cliente) REFERENCES clientes (cliente_id) 
);  