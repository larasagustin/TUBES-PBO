<?php
class Product {
    private $conn;
    private $table = "products";

    public $id;
    public $name;
    public $price;
    public $stock;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create Product
    public function create() {
        $query = "INSERT INTO " . $this->table . " (name, price, stock) VALUES (:name, :price, :stock)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':stock', $this->stock);
        return $stmt->execute();
    }

    // Read Products
    public function read() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Update Product
    public function update() {
        $query = "UPDATE " . $this->table . " SET name = :name, price = :price, stock = :stock WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':stock', $this->stock);
        return $stmt->execute();
    }

    // Delete Product
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}
?>
