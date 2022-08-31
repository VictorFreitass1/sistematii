<?php 
    include('../../config.php');
    include('../../connections/conn.php')
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta http-equiv="refresh">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/meu_estilo.css" type="text/css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css" type="text/css">
    <title><?php echo SYS_NAME; ?> - Login</title>
</head>
<body class="fundo">
<?php include('../../menu_publico.php'); ?>
    <main class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-2 col-md-8">
               <h4 class="breadcrumb text-warning">
                    <a href="index.php">
                        <button class="btn btn-info">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </button>
                    </a>
                    Pedidos de Reservas
               </h4>
                <div class="thumbnail">
                    <div class="alert alert-info" role="alert">
                        <label for="reserva.php">Regras da reserva</label>
                        <div class="form-group">
                            <div class="input-group"></div>
                                <span class="input-group-addon">
                                    A reserva pode ser realizada com no mínimo 24 horas de antecedência e no máximo 45 dias.
                                    <br>
                                    <br>
                                    Apenas um pedido de reserva por dia para um mesmo cpf.
                                    <br>
                                    <br>
                                    O cliente deve usar o nome completo, o cpf e o email para realizar a reserva,<br>essas são as informações necessárias.
                                    <br>
                                    <br>
                                    CPF e email devem ser utilizados para login do cliente no sistema de reserva, além da senha.
                                    <br>
                                    <br>
                                    <span class="glyphicon glyphicon-task" aria-hidden="true"></span>
                                </span>
                                    <br>
                                <section>
                                        <article>
                                            <h1 class="breadcrumb text-info text-center">Cadastro para realizar a reserva</h1>
                                            <div class="thumbnail">
                                                <br>
                                                <div class="alert alert-info" role="alert">
                                                    <form action="login.php" name="form_login" id="form_login" method="post" enctype="multipart/form-data">
                                                        <label for="login_usuario">Nome completo:</label>
                                                        <p class="input-group">
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-user text-info" aria-hidden="true"></span>
                                                            </span>
                                                                <input type="text" name="login_usuario" id="login_usuario" class="form-control" autofocus required autocomplete="off" placeholder="Digite seu nome.">
                                                        </p>
                                                        <label for="cpf_usuario">CPF:</label>
                                                        <p class="input-group">
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-user text-info" aria-hidden="true"></span>
                                                            </span>
                                                                <input type="text" name="cpf_usuario" id="cpf_usuario" class="form-control" autofocus required autocomplete="off" placeholder="Digite seu CPF.">
                                                        </p>
                                                            <label for="email_usuario">Email:</label>
                                                        <p class="input-group">
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-qrcode text-info" aria-hidden="true"></span>
                                                            </span>
                                                                <input type="password" name="email_usuario" id="email_usuario" class="form-control" required autocomplete="off" placeholder="Digite seu email.">
                                                        </p>
                                                        <p class="text-center">                                                
                                                            <input type="submit" value="Realizar reserva" class="btn btn-primary" for="cadastrar_usuarios">
                                                        </p>
                                                    </form>
                                                </div>
                                            </div><!-- fecha thumbnail -->
                                        </article>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>