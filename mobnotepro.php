<?php
// Conexão
require_once 'conexao.php';
require_once 'reparo.php';

// Sessão
session_start();

// Verificação
if(!isset($_SESSION['logado-prof'])):
    header('Location: index.php');
endif;

// Botão enviar

    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);
    $turma = $_POST['selturma'];
    $turma8 = $_POST['turmaselecionada'];
    $cont = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM usuarios WHERE id = '$id'"));
    $dados_turma = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM turmas WHERE turma = '$turma'"));
    $numero_linhas = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(id) FROM turmas;"));
    $todas_turmas = array(mysqli_query($connect, "SELECT turma FROM turmas;"));
    $dados2 =  mysqli_fetch_array(mysqli_query($connect, "SELECT turma FROM turmas"));
    $erros = "";
    $data = date('d/m/y');
    $texto = mysqli_escape_string($connect, $_POST['texto']);
    if($dados['tipo'] == 'professor'):
        $tipo= "Professor";
    else:
        $tipo= "Aluno";
    endif;
    $status = '<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <lottie-player 
        src="https://assets4.lottiefiles.com/packages/lf20_pQChF8.json"  background="transparent"  speed="1"  style="width: 4rem; height: 4rem;" autoplay >
    </lottie-player>';
         

if(isset($_POST['turmabutton'])):

    $dados_turma = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM turmas WHERE turma = '$turma'"));  
    
endif;

if(isset($_POST['btn-entrar'])):
    $texto = mysqli_escape_string($connect, $_POST['texto']);
    $turma =  $dados_turma['id'];
        if(!empty($texto)) {
            
            mysqli_query($connect, "UPDATE turmas
            SET agenda = '$texto', datamodif_agenda = '$data'
            WHERE turma = $turma8 AND id_admin = $id");

$erros = "<div class='alert alert-success' role='alert'>
<i class='fas fa-check-double'></i> Edição concluída em: ".$turma8.".
</div>";
$status = '<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<lottie-player 
    src="https://assets3.lottiefiles.com/datafiles/OhIfcxnkLsj1Jxj/data.json"  background="transparent"  speed="1"  style="width: 4rem; height: 4rem;" autoplay >
</lottie-player>';
        } else if ($texto == "" or $turma == "") {
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
    <link rel="icon" type="imagem/png" href="/assets/icone.png" />
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
                        <a class="navbar-brand" href=""><img id="fotoperfil"
                                src="upload/<?php echo $dados['arquivo']; ?>" style="width: 2rem; height: 2rem;"
                                alt="..." class="img-thumbnail"> Olá
                            <?php echo $dados['login']; ?>!</a><br />

                        <span class="text-muted">Perfil de <?php echo $tipo; ?></span><br /><br />

                        <div class="container-fluid justify-content-md-center">
                            <div class="row justify-content-md-center">
                                <div
                                    class="col-sm-3 alert-dark mr-3 ml-3 shadow-lg p-3 mb-3 bg-secondary rounded  animated fadeInRight fast justify-content-md-center">
                                    <center>
                                        <a class="nav-link" href="index.php"><i class="fas fa-home"></i>
                                            Início <span class="sr-only">(current)</span></a>
                                    </center>
                                </div>
                                <div
                                    class="col-sm-3 alert-dark mr-3 ml-3 shadow-lg p-3 mb-3 bg-secondary rounded  animated fadeInRight justify-content-md-center">
                                    <center>
                                        <a class="nav-link" href="novoconteudo.php"><span
                                                class="spinner-grow spinner-grow-sm" role="status"
                                                aria-hidden="true"></span> Novo Conteúdo</a>
                                    </center>
                                </div>

                                <div
                                    class="col-sm-3 alert-dark mr-3 ml-3 shadow-lg p-3 mb-3 bg-secondary rounded  animated fadeInRight fast justify-content-md-center">
                                    <center>
                                        <a class="nav-link" href="infoconta.php"><i class="fas fa-cogs"></i>
                                            Configurações</a>
                                    </center>
                                </div>


                            </div>
                            <div class="row justify-content-md-center">
                                <div
                                    class="col-sm-3 alert-dark mr-3 ml-3 shadow-lg p-3 mb-3 bg-secondary rounded animated fadeInRight slow justify-content-md-center">
                                    <center>
                                        <a class="nav-link" href="mudarsenha.php"><i class="fas fa-key"></i> Mudar
                                            Senha<span class="sr-only">(current)</span></a>
                                    </center>
                                </div>
                                <div
                                    class="col-sm-3 alert-dark mr-3 ml-3 shadow-lg p-3 mb-3 bg-secondary rounded animated fadeInRight justify-content-md-center">
                                    <center>
                                        <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>
                                            Sair</a>
                                    </center>
                                </div>
                                <div
                                    class="col-sm-3 alert-dark mr-3 ml-3 shadow-lg p-3 mb-3 bg-secondary rounded animated fadeInRight justify-content-md-center">
                                    <center>
                                        <a class="nav-link" href="feedback.php"><i
                                                class="fas fa-exclamation-triangle"></i>
                                            Reportar um Erro</a>
                                    </center>
                                </div>
                                <br />
                                <br />
                            </div>
                        </div>


                    </div>
                </div>
                <nav class="navbar navbar-dark bg-transparent text-dark justify-content-md-center">

                    <button class="btn btn-link" type="button" data-toggle="collapse"
                        data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-angle-double-down" style="color:whitesmoke;"></i>
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
                    <div class="col-md-12 autoAnimacaoSlide">
                        <div class="panel text-left shadow-lg">
                        <center>
                            <?php echo $status?>
                                <h1>Agenda de Turmas</h1>
                            </center><br/>
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <div class="input-group mb-3">

                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary" type="submit" id="button-addon1"
                                                name="turmabutton">Selecionar</button>
                                        </div>
                                        <select class="custom-select" id="inputGroupSelect02" name="selturma">
                                            <option value="">Selecione a Turma</option>
                                            <?php
                                            

                                            
                                            for($i = 1; $i <= intval($numero_linhas[0]); $i++)
                                            {
                                                $nometurma = mysqli_fetch_assoc(mysqli_query($connect, "SELECT turma FROM turmas WHERE (turmas.id_admin = $id) AND (id = $i);"));
                                                
                                                if ($nometurma != "") {
                                                $nometurma2 = $nometurma['turma'];
                                                echo "<option value='".$nometurma2."'>".$nometurma2.'</option>';
                                                }
                                            }
                                            ?>
                                        </select>

                                        <a class="nav-link animated heartBeat slow"><?php echo $turma; ?></a>
                                    </div>
                                </form>
                            </center>
                            <a class="nav-link animated shake fast"><?php echo $erros; ?></a>
                           
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="input-group mb-3 textoconteudo">
                                    <textarea type="text" class="form-control" placeholder="As Informações estão aqui."
                                        name="texto" aria-label="Example text with button addon"
                                        aria-describedby="button-addon1"><?php echo $dados_turma['agenda'] ?></textarea>
                                    <input type="text" class="form-control" placeholder="As Informações estão aqui."
                                        name="turmaselecionada" style="display: none;"
                                        aria-label="Example text with button addon"
                                        aria-describedby="button-addon1" value="<?php echo $turma ?>">
                                </div>
                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary" type="submit" name="btn-entrar">Salvar
                                        Alterações</button>
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