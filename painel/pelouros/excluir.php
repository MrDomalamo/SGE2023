<?php 
$tabela = 'pelouros';
require_once("../../conexao.php");

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM direcoes where pelouro = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	echo 'Esta Pelouro não pode ser excluída, primeiro exclua as direcoes relacionados a ela para depois excluir este registro!';
	exit();
}

$pdo->query("DELETE FROM $tabela where id = '$id'");

echo 'Excluído com Sucesso';


?>