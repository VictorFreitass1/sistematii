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
    $rotulo_tipo = $_POST['rotulo_tipo'];
    $sigla_tipo =  $_POST['sigla_tipo'];

    // Campo do form para filtar o registros 
    $id_filtro = $_POST['id_produto'];

    // Consulta (query) Sql para inserção dos dados
    $query = "update tbprodutos
                rotulo_tipo = '".$rotulo_tipo."',
                sigla_tipo = '".$sigla_tipo."'";
    $resultado = $conn->query($query);

    // Após a ação a página será direcionada
    if (mysqli_insert_id($conn)) {
        header('location: tipos_lista.php');
        // Adicionar tratamento...
    }else{
        header('location: tipos_lista.php');
    }
}

// Consulta para recuperar dados do filtro da chamada da página... 
$id_alterar = $_GET['id_tipo'];
$query_busca = "select * from tbtipos where id_tipo = ".$id_alterar;
$lista = $conn->query($query_busca);
$linha = $lista->fetch_assoc();
$total_linhas = $lista->num_rows;

$consulta_fk = "select * from tbtipos 
                order by rotulo_tipo asc";
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
                    <a href="produtos_lista.php">
                        <button class="btn btn-danger">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </button>
                    </a>
                    Atualizando Produtos
                </h3>
                <div class="thumbnail"><!-- Abre thumbnail -->
                <div class="alert-alert-danger" role="alert">
                    <form action="tipos_atualiza.php" method="post"
                        id="form_tipo_atualiza" name="form_tipo_atualiza"
                        enctype="multipart/form-data">
                        <!-- inserir o campo id_produto OCULTO para uso no filtro -->
                        <input type="hidden" name="id_tipo" id="id_tipo"
                               value="<?php echo $linha['id_tipo'];?>">
                            <!-- Select id_tipo_produto -->
                            <label for="id_tipo">Tipo:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
                                </span>
                                <select name="id_tipo" id="id_tipo" class="form-control" required>
                                    <?php do { ?>
                                    <option value="<?php echo $linha_fk['id_tipo']?>"
                                        <?php 
                                            if(!(strcmp($linha_fk['id_tipo'],$linha['id_tipo'])))
                                            {echo "selected=\"selected\"";}
                                        ?>  >
                                        <?php echo $linha_fk['rotulo_tipo'];?>
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
                            <!--radio destaque_produto-->
                            <label for="rotulo_tipo">Rotulo</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="rotulo_tipo" name="rotulo_tipo"
                                        maxlength="100" required value="<?php echo $linha['rotulo_tipo']; ?>"
                                        placeholder="Digite o título do produto...">
                            </div>
                            <br>
                            <!--Text descri_produto-->
                            <label for="sigla_tipo">Sigla:</label>
                            <div class="input-group">
                            <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span>
                                </span>
                                <input type="text" class="form-control" id="sigla_tipo" name="sigla_tipo"
                                        maxlength="100" required value="<?php echo $linha['sigla_tipo']; ?>"
                                        placeholder="Digite o título do produto...">
                            </div>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Script para a imagem -->
    <script>
        document.getElementById("imagem_produto").onchange = function (){
            var reader = new FileReader();
            if(this.file[0].size>528385){
                alert("A imagem deve ter no máximo 500KB");
                $("#imagem").attr("src", "blank");
                $("#imagem").hide();
                $("imagem_produto").wrap('<form>').closest('form').get(0).reset();
                $("imagem_produto").unwrap();
                return false;
            }
            // verifica se o input do tipo file possui dado
            if(this.file[0].type.indexOf("image")==-1){
                alert("Formato inválido, escolha uma imagem!");
                $("#imagem").attr("src", "blank");
                $("#imagem").hide();
                $("imagem_produto").wrap('<form>').closest('form').get(0).reset();
                $("imagem_produto").unwrap();
                return false;
            };
            reader.onload = function (e){
                // obter dados carregados e renderizar a miniatura
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
<?php 
    mysqli_free_result($lista);
    mysqli_free_result($lista_fk);
?>