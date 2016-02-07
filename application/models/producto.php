<?php

class Producto extends MY_Model {
    const DB_TABLE = 'productos';
    const DB_TABLE_PK = 'codigo';

    /**
     * Llave primaria.
     * @var int
     */
    public $codigo;

    /**
     * @var string
     */
    public $descripcion;

    /**
     * @var string
     */
    public $unidad;

    /**
     * @var float
     */
    public $precio;

    /**
     * @var IVA
     */
    public $iva;

    /**
     * @var int
     */
    public $ieps;

    protected function loadObjectAttributes () {
        $this->load->model(array('IVA'));
        $this->iva = new IVA($this->iva);
    }
}
?>