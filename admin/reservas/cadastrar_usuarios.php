<?php 
    include('../../config.php');
    include('../../connections/conn.php');
    $consulta = "select * from tbpedidos_reserva order by data asc";

    // Inicia verificação do login
    if ($_POST) {
        //definindo o USE do banco de dados
        mysqli_select_db($conn, $database_conn);
        //verifica login e senha recebidos
        $data     = $_POST['data'];
        $horario  = $_POST ['horario'];
        $numero   = $_POST ['numero'];
        $motivo   = $_POST['motivo'];

        // se a sessão não existir, iniciamos uma sessão
        if (!isset($_SESSION)) {
            $sessao_antiga = session_name("Chulettaaa");
            session_start();
            $sessao_name_new = session_name(); //Recupera o nome atual
        }
        if ($linha!=null) {
            $_SESSION['data'] = $data;
            $_SESSION['horario'] = $horario;
            $_SESSION['numero'] = $numero;
            $_SESSION['motivo'] = $motivo;
            $_SESSION['nome_da_sessao'] = session_name();
         //   echo "<script>window.open('index.php','_self')</script>";
            header ("location: cadastrar usuarios_reservas.php");
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
                    Reservas
                </h4>
                <div class="thumbnail">
                    <div class="alert alert-info" role="alert">
                        <label for="pedido_reservas.php"></label>
                        <div class="form-group">
                            <div class="input-group"></div>
                                <span class="input-group-addon">
                                    <thead>
                                        <th class="hidden"><strong>Id</strong></th>
                                        <th><strong>Data</strong></th>
                                        <th><strong>Horário</strong></th>
                                        <th><strong>Número</strong></th>
                                        <th><strong>Motivo</strong></th>
                                    </thead>
                                    <tbody><!-- Corpo da tabela -->
                <!-- Abre a estrutura de repetição -->
                <?php do { ?>
                    <tr><!-- Linha da tabela -->
                        <td class="hidden"><?php echo $linha['id_produto'] ?></td>
                        <td>
                            <span class="visible-xs"><?php echo $linha['data'] ?></span>
                            <span class="hidden-xs"><?php echo $linha['rotulo_tipo'] ?></span>
                        </td>
                        <td>
                            <?php
                            if ($linha['destaque_produto'] == 'Sim') {
                                echo ("<span class='glyphicon glyphicon-heart text-danger' aria-hidden='true'></span>");
                            } else {
                                echo ("<span class='glyphicon glyphicon-ok text-info' aria-hidden='true'></span>");
                            }
                            ?>
                            <?php echo $linha['descri_produto'] ?>
                        </td>
                        <td> <?php echo $linha['resumo_produto'] ?></td>
                        <td> <?php echo number_format($linha['valor_produto'], 2, ',', '.') ?></td>
                        <td><img src="../images/<?php echo $linha['imagem_produto'] ?>" alt="" width="100px"></td>
                        <td>
                            <a href="produto_atualiza.php?id_produto=<?php echo $linha['id_produto'] ?>" 
                            class="btn btn-warning btn-block btn-xs">
                                <span class="hidden-xs">Alterar</span>
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </a>
                            <button class="btn btn-danger btn-block btn-xs delete " 
                                    role="button" 
                                    data-id="<?php echo $linha['id_produto']; ?>" 
                                    data-nome="<?php echo $linha['descri_produto']; ?>">
                                <span class="hidden-xs ">Excluir</span>
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </button>
                        </td>
                    </tr><!-- Fecha a linha da tabela -->
                <?php } while ($linha = $lista->fetch_assoc()); ?>
            </tbody><!-- Fecha corpo da tabela -->
                                </span>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </main>
</body>