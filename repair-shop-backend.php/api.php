<?php
header("Content-Type: application/json");
require 'db.php';

$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? null;

switch ($action) {
    case 'getCustomers':
        $stmt = $pdo->query("SELECT * FROM customers");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        break;

    case 'addCustomer':
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare("INSERT INTO customers (name, email, phone) VALUES (:name, :email, :phone)");
        $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':phone' => $data['phone']
        ]);
        echo json_encode(['message' => 'Customer added successfully']);
        break;

    // Add similar cases for employees and repair jobs
    default:
        echo json_encode(['message' => 'Invalid action']);
        break;
}
?>
