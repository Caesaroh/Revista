<?php

class IVA extends MY_Model {
    const DB_TABLE = 'tipo_iva';
    const DB_TABLE_PK = 'id';

    /**
     * Llave primaria.
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $label;

    /**
     * @var int
     */
    public $tasa;
}
?>