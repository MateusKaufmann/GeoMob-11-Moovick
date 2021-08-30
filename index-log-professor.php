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

// Dados e variáveis
        $id = $_SESSION['id_usuario'];
        $up = 0;
        $sql = "SELECT * FROM usuarios WHERE id = '$id'";
        $resultado = mysqli_query($connect, $sql);
        $dados = mysqli_fetch_array($resultado);
        $numero_linhas = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(id) FROM turmas;"));
        $todas_turmas = array(mysqli_query($connect, "SELECT turma FROM turmas;"));
        $dados2 =  mysqli_fetch_array(mysqli_query($connect, "SELECT turma FROM turmas"));
        if($dados['tipo'] == 'professor'):
            $tipo= "Professor";
        else:
            $tipo= "Aluno";
        endif;
        mysqli_query($connect, "SET @count = 0;");
        mysqli_query($connect, " UPDATE turmas SET turmas.id = @count:= @count + 1;");
       

//Redirecionamento para a turma desejada

        if(isset($_POST['turmabutton'])):
            $login = mysqli_escape_string($connect, $_POST['turma']);
            $sql = "insert into usuarios (id, login, sobrenome, cpf, senha, datamade, turma, arquivo) values (DEFAULT, '$login', '$sobrenome', '$cpf', MD5('$senha'), '$datamade', '$turma', '$novo_nome')";
            mysqli_query($connect, $sql);
            $erros = "";
        endif;

        if(isset($_POST['deletar'])) {
            $turma = $_POST['selturma'];
            $_SESSION["turmaacesso"]= $turma;
            $turma10 = $_SESSION["turmaacesso"];

            if (!empty($turma10)) {
                if(mysqli_num_rows(mysqli_query($connect, "SELECT * FROM turmas WHERE (turma = $turma10) AND (id_admin = $id)")) > 0) {
                    
                        $sql = "delete from turmas WHERE turma = $turma10";
                        mysqli_query($connect, $sql);
                        mysqli_query($connect, "SET @count = 0;");
                        mysqli_query($connect, " UPDATE turmas SET turmas.id = @count:= @count + 1;");
                        $erros = "<div class='alert alert-success' role='alert'>
                        <i style='color: green;'class='fas fa-check-double'></i> Pronto. Turma ".$turma10." excluída.
                    </div>";
                } else if (mysqli_num_rows(mysqli_query($connect, "SELECT * FROM turmas WHERE (turma = $turma10) AND (id_admin = $id)")) == 0){
                    $erros = "<div class='alert alert-danger' role='alert'>
                <i class='fas fa-exclamation-triangle'></i> Falha! Você não possui essa turma.
              </div>";
                }
            } else {
                $erros = "<div class='alert alert-danger' role='alert'>
                <i class='fas fa-exclamation-triangle'></i> Falha! Você não digitou uma turma.
              </div>";
            }
        }
        if(isset($_POST['acessoturma'])) {
            if(!empty($_POST['selturma'])) {
            $turma = $_POST['selturma'];
            $_SESSION["turmaacesso"]= $turma;
            header('Location: turmapro.php');      
            } else {
                $erros = "<div class='alert alert-danger' role='alert'>
                <i class='fas fa-exclamation-triangle'></i> Falha! Você não selecionou uma turma.
              </div>";
            }
        }
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

                <div class="col-md-12 col-sm-12" style="overflow-Y: hidden;">
                    <img class="animated animated vanishIn mh-100" src="assets/logomarca2.png" alt="">
                </div>
            </div>
        </div>
    </header>
    <!--Parte do Conteúdo/Menus-->
    <section class="secao-1" id="secao-1">
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-12 animated puffIn">

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
                                        <a class="nav-link text-dark" href="cadastroturma.php">
                                            <script
                                                src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js">
                                            </script>
                                            <lottie-player
                                                src="https://assets6.lottiefiles.com/temporary_files/pfnmY4.json"
                                                background="transparent" speed="0.8" style="width: 3rem; height: 3rem;"
                                                loop autoplay>
                                            </lottie-player><br/>Novo Curso
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

    <main>
        <section class="secao-1" id="secao-1">
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-12 animated puffIn">
                        <div class="panel text-left shadow-lg">
                            <h1 class="animated">Seja bem vindo(a), Professor <?php echo $dados['login']; ?>! </h1>
                            <p class="pt-4 animated">Você é um administrador do Moovick! Por aqui, você pode editar cada
                                um dos cursos que ficarão disponíveis para seus alunos.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--Seleção do Ano-->

        <section class="secao-2 container-fluid p-0">
            <div class="cover autoAnimacaoSlide">
                <div class="content text-center" id="secao-2">
                    <h1><?php echo $dados['login']; ?>, esses são seus cursos.</h1>
                    <p>Você pode acessá-los e excluí-los usando os menus abaixo.</p>
                </div>
            </div>
            <br />
            <br />
            <section class="secao-1" id="secao-1">
                <div class="container text-center">
                    <div class="row">
                        <div class="col-md-12 autoAnimacaoSlide">
                            <div class="panel text-left shadow-lg">
                                <table class="table">
                                    <thead>
                                        <tr>

                                            <th scope="col">Curso</th>
                                            <th scope="col">Turma</th>
                                            <th scope="col">Ações</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            

                                            
                                            for($i = 1; $i <= intval($numero_linhas[0]); $i++)
                                            {
                                                $nometurma = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM turmas WHERE (turmas.id_admin = $id) AND (id = $i);"));
                                                
                                                if ($nometurma != "") {
                                                    $nometurma2 = $nometurma['unico'];
                                                    $nometurma3 = $nometurma['nome'];
                                                    $nometurma4 = $nometurma['turma'];
                                                    $mensagemdelete =  '"Deseja deletar esta turma?"';
                                                echo "<tr>
                                                
                                                
                                                <td>$nometurma3</td>
                                                <td>$nometurma4</td>
                                                <td><a class='text-sucess' href='turmapro.php?turma=".$nometurma2."' >Acessar</a> - <a href='deletarturma.php?codigo=".$nometurma['id']."' onclick='return confirm(".$mensagemdelete.")' class='text-danger'>Excluir</a>
                                              </tr>";
                                                }
                                            }
                                            ?>

                                    </tbody>
                                </table>
                                <br/>   
                                    <div class="input-group mb-3"> 
                                        <br/>          
                                            <button type="button" onclick="window.location.href='cadastroturma.php'"
                                                class="btn btn-success">Novo Curso</button>              
                                    </div>

                                <a class="nav-link animated shake fast" style="color: red;"><?php echo $erros; ?></a>
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