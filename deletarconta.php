<?php
// Conexão
require_once 'conexao.php';

// Sessão
session_start();
$id = $_SESSION['id_usuario'];
$cont = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM usuarios WHERE id = '$id'"));

// Verificação
if(!isset($_SESSION['logado']) and !isset($_SESSION['logado-prof'])):
    header('Location: index.php');
endif;
if($cont['tipo'] == 'professor'):
    $tipo= "Professor";
else:
    $tipo= "Aluno";
endif;
$status = "<script src='https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js'></script>
          <lottie-player 
              src='https://assets2.lottiefiles.com/temp/lf20_tKCHP4.json'  background='transparent'  speed='1'  style='height: 4rem; width: 4rem;'  autoplay >
          </lottie-player>";
if(isset($_POST['btn-entrar'])):
    $erros = "";
    $erros2 = "";
    $mudarsenha = mysqli_escape_string($connect, $_POST['mudarsenha']);
    $verificar = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM usuarios WHERE id = $id"));
    
    $senha = $verificar['senha'];
    $foto = $verificar['arquivo'];
            if (!empty($mudarsenha)):
    
                    if(MD5($mudarsenha) == $senha):
            
                    
                    $numero_linhas = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(id) FROM turmas;"));
                    $numero_linhas2 = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(id) FROM conteudos;"));


                    for ($i = 1; $i <= intval($numero_linhas[0]); $i++) {
                        $var = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM turmas WHERE (turmas.id_admin = '$id') AND (turmas.id = '$i');"));
                        $codigoturma = $var['unico'];
                        for ($i2 = 1; $i2 <= intval($numero_linhas2[0]); $i++) {
                        $var2 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos WHERE (conteudos.codigo = '$codigoturma') and (conteudos.id = '$i2');"));
                        if (!empty($var2)) {
                            $conteudo = $var2['arquivo'];
                            unlink("conteudos/$conteudo");
                        }
                    }
                }

                    mysqli_query($connect, "DELETE FROM conteudos WHERE id_admin = '$id'");
                    mysqli_query($connect, "DELETE FROM turmas WHERE turmas.id_admin = $id;");
                    mysqli_query($connect, "DROP TABLE `$id`;");
                    unlink("upload/$foto");
                    $sql = "DELETE from usuarios
                    WHERE id = '$id'";
                    mysqli_query($connect, $sql);
                    mysqli_query($connect, "SET @count = 0;");
                    mysqli_query($connect, " UPDATE turmas SET turmas.id = @count:= @count + 1;");
                    header('Location: logout.php');
                    
                    else: 
                        $erros = "<div class='alert alert-danger' role='alert'>
                        <i class='fas fa-exclamation-triangle'></i> Senha incorreta. Tem CERTEZA de que quer deletar a conta?
                      </div>";
                      $status = '<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
          <lottie-player 
              src="https://assets5.lottiefiles.com/temp/lf20_tNI4Yn.json"  background="transparent"  speed="1"  style="width: 4rem; height: 4rem;"  autoplay >
          </lottie-player>';
                    endif;
                    
            endif;

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
    <link rel="stylesheet" href="../css/_vanishIn.scss">
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
                        <a class="navbar-brand" href=""><img src="upload/<?php echo $cont['arquivo']?>"
                                style="height: 2.5rem; width: 2.5rem;" class="rounded-circle"> Olá
                            <?php echo $cont['login']; ?>!</a><br />

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
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <center>
                                    <?php echo $status?>
                                    <h1>Deletar Conta</h1>
                                </center>
                                <p>Lamentamos ver você indo embora. Antes de sair, gostaria de contar o motivo de estar
                                    deixando o Moovick? Clique <a href="feedback.php">aqui</a>.</p>
                                <a class="nav-link animated shake fast" style="color: red;"><?php echo $erros; ?></a>
                                <br />
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" placeholder="Senha" name="mudarsenha"
                                        aria-label="Example text with button addon" aria-describedby="button-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary" type="submit" name="btn-entrar">Deletar
                                        Conta</button>
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