<?php
// Conexão
require_once 'conexao.php';
require_once 'vars.php';
// Sessão
session_start();
//Imagem de erro
$status = "<script src='https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js'></script>
          <lottie-player 
              src='https://assets1.lottiefiles.com/datafiles/Z1Kn23v4ZVf9y5sBQDTFuuLziHpdFfHGp0z6V24v/Plus/data.json'  background='transparent'  speed='1'  style='height: 4rem; width: 4rem;'  autoplay >
          </lottie-player>";
// Botão cadastrar
if (isset($_POST['btn-entrar'])) {
    if (empty($login) or empty($senha) or empty($cpf) or empty($senha2) or ($_FILES['arquivo']['size'] == 0)) {
        $erros = "<div class='alert alert-danger' role='alert'>
            <i class='fas fa-exclamation-triangle'></i> Falha! Preencha todos os campos (isso inclui a foto)!
          </div>";
        $status = '<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
      <lottie-player 
          src="https://assets5.lottiefiles.com/temp/lf20_tNI4Yn.json"  background="transparent"  speed="1"  style="width: 4rem; height: 4rem;"  autoplay >
      </lottie-player>';
    } elseif (empty($sobrenome)) {
        $erros = "<div class='alert alert-danger' role='alert'>
        <i class='fas fa-exclamation-triangle'></i> Falha! Preencha todos os campos (isso inclui a foto)!
      </div>";
        $status = '<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
      <lottie-player 
          src="https://assets5.lottiefiles.com/temp/lf20_tNI4Yn.json"  background="transparent"  speed="1"  style="width: 4rem; height: 4rem;"  autoplay >
      </lottie-player>';
    } elseif ($senha != $senha2) {
        $erros = "<div class='alert alert-danger' role='alert'>
            <i class='fas fa-exclamation-triangle'></i> Falha! Senhas não podem ser diferentes!
          </div>";
        $status = '<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
      <lottie-player 
          src="https://assets5.lottiefiles.com/temp/lf20_tNI4Yn.json"  background="transparent"  speed="1"  style="width: 4rem; height: 4rem;"  autoplay >
      </lottie-player>';
    } elseif (strlen($cpf) < 8) {
        $erros = "<div class='alert alert-danger' role='alert'>
        <i class='fas fa-exclamation-triangle'></i> Falha! Matrícula inválida!
      </div>";
        $status = '<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
      <lottie-player 
          src="https://assets5.lottiefiles.com/temp/lf20_tNI4Yn.json"  background="transparent"  speed="1"  style="width: 4rem; height: 4rem;"  autoplay >
      </lottie-player>';
    } else {
        $resultado = mysqli_query($connect, "SELECT cpf FROM usuarios WHERE cpf = '$cpf'");
        if (mysqli_num_rows($resultado) > 0) {
            $senha = md5($senha);
            $sql = "SELECT * FROM usuarios WHERE cpf = '$cpf' AND senha = '$senha'";
            $resultado = mysqli_query($connect, $sql);
            if (mysqli_num_rows($resultado) == 1) {
                $dados = mysqli_fetch_array($resultado);
                mysqli_close($connect);
                $erros = "<div class='alert alert-danger' role='alert'>
                <i class='fas fa-exclamation-triangle'></i> Falha! Ja existe um usuário com essa matrícula. 
                </div>";
                $status = '<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                <lottie-player 
                src="https://assets5.lottiefiles.com/temp/lf20_tNI4Yn.json"  background="transparent"  speed="1"  style="width: 4rem; height: 4rem;"  autoplay >
                </lottie-player>';
            } else {
                $erros = "<div class='alert alert-danger' role='alert'>
                <i class='fas fa-exclamation-triangle'></i> Falha! Já existe um usuário com essa matrícula!
                </div>";
                $status = '<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                <lottie-player 
                src="https://assets5.lottiefiles.com/temp/lf20_tNI4Yn.json"  background="transparent"  speed="1"  style="width: 4rem; height: 4rem;"  autoplay >
                </lottie-player>';
            };
        } else {
            $extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
            $novo_nome = md5(time()) .".". $extensao;
            $diretorio = "upload/";
            if ($extensao == 'png' or $extensao == 'jpg') {
                if (filesize($arquivo) < 2097152) {
                    $sql = "insert into usuarios (id, login, sobrenome, cpf, senha, datamade, arquivo) values (DEFAULT, '$login', '$sobrenome', '$cpf', MD5('$senha'), '$datamade', '$novo_nome')";
                    move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);
                    mysqli_query($connect, $sql);
                    $erros = "";
                    $tipo = "";
                    // Depois de cadastrar, login:
                    $cpf = mysqli_escape_string($connect, $_POST['cpf']);
                    $senha = mysqli_escape_string($connect, $_POST['senha']);
                    if (empty($cpf) or empty($senha)) {
                        $erros = "<i class='fas fa-exclamation-triangle'></i>  O campo login/senha precisa ser preenchido";
                    } else {
                        $resultado = mysqli_query($connect, "SELECT cpf FROM usuarios WHERE cpf = '$cpf'");
                        if (mysqli_num_rows($resultado) > 0) {
                            $senha = md5($senha);
                            $resultado = mysqli_query($connect, "SELECT * FROM usuarios WHERE cpf = '$cpf' AND senha = '$senha'");
                            if (mysqli_num_rows($resultado) == 1) {
                                $dados = mysqli_fetch_array($resultado);
                        
                                $_SESSION['id_usuario'] = $dados['id'];
                                $tabela = $_SESSION['id_usuario'];
                                if ($dados['tipo'] == 'professor') {
                                    $_SESSION['logado-prof'] = true;
                                    header('Location: index-log-professor.php');
                                } else {
                                    $_SESSION['logado'] = true;
                                    $sqlcriatabela = "CREATE TABLE `$tabela` (id VARCHAR(1000) NOT NULL);";
                                    mysqli_query($connect, $sqlcriatabela);
                                    header('Location: index-log.php');
                                };
                            } else {
                                $erros = "<i class='fas fa-exclamation-triangle'></i>  Usuário e senha não conferem";
                            };
                        } else {
                            $erros = "<i class='fas fa-exclamation-triangle'></i>  Usuário inexistente";
                        }
                    }
                }
            } else {
                $erros = "<div class='alert alert-danger' role='alert'>
                <i class='fas fa-exclamation-triangle'></i> Falha! Sua foto não é PNG nem JPG!
                </div>";
                $status = '<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                <lottie-player 
                src="https://assets5.lottiefiles.com/temp/lf20_tNI4Yn.json"  background="transparent"  speed="1"  style="width: 4rem; height: 4rem;"  autoplay >
                </lottie-player>';
            }
        }
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
    <link rel="icon" type="imagem/png" href="/assets/icone.png" />
    <script src="https://cdnjs.com/libraries/bodymovin" type="text/javascript"></script>

    <script>
    function carregando() {
        document.getElementById("carregando").style = "";
    }
    </script>
</head>

<body>
    <!--Container de criar conta-->
    <main>
        <section class="secao-1">
            <div class="container text-center">
                <div class="row animated vanishIn">
                    <div class="col-md-12">
                        <div class="panel text-left shadow-lg">
                            <center>
                                <?php echo $status; ?>
                                <h1>Criar uma Conta</h1>
                            </center>
                            <br />
                            <a>Preencha os campos abaixo, incluindo a foto (.png ou .jpg). Caso
                                for professor, digite seu código de servidor no lugar da matrícula. Sua permissão de
                                administrador será concedida em até 3 dias.</a>
                            <a class="nav-link animated shake fast" style="color: red;"><?php echo $erros; ?></a>
                            <br />
                            <form method="post" enctype="multipart/form-data"
                                action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fas fa-signature animated fadeInRight slow"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Apelido" name="nome"
                                        aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Nome completo" name="sobrenome"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text animated fadeInRight slow" id="basic-addon3">Ex:
                                            10150034</span>
                                    </div>
                                    <input type="number" class="form-control" id="basic-url"
                                        aria-describedby="basic-addon3" placeholder="Sua matrícula" name="cpf">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" placeholder="Sua foto de perfil"
                                        name="arquivo" aria-label="Example text with button addon"
                                        aria-describedby="button-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fas fa-key animated fadeInRight slow"></i></span>
                                    </div>
                                    <input type="password" class="form-control" placeholder="Senha" name="senha"
                                        aria-label="Example text with button addon" aria-describedby="button-addon1">
                                    <input type="password" class="form-control" placeholder="Confirme a Senha"
                                        name="senhaconfirma" aria-label="Recipient's username"
                                        aria-describedby="button-addon2">
                                </div>
                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary" id="carregandobutton" type="submit"
                                        onclick="carregando()" name="btn-entrar"><span
                                            class="spinner-border spinner-border-sm" role="status" id="carregando"
                                            aria-hidden="true" style="display: none;"></span> Cadastrar</button>
                                    <button type="button" id="carregandobutton"
                                        onclick="window.location.href='index.php'" class="btn btn-outline-secondary">
                                        Cancelar</button>
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