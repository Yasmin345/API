<?php
    //criando classe de conexão
    class ConexaoBanco{
        private $host = "localhost"; // endereço do banco de dados
        private $usuario = "root"; //nome de usuario
        private $senha = ""; //senha
        private $bancoDados = "aulao"; // nome do banco de dados
        
        
    

    //função de conecção
    public function getConexao(){
            //variavel q guarda a conexão
                    // driver do DB do mysql que vem no xaamp
            $con = new mysqli($this->host, $this->usuario, $this->senha, $this-> bancoDados); // seguir ordem pré-definida do drive

        // verificando conexão
        if ($con -> connect_error){
            // o die faz com que ele executa o que esta dentro e interrompe todo o resto 
            die("Conexão Com Banco de Dados Falhou!" . $con -> connect_error); // .$con..serve para exibir a descrição do erro
        } else {
            echo "conexão bem sucedida!";
        }

        return $con; // retorna o objeto no caso a conexão
    }
    

}
?>