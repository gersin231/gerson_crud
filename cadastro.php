<?php  
    require_once 'usuario.php';
    $usuario=new Usuario();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <h2>CADASTRO DE USUÁRIO</h2>
    <form action="" method="post">
        <label>Nome:</label>
        <input type="text" name="nome" id="" placeholder="Digite seu nome.">
        <label>Email:</label>
        <input type="email" name="email" id="" placeholder="Digite seu email.">
        <label>tel:</label>
        <input type="tel" name="tel" id="" placeholder="Digite seu Telefone."> 
        <label>Senha:</label>
        <input type="password" name="senha" id="" placeholder="Digite seu senha.">
        <label>Confirmar Senha:</label>
        <input type="password" name="confSenha" id="" placeholder="Confirmar sua senha.">
        <input type="submit" value="CADASTRAR">
        <A href="index.php">VOLTAR</a>
</form>
<?php  
if(isset($_POST['nome']))
    {
    $nome=$_POST['nome'];
    $telefone=$_POST['tel'];
    $email=$_POST['email'];
    $senha=$_POST['senha'];
    $confSenha=$_POST['confSenha'];
    
    if(!empty($nome) && !empty($telefone) && !empty($email)&& !empty($senha)&& !empty($confSenha))
    {
        $usuario->conectar('crud','localhost', 'root','');
        if($usuario->msgErro == "")
        {
            if($senha == $confSenha)
            {
                if($usuario->cadastrar($nome, $telefone,$email,$senha))
                {
                    echo '<div id="msn-sucesso">Cadastrado com sucesso! Clique <a href="index.php">aqui</a> para logar.</div>';
                }
                
                else
                {
                    echo '<div id="msn-erro">Erro: ' . $usuario->msgErro . '</div>';
                }
            }
            else
            {
                echo '<div id="msn-erro">As senhas não coincidem. Tente novamente.</div>';

            }
        }
        else
        {  
            echo '<div id="msn-erro">Erro: ' . $usuario->msgErro . '</div>';
        }
    }

else
{   
     echo '<div id="msn-erro">Por favor, preencha todos os campos.</div>';
}
}
?> 
</body>
</html>