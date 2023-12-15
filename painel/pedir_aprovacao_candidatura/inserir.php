<?php 
$tabela = 'aprovar_candidatura';
require_once("../../conexao.php");

@session_start();
$id_usuario = $_SESSION['id_usuario'];
$nivel_usuario = $_SESSION['nivel_usuario'];
   
$candidato = $_POST['candidato'];
$diretor  = $_POST['diretor'];
$id = $_POST['id'];


$query = $pdo->query("SELECT * FROM usuarios WHERE id = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$recrutador = $res[0]['id_func'];
	
}

  


$query = $pdo->query("SELECT * FROM arquivos where registro = 'Candidaturas' and id_reg = '$id' order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$arquivo = $res[0]['arquivo'];
	$nome_arquivo = $res[0]['nome'];
}else{
	$arquivo = 'sem-perfil.jpg';
	$nome_arquivo = 'Nenhum Arquivo Selecionado';
}



	if($id == ""){
		$query = $pdo->prepare("INSERT INTO $tabela SET candidato = '$candidato', recrutador = '$recrutador', diretor  = '$diretor', data_cad = curDate() , ativo = 'Sim', status = 'espera' ");
		
	}else{
		$query = $pdo->prepare("UPDATE $tabela SET candidato = '$candidato', recrutador = '$recrutador', diretor  = '$diretor' , ativo = 'Sim', status = 'espera' WHERE id = '$id'");
	    
	}

		$query->execute();
		$id_aprovar = $pdo->lastInsertId();

		
		echo 'Salvo com Sucesso';


			$query = $pdo->query("SELECT * FROM aprovar_candidatura where id = '$id_aprovar'");
			$res = $query->fetchAll(PDO::FETCH_ASSOC);
			if(@count($res) > 0){
			$data_cad = $res[0]['data_cad'];
		
			} 



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
	
	
		
	
		$destinatario = $email_diretor ;
		$assunto = 'Pedido de aprovacao da candidatura no ' .$nome_sistema.'!';
		$url_painel_candidato = $url_sistema.'';
		$url_logo = $url_sistema.'/img/logoedm.png';
		// $url_doc = $url_sistema.'/painel/images/arquivos/'. $arquivo. '';
		// $url_docc = $url_sistema.'/painel/images/arquivos/'. $tumb_arquivo. '';
		
		
		
				$mensagem = "
		
							  Senhor (a) Director (a) $nome_diretor 
							  <br><br>, Vim por este meio solicitar o  pedido de aprovação da candidatura para o estágio referente ao Candidato $nome_candidato! 

							  <br><br> Data da Emissão: $data_cad
							 
							  <br><br> Ir Para o Painel do Candidato -> <a href='$url_painel_candidato' target='_blank'> Clique Aqui </a>
						
							  
		
							  <br><br>
							  Nome do Diretor: $nome_recrutador
							  Email: $email_recrutador
							
							  <br><br>
							  Nome do candidato: $nome_candidato
							  Email: $email_candidato
							 
							  
		
							  ";
		
		$remetente = $email_adm;
		$cabecalhos = 'MIME-Version: 1.0' . "\r\n";
		$cabecalhos .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
		$cabecalhos .= "From: " .$remetente;
		
		@mail($destinatario, $assunto, $mensagem, $cabecalhos);
		
		
		//envio para o administrador
		$destinatario = $email_adm;
		$assunto = 'Pedido de aprovacao da candidatura';
		
			$mensagem = "O Recrutador(a) $nome_recrutador , acaba de enviar um pedido de aprovação, da  candidatura referente ao Candidato(a) $nome_candidato,  para o Director (a) $nome_diretor 
	
			<br><br> Data do pedido: $data_cad

			<br><br> Verificar actividade -> <a href='$url_painel_candidato' target='_blank'> Clique Aqui </a>";
		
		$remetente = $email_adm;
		$cabecalhos = 'MIME-Version: 1.0' . "\r\n";
		$cabecalhos .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
		$cabecalhos .= "From: " .$remetente;
		
		@mail($destinatario, $assunto, $mensagem, $cabecalhos);
				
		
		
			
			?>