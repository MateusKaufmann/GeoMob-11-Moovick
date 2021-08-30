<?php
// Conexão
        require_once 'conexao.php';
require_once 'reparo.php';

// Sessão
        session_start();

// Verificação e exclusão
if(!isset($_SESSION['logado'])) {
    header('Location: index.php');
} else {
        $id = $_SESSION['id_usuario'];
        $sql = "SELECT * FROM usuarios WHERE id = '$id'";
        $resultado = mysqli_query($connect, $sql);
        $dados = mysqli_fetch_array($resultado);
        $turma = $dados['turma'];
        mysqli_query($connect, "SET @count = 0;");
        mysqli_query($connect, " UPDATE turmas SET turmas.id = @count:= @count + 1;");
        $codigo = $_GET['codigo'];
        mysqli_query($connect, "DELETE from `$id` WHERE id = '$codigo';");
}
?>
<body onload='window.history.back();'></body>