<?php
// Conexão
require_once 'conexao.php';
require_once 'reparo.php';

// Sessão
session_start();
$id = $_SESSION['id_usuario'];
$cont = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM usuarios WHERE id = '$id'"));

// Verificação
if(!isset($_SESSION['logado']) and !isset($_SESSION['logado-prof'])):
    header('Location: index.php');
endif;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Moovick</title>
    <!--Link do Arquivo CSS do Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/animacao.css">
    <link rel="icon" type="imagem/png" href="/assets/icone.png" />
</head>

<body>
    <!--Parte do Logo-->
    <header>
        <div class="container-fluid p-0">
        <nav class="navbar fixed-top navbar-expand-lg navbar-light" style="background-color: whitesmoke;">
                <a class="navbar-brand" href=""><i class="fas fa-user-friends"></i> Olá
                    <?php echo $cont['login']; ?>!</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home <span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="true" aria-expanded="false"><i class="fas fa-cogs"></i> Ações</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="feedback.php"><i class="fas fa-exclamation-triangle"></i>
                                    Tenho um
                                    Problema</a>
                                <a class="dropdown-item" href="mudarsenha.php"><i class="fas fa-key"></i> Mudar
                                    Senha</a>
                                <a class="dropdown-item" href="infoconta.php"><i class="fas fa-address-card"></i> Minhas
                                    Informações</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!--Parte do Conteúdo/Menus-->
    <main>
        <section class="secao-1">
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-12 autoAnimacaoSlide">
                        <div class="panel text-left shadow-lg">
                            <h1 class="animated"><i class="fas fa-book-open"></i> Edições Salvas</h1>
                            <a class="nav-link animated heartBeat slow">Tudo o que você escreveu foi salvo em seu MobNote! </a><a href="mobnote.php">Voltar.</a>

                            <br />

                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
        </section>
        <section class="secao-5 container-fluid p-0 text-center">
            <div class="row">
                <div class="col-md-12 col-sm-12 fonte">
                    <h4>&copy; Moovick - <?php echo date("Y"); ?></h4>
                    <p>Banco de Dados e UI Design por Mateus e Érica. Uso de Bootstrap.</p>
                </div>
            </div>
        </section>
    </main>

    <!--Links para os arquivos JS do Bootstrap e para o JQuery-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/0cc6547d66.js"></script>
    <script src="js/javascript.js"></script>

</body>

</html>