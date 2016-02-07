<?php

class Cliente extends MY_Model {
    const DB_TABLE = 'clientes';
    const DB_TABLE_PK = 'id';

    /**
     * Llave primaria.
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $regimen;

    /**
     * @var string
     */
    public $nombre;

    /**
     * @var string
     */
    public $apellidoMaterno;

    /**
     * @var string
     */
    public $apellidoPaterno;

    /**
     * @var string
     */
    public $rfc;

    /**
     * @var string
     */
    public $telefono;

    /**
     * @var string
     */
    public $correo;

    /**
     * @var string
     */
    public $calle;

    /**
     * @var int
     */
    public $numero;

    /**
     * @var string
     */
    public $colonia;

    /**
     * @var string
     */
    public $municipio;

    /**
     * @var string
     */
    public $estado;

    /**
     * @var int
     */
    public $cp;
}
?>