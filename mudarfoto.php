<?php
// Conexão
require_once 'conexao.php';
require_once 'reparo.php';

// Sessão
session_start();

// Verificação
if(!isset($_SESSION['logado']) && !isset($_SESSION['logado-prof'])):
    header('Location: index.php');
endif;

$id = $_SESSION['id_usuario'];
$status = "<script src='https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js'>
                                </script>
                                <lottie-player src='https://assets9.lottiefiles.com/datafiles/9jPPC5ogUyD6oQq/data.json'
                                    background='transparent' speed='1' style='width: 6rem; height: 6rem;'' loop autoplay>
                                </lottie-player>
                                <br />";
         $sql = "SELECT * FROM usuarios WHERE id = '$id'";
        $resultado = mysqli_query($connect, $sql);
        $dados = mysqli_fetch_array($resultado);
        if($dados['tipo'] == 'professor'):
            $tipo= "Professor";
        else:
            $tipo= "Aluno";
        endif;

// Botão enviar
if(isset($_POST['btn-entrar'])):
	    $erros = "";
	    $titulo = mysqli_escape_string($connect, $_POST['titulo']);
        $resumo = mysqli_escape_string($connect, $_POST['resumo']);
        $id = $_SESSION['id_usuario'];
        
        $cont = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM usuarios WHERE id = '$id'"));
        $dados_turma = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM turmas WHERE turma = '$turma'"));
        $numero_linhas = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(id) FROM turmas;"));
        $todas_turmas = array(mysqli_query($connect, "SELECT turma FROM turmas;"));
        $dados2 =  mysqli_fetch_array(mysqli_query($connect, "SELECT turma FROM turmas"));
        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
        $novo_nome = md5(time()) . $extensao;
        $diretorio = "conteudos/";
        $erros = "";
        $data = date('d/m/y');
        $texto = mysqli_escape_string($connect, $_POST['texto']);
        mysqli_query($connect, "ALTER TABLE conteudos AUTO_INCREMENT = 1;");
        
	if(($_FILES['arquivo']['size'] == 0)) {
		$erros = "<div class='alert alert-danger' role='alert'>
            <i class='fas fa-exclamation-triangle'></i> Falha! Não há arquivo!
          </div>";
          $status = '<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
          <lottie-player 
              src="https://assets5.lottiefiles.com/temp/lf20_tNI4Yn.json"  background="transparent"  speed="1"  style="width: 4rem; height: 4rem;"  autoplay >
          </lottie-player>';

    }

	else {
		
            $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
            $novo_nome = md5(time()) . $extensao;
            $diretorio = "upload/";
            move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);
            $fotoantiga = mysqli_fetch_array(mysqli_query($connect, "SELECT arquivo from usuarios WHERE id = '$id'"));
            unlink("upload/$fotoantiga[0]");
            mysqli_query($connect, "UPDATE usuarios
            SET arquivo = '$novo_nome' WHERE id = '$id'");
            $erros = "<div class='alert alert-success' role='alert'>
            <i style='color: green;'class='fas fa-check-double'></i> Pronto!
        </div>";
        $status = '<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                        <lottie-player 
                        src="https://assets3.lottiefiles.com/datafiles/OhIfcxnkLsj1Jxj/data.json"  background="transparent"  speed="1"  style="width: 4rem; height: 4rem;" autoplay >
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/animacao.css">
    <link rel="stylesheet" href="css/_vanishIn.scss">
    <link rel="icon" type="imagem/png" href="/assets/icone.png" />

    <script>
    function carregando() {
        document.getElementById("carregando").style = "";
    }
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
                                        <a class="nav-link fonte text-dark" href="index.php">
                                            <script
                                                src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js">
                                            </script>
                                            <lottie-player src="https://assets2.lottiefiles.com/temp/lf20_tUrEqM.json"
                                                background="transparent" speed="0.8" style="width: 3rem; height: 3rem;"
                                                loop autoplay>
                                            </lottie-player>Início
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
                                            </lottie-player>Configurações
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
                                            </lottie-player>Feedback
                                        </a>
                                    </center>
                                </div>
                            </div>
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
                    <div class="col-md-12 animated vanishIn">
                        <div class="panel text-left shadow-lg">
                            <center>

                                <?php echo $status?>
                                <h1>Mudar foto de perfil</h1>
                            </center>
                            <br />
                            <a>Faça o envio da nova foto. A antiga será deletada permanentemente.</a>
                            <a class="nav-link animated shake fast" style="color: red;"><?php echo $erros; ?></a>
                            <br />
                            <form method="post" enctype="multipart/form-data"
                                action="<?php echo $_SERVER['PHP_SELF']; ?>">

                                <div class="input-group mb-3">

                                    <input type="file" class="form-control" placeholder="Arquivo de aula" name="arquivo"
                                        aria-label="Example text with button addon" aria-describedby="button-addon1">

                                </div>

                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary" id="carregandobutton" type="submit"
                                        onclick="carregando()" name="btn-entrar"><span
                                            class="spinner-border spinner-border-sm" role="status" id="carregando"
                                            aria-hidden="true" style="display: none;"></span> Pronto</button>
                                </div>

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