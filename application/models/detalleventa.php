<?php

class DetalleVenta extends MY_Model {
    const DB_TABLE = 'detalle_venta';
    const DB_TABLE_PK = 'id';

    /**
     * Llave primaria.
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $venta;

    /**
     * @var Producto
     */
    public $producto;

    /**
     * @var float
     */
    public $cantidad;

    /**
     * @var int
     */
    public $iepsUnidad;

    public function loadObjectAttributes () {
        $this->load->model('Producto');
        $this->producto = new Producto($this->producto);
    }
}
?>