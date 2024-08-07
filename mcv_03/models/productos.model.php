<?php
class ProductosModel {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Crear producto
    public function crearProducto($codigo_barras, $nombre_producto, $graba_iva) {
        $stmt = $this->db->prepare("INSERT INTO productos (Codigo_Barras, Nombre_Producto, Graba_IVA) VALUES (?, ?, ?)");
        return $stmt->execute([$codigo_barras, $nombre_producto, $graba_iva]);
    }

    // Leer todos los productos
    public function obtenerProductos() {
        $stmt = $this->db->query("SELECT * FROM productos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Leer un solo producto por ID
    public function obtenerProductoPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM productos WHERE idProductos = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar producto
    public function actualizarProducto($id, $codigo_barras, $nombre_producto, $graba_iva) {
        $stmt = $this->db->prepare("UPDATE productos SET Codigo_Barras = ?, Nombre_Producto = ?, Graba_IVA = ? WHERE idProductos = ?");
        return $stmt->execute([$codigo_barras, $nombre_producto, $graba_iva, $id]);
    }

    // Eliminar producto
    public function eliminarProducto($id) {
        $stmt = $this->db->prepare("DELETE FROM productos WHERE idProductos = ?");
        return $stmt->execute([$id]);
    }
}
?>
