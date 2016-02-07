<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

	public function index () {
		$this->load->model(array('Cliente'));
		header("Content-type: application/json");
		$cliente = new Cliente();

		echo json_encode(array_values($cliente->get()));
	}

	public function saveCliente() {
		$this->load->model(array('Cliente'));
		header("Content-type: application/json");
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);

		$cliente = new Cliente();
		if (isset($request->id)) {
			$cliente->load($request->id);
		}

		$cliente->regimen = $request->regimen->id;
		$cliente->nombre = $request->nombre;
		$cliente->apellidoMaterno = isset($request->apellidoMaterno) ? $request->apellidoMaterno : "";
		$cliente->apellidoPaterno = isset($request->apellidoPaterno) ? $request->apellidoPaterno : "";
		$cliente->rfc = isset($request->rfc) ? $request->rfc : "";
		$cliente->telefono = isset($request->telefono) ? $request->telefono : "";
		$cliente->correo = isset($request->correo) ? $request->correo : "";
		$cliente->calle = isset($request->calle) ? $request->calle : "";
		$cliente->numero = isset($request->numero) ? $request->numero : "";
		$cliente->colonia = isset($request->colonia) ? $request->colonia : "";
		$cliente->municipio = isset($request->municipio) ? $request->municipio : "";
		$cliente->estado = isset($request->estado) ? $request->estado : "";
		$cliente->cp = isset($request->cp) ? $request->cp : "";

		if($cliente->save()) {
			echo json_encode(array("success" => true));
		} else {
			echo json_encode(array("success" => true));
		}
	}

	public function getCliente($clienteId) {
		$this->load->model(array('Cliente'));
		$cliente = new Cliente($clienteId);

		echo json_encode($cliente);
	}

	public function eliminar ($clienteId) {
		$this->load->model(array('Cliente'));
		$cliente = new Cliente($clienteId);

		echo json_encode(array("success" => $cliente->delete()));
	}
}
