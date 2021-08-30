<?php
// Conexão
require_once 'conexao.php';
require_once 'reparo.php';
// Sessão
session_start();
//Variáveis
$id = $_SESSION['id_usuario'];
$dados = mysqli_fetch_array(mysqli_query($connect,  "SELECT * FROM usuarios WHERE id = '$id'"));
// Verificação
if (!isset($_SESSION['logado-prof'])) :
    header('Location: index.php');
endif;
if ($dados['tipo'] == 'professor') :
    $tipo = "Professor";
else :
    $tipo = "Aluno";
endif;
// Botão enviar
mysqli_query($connect, "ALTER TABLE turmas auto_increment = 1;");
$turma = $_POST['selturma'];
$cont = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM usuarios WHERE id = '$id'"));
$erros = "";
$status = "<script src='https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js'></script>
          <lottie-player 
              src='https://assets1.lottiefiles.com/datafiles/Z1Kn23v4ZVf9y5sBQDTFuuLziHpdFfHGp0z6V24v/Plus/data.json'  background='transparent'  speed='1'  style='height: 4rem; width: 4rem;'  autoplay >
          </lottie-player>";
if (isset($_POST['btn-entrar'])) :

    $cadastrar = mysqli_escape_string($connect, $_POST['selturma']);
    $senhaturma = mysqli_escape_string($connect, $_POST['senhaturma']);
    $nome = mysqli_escape_string($connect, $_POST['nome']);


    if (!empty($cadastrar) and !empty($senhaturma) and !empty($nome)) {

        $testando = mysqli_query($connect, "SELECT * FROM turmas WHERE turma = '$cadastrar';");
        $tempo = md5(time());
            mysqli_query($connect, "SET @count = 0;");
            mysqli_query($connect, " UPDATE turmas SET turmas.id = @count:= @count + 1;");
            mysqli_query($connect, "INSERT INTO turmas
            (turma, id_admin, senha, nome, unico) VALUES ('$cadastrar', '$id', '$senhaturma', '$nome', '$tempo')");

            $erros = "<div class='alert alert-success' role='alert'>
<i class='fas fa-check-double'></i> Cadastrado novo curso: " . $nome .", turma ". $tempo . ".
</div>";
            $status = '<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                    <lottie-player 
                        src="https://assets3.lottiefiles.com/datafiles/OhIfcxnkLsj1Jxj/data.json"  background="transparent"  speed="1"  style="width: 4rem; height: 4rem;" autoplay >
                    </lottie-player>';
    } else {
        $erros = "<div class='alert alert-danger' role='alert'>
            <i class='fas fa-exclamation-triangle'></i> Todos os campos devem ser preenchidos.
          </div>";
        $status = '<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
          <lottie-player 
              src="https://assets5.lottiefiles.com/temp/lf20_tNI4Yn.json"  background="transparent"  speed="1"  style="width: 4rem; height: 4rem;"  autoplay >
          </lottie-player>';
    }


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
    <link rel="stylesheet" href="css/_vanishIn.scss">
    <link rel="icon" type="imagem/png" href="/assets/icone.png" />
    <script src="https://cdnjs.com/libraries/bodymovin" type="text/javascript"></script>
    <script>


    </script>
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
                                        <a class="nav-link fonte text-dark" href="novoconteudo.php">
                                            <script
                                                src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js">
                                            </script>
                                            <lottie-player
                                                src="https://assets9.lottiefiles.com/datafiles/lwjM2vQf6cSbmAu/data.json"
                                                background="transparent" speed="0.8" style="width: 3rem; height: 3rem;"
                                                loop autoplay>
                                            </lottie-player><br/>Novo Conteúdo
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
        <section class="secao-1">
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-12 animated vanishIn faster">
                        <div class="panel text-left shadow-lg">
                            <center>
                                <?php echo $status ?>
                                <h1>Novo Curso</h1>
                            </center>

                            <br />
                            <a class="nav-link animated shake fast"><?php echo $erros; ?></a>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <form>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Número da Turma</label>
                                        <input class="custom-select" type="number" id="inputGroupSelect02" placeholder="Número" name="selturma">
                                        <label for="exampleInputEmail1">Nome do curso</label>
                                        <input class="custom-select" type="text" id="inputGroupSelect02" placeholder="Nome do Curso" name="nome">

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Senha para os alunos (opcional)</label>
                                        <input class="custom-select" type="password" id="inputGroupSelect02" placeholder="Senha para Inscrição" name="senhaturma">
                                    </div>
                                    <small id="emailHelp" class="form-text text-muted">Para visualizar seus cursos, vá
                                        até a página inicial ou clique <a href="index-log-professor.php">aqui</a>.</small>
                                    <br />
                                    <button type="submit" id="carregandobutton" name="btn-entrar" onclick="carregando()" class="btn btn-outline-secondary"><span class="spinner-border spinner-border-sm" role="status" id="carregando" aria-hidden="true" style="display: none;"></span> Cadastrar</button>



                                </form>
                            </form>


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