<?php
require_once 'usuario.php';

// cria uma nova instância da classe Usuario
$usuario = new Usuario();

// conectar ao banco de dados
$usuario->conectar('crud', 'localhost', 'root', '');  // conectando com banco de dados

// verifica se houve erro na conexão
if ($usuario->msgErro != "") {
    echo "<div style='color: red;'>Erro de conexão: " . $usuario->msgErro . "</div>";
    exit; // se houver erro, interrompe o processo de execução
}

// verifica se o ID do usuário foi passado pela URL
if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];

    // buscar os dados do usuário
    $sql = $usuario->getPdo()->prepare("SELECT * FROM usuarios WHERE id_usuario = :id");
    $sql->bindValue(':id', $id_usuario);
    $sql->execute();

    $usuario_data = $sql->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        #atualizar os dados do usuário com os dados do formulário
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];

        $update_sql = $usuario->getPdo()->prepare("UPDATE usuarios SET nome = :nome, telefone = :telefone, email = :email WHERE id_usuario = :id");
        $update_sql->bindValue(':nome', $nome);
        $update_sql->bindValue(':telefone', $telefone);
        $update_sql->bindValue(':email', $email);
        $update_sql->bindValue(':id', $id_usuario);
        
        if ($update_sql->execute()) {
            header('Location: usuario_cadastrados.php');
            exit;
        } else {
            echo '<div id="msn-erro">Erro ao atualizar usuário.</div>';
        }
    }
} else {
    echo '<div id="msn-erro">Usuário não encontrado.</div>';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
</head>
<body>
    <h2>Editar Usuário</h2>
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo $usuario_data['nome']; ?>" required><br>

        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" id="telefone" value="<?php echo $usuario_data['telefone']; ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $usuario_data['email']; ?>" required><br>

        <input type="submit" value="Atualizar">
    </form>

    <br>
    <a href="usuario_cadastrados.php">Voltar para a lista de usuários</a>
</body>
</html>
