<?php
// Conexão
        require_once 'conexao.php';
require_once 'reparo.php';

// Sessão
        session_start();

// Verificação
if(!isset($_SESSION['logado-prof'])) {
    header('Location: index.php');
} else {

// Dados e variáveis
        $id = $_SESSION['id_usuario'];
        $sql = "SELECT * FROM usuarios WHERE id = '$id'";
        $resultado = mysqli_query($connect, $sql);
        $dados = mysqli_fetch_array($resultado);
        $turma = $dados['turma'];
        $turma_session = $_SESSION['turmaacesso'];
        $numero_linhas_cont = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(turma) FROM conteudos;"));
        $sql2 = "SELECT * FROM turmas where turma = '$turma'";
        $resultado2 = mysqli_query($connect, $sql2);
        $dados2 = mysqli_fetch_array($resultado2);
        mysqli_query($connect, "SET @count = 0;");
        mysqli_query($connect, " UPDATE turmas SET turmas.id = @count:= @count + 1;");
        if($dados['tipo'] == 'professor'):
            $tipo= "Professor";
        else:
            $tipo= "Aluno";
        endif;


        $codigo = $_GET['codigo'];
        mysqli_query($connect, "DELETE from turmas WHERE id = $codigo;");
}
?>
<body onload='window.history.back();'></body>