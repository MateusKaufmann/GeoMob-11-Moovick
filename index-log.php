<?php
// Conexão
require_once 'conexao.php';
require_once 'reparo.php';

// Sessão
session_start();

// Verificação
if (!isset($_SESSION['logado'])) :
    header('Location: index.php');
endif;

// Dados e variáveis
$id = $_SESSION['id_usuario'];
$sql = "SELECT * FROM usuarios WHERE id = '$id'";
$resultado = mysqli_query($connect, $sql);
$dados = mysqli_fetch_array($resultado);
$turma = $dados['turma'];
$agenda = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM turmas WHERE turma = '$turma'"));
$numero_linhas = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(id) FROM turmas;"));
if ($dados['tipo'] == 'professor') :
    $tipo = "Professor";
else :
    $tipo = "Aluno";
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/animacao.css">
    <link rel="stylesheet" href="css/_vanishIn.scss">
    <link rel="icon" type="imagem/png" href="/assets/icone.png" />
    <script src="https://cdnjs.com/libraries/bodymovin" type="text/javascript"></script>

</head>

<body>
    <!--Parte do Logo-->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent text-light">
            <a class="navbar-brand"><img src="upload/<?php echo $dados['arquivo']?>"
                    style="height: 2.5rem; width: 2.5rem;" class="rounded-circle"> Olá
                <?php echo $dados['login']; ?>!</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-light" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdownMenuLink"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="infoconta.php"><i class="fas fa-user"></i> Minhas
                                Informações</a>
                            <a class="dropdown-item" href="mudarsenha.php"><i class="fas fa-key"></i> Mudar Senha</a>
                            <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>








        <div class="container text-center" id="home">
            <div class="row">

                <div class="col-md-12 col-sm-12 mh-75" style="overflow-Y: hidden;">
                    <img class="animated animated vanishIn fast mh-100" src="assets/logomarca1.png" alt="">
                </div>
            </div>
        </div>
    </header>
    <!--Parte do Conteúdo/Menus-->
    <main>
        <section class="secao-1" id="secao-1">
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-12 animated puffIn">

                        <div class="container-fluid justify-content-md-center">
                            <div class="row justify-content-md-center">
                                <div
                                    class="col-sm-2 alert-dark mr-3 ml-3 shadow-lg p-3 mb-3 bg-secondary rounded  animated vanishIn faster justify-content-md-center">
                                    <center>
                                        <a class="nav-link fonte text-dark" href="mobnote.php">
                                            <script
                                                src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js">
                                            </script>
                                            <lottie-player
                                                src="https://assets9.lottiefiles.com/datafiles/lwjM2vQf6cSbmAu/data.json"
                                                background="transparent" speed="0.8" style="width: 3rem; height: 3rem;"
                                                loop autoplay>
                                            </lottie-player><br/>MobNote
                                        </a>
                                    </center>
                                </div>
                                <div
                                    class="col-sm-2 alert-dark mr-3 ml-3 shadow-lg p-3 mb-3 bg-warning rounded  animated vanishIn fast justify-content-md-center">
                                    <center>
                                        <a class="nav-link text-dark" href="cursos.php">
                                            <script
                                                src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js">
                                            </script>
                                            <lottie-player
                                                src="https://assets6.lottiefiles.com/temporary_files/pfnmY4.json"
                                                background="transparent" speed="0.8" style="width: 3rem; height: 3rem;"
                                                loop autoplay>
                                            </lottie-player><br/>Cursos
                                        </a>
                                    </center>
                                </div>

                                <div
                                    class="col-sm-2 alert-dark mr-3 ml-3 shadow-lg p-3 mb-3 bg-info rounded  animated vanishIn justify-content-md-center">
                                    <center>
                                        <a class="nav-link text-dark" href="infoconta.php">
                                            <script
                                                src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js">
                                            </script>
                                            <lottie-player
                                                src="https://assets1.lottiefiles.com/datafiles/hwymw0tkrW6mtpj/data.json"
                                                background="transparent" speed="0.8" style="width: 3rem; height: 3rem;"
                                                loop autoplay>
                                            </lottie-player><br/>Configurações
                                        </a>
                                    </center>
                                </div>
                                <div
                                    class="col-sm-2 alert-dark mr-3 ml-3 shadow-lg p-3 mb-3 bg-danger rounded animated vanishIn slowjustify-content-md-center">
                                    <center>
                                        <a class="nav-link text-dark" href="feedback.php">
                                            <script
                                                src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js">
                                            </script>
                                            <lottie-player src="https://assets7.lottiefiles.com/temp/lf20_oGlWy5.json"
                                                background="transparent" speed="0.8" style="width: 3rem; height: 3rem;"
                                                loop autoplay>
                                            </lottie-player><br/>Feedback
                                        </a>
                                    </center>
                                </div>

                            </div>
                            <div class="row justify-content-md-center">

                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </section>

        <!--Cursos-->

        <section class="secao-2 container-fluid p-0">

            <div class=" container-fluid text-center autoAnimacaoSlide">
                <section class="secao-4 autoAnimacaoSlide">
                    <div class="container text-center">
                        <h1 class="autoAnimacaoSlide">Meus Cursos</h1>
                    </div>
                    <section class="secao-1">
                        <div class="container text-center">
                            <div class="row">
                                <div class="col-md-12 autoAnimacaoSlide">
                                    <div class="panel text-left shadow-lg">
                                        <table class="table">
                                            <thead>
                                                <tr>

                                                    <th scope="col">Nome</th>
                                                    <th scope="col">Turma</th>
                                                    <th scope="col">Ações</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                            $contavel = 0;

                                            $tabela = $_SESSION['id_usuario'];

                                            for ($i = 1; $i <= intval($numero_linhas[0]); $i++) {
                                                $nometurma = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM turmas WHERE id = '$i';"));
                                                $idcurso = $nometurma['unico'];
                                                $resultado = mysqli_query($connect, "SELECT * FROM `$tabela` WHERE id = '$idcurso'");
                                                if (mysqli_num_rows($resultado) > 0) {
                                                    if (!empty($nometurma)) {
                                                        $nometurma2 = $nometurma['turma'];
                                                        $mensagemdelete =  '"Deseja sair deste curso e excluí-lo de sua lista? Essa ação não poderá ser desfeita!"';
                                                        echo "<tr>
                                                
                                                
                                                <td>" . $nometurma['nome'] . "</td>
                                                <td>" . $nometurma2 . "</td>
                                                <td><a class='text-sucess' href='turma.php?turma=" . $idcurso . "' >Acessar</a> - <a href='saircurso.php?codigo=" . $nometurma['unico'] . "' onclick='return confirm(" . $mensagemdelete . ")' class='text-danger'>Sair</a>
                                              </tr>";
                                              $contavel += 1;
                                                    }
                                                }
                                            }
                                             if ($contavel <= 0) {
                                                echo "<tr>
                                                
                                                
                                                <td> Nenhum curso </td>
                                                <td> - </td>
                                                <td> - </a>
                                              </tr>";
                                             }
                                            ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
            </div>


        </section>
        </div>
        <br />
        <br />
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