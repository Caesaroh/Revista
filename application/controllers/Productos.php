<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

	public function index() {
		$this->load->model(array('Producto'));
		$producto = new Producto();

		echo json_encode(array_values($producto->get()));
	}

	public function saveProducto() {
		$this->load->model(array('Producto'));
		//header("Content-type: application/json");
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$producto = new Producto();
		$codigo = $request->codigo;

		if ($producto->countWhere(array('codigo' => $codigo)) > 0) {
			if (!$request->edit) {
				echo json_encode(array("success" => false, 'error' => array('codigo' => "El código {$codigo} ya existe")));
				return;
			}
		}
		$producto->codigo = $request->codigo;
		$producto->descripcion = $request->descripcion;
		$producto->unidad = isset($request->unidad) ? $request->unidad : "";
		$producto->precio = $request->precio;
		$producto->iva = $request->iva->id;
		$producto->ieps = isset($request->ieps) ? $request->ieps : "";

		echo json_encode(array("success" => $producto->save()));
	}

	public function getProducto($productoId) {
		$this->load->model(array('Producto'));
		$producto = new Producto($productoId);
		$producto->edit = true;

		echo json_encode($producto);
	}

	public function getIvas () {
		$this->load->model(array('IVA'));
		$iva = new IVA();

		echo json_encode(array_values($iva->get()));
	}

	public function eliminar ($productoId) {
		$this->load->model(array('Producto'));
		$producto = new Producto($productoId);

		echo json_encode(array("success" => $producto->delete()));
	}
}
