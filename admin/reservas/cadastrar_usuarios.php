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