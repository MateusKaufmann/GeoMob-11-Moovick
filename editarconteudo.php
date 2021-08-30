<?php
// Conexão
require_once 'conexao.php';
require_once 'reparo.php';

// Sessão
session_start();

// Verificação
if (!isset($_SESSION['logado-prof'])) :
    header('Location: index.php');
endif;

$id = $_SESSION['id_usuario'];
$numero_linhas = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(id) FROM turmas;"));
$codigo = $_GET['conteudo'];
 if (!empty($codigo)) {
$dados_conteudo = mysqli_fetch_array(mysqli_query($connect, "SELECT * from conteudos where id = $codigo;"));
 }
if ($dados_conteudo['id_admin'] != $id) {
    header('Location: index.php');
}
// Botão enviar
if (isset($_POST['btn-entrar'])) :
    $erros = "";
    $codigo = $_GET['conteudo'];
    $dados_conteudo = mysqli_fetch_array(mysqli_query($connect, "SELECT * from conteudos where id = $codigo;"));
    $titulo = mysqli_escape_string($connect, $_POST['titulo']);
    $resumo = mysqli_escape_string($connect, $_POST['resumo']);
    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);
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
    if ($dados['tipo'] == 'professor') :
        $tipo = "Professor";
    else :
        $tipo = "Aluno";
    endif;


    if (empty($titulo) or empty($resumo) or  empty($turma) or ($_FILES['arquivo']['size'] == 0)) {
        $erros = "<div class='alert alert-danger' role='alert'>
            <i class='fas fa-exclamation-triangle'></i> Falha! Preencha todos os campos (isso inclui o arquivo)!
          </div>";
    } else {

        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
        $novo_nome = md5(time()) . $extensao;
        $diretorio = "conteudos/";
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);
        $codigo = $_GET['conteudo'];
        mysqli_query($connect, "UPDATE conteudos SET resumo = $resumo, titulo = $titulo, conteudo = $novo_nome WHERE id = $codigo");
        $erros = "<div class='alert alert-success' role='alert'>
            <i style='color: green;'class='fas fa-check-double'></i> Pronto!
        </div>";
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

    </header>
    <!--Parte do Conteúdo/Menus-->
    <main>
        <section class="secao-1">
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-12 autoAnimacaoSlide">
                        <div class="panel text-left shadow-lg">
                            <center>
                                <img src="assets/logoresumido.png" class="rounded mx-auto d-block animated fadeInRight slow" style="height: 4rem;" alt="...">
                                <h1>Editar Conteúdo: <?php echo $dados_conteudo['titulo'] ?></h1>
                            </center>
                            <br />
                            <a>Preencha os campos abaixo. Não esqueça de incluir o arquivo de aula.</a>
                            <a class="nav-link animated shake fast" style="color: red;"><?php echo $erros; ?></a>
                            <br />
                            <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-signature animated fadeInRight slow"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="titulo" aria-label="Username" placeholder="<?php echo $dados_conteudo['titulo'] ?>" aria-describedby="basic-addon1">
                                </div>

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="<?php echo $dados_conteudo['resumo'] ?>" name="resumo" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <select class="custom-select" id="inputGroupSelect02" name="selturma">
                                        <option value="<?php echo $dados_conteudo['turma'] ?>">
                                            <?php echo $dados_conteudo['turma'] ?></option>
                                        <?php
                                        for ($i = 1; $i <= intval($numero_linhas[0]); $i++) {
                                            $nometurma = mysqli_fetch_array(mysqli_query($connect, "SELECT turma FROM turmas WHERE (id = $i) AND (id_admin = $id);"));

                                            if (!empty($nometurma) != "") {
                                                $nometurma2 = $nometurma['turma'];
                                                echo "<option value='" . $nometurma2 . "'>" . $nometurma2 . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="input-group mb-3">

                                    <input type="file" class="form-control" placeholder="Arquivo de aula" name="arquivo" aria-label="Example text with button addon" aria-describedby="button-addon1">

                                </div>

                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary" id="carregandobutton" type="submit" onclick="carregando()" name="btn-entrar"><span class="spinner-border spinner-border-sm" role="status" id="carregando" aria-hidden="true" style="display: none;"></span> Concluir</button>
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