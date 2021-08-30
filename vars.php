<?php
    //cadastro

    $erros = "";
    $login = mysqli_escape_string($connect, $_POST['nome']);
    $sobrenome = mysqli_escape_string($connect, $_POST['sobrenome']);
    $datamade = date('d/m/y');
    $senha = mysqli_escape_string($connect, $_POST['senha']);
    $senha2 = mysqli_escape_string($connect, $_POST['senhaconfirma']);
    $cpf = mysqli_escape_string($connect, $_POST['cpf']);
    $turma = mysqli_escape_string($connect, $_POST['turma']);
    $turmasenha = mysqli_escape_string($connect, $_POST['turmasenha']);



?>