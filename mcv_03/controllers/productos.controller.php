<?php
class ProductosController {

    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    // Crear producto
    public function crearProducto($codigo_barras, $nombre_producto, $graba_iva) {
        return $this->model->crearProducto($codigo_barras, $nombre_producto, $graba_iva);
    }

    // Leer todos los productos
    public function obtenerProductos() {
        return $this->model->obtenerProductos();
    }

    // Leer un solo producto por ID
    public function obtenerProductoPorId($id) {
        return $this->model->obtenerProductoPorId($id);
    }

    // Actualizar producto
    public function actualizarProducto($id, $codigo_barras, $nombre_producto, $graba_iva) {
        return $this->model->actualizarProducto($id, $codigo_barras, $nombre_producto, $graba_iva);
    }

    // Eliminar producto
    public function eliminarProducto($id) {
        return $this->model->eliminarProducto($id);
    }
}
?>
