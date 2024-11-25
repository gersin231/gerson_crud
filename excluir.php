<?php
require_once 'usuario.php';
$usuario = new Usuario();

#verifica se o ID foi passado pela URL
if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];

    #conectar ao banco de dados
    $usuario->conectar('crud', 'localhost', 'root', '');

    #chama o método para excluir o usuário
    if ($usuario->excluir($id_usuario)) {
    #redireciona para a lista de usuários após a exclusão
        header('Location: usuario_cadastrados.php');
    } else {
    #se não conseguir excluir, exibe uma mensagem de erro
        echo 'Erro ao excluir usuário.';
    }
} else {
    #se não passar o ID, exibe uma mensagem de erro
    echo 'Usuário não encontrado.';
}
?>
