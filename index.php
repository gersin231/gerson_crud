<?php
    require_once 'usuario.php';
    $usuario = new Usuario();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Login</title>
</head>
<body>
    <h2>CRUD - CREATE READ UPDATE DELETE</h2>
    <h3>Tela Login</h3>
    <form method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="Digite seu email." required>
        
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
        
        <input type="submit" value="LOGAR">
        <a href="cadastro.php">CADASTRE-SE</a>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if (!empty($email) && !empty($senha)) {
            // conectar ao banco de dados
            $usuario->conectar('crud', 'localhost', 'root', '');
            
            // verifica se não houve erro na conexão
            if ($usuario->msgErro == "") {
                // tenta fazer o login
                if ($usuario->logar($email, $senha)) {
                    // Redireciona para a área privada em caso de sucesso
                    header("Location: usuario_cadastrados.php");
                    exit; // Garanta que o código após o redirecionamento não seja executado
                } else {
                    // se falhar, exibe mensagem de erro
                    echo '<div id="msn-erro">Email e/ou senha estão incorretos.</div>';
                }
            } else {
                // se houver erro na conexão, exibe a mensagem de erro
                echo '<div id="msn-erro">Erro: ' . $usuario->msgErro . '</div>';
            }
        } else {
            // se os campos estão vazios, exibe uma mensagem
            echo '<div id="msn-erro">Por favor, preencha todos os campos.</div>';
        }
    }
    ?>
</body>
</html>
