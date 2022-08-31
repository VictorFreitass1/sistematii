<?php 
// sistema de autenticação
include('acesso_com.php');
//variáveis de ambiente
include ('../config.php');
// conexão com banco
include ('../connections/conn.php');

if($_POST){

    if (isset($_POST['enviar'])) {
        $nome_img = $_FILES['imagem_produto']['name'];
        $tmp_img = $_FILES['imagem_produto']['tmp_name'];
        $pasta_img = "../images/".$nome_img;
        move_uploaded_file($tmp_img,$pasta_img);
    }
    // voce poderia e deveria criar procedure!
    
    $login_usuario = $_POST['login_usuario'];
    $senha_usuario =  $_POST['senha_usuario'];
    $nivel_usuario =  $_POST['nivel_usuario'];

    $campos_insert= "login_usuario, senha_usuario, nivel_usuario";
    $values = "$login_usuario,'$senha_usuario', '$nivel_usuario'";
    $query = "insert into tbusuarios ($campos) values ($values);";
    $resultado = $conn->query($query);
    //var_dump($query);
    // após o insert redireciona a página
    if(mysqli_insert_id($conn)){
        header("location: usuarios_lista.php");
    }else{
        header("location: usuarios_lista.php");
    }
}
// chave estrangeira tipo
$query_tipo = "select * from tbusuarios order by login_usuario asc";
$lista_fk = $conn->query($query_tipo);
$linha_fk = $lista_fk->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SYS_NAME;?> - Inserir Usuarios</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../css/meu_estilo.css" type="text/css">
</head>
<body class="fundo">
    <?php include ('menu_adm.php');?>
    <main class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-2 col-md-8">
               <h4 class="breadcrumb text-warning">
                <a href="usuarios_lista.php">
                    <button class="btn btn-danger">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Inserindo Usuarios
               </h4> 
                    <div class="thumbnail">
                        <div class="alert alert-danger" role="alert">
                            <form action="usuarios_insere.php" id="form_usuarios_insere" name="form_usuarios_insere"  enctype="multipart/form-data">
                                <!-- Seleciona o Tipo do Produto -->
                                <label for="id_usuario">Usuarios:</label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-task" aria-hidden="true"></span>
                                            </span>
                                            <select name="id_usuario" id="id_usuario" class="form-control" required>
                                            <?php do { ?>
                                            <option value="<?php echo $linha_fk['id_usuario']?>"
                                            >
                                            <?php echo $linha_fk['login_usuario'];?>
                                            </option>
                                            <?php } while ($linha_fk = $lista_fk->fetch_assoc());
                                            $linhas_fk = mysqli_num_rows($lista_fk);
                                            if ($linhas_fk>0) {
                                            mysqli_data_seek($lista_fk,0);
                                            $linhas_fk = $lista_fk->fetch_assoc();
                                            }
                                            ?>
                                        </select>
                                        </div>
                                        <br>
                                        <label for="senha_usuario">Senha:</label>
                                        <div class="input-group">
                                            <label for="senha_usuario" class="radio-inline">
                                                <input type="radio" name="senha_usuario" id="senha_usuario" value="Sim">Sim
                                            </label>
                                            <label for="senha_usuario" class="radio-inline">
                                                <input type="radio" name="senha_usuario" id="senha_usuario" value="Não" checked>Não
                                            </label>
                                        </div> <!-- Fecha a div do radio Button -->
                                    </div>
                                    <br>
                                    <label for="nivel_usuario">Nivel:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span>
                                        </span>
                                            <input type="text" class="form-crontrol" name="nivel_usuario" id="nivel_usuario"
                                            placeholder="Digite o título do produto" maxlength="100" required>
                                    </div>
                                    <br>
                                    <input type="submit" value="Cadastrar" name="enviar" id="enviar" 
                                    class="btn btn-danger btn-block">
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </main>
    <script>
        document.getElementById("imagem_produto").onchange = function() {
            var reader = new FileReader();
            if (this.files[0].size > 528385) {
                alert("A imagem deve ter no máximo 500KB");
                $("#imagem").attr("src", "blank");
                $("#imagem").hide();
                $("#imagem_produto").wrap('<form>').closest('form').get(0).reset();
                $("#imagem_produto").unwrap();
                return false;
            }
            // Verifica se o input do titpo file possui dado
            if (this.files[0].type.indexOf("image") == -1) {
                alert("Formato inválido, escolha uma imagem!");
                $("#imagem").attr("src", "blank");
                $("#imagem").hide();
                $("#imagem_produto").wrap('<form>').closest('form').get(0).reset();
                $("#imagem_produto").unwrap();
                return false;
                };
                 reader.onload = function(e) {
                //Obter dados  carregados e renderizar a miniatura
                document.getElementById("imagem").src = e.target.result;
                $("#imagem").show();
             };
            reader.readAsDataURL(this.files[0]);
        };
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

</body>
</html>