<?php
// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os valores dos campos do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $confirmar_senha = $_POST["confirmar-senha"];
    $data_nascimento = $_POST["data-nascimento"];
    $telefone = $_POST["telefone"]; // Novo campo

    // Verificar se as senhas coincidem
    if ($senha == $confirmar_senha) {
        // Conectar ao banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "projetobd";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Inserir os dados no banco de dados
        $sql = "INSERT INTO usuarios (nome, email, senha, data_nascimento, telefone) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $nome, $email, $senha, $data_nascimento, $telefone);
        $stmt->execute();

        $conn->close();
        header("Location: login.php");
        exit;
    } else {
        echo "Senhas não coincidem";
    }
}
?>