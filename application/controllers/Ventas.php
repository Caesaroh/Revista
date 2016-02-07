<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller {

	public function index () {
		$this->load->model(array('Venta'));
		header("Content-type: application/json");
		$venta = new Venta();

		echo json_encode(array_values($venta->get()));
	}

	public function saveVenta() {
		$this->load->model(array('Venta', 'DetalleVenta'));
		header("Content-type: application/json");
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);

		$venta = new Venta();
		if (isset($request->folio)) {
			$venta->load($request->folio);
		}

		$venta->fecha = $request->fecha;
		$venta->cliente = $request->cliente->id;

		if($venta->save()) {
			foreach ($request->deletedRows as $id) {
				$detalle = new DetalleVenta($id);
				$detalle->delete();
			}

			foreach ($request->rows as $row) {
				$detalle = new DetalleVenta();
				if (isset($row->id)) {
					$detalle->load($row->id);
				}
				$detalle->venta = $venta->folio;
				$detalle->cantidad = $row->cantidad;
				$detalle->producto = $row->producto->codigo;
				$detalle->iepsUnidad = isset($row->iepsUnidad) && $row->iepsUnidad ? 1 : 0;

				$detalle->save();
			}

			$venta->loadObjectAttributes();
			$response = $this->setDocumentoVenta($venta);

			echo json_encode(array("success" => true, "ws" => $response));
		} else {
			echo json_encode(array("success" => true));
		}
	}

	/**
	 * @param int|Venta $venta
     */
	public function setDocumentoVenta($venta) {
		if(!is_object($venta)) {
			$this->load->model(array("Venta"));
			$venta = new Venta($venta);
		}

		$soapClient = new SoapClient("https://staging.clickbalance.net/click/wsCFD.php?wsdl");

		$conceptos = array();
		foreach ($venta->getDetalle() as $concepto) {
			$conceptos [] = array(
				'idproducto' => 0,
				'almacen' => 0,
				'series' => 0,
				'codigo' => str_pad($concepto->producto->codigo, 20 - strlen($concepto->producto->codigo)),
				'cantidad' => $concepto->cantidad,
				'unidad' => $concepto->producto->unidad,
				'descripcion' => $concepto->producto->descripcion,
				'valorunitario' => $concepto->producto->precio,
				'tasadescuento' => 0,
				'descuento' => 0,
				'tasaieps' => $concepto->producto->ieps,
				'ieps' => $concepto->cantidad * $concepto->producto->precio * $concepto->producto->ieps / 100,
				'tasaiva' => $concepto->producto->iva->tasa,
				'iva' => $concepto->cantidad * $concepto->producto->precio * $concepto->producto->iva->tasa / 100,
				'observaciones' => '',
				'InstitucionesEducativas' => array(),
				'InformacionAduanera' => array()
			);
		}

		$subTotal = $venta->getSubtotal();
		$iva = $venta->getTotalIva();
		$ieps = $venta->getTotalIeps();
		$total = $subTotal + $iva + $ieps;
		$params = array(
			'usuario' => "",
			'password' => "",
			'empresa' => 0,
			'plaza' => 0,
			'datosfactura' => array(
				'tipodocumento' => "",
				'folio' => $venta->folio,
				'fecha' => $venta->fecha,
				'receptor' => array(
					'idcliente' => $venta->cliente->id,
					'rfc' => $venta->cliente->rfc,
					'nombre' => $venta->cliente->nombre,
					'email' => $venta->cliente->correo,
					'calle' => $venta->cliente->calle,
					'nexterior' => $venta->cliente->numero,
					'ninterior' => '000',
					'colonia' => $venta->cliente->colonia,
					'localidad' => 'sin asignar',
					'municipio' => $venta->cliente->municipio,
					'estado' => $venta->cliente->estado,
					'pais' => "México",
					'codigopostal' => $venta->cliente->cp,
					'numero_referencia_asociado' => "",
					'iddireccion' => 0
				),
				'iddireccionentrega' => 0,
				'razon_social_comp_id' => 0,
				'idagente' => 0,
				'metodoDePago' => "EFECTIVO",
				'RefDePago' => "",
				'tipopago' => 0,
				'conceptos' => $conceptos,
				'subtotal' => $subTotal,
				'descuento' => 0,
				'ieps' => $ieps,
				'iva' => $iva,
				'isrretenido' => 0,
				'ivaretenido' => 0,
				'implocales' => array(),
				'idaddenda' => 0,
				'addenda' => "",
				'referencia' => "",
				'texto_adicional_1' => "",
				'texto_adicional_2' => "",
				'texto_adicional_3' => "",
				'texto_adicional_4' => "",
				'texto_adicional_5' => "",
				'texto_adicional_6' => "",
				'texto_adicional_7' => "",
				'texto_adicional_8' => "",
				'texto_adicional_9' => "",
				'texto_adicional_10' => "",
				'ventaFormasDePago' => array(),
				'codigo_transaccion' => "",
				'desglose_ieps' => 0,
				'total' => $total,
				'observaciones' => "",
				'moneda_id' => 0,
				'tipo_cambio' => 1.0000,
				'asignar_folio_siguiente_si_esta_ocupado' => 1
			)
		);

		return $soapClient->__soapCall("setGeneraDocumentoVenta", $params);
	}

	public function eliminar($ventId) {
		$this->load->model(array('Venta'));
		$venta = new Venta($ventId);

		echo json_encode(array("success" => $venta->delete()));
	}

	public function getVenta($ventId) {
		$this->load->model(array('Venta'));
		$venta = new Venta($ventId);
		$venta->rows = $venta->getDetalle();

		echo json_encode($venta);
	}
}
