<?php
    //Incluindo variaveis de sistema
    include('../config.php');

    //Só vai ter acesso a esse arquivo quem estiver autenticado
    include ('acesso_com.php');

    //incluindo o arquivo de conexão
    include ('../connections/conn.php');

    // selecionando os dados
    $consulta = "select * from tbtipos order by rotulo_tipo asc";  //Ordenando produtos | asc (ascensão)

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
    <title>Tipos (<?php echo $total_linhas; ?>)</title>
    </head>
<body class="">
    <?php include ('menu_adm.php'); ?>
    <main class="container">
        <h1 class="beeadcrumb alert-danger">Lista de Tipos</h1>
        <table class="table table-condensed table-hover tbopacidade">
            <!-- thead>th*8 -->
            <thead>
                <th class="hidden">Id</th>
                <th>Sigla</th>
                <th>Rotulo</th>
                <th>
                    <a href="tipos_insere.php" class="btn btn-block btn-primary btn-xs">
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
                <td><?php echo $linha['sigla_tipo']?></td>
                    <td class="hidden"><?php echo $linha['id_tipo'];?></td>
                        <td>
                            <span class="visible-xs"><?php echo $linha['sigla_tipo'] ?></span>
                            <span class="hidden-xs"><?php echo $linha['rotulo_tipo'] ?></span>
                        </td>
                        <td>
                        <a href="tipos_atualiza.php?id_tipo=<?php echo $linha['id_tipo'];?>" 
                        class="btn btn-warning btn-block btn-xs">
                            <span class="hidden-xs">Alterar</span>
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </a>
                        <button class="btn btn-danger btn-block btn-xs delete"
                                role="button"
                                data-nome="<?php echo $linha['rotulo_tipo'];?>" 
                                data-id="<?php echo $linha['id_tipo'];?>">
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
                    Deseja realmente <strong>excluir</strong> o item?
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
            $('a.delete-yes').attr('href','tipos_excluir.php?id_tipo='+id);
            //Abre o Modal
            $('#myModal').modal('show');
        })
    </script>
</body>
</html>