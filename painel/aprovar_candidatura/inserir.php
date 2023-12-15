<?php 
$tabela = 'aprovar_candidatura';
require_once("../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id_usuario'];
$nivel_usuario = $_SESSION['nivel_usuario'];

$candidato = $_POST['candidato'];    
$recrutador = $_POST['recrutador'];
$status = $_POST['status'];
$data_aprovacao = $_POST['data_aprovacao'];
$descricao = $_POST['descricao'];
$id = $_POST['id'];





$query = $pdo->query("SELECT * FROM usuarios WHERE id = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$diretor = $res[0]['id_func'];
	
}
 




	if($id == ""){
		$query = $pdo->prepare("INSERT INTO $tabela SET candidato = '$candidato', recrutador = '$recrutador', diretor = '$diretor',status = '$status' ,data_aprovacao = '$data_aprovacao', descricao = :descricao ,ativo = 'Sim' ");
		
	}else{
		$query = $pdo->prepare("UPDATE $tabela SET candidato = '$candidato', recrutador = '$recrutador', diretor = '$diretor',status = '$status' ,data_aprovacao = '$data_aprovacao', descricao = :descricao ,ativo = 'Sim' WHERE id = '$id'");
	    
	}
		$query->bindValue(":descricao", "$descricao");
		$query->execute();
		echo 'Salvo com Sucesso';
		
		
		
$query = $pdo->query("SELECT * FROM usuarios where id_candidato = '$candidato'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$nome_candidato = $res[0]['nome'];
	$email_candidato = $res[0]['email'];
	
} 

$query = $pdo->query("SELECT * FROM usuarios where id_func = '$recrutador'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$nome_recrutador = $res[0]['nome'];
	$email_recrutador = $res[0]['email'];
	
} 

$query = $pdo->query("SELECT * FROM usuarios where id_func = '$diretor'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$nome_diretor  = $res[0]['nome'];
	$email_diretor  = $res[0]['email'];
	
} 
	
	
		
	
		$destinatario = $email_recrutador ;
		$assunto = 'Resposta do Pedido de Aprovacao ';
		$url_painel_candidato = $url_sistema.'';
		$url_logo = $url_sistema.'/img/logoedm.png';
		// $url_doc = $url_sistema.'/painel/images/arquivos/'. $arquivo. '';
		// $url_docc = $url_sistema.'/painel/images/arquivos/'. $tumb_arquivo. '';
		
		
		
				$mensagem = "
		
							  Prezado (a) Recrutador(a) $nome_recrutador 
							  <br><br>Encontre abaixo a resposta a sua solicitação, com relação ao pedido de aprovação do candidato $nome_candidato. 
							 
							  
						
							  <br><br> Resposta: $status
							  <br><br> Data Resposta: $data_aprovacao
		
							  <br><br>
							  Nome do Director: $nome_diretor
							  Email: $email_diretor
							
							  <br><br>
							  Nome do candidato: $nome_candidato
							  Email: $email_candidato
							<br><br> Verificar atividade -> <a href='$url_painel_candidato' target='_blank'> Clique Aqui </a>
							  
		
							  ";
		
		$remetente = $email_adm;
		$cabecalhos = 'MIME-Version: 1.0' . "\r\n";
		$cabecalhos .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
		$cabecalhos .= "From: " .$remetente;
		
		@mail($destinatario, $assunto, $mensagem, $cabecalhos);
		
		
		//envio para o administrador
		$destinatario = $email_adm;
		$assunto = 'Resposta do pedido de aprovacao da candidatura';
		
			$mensagem = "O Diretor (a) $nome_diretor , acaba de enviar a resposta do pedido de aprovacão, da  candidatura correspondente ao Candidato(a) $nome_candidato,  para o recrutador (a) $nome_recrutador 
			
			<br><br> Resposta: $status
			<br><br> Data Resposta: $data_aprovacao

			<br><br> Verificar atividade -> <a href='$url_painel_candidato' target='_blank'> Clique Aqui </a>";
			
		  
			
		
		$remetente = $email_adm;
		$cabecalhos = 'MIME-Version: 1.0' . "\r\n";
		$cabecalhos .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
		$cabecalhos .= "From: " .$remetente;
		
		@mail($destinatario, $assunto, $mensagem, $cabecalhos);
				
		
		
			
			
		
			
			?>