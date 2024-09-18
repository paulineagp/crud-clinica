<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" type="text/css" href="/projeto-vs/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Menu</h1>
        <ul>
            <li><a href="crud.php?action=cadastrarPet">Cadastrar Pet</a></li>
            <li><a href="crud.php?action=listarPets">Listar Pets</a></li>
            <li><a href="crud.php?action=atualizarPet">Atualizar Pet</a></li>
            <li><a href="crud.php?action=excluirPet">Excluir Pet</a></li>
            <li><a href="crud.php?action=cadastrarTutor">Cadastrar Tutor</a></li>
            <li><a href="crud.php?action=listarTutores">Listar Tutores</a></li>
            <li><a href="crud.php?action=atualizarTutor">Atualizar Tutor</a></li>
            <li><a href="crud.php?action=excluirTutor">Excluir Tutor</a></li>
        </ul>
        <a href="logout.php" class="logout-button">Logout</a>
        <div class="form-container">
            <?php
            require 'pet_crud.php'; 

            try {
                $pdo = new PDO('mysql:host=localhost;dbname=clinica', 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $petCRUD = new PetCRUD($pdo);
                $tutorCRUD = new TutorCRUD($pdo);

                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {
                        case 'cadastrarPet':
                            echo '<form method="POST" action="crud.php?action=savePet">
                                    <label for="nome">Nome do Pet:</label>
                                    <input type="text" id="nome" name="nome" required>
                                    <label for="tipo">Tipo do Pet:</label>
                                    <input type="text" id="tipo" name="tipo" required>
                                    <label for="id_tutor">ID do Tutor:</label>
                                    <input type="number" id="id_tutor" name="id_tutor" required>
                                    <button type="submit">Cadastrar Pet</button>
                                  </form>';
                            break;
                        case 'listarPets':
                            $petCRUD->listarPets();
                            break;
                        case 'atualizarPet':
                            echo '<form method="POST" action="crud.php?action=updatePet">
                                    <label for="nome">Nome do Pet:</label>
                                    <input type="text" id="nome" name="nome" required>
                                    <label for="novoTipo">Novo Tipo do Pet:</label>
                                    <input type="text" id="novoTipo" name="novoTipo" required>
                                    <button type="submit">Atualizar Pet</button>
                                  </form>';
                            break;
                        case 'excluirPet':
                            echo '<form method="POST" action="crud.php?action=deletePet">
                                    <label for="nome">Nome do Pet:</label>
                                    <input type="text" id="nome" name="nome" required>
                                    <button type="submit">Excluir Pet</button>
                                  </form>';
                            break;
                        case 'cadastrarTutor':
                            echo '<form method="POST" action="crud.php?action=saveTutor">
                                    <label for="nome">Nome do Tutor:</label>
                                    <input type="text" id="nome" name="nome" required>
                                    <label for="telefone">Telefone do Tutor:</label>
                                    <input type="text" id="telefone" name="telefone" required>
                                    <button type="submit">Cadastrar Tutor</button>
                                  </form>';
                            break;
                        case 'listarTutores':
                            $tutorCRUD->listarTutores();
                            break;
                        case 'atualizarTutor':
                            echo '<form method="POST" action="crud.php?action=updateTutor">
                                    <label for="nome">Nome do Tutor:</label>
                                    <input type="text" id="nome" name="nome" required>
                                    <label for="novoTelefone">Novo Telefone do Tutor:</label>
                                    <input type="text" id="novoTelefone" name="novoTelefone" required>
                                    <button type="submit">Atualizar Tutor</button>
                                  </form>';
                            break;
                        case 'excluirTutor':
                            echo '<form method="POST" action="crud.php?action=deleteTutor">
                                    <label for="nome">Nome do Tutor:</label>
                                    <input type="text" id="nome" name="nome" required>
                                    <button type="submit">Excluir Tutor</button>
                                  </form>';
                            break;
                        case 'savePet':
                            $nome = $_POST['nome'];
                            $tipo = $_POST['tipo'];
                            $idTutor = $_POST['id_tutor'];
                            $petCRUD->cadastrarPet($nome, $tipo, $idTutor);
                            break;
                        case 'updatePet':
                            $nome = $_POST['nome'];
                            $novoTipo = $_POST['novoTipo'];
                            $petCRUD->atualizarPet($nome, $novoTipo);
                            break;
                        case 'deletePet':
                            $nome = $_POST['nome'];
                            $petCRUD->excluirPet($nome);
                            break;
                        case 'saveTutor':
                            $nome = $_POST['nome'];
                            $telefone = $_POST['telefone'];
                            $tutorCRUD->cadastrarTutor($nome, $telefone);
                            break;
                        case 'updateTutor':
                            $nome = $_POST['nome'];
                            $novoTelefone = $_POST['novoTelefone'];
                            $tutorCRUD->atualizarTutor($nome, $novoTelefone);
                            break;
                        case 'deleteTutor':
                            $nome = $_POST['nome'];
                            $tutorCRUD->excluirTutor($nome);
                            break;
                        default:
                            echo "Ação inválida.";
                            break;
                    }
                }
            } catch (PDOException $e) {
                die("Erro ao conectar ao banco de dados: " . $e->getMessage());
            }
            ?>
        </div>
    </div>
</body>
</html>
