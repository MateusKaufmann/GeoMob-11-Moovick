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
    <link rel="stylesheet" href="css/_puffIn.scss">
    <link rel="icon" type="imagem/png" href="/assets/icone.png" />
    <script src="https://cdnjs.com/libraries/bodymovin" type="text/javascript"></script>
</head>

<body>
    <!--Parte do Logo-->
    <header>
        <div class="container-fluid p-0 justify-content-md-center">
            <div class="pos-f-t">
                <div class="collapse" id="navbarToggleExternalContent">
                    <div class="bg-dark p-4">
                        <a class="navbar-brand" href=""><img src="upload/<?php echo $dados['arquivo']?>"
                                style="height: 2.5rem; width: 2.5rem;" class="rounded-circle"> Olá
                            <?php echo $dados['login']; ?>!</a><br />

                        <span class="text-muted">Perfil de <?php echo $tipo; ?></span><br /><br />

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
                                        <a class="nav-link fonte text-dark" href="index.php">
                                            <script
                                                src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js">
                                            </script>
                                            <lottie-player src="https://assets2.lottiefiles.com/temp/lf20_tUrEqM.json"
                                                background="transparent" speed="0.8" style="width: 3rem; height: 3rem;"
                                                loop autoplay>
                                            </lottie-player><br/>Início
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
                            <br />
                            <br />
                        </div>


                    </div>
                </div>
                <nav class="navbar navbar-dark bg-transparent text-dark justify-content-md-center">

                    <button class="btn btn-link" type="button" data-toggle="collapse"
                        data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js">
                        </script>
                        <lottie-player src="https://assets7.lottiefiles.com/packages/lf20_UOfiyS.json"
                            background="transparent" speed="1" style="width: 2rem; height: 2rem;" autoplay>
                        </lottie-player>
                    </button>


                </nav>
            </div>
        </div>
    </header>
    <!--Parte do Conteúdo/Menus-->
    <main>
        <!--Segurança da conta-->
        <br />
        <br />
        <br />
        <div class=" container-fluid text-center autoAnimacaoSlide">
            <section class="secao-4 autoAnimacaoSlide">
                <div class="container text-center">
                    <h1 class="autoAnimacaoSlide">Cursos Disponíveis</h1>
                </div>
                <section class="secao-1">
                    <div class="container text-center">
                        <div class="row">
                            <div class="col-md-12 animated vanishIn">
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
                                                $num = 0;
                                                $numero_linhas = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(id) FROM turmas;"));
                                                for ($i = 1; $i <= intval($numero_linhas[0]); $i++) {
                                                    $nometurma = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM turmas WHERE (id = $i);"));
                                                    $tabela = $id;
                                                    
                                                    if ($nometurma != "") {
                                                        $nometurma2 = $nometurma['unico'];
                                                        $nometurma3 = $nometurma['id'];
                                                        $testar = mysqli_query($connect, "SELECT id FROM `$tabela` WHERE id = '$nometurma2';");
                                                        $mensagemdelete =  '"Deseja sair deste curso e excluí-lo de sua lista? Essa ação não poderá ser desfeita!"';
                                                        if (mysqli_num_rows($testar) == 0) {
                                                            $num++;
                                                        echo "<tr>
                                                
                                                                <td>".$nometurma['nome']."</td>
                                                                <td>".$nometurma['turma']."</td>
                                                                <td><a href='inscrevercurso.php?id=".$nometurma['unico']."'>Inscrever-me</a></td>
                                                                </tr>
                                                            
                                                    ";
                                                        } else {
                                                            
                                                                $num++;
                                                            echo "<tr>
                                                                    
                                                                    <td>".$nometurma['nome']."</td>
                                                                    <td>".$nometurma['turma']."</td>
                                                                    <td><a class='text-success' href='turma.php?turma=" . $nometurma['unico'] . "' >Acessar</a> - <a href='saircurso.php?codigo=" . $nometurma['unico'] . "' onclick='return confirm(" . $mensagemdelete . ")' class='text-danger'>Sair</a></td>
                                                                    </tr>
                                                                
                                                        ";
                                                         
                                                        }
                        }
                    }
                    ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </section>
        </div>




        <br />
        <br />


        <!--Sobre os desenvolvedores (seção 4)-->
        <section class="secao-5 container-fluid p-0 text-center">
            <div class="row">
                <div class="col-md-12 col-sm-12 fonte">
                    <h4>&copy; Mateus e Érica - 2019</h4>
                    <p>Banco de Dados e Design por Mateus e Érica. Uso de Bootstrap.</p>
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