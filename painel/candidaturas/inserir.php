<?php 
$tabela = 'candidaturas';
require_once("../../conexao.php");

$candidato = $_POST['candidato'];    
$recrutador = $_POST['recrutador'];
$finalidade = $_POST['finalidade'];
$cidade = $_POST['cidade'];
$bairro = $_POST['bairro'];
$direcoes = $_POST['direcoes'];
$pelouro = $_POST['pelouro'];
$data_inicio = $_POST['data_inicio']; 
$data_final = $_POST['data_final'];
$estado = $_POST['estado'];
$descricao = $_POST['descricao'];
$id = $_POST['id'];
 


$query = $pdo->query("SELECT * FROM arquivos where registro = 'Candidaturas' and id_reg = '$id' order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$arquivo = $res[0]['arquivo'];
	$nome_arquivo = $res[0]['nome'];
}else{
	$arquivo = 'sem-perfil.jpg';
	$nome_arquivo = 'Nenhum arquivo anexado';
}


$query = $pdo->query("SELECT * FROM usuarios where id = '$candidato'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$genero = $res[0]['genero'];
	$id_candidato = $res[0]['id_candidato'];
}

$query = $pdo->query("SELECT * FROM candidatos where id = '$id_candidato'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$idade = $res[0]['idade'];
}


	if($id == ""){
		$query = $pdo->prepare("INSERT INTO $tabela SET candidato = '$candidato', recrutador = '$recrutador', finalidade = '$finalidade', bairro = '$bairro', cidade = '$cidade', direcoes = '$direcoes', pelouro = '$pelouro',data_cad = curDate(), data_inicio = '$data_inicio', data_final = '$data_final', estado = '$estado' ,arquivo = '$arquivo', descricao =:descricao ,ativo = 'Sim', genero = '$genero', idade = '$idade' ");
		
	}else{
		$query = $pdo->prepare("UPDATE $tabela SET candidato = '$candidato', recrutador = '$recrutador', finalidade = '$finalidade', bairro = '$bairro', cidade = '$cidade', direcoes = '$direcoes', pelouro = '$pelouro', data_inicio = '$data_inicio', data_final = '$data_final', estado = '$estado' ,arquivo = '$arquivo', descricao = :descricao ,ativo = 'Sim', genero = '$genero', idade = '$idade' WHERE id = '$id'");
	    
	}

	
	
    	$query->bindValue(":descricao", "$descricao");
		$query->execute();

		
echo 'Salvo com Sucesso'; 

$query = $pdo->query("SELECT * FROM usuarios where id = '$candidato'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$nome_candidato = $res[0]['nome'];
	$email_candidato = $res[0]['email'];
	
} 
	
