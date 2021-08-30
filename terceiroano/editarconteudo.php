<?php
// Conexão
require_once '../conexao.php';

// Sessão
session_start();

// Verificação
if(!isset($_SESSION['logado-prof'])):
    header('Location: ../index.php');
endif;

// Botão enviar

    $id = $_SESSION['id_usuario'];
    $aluno = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM usuarios WHERE id = '$id'"));
    $resultado1 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 1"));
        $resultado2 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 2"));
        $resultado3 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 3"));
        $resultado4 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 4"));
        $resultado5 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 5"));
        $resultado6 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 6"));
        $resultado7 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 7"));
        $resultado8 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 8"));
        $resultado9 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 9"));
        $resultado10 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 10"));
        $resultado11 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 11"));
        $resultado12 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 12"));
        $resultado13 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 13"));
        $resultado14 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 14"));
        $resultado15 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 15"));
        $resultado16 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 16"));
    $cont = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 0"));
    $erros = "";
	$titulo = mysqli_escape_string($connect, $_POST['titulo']);
    $previa = mysqli_escape_string($connect, $_POST['previa']);
	$texto = mysqli_escape_string($connect, $_POST['texto']);
	$imagem = mysqli_escape_string($connect, $_POST['imagem']);
    $card = mysqli_escape_string($connect, $_POST['select']);
    $update = "UPDATE conteudos3
    SET nome = '$titulo', previa = '$previa', texto = '$texto', imagem = '$imagem'
    WHERE id = '$card';";    

if(isset($_POST['btn-entrar'])):


            

    if(empty($card)):
                $erros = "<i style='color: red;'class='fas fa-exclamation-triangle'></i> Falha! Você não selecionou o card que quer salvar.";
    else:
        mysqli_query($connect, $update);
            $erros = "<i style='color: green;'class='fas fa-check-double'></i> Edição concluída com sucesso!";
            endif;	
        		
		
endif;
if(isset($_POST['btn-entrar2'])):
    if($card == 1):
        $cont = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 1"));
    elseif($card == 2):
        $cont = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 2"));
    elseif($card == 3):
        $cont = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 3"));
    elseif($card == 4):
        $cont = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 4"));
    elseif($card == 5):
        $cont = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 5"));
    elseif($card == 6):
        $cont = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 6"));
    elseif($card == 7):
        $cont = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 7"));
    elseif($card == 8):
        $cont = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 8"));
    elseif($card == 9):
        $cont = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 9"));
    elseif($card == 10):
        $cont = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 10"));
    elseif($card == 11):
        $cont = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 11"));
    elseif($card == 12):
        $cont = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 12"));
    elseif($card == 13):
        $cont = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 13"));
    elseif($card == 14):
        $cont = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 14"));
    elseif($card == 15):
        $cont = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 15"));
    elseif($card == 16):
        $cont = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM conteudos3 WHERE id = 16"));
    else:
        $erros = "<i style='color: red;'class='fas fa-exclamation-triangle'></i> Falha! Card do conteúdo não selecionado."; 
    endif;
    mysqli_close($connect);
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
</head>

<body>
    <!--Parte do Logo-->
    <header>
        <div class="container-fluid p-0">
        <nav class="navbar fixed-top navbar-expand-lg navbar-light" style="background-color: whitesmoke;">
                <a class="navbar-brand" href=""><i class="fas fa-user-friends"></i> Olá
                    <?php echo $aluno['login']; ?>!</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="../index.php"><i class="fas fa-home"></i> Home <span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="../mobnotepro.php"><i class="fas fa-book-open"></i> MobNote Pro</a>
                        </li>
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="true" aria-expanded="false"><i class="fas fa-cogs"></i> Ações</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="../feedback.php"><i class="fas fa-exclamation-triangle"></i>
                                    Tenho um
                                    Problema</a>
                                <a class="dropdown-item" href="../mudarsenha.php"><i class="fas fa-key"></i> Mudar
                                    Senha</a>
                                <a class="dropdown-item" href="../infoconta.php"><i class="fas fa-address-card"></i> Minhas
                                    Informações</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!--Parte do Conteúdo/Menus-->
    <main>
        <section class="secao-1">
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-12 autoAnimacaoSlide">
                        <div class="panel text-left shadow-lg">
                            <h1 class="animated">Editar Conteúdo - 3° Ano</h1>
                            <a class="nav-link animated heartBeat slow"><?php echo $erros; ?></a>
                            <br />
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="input-group mb-3">
                                    <select name="select" class='form-control'>
                                    <option value="">Selecione o Conteúdo</option>
                                        <option value="1"><?php echo $resultado1['nome'] ?></option>
                                        <option value="2"><?php echo $resultado2['nome'] ?></option>
                                        <option value="3"><?php echo $resultado3['nome'] ?></option>
                                        <option value="4"><?php echo $resultado4['nome'] ?></option>
                                        <option value="5"><?php echo $resultado5['nome'] ?></option>
                                        <option value="6"><?php echo $resultado6['nome'] ?></option>
                                        <option value="7"><?php echo $resultado7['nome'] ?></option>
                                        <option value="8"><?php echo $resultado8['nome'] ?></option>
                                        <option value="9"><?php echo $resultado9['nome'] ?></option>
                                        <option value="10"><?php echo $resultado10['nome'] ?></option>
                                        <option value="11"><?php echo $resultado11['nome'] ?></option>
                                        <option value="12"><?php echo $resultado12['nome'] ?></option>
                                        <option value="13"><?php echo $resultado13['nome'] ?></option>
                                        <option value="14"><?php echo $resultado14['nome'] ?></option>
                                        <option value="15"><?php echo $resultado15['nome'] ?></option>
                                        <option value="16"><?php echo $resultado16['nome'] ?></option>
                                    </select>
                                    <button class="btn btn-outline-secondary" type="submit"
                                        name="btn-entrar2">Ver Conteúdo</button>
                                </div>
                                <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Título do Card" name="titulo"
                                        aria-label="Example text with button addon" aria-describedby="button-addon1" value="<?php echo $cont['nome'] ?>">
                                </div>
                                <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Prévia do Conteúdo (opcional)"
                                        name="previa" aria-label="Example text with button addon"
                                        aria-describedby="button-addon1" value="<?php echo $cont['previa'] ?>">
                                </div>
                                <div class="input-group mb-3 textoconteudo">
                                    <textarea type="text" class="form-control" placeholder="O conteúdo está aqui."
                                        name="texto" aria-label="Example text with button addon"
                                        aria-describedby="button-addon1"><?php echo $cont['texto'] ?></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="link de imagem (opcional)"
                                        name="imagem" aria-label="Example text with button addon"
                                        aria-describedby="button-addon1" value="<?php echo $cont['imagem'] ?>">
                                </div>
                                <div class="input-group mb-3">
                                    <p>Antes de clicar em Salvar, verifique se a caixa de seleção está com o card correto selecionado. Caso contrário, você perderá seus dados.</p>
                                    <button class="btn btn-outline-secondary" type="submit"
                                        name="btn-entrar">Salvar Conteúdo</button>
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
    <script src="../js/javascript.js"></script>

</body>

</html>