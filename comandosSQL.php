<?php 

    require_once "conexao.php"; // usado para incluir o conexao.php nesse arquivo, podendo ser reutilizado aqui

    // declarando variaveis 
    $nome;
    $email;

    // dentro do servidor, pegamos o método de requisão e se for igual o post(usado no index, dentro do form)
    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        // nome do input no form, que sera a chave
        $nome = $_POST['nome'];
        $email = $_POST['email'];
    }

    // instanciando a classe de conexão
    $conexao = new ConexaoBanco();
    // chamando a função
    $con = $conexao->getConexao();

    // INSERT
    // variavel q vai guardar o comando sql
                // recebe a consulta e prepara o banco
    $sql = $con -> prepare("INSERT INTO  user (nome, email) VALUES (?,?)"); // sem valores pois virão do front

    if ($sql) { // verifica se sql existe e não é nula  Se houve algum erro na preparação, o valor de $sql será false, e o bloco dentro do if não será executado.

        // blind_param coloca os valores reais nos espaços certos (?)
        // ss define o tipo da variavel q vai entrar, no caso duas Strings 
        $sql->bind_param("ss", $nome, $email);

        // enviar a tarefa e tudo ocorreu bem 
        if ($sql -> execute()){
            echo "<br> Novo registro criado com Sucesso <br>";
        } else{
            echo"Erro ao criar registro: " . $sql->error;
        }

        $sql -> close(); // fechando pois nao usaremos mais

    // se criou o prepare criou o sql só essas duas opçoes acima podem ocorrer, mas caso não tenha criado (↓)

    } else {
        echo "Erro ao preparar o SQL: " . $con->error;
    }


    
    // select
    // result guarda o resultado da pesquisa, e query é usada para enviar uma consultaao DB
    $result = $con -> query("SELECT * FROM user");

    // se o numero de linhas da consulta for maior que zero
    if($result ->num_rows >0){
        // fetch assoc faz com que cada linha seja apresentada como um array com chaves e valores
        while ($linha= $result-> fetch_assoc()){ // loop para percorrer linhas 
            // desmembrando e colocando - (. usado para concatenar)
            echo  $linha["nome"] . " - " . $linha["email"] . " <br>";

        }
    }
    
    
    

?>