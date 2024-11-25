<?php 
    class Usuario{
        private $pdo;

        public $msgErro= "";

        public function conectar($nome, $host, $usuario, $senha){
            global $pdo;

            try{
                $this->pdo = new PDO("mysql:dbname=".$nome.";host=" .$host, $usuario, $senha);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Configura para lançar exceções em erros
            }
            catch (PDOException $erro){
                $msgErro = $erro->getMessage();
            }
        }
        public function getpdo() {
            return $this->pdo;
        }

        public function cadastrar($nome, $telefone, $email, $senha){
            global $pdo;

            $sql= $this->pdo->prepare("SELECT id_usuario from usuarios where email=:m");
            $sql->bindValue(":m",$email);
            $sql->execute();
            
            if($sql->rowCount()>0){
                return false;
            }
            else{
                $sql=$this->pdo->prepare("INSERT INTO usuarios(nome,telefone,email,senha)
                values (:n,:t,:e,:s)");
                $sql->bindValue(":n",$nome);
                $sql->bindValue(":t",$telefone);
                $sql->bindValue(":e",$email);
                $sql->bindValue(":s",md5($senha));
                $sql->execute();
                return true;
            }
        }
        public function listarUsuarios() {
            $sql = $this->pdo->prepare("SELECT id_usuario, nome, telefone, email FROM usuarios");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);  # retorna todos os usuários encontrados
        }
        public function excluir($id) {
            $sql = $this->pdo->prepare("DELETE FROM usuarios WHERE id_usuario = :id");
            $sql->bindValue(':id', $id);
            return $sql->execute(); # retorna verdadeiro se a exclusão for bem-sucedida
        }
    

        public function logar($email,$senha)
        {
            global $pdo;

            $verificarEmaiSenha = $this->pdo ->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
            $verificarEmaiSenha ->bindValue(":e",$email);
            $verificarEmaiSenha ->bindValue(":s",md5($senha));
            $verificarEmaiSenha ->execute();
            if($verificarEmaiSenha->rowCount()>0)
            {
                $dados = $verificarEmaiSenha->fetch();
                session_start();
                $SESSION['id_usuario'] =$dados['id_usuario'];
                return true;
            }
            else{return false;}
        }
    
    }
    ?>

