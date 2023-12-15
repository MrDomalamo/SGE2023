<?php 
$tabela = 'candidatos';
require_once("../../conexao.php");

$id = $_POST['id'];




$query = $pdo->query("SELECT * FROM usuarios where id_candidato = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_usuario = $res[0]['id'];


$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$foto = $res[0]['foto'];
if($foto != "sem-perfil.jpg"){
	@unlink('../images/perfil/'.$foto);
}

$query = $pdo->query("SELECT * FROM candidaturas where candidato = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	echo 'Este candidato não pode ser excluído, primeiro exclua o candidatura relacionada a este, para depois excluir este candidato!';
	exit();
}

$pdo->query("DELETE FROM $tabela where id = '$id'");
$pdo->query("DELETE FROM usuarios where id_candidato = '$id'");

echo 'Excluído com Sucesso';


?>