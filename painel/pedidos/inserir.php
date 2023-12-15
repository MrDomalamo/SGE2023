<?php 
$tabela = 'pedidos';
require_once("../../conexao.php");

		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$telefone = $_POST['telefone'];
		$email = $_POST['email'];
		$comentario = $_POST['comentario'];
		// $data_cad = $_POST['data_cad'];
		$corretor = $_POST['corretor'];
		$imoveis = $_POST['imoveis'];
		$tipo = $_POST['tipo'];
		$url = $_POST['url'];
		$status = $_POST['status'];



//validar cpf
$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'BI já Cadastrado, escolha Outro!';
	exit();
}

//validar email


$nome_novo = strtolower( preg_replace("[^a-zA-Z0-9-]", "-", 
        strtr(utf8_decode(trim($url)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"),
        "aaaaeeiooouuncAAAAEEIOOOUUNC-")) );
$url = preg_replace('/[ -]+/' , '-' , $nome_novo);







if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, telefone = :telefone, email = :email, comentario = :comentario, data_cad = curDate(), corretor = '$corretor', tipo = '$tipo', status = '$status', imoveis = '$imoveis', url = :url");
	
}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, telefone = :telefone, email = :email, comentario = :comentario, data_cad = '$data_cad', corretor = '$corretor', tipo = '$tipo', status = '$status', imoveis = '$imoveis', url = :url, WHERE id = '$id'");



}
$query->bindValue(":nome", "$nome");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":email", "$email");
$query->bindValue(":comentario", "$comentario");
$query->bindValue(":url", "$url");
$query->execute();
$ult_id = $pdo->lastInsertId();

if($id == ""){
	$url = $url .'-'.$ult_id;
	$novo_id = $ult_id;
}else{
	$url = $url .'-'.$id;
	$novo_id = $id;
}

//atualizar no imovel o campo url
$query = $pdo->query("UPDATE $tabela SET url = '$url' WHERE id = '$novo_id'");

echo 'Salvo com Sucesso'; 

?>