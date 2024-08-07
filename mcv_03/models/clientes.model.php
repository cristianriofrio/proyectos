<?php
class ClientesModel {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Crear cliente
    public function crearCliente($nombres, $direccion, $telefono, $cedula, $correo) {
        $stmt = $this->db->prepare("INSERT INTO clientes (Nombres, Direccion, Telefono, Cedula, Correo) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$nombres, $direccion, $telefono, $cedula, $correo]);
    }

    // Leer todos los clientes
    public function obtenerClientes() {
        $stmt = $this->db->query("SELECT * FROM clientes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Leer un solo cliente por ID
    public function obtenerClientePorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM clientes WHERE idClientes = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar cliente
    public function actualizarCliente($id, $nombres, $direccion, $telefono, $cedula, $correo) {
        $stmt = $this->db->prepare("UPDATE clientes SET Nombres = ?, Direccion = ?, Telefono = ?, Cedula = ?, Correo = ? WHERE idClientes = ?");
        return $stmt->execute([$nombres, $direccion, $telefono, $cedula, $correo, $id]);
    }

    // Eliminar cliente
    public function eliminarCliente($id) {
        $stmt = $this->db->prepare("DELETE FROM clientes WHERE idClientes = ?");
        return $stmt->execute([$id]);
    }
}
?>