// echo $arquivo;
$ext = pathinfo($arquivo, PATHINFO_EXTENSION);
if($ext == 'pdf'){
	$tumb_arquivo = 'pdf.png';
}else if($ext == 'rar' || $ext == 'zip'){
	$tumb_arquivo = 'rar.png';
}else if($ext == 'doc' || $ext == 'docx' || $ext == 'txt'){
	$tumb_arquivo = 'word.png';
}else if($ext == 'xlsx' || $ext == 'xlsm' || $ext == 'xls'){
	$tumb_arquivo = 'excel.png';
}else if($ext == 'xml'){
	$tumb_arquivo = 'xml.png';
}else{
	$tumb_arquivo = $arquivo;
}
		
		
	
		$destinatario = $email_candidato;
		$assunto = 'Atualizacao da sua candidatura no ' .$nome_sistema.'!';
		$url_painel_candidato = $url_sistema.'';
		$url_logo = $url_sistema.'/img/logoedm.png';
		$url_doc = $url_sistema.'/painel/images/arquivos/Manual usuário para o aluno';
		$url_docc = $url_sistema.'/painel/images/arquivos/'. $tumb_arquivo. '';
		if($estado == 'Indeferido'){
		
		
				$mensagem = "
		
							  Prezado (a) $nome_candidato 
							  <br><br>Recebemos a informação de indisponibilidade de vagas na sua área de informação, por conseguinte lamentamos informar que não poderemos recebe-lo, podendo submeter o seu pedido numa outra oportunidade.
							  <br><br>Melhores Comprimentos!

							 
		
							  ";
		
		$remetente = $email_adm;
		$cabecalhos = 'MIME-Version: 1.0' . "\r\n";
		$cabecalhos .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
		$cabecalhos .= "From: " .$remetente;
		
		@mail($destinatario, $assunto, $mensagem, $cabecalhos);
		
		
		//envio para o administrador
		$destinatario = $email_adm;
		$assunto = 'Atualizacao das candidaturas';
		
			$mensagem = "O Senhor(a) $nome_candidato teve a sua candidatura dado como $estado";
		  
		
		$remetente = $email_adm;
		$cabecalhos = 'MIME-Version: 1.0' . "\r\n";
		$cabecalhos .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
		$cabecalhos .= "From: " .$remetente;
		
		@mail($destinatario, $assunto, $mensagem, $cabecalhos);
				
			}else if($estado == 'Em Curso'){
		
		
		$mensagem = "
		
							  Prezado (a) $nome_candidato 
							  <br><br>O seu pedido mereceu a nossa melhor atenção, por conseguinte informamos que foi APROVADO a vaga de estagiário. 
							  <br><br>Informamos ainda, que o estágio terá a duração de 3 meses e não será remunerado, sendo obrigatório possuir seguro provisório contra acidentes de trabalho.
							  <br>Melhores Cumprimentos!


							 
							
		
							 <br> Descricao do Arquivo: $nome_arquivo
							  <br> <a href='$url_doc' target='_blank'><img src='$url_docc' width='150px'></a><br>
		
							  ";
		
		$remetente = $email_adm;
		$cabecalhos = 'MIME-Version: 1.0' . "\r\n";
		$cabecalhos .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
		$cabecalhos .= "From: " .$remetente;
		
		@mail($destinatario, $assunto, $mensagem, $cabecalhos);
		
		
		//envio para o administrador
		$destinatario = $email_adm;
		$assunto = 'Atualizacao das candidaturas';
		
		$mensagem = "O Senhor(a) $nome_candidato teve a sua candidatura dado como $estado
		  <br> Descricao do Arquivo: $nome_arquivo
		   <br> <a href='$url_doc' target='_blank'><img src='$url_docc' width='150px'></a><br>";
		
		$remetente = $email_adm;
		$cabecalhos = 'MIME-Version: 1.0' . "\r\n";
		$cabecalhos .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
		$cabecalhos .= "From: " .$remetente;
		
		@mail($destinatario, $assunto, $mensagem, $cabecalhos);
				
			}else if($estado == 'Concluido'){
		
		
		
		$mensagem = "
		
							  Prezado (a) $nome_candidato 
							  <br><br>O seu estágio foi dado como $estado, desta forma agradecemos pela selecção da EDM para realização do mesmo. Sendo assim, desejamos-lhe êxitos na sua carreira profissional!
							 
		
							 <br> Descrição do Arquivo: $nome_arquivo
							  <br> <a href='$url_doc' target='_blank'><img src='$url_docc' width='150px'></a><br>
		
							 
							  ";
		
		$remetente = $email_adm;
		$cabecalhos = 'MIME-Version: 1.0' . "\r\n";
		$cabecalhos .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
		$cabecalhos .= "From: " .$remetente;
		
		@mail($destinatario, $assunto, $mensagem, $cabecalhos);
		
		
		//envio para o administrador
		$destinatario = $email_adm;
		$assunto = 'Atualizacao das candidaturas';
		
		$mensagem = "O Senhor(a) $nome_candidato teve a sua candidatura dado como $estado 
		  <br> Descricao do Arquivo: $nome_arquivo
		   <br> <a href='$url_doc' target='_blank'><img src='$url_docc' width='150px'></a><br>";
		
		$remetente = $email_adm;
		$cabecalhos = 'MIME-Version: 1.0' . "\r\n";
		$cabecalhos .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
		$cabecalhos .= "From: " .$remetente;
		
		@mail($destinatario, $assunto, $mensagem, $cabecalhos);
				
			}
		
		 
		
		
			
			?>