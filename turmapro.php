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
        $sql = "SELECT * FROM usuarios WHERE id = '$id'";
        $resultado = mysqli_query($connect, $sql);
        $dados = mysqli_fetch_array($resultado);
        $turma = $dados['turma'];
        $turma_acesso = $_GET['turma'];
        $numero_linhas_cont = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(codigo) FROM conteudos;"));
        $numero_linhas_cont_turma = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(id) FROM conteudos WHERE conteudos.codigo = '$turma_acesso';"));
        $sql2 = "SELECT * FROM turmas where unico = '$turma_acesso'";
        $resultado2 = mysqli_query($connect, $sql2);
        $dados2 = mysqli_fetch_array($resultado2);
        $nomecurso = $dados2['nome'];
        if ($dados2['id_admin'] != $_SESSION['id_usuario']) {
            header('Location: index.php');
        }
        if (empty($turma_acesso)) {
            header('Location: index.php');
        }
        mysqli_query($connect, "SET @count = 0;");
        mysqli_query($connect, " UPDATE conteudos SET conteudos.id = @count:= @count + 1;");
        if($dados['tipo'] == 'professor'):
            $tipo= "Professor";
        else:
            $tipo= "Aluno";
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

            </section>
            </div>
            </section>
            <section class="secao-1" id="secao-1">

                <div class="container text-center">


                    <div class="container-fluid">
                        <!-- CPF, NOME E MATRÍCULA -->
                        <div class="row fonte d-flex justify-content-center">
                            <div class="col-sm-8" style="padding-bottom: 1rem;">
                                <div class="card">
                                    <h5 class="card-header">Curso: <?php echo $nomecurso?> - <?php echo $dados2['turma']?></h5>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>

                                                        <th scope="col">Nome</th>
                                                        <th scope="col">Arquivo</th>
                                                        <th scope="col">Ações</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                            

                                            if (intval($numero_linhas_cont[0]) > 0) {
                                            for($i = 0; $i <= intval($numero_linhas_cont[0]); $i++)
                                            {
                                                
                                                $titulo = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM conteudos WHERE codigo = '$turma_acesso' AND id = '$i' AND id_admin = '$id';"));
                                                if (!empty($titulo)) {
                                                
                       
                                                    $mensagemdelete =  '"Deseja deletar este conteúdo?"';

                                                echo "<tr>
                                                
                                                
                                                <td>".$titulo['titulo']."</td>
                                                <td><a class='text-dark' href='conteudos/".$titulo['conteudo']."' download>Baixar arquivo</a></td>
                                                <td><a href='deletarconteudo.php?conteudo=".$titulo['id']."' onclick='return confirm(".$mensagemdelete.")' class='text-danger'>Excluir</a>
                                                
                                              </tr>";
                                                } 
                                            }
                                        } else if ($numero_linhas_cont_turma == ""){
                                            echo "<tr>
                                                
                                                
                                                <td>Ainda não há conteúdos nessa turma.</td>
                                                <td></td>
                                                
                                              </tr>";
                                        }
                                            ?>

                                                </tbody>
                                            </table>
                                            <div class="table-responsive">

                                            </div>
                                        </div>
                                    </div>

                                </div>




                            </div>
                        </div>
            </section>



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