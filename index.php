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
		$erros = "<i class='fas fa-exclamation-triangle'></i>  O campo login/senha precisa ser preenchido";
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
				$erros = "<i class='fas fa-exclamation-triangle'></i>  Usuário e senha não conferem";
			endif;

		else:
			$erros = "<i class='fas fa-exclamation-triangle'></i>  Usuário inexistente";
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
    <link rel="stylesheet" href="css/_puffIn.scss">
    <link rel="icon" type="imagem/png" href="/assets/icone.png" />
    <script src="https://cdnjs.com/libraries/bodymovin" type="text/javascript"></script>
</head>

<body>
    <!--Parte do Logo-->
    <header>
        <div class="container-fluid p-0">
            <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark animated slideInDown" style="background-color: whitesmoke;">
            <a class="navbar-brand animated vanishIn"><img src="assets/logoresumido.png" class="rounded mx-auto d-block" style="height: 2rem;" alt="..."></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                    <li class="nav-item active animated vanishIn">
                            <a class="nav-link" href="cadastro.php"><i class="fas fa-plus-circle"></i> Criar conta<span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active animated vanishIn">
                            <a class="nav-link" href="login.php"><i class="fas fa-user-friends"></i> Login <span
                                    class="sr-only">(current)</span></a>
                        </li>
                        
                    </ul>
                </div>
            </nav>
        </div>


        <div class="container text-center">
            <div class="row">

                <div class="col-md-12 col-sm-12" style="overflow-Y: hidden;">
                    <img class="animated animated vanishIn mh-100" src="assets/logomarca.png" alt="">
                </div>
            </div>
        </div>
    </header>
    <!--Parte do Conteúdo/Menus-->
    <main>
        <section class="secao-1">
            <div class="container text-center">
                <div class="row animated puffIn">
                    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-interval="8000">
                                <div class="col-md-12 autoAnimacaoSlide">
                                    <div class="panel text-left shadow-lg">
                                        <h1 class="animated">O que é Moovick?</h1>
                                        <p class="pt-4 animated">Moovick é um software em fase de desenvolvimento,
                                            produzido por
                                            alunos do ensino médio que, assim como você, procuram organizar melhor suas
                                            atividades e
                                            vida acadêmicas. Com ele, todos os seus conteúdos de Geografia estão
                                            armazenados em um
                                            só lugar. Legal né?
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item" data-interval="8000">
                                <div class="col-md-12 autoAnimacaoSlide">
                                    <div class="panel text-left shadow-lg">
                                        <h1 class="animated">Como funciona?</h1>
                                        <p class="pt-4 animated">Moovick armazena todos os conteúdos de todos os anos de
                                            Geografia de acordo com a ementa do curso. Se você for aluno, pode
                                            visualizá-los livremente. Basta ter uma conta. Se for professor, pode
                                            editá-los através do menu de edição. Crie uma conta no clicando em "Login
                                            inteligente" > "Criar conta", no menu superior.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item" data-interval="8000">
                                <div class="col-md-12 autoAnimacaoSlide">
                                    <div class="panel text-left shadow-lg">
                                        <h1 class="animated">Principais Funcionalidades:</h1>
                                        <p class="pt-4 animated">Moovick conta com o MobNote, um bloco de notas online.
                                            Nele, você pode escrever o que achar interessante explicado em aula (no caso
                                            dos alunos). Professores também têm acesso ao MobNote, só que na versão
                                            "pro". Nesta versão, pode-se, também, colocar observações visíveis para os
                                            alunos (função sendo implementada).
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--Segurança da conta-->
        <br />
        <br />
        <br />
        <div class="container text-center">
            <div class="container-fluid">
                <!-- CPF, NOME E MATRÍCULA -->
                <div class="row fonte">
                    <div class="col-sm-4" style="padding-bottom: 1rem;">
                        <div class="card">
                            <h5 class="card-header">Matrícula</h5>
                            <div class="card-body">
                                <h5 class="card-title">Pra quê usamos sua Matrícula?</h5>
                                <p class="card-text">Sua Matrícula serve como identificação única no Moovick. É através
                                    dela que sabemos identificar você.</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4" style="padding-bottom: 1rem;">
                        <div class="card">
                            <h5 class="card-header">Seu Nome</h5>
                            <div class="card-body">
                                <h5 class="card-title">Como nos dirigimos a você</h5>
                                <p class="card-text">Você pode informar seu nome social também, sabia? Queremos que se
                                    sinta confortável usando o Moovick.</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4" style="padding-bottom: 1rem;">
                        <div class="card">
                            <h5 class="card-header">Sua Turma</h5>
                            <div class="card-body">
                                <h5 class="card-title">Conteúdos específicos</h5>
                                <p class="card-text">Quando sabemos a qual turma você pertence, podemos direcionar
                                    assuntos específicos a você.</p>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
        </div>
        </section>
        <br />
        <br />
        <section class="secao-3 container-fluid p-0 text-center autoAnimacaoSlide fonte">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h1>Como acessar?</h1>
                    <p>Você pode criar uma conta clicando em "Criar conta", no menu superior.</p>
                </div>
            </div>
        </section>

        <!--Sobre os desenvolvedores (seção 4)-->
        <section class="secao-4 autoAnimacaoSlide">
            <div class="container text-center">
                <h1 class="autoAnimacaoSlide">Quem criou o Moovick?</h1>
            </div>
            <div class="alunos row fonte">
                <!--Primeiro Slide Alundo-->
                <div class="col-md-6 col-12 text-center autoAnimacaoSlide">
                    <div class="card mr-2 d-inline-block shadow-lg">

                        <div class="card-img-top">
                            <br />
                            <br />
                            <img src="assets/mateus.jpg" alt="Mateus" class="img-fluid rounded-circle w-50 p-2">
                        </div>
                        <div class="card-texto">
                            <h3 class="card-title">Mateus Kaufmann</h3>
                            <p class="card-text">17 anos. Estudante do curso integrado de Informática do IFRS - Câmpus
                                Restinga.</p>
                            <br />
                            <br />

                        </div>
                    </div>
                </div>
                <!--Segundo Slide Aluno-->
                <div class="col-md-6 col-12 text-center autoAnimacaoSlide">
                    <div class="card mr-2 d-inline-block shadow-lg">
                        <div class="card-img-top">
                            <br />
                            <br />
                            <img src="assets/erica.jpg" alt="Mateus" class="img-fluid rounded-circle w-50 p-2">
                        </div>
                        <div class="card-texto">
                            <h3 class="card-title">Érica Matos</h3>
                            <p class="card-text">17 anos. Estudante do curso integrado de Informática do IFRS - Câmpus
                                Restinga.</p>
                            <br />
                            <br />

                        </div>
                    </div>
                </div>
            </div>
        </section>
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