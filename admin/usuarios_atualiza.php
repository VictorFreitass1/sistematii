<?php 
// incluindo variáveis de ambiente, acesso e banco
include ('../config.php');
include ('acesso_com.php');
include ('../connections/conn.php');

if ($_POST) {
    //Guardando o nome da imagem no banco de dados e o arquivo no diretorio     
    if($_FILES['imagem_produto']['name']){
        $nome_img = $_FILES['imagem_produto']['name'];
        $tmp_img = $_FILES['imagem_produto']['tmp_name'];
        $pasta_img = "../images/".$nome_img;
        move_uploaded_file($tmp_img,$pasta_img);
    }else{
        $nome_img = $_POST['imagem_produto_atual'];
    }
    // Receber os dados do formulário
    // Organizar os campos na mesma ordem
    $id_usuario     = $_POST['id_usuario'];
    $login_usuario  = $_POST['login_usuario'];
    $senha_usuario  = $_POST['senha_usuario'];
    $nivel_usuario  = $_POST['nivel_usuario'];
    $imagem_produto   = $nome_img;

    // Campo do form para filtar o registros 
    $id_filtro = $_POST['id_usuario'];

    // Consulta (query) Sql para inserção dos dados
    $query = "update tbprodutos
                id_usuario = '".$id_usuario."',
                login_usuario = '".$login_usuario."',
                senha_usuario = '".$senha_usuario."',
                nivel_usuario = '".$nivel_usuario."';
                imagem_produto = '".$imagem_produto."'";

    $resultado = $conn->query($query);

    // Após a ação a página será direcionada
    if (mysqli_insert_id($conn)) {
        header('location: usuarios_lista.php');
        // Adicionar tratamento...
    }else{
        header('location: usuarios_lista.php');
    }
}

// Consulta para recuperar dados do filtro da chamada da página... 
$id_alterar = $_GET['id_usuario'];
$query_busca = "select * from tbusuarios where id_usuario = ".$id_alterar;
$lista = $conn->query($query_busca);
$linha = $lista->fetch_assoc();
$total_linhas = $lista->num_rows;

$consulta_fk = "select * from tbusuarios 
                order by login_usuario asc";
$lista_fk = $conn->query($consulta_fk);
$linha_fk = $lista_fk->fetch_assoc();
$total_linhas_fk = $lista_fk->num_rows;

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SYS_NAME;?> - Admin (Alterar)</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../css/meu_estilo.css" type="text/css">
</head>
<body class="">
    <?php include ('menu_adm.php');?>
    <main class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-2 col-md-8">
                <h3 class="breadcrumb text-danger">
                    <a href="usuarios_lista.php">
                        <button class="btn btn-danger">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </button>
                    </a>
                    Atualizando Usuarios
                </h3>
                <div class="thumbnail"><!-- Abre thumbnail -->
                <div class="alert-alert-danger" role="alert">
                    <form action="usuarios_atualiza.php" method="post"
                        id="form_usuarios_atualiza" name="form_usuarios_atualiza"
                        enctype="multipart/form-data">
                        <!-- inserir o campo id_produto OCULTO para uso no filtro -->
                        <input type="hidden" name="id_usuario" id="id_usuario"
                               value="<?php echo $linha['id_usuario'];?>">
                            <!--login usuario-->
                            <label for="login_usuario">Usuario</label>
                            <div class="input-group">
                                <label for="login_usuario_s" class="radio-inline">
                                    <input type="radio" name="login_usuario" id="login_usuario" value="Sim"
                                        <?php echo $linha['login_usuario']=="Sim"?"checked":null; ?>>
                                    Sim
                                </label>
                                <label for="login_usuario_n" class="radio-inline">
                                    <input type="radio" name="login_usuario" id="login_usuario" value="Não"
                                        <?php echo $linha['login_usuario']=="Não"?"checked":null; ?>>
                                    Não
                                </label>
                            </div>
                            <br>
                            <!--senha_usuario-->
                            <label for="senha_usuario">Senha Usuario:</label>
                            <input type="number" name="senha_usuario" id="senha_usuario"?>

                            </div>
                            <br>
                            <!--nivel_usuario-->
                            <label for="nivel_usuario">Nivel do usuario:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-alt" aria-hidden="true"></span>
                                </span>
                                <textarea name="nivel_usuario" id="nivel_usuario" cols="100" rows="4">
                                        <?php echo $linha['nivel_usuario'];?>
                                </textarea>
                            </div>
                            <br>
                            <!-- btn enviar -->
                            <input type="submit" value="Atualizar" name="enviar" id="enviar" class="btn btn-danger btn-block">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
<?php 
    mysqli_free_result($lista);
    mysqli_free_result($lista_fk);
?>