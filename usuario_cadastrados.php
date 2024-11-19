<?php
// Inclui o arquivo da classe Usuario
require_once 'usuario.php';

// Cria uma nova instância da classe Usuario
$usuario = new Usuario();

// Conecta ao banco de dados
$usuario->conectar('crud', 'localhost', 'root', '');

// Chama o método listarUsuarios para obter todos os usuários
$usuarios = $usuario->listarUsuarios();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
</head>
<body>
    <h2>Lista de Usuários Cadastrados</h2>

    <!-- tabela para exibir dados -->
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Ações</th> <!-- coluna para os botões de ação -->
            </tr>
        </thead>
        <tbody>
            <?php
            // verifica se existem usuários cadastrados
            if (count($usuarios) > 0) {
                // exibe cada usuário em uma linha da tabela
                foreach ($usuarios as $usuario) {
                    echo "<tr>";
                    echo "<td>" . $usuario['id_usuario'] . "</td>";
                    echo "<td>" . $usuario['nome'] . "</td>";
                    echo "<td>" . $usuario['telefone'] . "</td>";
                    echo "<td>" . $usuario['email'] . "</td>";
                    echo "<td>
                            <a href='editar.php?id=" . $usuario['id_usuario'] . "'><button>Editar</button></a>
                            <a href='excluir.php?id=" . $usuario['id_usuario'] . "'><button>Excluir</button></a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                // caso não haja usuários, exibe uma mensagem
                echo "<tr><td colspan='5'>Nenhum usuário cadastrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <br>
    <a href="index.php">Voltar para a página inicial</a>
</body>
</html>
