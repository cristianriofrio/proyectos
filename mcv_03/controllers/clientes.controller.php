<?php
class ClientesController {

    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    // Crear cliente
    public function crearCliente($nombres, $direccion, $telefono, $cedula, $correo) {
        return $this->model->crearCliente($nombres, $direccion, $telefono, $cedula, $correo);
    }

    // Leer todos los clientes
    public function obtenerClientes() {
        return $this->model->obtenerClientes();
    }

    // Leer un solo cliente por ID
    public function obtenerClientePorId($id) {
        return $this->model->obtenerClientePorId($id);
    }

    // Actualizar cliente
    public function actualizarCliente($id, $nombres, $direccion, $telefono, $cedula, $correo) {
        return $this->model->actualizarCliente($id, $nombres, $direccion, $telefono, $cedula, $correo);
    }

    // Eliminar cliente
    public function eliminarCliente($id) {
        return $this->model->eliminarCliente($id);
    }
}
?>
