<?php
// Conexão
require_once 'conexao.php';
require_once 'reparo.php';

// Sessão
session_start();

// Verificação
if(isset($_SESSION['logado'])):
    header('Location: index-log.php');
endif;

if(isset($_SESSION['logado-prof'])):
    header('Location: index-log-professor.php');
endif;
$status = "<script src='https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js'></script>
<lottie-player 
    src='https://assets7.lottiefiles.com/datafiles/PJaBnGmD25lDMgV/data.json'  background='transparent'  speed='0.2'  style='width: 4rem; height: 4rem;'    autoplay >
</lottie-player>";
// Botão enviar
if(isset($_POST['btn-entrar'])):
    $erros = "";
    $tipo = "";
	$cpf = mysqli_escape_string($connect, $_POST['cpf']);
	$senha = mysqli_escape_string($connect, $_POST['senha']);

	if(isset($_POST['lembrar-senha'])):

		setcookie('cpf', $cpf, time()+3600);
		setcookie('senha', md5($senha), time()+3600);
	endif;

	if(empty($cpf) or empty($senha)):
		$erros = "<div class='alert alert-danger' role='alert'>
        <i class='fas fa-exclamation-triangle'></i> Todos os campos devem ser preenchidos.
      </div>";
      $status = '<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
      <lottie-player 
          src="https://assets5.lottiefiles.com/temp/lf20_tNI4Yn.json"  background="transparent"  speed="0.5"  style="width: 4rem; height: 4rem;"  autoplay >
      </lottie-player>';
	else:
		// 105 OR 1=1 
	    // 1; DROP TABLE teste

		$sql = "SELECT cpf FROM usuarios WHERE cpf = '$cpf'";
		$resultado = mysqli_query($connect, $sql);		

		if(mysqli_num_rows($resultado) > 0):
		$senha = md5($senha);       
        $sql = "SELECT * FROM usuarios WHERE cpf = '$cpf' AND senha = '$senha'";



        $resultado = mysqli_query($connect, $sql);

			if(mysqli_num_rows($resultado) == 1):
				$dados = mysqli_fetch_array($resultado);
				mysqli_close($connect);
                $_SESSION['id_usuario'] = $dados['id'];
                
                if($dados['tipo'] == 'professor'):
                    $_SESSION['logado-prof'] = true;
                    header('Location: index-log-professor.php');
                else:
                    $_SESSION['logado'] = true;
                    header('Location: index-log.php'); 
                endif;
			else:
				$erros = "<div class='alert alert-danger' role='alert'>
                <i class='fas fa-exclamation-triangle'></i> Usuário e senha não conferem.
              </div>";
              $status = '<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
              <lottie-player 
                  src="https://assets5.lottiefiles.com/temp/lf20_tNI4Yn.json"  background="transparent"  speed="0.5"  style="width: 4rem; height: 4rem;"  autoplay >
              </lottie-player>';
			endif;

		else:
			$erros = "<div class='alert alert-danger' role='alert'>
            <i class='fas fa-exclamation-triangle'></i> Não existe usuário com essa matrícula.
          </div>";
          $status = '<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
          <lottie-player 
              src="https://assets5.lottiefiles.com/temp/lf20_tNI4Yn.json"  background="transparent"  speed="0.5"  style="width: 4rem; height: 4rem;"  autoplay >
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/animacao.css">
    <link rel="stylesheet" href="css/_vanishIn.scss">
    <link rel="icon" type="imagem/png" href="/assets/icone.png" />
    <link rel="icon" type="imagem/png" href="/assets/icone.png" />
    <script src="https://cdnjs.com/libraries/bodymovin" type="text/javascript"></script>
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
                    <div class="col-md-12 animated vanishIn fast">
                        <div class="panel text-left shadow-lg">
                            <center>
                            <?php echo $status; ?>
                                <h1>Fazer Login</h1>
                            </center>

                            <br />
                            <a class="nav-link animated shake fast" style="color: red;"><?php echo $erros; ?></a>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <form>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Matrícula</label>
                                        <input type="number" name="cpf" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" placeholder="Ex: 10150045">
                                        <small id="emailHelp" class="form-text text-muted">Não compartilhe seus dados de
                                            login com ninguém.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Senha</label>
                                        <input type="password" name="senha" class="form-control"
                                            id="exampleInputPassword1" placeholder="Senha">
                                    </div>
                                    <small id="emailHelp" class="form-text text-muted">Ainda não possui uma conta? Pode
                                        criar uma clicando <a href="cadastro.php">aqui</a>.</small>
                                    <br />
                                    <button type="submit" id="carregandobutton" name="btn-entrar" onclick="carregando()"
                                        class="btn btn-outline-secondary"><span class="spinner-border spinner-border-sm"
                                            role="status" id="carregando" aria-hidden="true"
                                            style="display: none;"></span> Entrar</button>
                                    <button type="button" id="carregandobutton" onclick="window.location.href='index.php'"
                                        class="btn btn-outline-secondary"> Cancelar</button>


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