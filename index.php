<?php
// Configuração do banco de dados
$host = 'localhost';
$dbname = 'portfolio';
$user = 'root';
$password = '';

try {
    // Criar conexão com PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);

    // Configurar modo de erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Receber os dados do formulário
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $email_alternativo = $_POST['email_alternativo'] ?? '';
    $mensagem = $_POST['mensagem'] ?? '';

    // Preparar a query
    $sql = "INSERT INTO envios (nome, email, telefone, email_alternativo, mensagem) 
            VALUES (:nome, :email, :telefone, :email_alternativo, :mensagem)";

    $stmt = $conn->prepare($sql);

    // Associar parâmetros
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':email_alternativo', $email_alternativo);
    $stmt->bindParam(':mensagem', $mensagem);

    // Executar
    if ($stmt->execute()) {
        echo "Mensagem enviada com sucesso!";
    } else {
        echo "Erro ao enviar a mensagem.";
    }

} catch (PDOException $e) {
    echo "Erro na conexão ou execução: " . $e->getMessage();
}
?>
