<?php
require __DIR__ . '/bd_conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['password']; 

    $stmt = $conn->prepare("INSERT INTO usuario (email, senha) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $senha);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'fail';
    }
}
?>
