<?php

class Venta extends MY_Model {
    const DB_TABLE = 'ventas';
    const DB_TABLE_PK = 'folio';

    /**
     * Llave primaria.
     * @var int
     */
    public $folio;

    /**
     * @var string
     */
    public $fecha;

    /**
     * @var Cliente
     */
    public $cliente;

    /**
     * @return DetalleVenta []
     */
    public function getDetalle() {
        $this->load->model('DetalleVenta');
        $detalle = new DetalleVenta();

        return array_values($detalle->get(array('venta' => $this->folio)));
    }

    /**
     * @return float
     */
    public function getSubtotal() {
        $subTotal = 0;
        foreach ($this->getDetalle() as $linea) {
            $subTotal += $linea->cantidad * $linea->producto->precio;
        }
        return $subTotal;
    }

    /**
     * @return float
     */
    public function getTotalIeps() {
        $totalIeps = 0;
        foreach ($this->getDetalle() as $linea) {
            if ($linea->iepsUnidad) {
                $totalIeps += $linea->cantidad;
                continue;
            }
            $totalIeps += $linea->cantidad * $linea->producto->ieps / 100;
        }
        return $totalIeps;
    }

    /**
     * @return float
     */
    public function getTotalIva() {
        $totalIva = 0;
        foreach ($this->getDetalle() as $linea) {
            $totalIva += $linea->cantidad * $linea->producto->iva->tasa / 100;
        }
        return $totalIva;
    }

    public function loadObjectAttributes () {
        $this->load->model('Cliente');
        $this->cliente = new Cliente($this->cliente);
    }
}
?>