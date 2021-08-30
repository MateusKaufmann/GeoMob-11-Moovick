<?php
// Conexão
        require_once 'conexao.php';

// Sessão
        session_start();

// Verificação
if(!isset($_SESSION['logado-prof'])) {
    header('Location: index.php');
} else {

// Dados e variáveis
        $id = $_SESSION['id_usuario'];
        $codigo = $_GET['conteudo'];
        $dados_conteudo = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos WHERE id = '$codigo'"));
        $arquivo = $dados_conteudo['conteudo'];
        mysqli_query($connect, "DELETE from conteudos WHERE id = $codigo;");
        unlink("conteudos/$arquivo");
        mysqli_query($connect, "SET @count = 0;");
        mysqli_query($connect, " UPDATE conteudos SET conteudos.id = @count:= @count + 1;");
}
?>
<body onload='window.history.back();'></body>