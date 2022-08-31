<?php 
    // Incluindo variaveis de sistema
    include('../config.php');

    // Só vai ter acesso a esse arquivo quem estiver autenticado
    include ('acesso_com.php');

    // Incluindo o arquivo de conexão
    include ('../connections/conn.php');

    // Selecionando os dados
    $consulta = "select * from tbusuarios order by login_usuario asc";  //Ordenando produtos | asc (ascensão)

    // buscar a lista completa de produtos no banco
    $lista = $conn->query($consulta);

    // separar produtos por linha no banco
    $linha = $lista -> fetch_assoc();

    // Contar número de linhas da lista
    $total_linhas = $lista->num_rows;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../css/meu_estilo.css" type="text/css">
    <title>Usuarios (<?php echo $total_linhas; ?>)</title>
    </head>
    
<body class="">
    <?php include ('menu_adm.php'); ?>
    <main class="container">
        <h1 class="beeadcrumb alert-danger">Lista de Usuarios</h1>
        <table class="table table-condensed table-hover tbopacidade">
            <!-- thead>th*8 -->
            <thead>
                <th class="hidden">Id</th>
                <th>Login</th>
                <th>Nivel</th>
                <th>
                    <a href="usuarios_insere.php" class="btn btn-block btn-primary btn-xs">
                        <span class="hidden-xs">Adicionar<br></span>
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                </th>
                </thead><!-- Fecha linha de cabeçalho da tabela -->
            <!-- tbody>tr>td*8 -->
            <tbody> <!-- Corpo da tabela -->
            <!-- Abre a estrutura de repetição-->
                <?php do { ?>
                <tr> <!-- Linha da tabela -->
                    <td class="hidden"><?php echo $linha['id_usuario'];?></td>
                  <td><?php echo $linha['login_usuario'];?></td>
                    <td>
                            <span class="visible-xs"><?php echo $linha['login_usuario'] ?></span>
                            <span class="hidden-xs"><?php echo $linha['nivel_usuario'] ?></span>
                        </td> 
                    <td>
                        <a href="usuarios_atualiza.php?id_usuario=<?php echo $linha['id_usuario'];?>" 
                        class="btn btn-warning btn-block btn-xs">
                            <span class="hidden-xs">Alterar</span>
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </a>
                        <button class="btn btn-danger btn-block btn-xs delete"
                                role="button"
                                data-nome="<?php echo $linha['login_usuario'];?>" 
                                data-id="<?php echo $linha['id_usuario'];?>">
                            <span class="hidden-xs">Excluir</span>
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </button>
                    </td>
                </tr> <!-- Fecha linha da tabela -->
                <?php } while ($linha=$lista->fetch_assoc()); ?>
                </tbody> <!-- Fecha corpo da tabela -->
        </table>
    </main>
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-danger">Atenção</h4>
                </div>
                <div class="modal-body">
                    Deseja realmente <strong>Excluir</strong> o item?
                    <h3><span class="text-danger nome"></span></h3>
                </div>
                <div class="modal-footer">
                    <a href="#" type="button" class="btn btn-danger delete-yes">Confirmar</a>
                    <button class="btn btn-success" data-dismiss="modal">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" 
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- Script para o Modal -->
    <script type="text/javascript">
        $('.delete').on('click',function(){
            //Busca o valor do atributo data-nome
            var nome = $(this).data('nome');
            //Busca o valor do atributo data-id
            var id = $(this).data('id');
            //Insere o nome do item na confirmação do Modal
            $('span.nome').text(nome);
            //Envia o id através do link do botão para confirmar 
            $('a.delete-yes').attr('href','usuarios_excluir.php?id_usuario='+id);
            //Abre o Modal
            $('#myModal').modal('show');
        })
    </script>
</body>
</html>