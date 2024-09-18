<?php

class Pet
{
    private $nome;
    private $tipo;

    public function __construct($nome, $tipo)
    {
        $this->nome = $nome;
        $this->tipo = $tipo;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function __toString()
    {
        return "Nome: " . $this->nome . ", Tipo: " . $this->tipo;
    }
}

class Tutor
{
    private $nome;
    private $telefone;

    public function __construct($nome, $telefone)
    {
        $this->nome = $nome;
        $this->telefone = $telefone;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function __toString()
    {
        return "Nome: " . $this->nome . ", Telefone: " . $this->telefone;
    }
}

class PetCRUD
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function cadastrarPet($nome, $tipo, $idTutor)
    {
        $stmt = $this->pdo->prepare("INSERT INTO pet (nome_pet, tipo_pet, id_tutor) VALUES (:nome, :tipo, :id_tutor)");
        $stmt->execute([':nome' => $nome, ':tipo' => $tipo, ':id_tutor' => $idTutor]);
        echo "Pet cadastrado com sucesso!\n";
    }

    public function listarPets()
    {
        $stmt = $this->pdo->query("SELECT nome_pet, tipo_pet FROM pet");
        $pets = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "Lista de Pets:\n";
        foreach ($pets as $pet) {
            echo "Nome: " . $pet['nome_pet'] . ", Tipo: " . $pet['tipo_pet'] . "\n";
        }
    }

    public function atualizarPet($nome, $novoTipo)
    {
        $stmt = $this->pdo->prepare("UPDATE pet SET tipo_pet = :novoTipo WHERE nome_pet = :nome");
        $stmt->execute([':novoTipo' => $novoTipo, ':nome' => $nome]);

        if ($stmt->rowCount() > 0) {
            echo "Pet atualizado com sucesso!\n";
        } else {
            echo "Pet não encontrado.\n";
        }
    }

    public function excluirPet($nome)
    {
        $stmt = $this->pdo->prepare("DELETE FROM pet WHERE nome_pet = :nome");
        $stmt->execute([':nome' => $nome]);

        if ($stmt->rowCount() > 0) {
            echo "Pet excluído com sucesso!\n";
        } else {
            echo "Pet não encontrado.\n";
        }
    }
}

class TutorCRUD
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function cadastrarTutor($nome, $telefone)
    {
        $stmt = $this->pdo->prepare("INSERT INTO tutor (nome_tutor, telefone_tutor) VALUES (:nome, :telefone)");
        $stmt->execute([':nome' => $nome, ':telefone' => $telefone]);
        echo "Tutor cadastrado com sucesso!\n";
    }

    public function listarTutores()
    {
        $stmt = $this->pdo->query("SELECT nome_tutor, telefone_tutor FROM tutor");
        $tutores = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "Lista de Tutores:\n";
        foreach ($tutores as $tutor) {
            echo "Nome: " . $tutor['nome_tutor'] . ", Telefone: " . $tutor['telefone_tutor'] . "\n";
        }
    }

    public function atualizarTutor($nome, $novoTelefone)
    {
        $stmt = $this->pdo->prepare("UPDATE tutor SET telefone_tutor = :novoTelefone WHERE nome_tutor = :nome");
        $stmt->execute([':novoTelefone' => $novoTelefone, ':nome' => $nome]);

        if ($stmt->rowCount() > 0) {
            echo "Tutor atualizado com sucesso!\n";
        } else {
            echo "Tutor não encontrado.\n";
        }
    }

    public function excluirTutor($nome)
    {
        $stmt = $this->pdo->prepare("DELETE FROM tutor WHERE nome_tutor = :nome");
        $stmt->execute([':nome' => $nome]);

        if ($stmt->rowCount() > 0) {
            echo "Tutor excluído com sucesso!\n";
        } else {
            echo "Tutor não encontrado.\n";
        }
    }
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=clinica', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

?>
