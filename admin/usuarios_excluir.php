<?php 
// incluindo o sistema de autenticação
include ('acesso_com.php');

// incluindo conexão com banco de dados
include ('../connections/conn.php');

$id_prod = $_GET['id_usuario'];

// removendo usando músculos (Força bruta)
//$query = "delete from tbprodutos where id_produto = $id_prod;";


// removendo usando método de acumulador (vai que precisa outra hora!)
$query = "update tbprodutos set deletado = default where id_usuario = $id_usuario;";


$resultado = $conn->query($query);
if(mysqli_insert_id($conn)){
    header("location: usuarios_lista.php");
}else{
    header("location: usuarios_lista.php");
}
?>