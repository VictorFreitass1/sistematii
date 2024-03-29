<?php
include('../../connections/conn.php');
// Inicia verificação do login
if ($_POST) {
    //definindo o USE do banco de dados
    mysqli_select_db($conn, $database_conn);
    //verifica login e senha recebidos
    $login_usuario = $_POST['login_usuario'];
    $cpf_usuario   = $_POST ['cpf_usuario'];
    $email_usuario = $_POST ['email_usuario'];
    $senha_usuario = $_POST['senha_usuario'];

    $verificaSQL = "select * 
    from tbusuarios 
    where login_usuario = '$login_usuario' 
    and   cpf_usuario = '$cpf_usuario'
    and   email_usuario = '$email_usuario'
    and senha_usuario = md5('$senha_usuario');
    ";
    //echo $verificaSQL;
    //carregar os dados e verificar a linha de retorno, caso exista
    $lista_session = mysqli_query($conn, $verificaSQL);
    $linha = $lista_session->fetch_assoc();
    $numero_linhas = mysqli_num_rows($lista_session);

    // se a sessão não existir, iniciamos uma sessão
    if (!isset($_SESSION)) {
        $sessao_antiga = session_name("Chulettaaa");
        session_start();
        $sessao_name_new = session_name(); //Recupera o nome atual
    }
    if ($linha!=null) {
        $_SESSION['login_usuario'] = $login_usuario;
        $_SESSION['nivel_usuario'] = $linha['nivel_usuario'];
        $_SESSION['nome_da_sessao'] = session_name();
     //   echo "<script>window.open('index.php','_self')</script>";
        header ("location: pedido_reservas.php");
    } 
    else {
        echo "<script>window.open('invasor.php','_self')</script>";
    }
}
?>


<!doctype html>
<html lang="pt-br">
<head>
    <meta http-equiv="refresh">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/2495680ceb.js" crossorigin="anonymous"></script><!-- Link arquivos Bootstrap css -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../../css/meu_estilo.css" rel="stylesheet" type="text/css">
    <title><?php echo SYS_NAME; ?> - Login</title>
</head>

<body class="fundofixo">
    <main class="container">
        <section>
            <article>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                        <h1 class="breadcrumb text-info text-center">Faça seu login</h1>
                        <div class="thumbnail">
                            <p class="text-info text-center" role="alert">
                                <i class="fas fa-users fa-10x"></i>
                            </p>
                            <br>
                            <div class="alert alert-info" role="alert">
                                <form action="login.php" name="form_login" id="form_login" method="post" enctype="multipart/form-data">
                                    <label for="login_usuario">Login:</label>
                                    <p class="input-group">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-user text-info" aria-hidden="true"></span>
                                        </span>
                                        <input type="text" name="login_usuario" id="login_usuario" class="form-control" autofocus required autocomplete="off" placeholder="Digite seu login.">
                                    </p>
                                    <label for="email_usuario">Email:</label>
                                    <p class="input-group">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-user text-info" aria-hidden="true"></span>
                                        </span>
                                        <input type="text" name="email_usuario" id="email_usuario" class="form-control" autofocus required autocomplete="off" placeholder="Digite seu Email.">
                                    </p>
                                    <label for="cpf_usuario">CPF:</label>
                                    <p class="input-group">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-user text-info" aria-hidden="true"></span>
                                        </span>
                                        <input type="text" name="cpf_usuario" id="cpf_usuario" class="form-control" autofocus required autocomplete="off" placeholder="Digite seu CPF.">
                                    </p>
                                    <label for="senha_usuario">Senha:</label>
                                    <p class="input-group">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-qrcode text-info" aria-hidden="true"></span>
                                        </span>
                                        <input type="password" name="senha_usuario" id="senha_usuario" class="form-control" required autocomplete="off" placeholder="Digite sua senha.">
                                    </p>
                                    <p class="text-right">
                                        <input type="submit" value="Entrar" class="btn btn-primary">
                                    </p>
                                </form>
                                <p class="text-center">
                                    <small>
                                        <br>
                                        Caso não faça uma escolha em 30 segundos será redirecionado automaticamente para página inicial.
                                    </small>
                                </p>
                            </div>
                        </div><!-- fecha thumbnail -->
                    </div><!-- fecha dimensionamento -->
                </div><!-- fecha row -->
            </article>
        </section>
    </main>

    <!-- Link arquivos Bootstrap js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>