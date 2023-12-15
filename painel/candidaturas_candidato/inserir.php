<?php 
$tabela = 'candidaturas';
require_once("../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id_usuario'];
$nivel_usuario = $_SESSION['nivel_usuario'];

$candidato = $id_usuario;

$finalidade = $_POST['finalidade'];
$cidade = $_POST['cidade'];
$bairro = $_POST['bairro'];

$descricao = $_POST['descricao'];
$id = $_POST['id'];






$query = $pdo->query("SELECT * FROM usuarios where id = '$candidato'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$genero = $res[0]['genero'];
	$id_candidato = $res[0]['id_candidato'];
	$nome_candidato = $res[0]['nome'];

}

$query = $pdo->query("SELECT * FROM $tabela where candidato = '$candidato' and  (estado = 'Pendente' or estado = 'Em Curso') ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'Prezado, '. $nome_candidato. ' ja submeteu uma candidatura aguarde pela resposta ou a finalidade da candidatura!';
	exit();
}


$query = $pdo->query("SELECT * FROM candidatos where id = '$id_candidato'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$idade = $res[0]['idade'];
}
 
	if($id == ""){
		$query = $pdo->prepare("INSERT INTO $tabela SET candidato = '$candidato', recrutador = '0', finalidade = '$finalidade', bairro = '$bairro', cidade = '$cidade', direcoes = '0', pelouro = '0',data_cad = curDate(), estado = 'Pendente' ,arquivo = 'sem-foto.png', descricao =:descricao ,ativo = 'Sim', genero = '$genero', idade = '$idade' ");
		
	}else{
		$query = $pdo->prepare("UPDATE $tabela SET candidato = '$candidato', finalidade = '$finalidade', bairro = '$bairro', cidade = '$cidade', descricao = :descricao, genero = '$genero', idade = '$idade'  WHERE id = '$id'");
	}

	$query->bindValue(":descricao", "$descricao");
	$query->execute();

	  
	
echo 'Salvo com Sucesso'; 

$query = $pdo->query("SELECT * FROM usuarios where id = '$candidato'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$nome_candidato = $res[0]['nome'];
	$email_candidato = $res[0]['email'];
	$bairro_recrutador = $res[0]['bairro'];
	
}

$query = $pdo->query("SELECT * FROM cargos where nome = 'Recrutador'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$id_cargo_recrutador = $res[0]['id'];
	
}




$query = $pdo->query("SELECT * FROM funcionarios where bairro = '$bairro_recrutador' and cargo = '$id_cargo_recrutador' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$nome_funcionario = $res[0]['nome'];
	$email_funcionario = $res[0]['email'];
	
}else{
	$nome_funcionario = 'Sem registro!';
	$email_funcionario = 'Sem registro!';
}


$destinatario = $email_candidato;
$assunto = 'Submissao da sua candidatura no ' .$nome_sistema.'!';
$url_painel_candidato = $url_sistema.'';
$url_logo = $url_sistema.'/img/logoedm.png';
$mensagem = "

			  Olá $nome_candidato, 
			 <br><br>O seu pedido mereceu a nossa melhor atenção, por conseguinte informamos que submeteu a candidatura com sucesso! Dentro em breve iremos entrar em contacto, através do seu email, para dar o informe relativo ao seu pedido.

			  ";

$remetente = $email_adm;
$cabecalhos = 'MIME-Version: 1.0' . "\r\n";
$cabecalhos .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
$cabecalhos .= "From: " .$remetente;

@mail($destinatario, $assunto, $mensagem, $cabecalhos);



//Recrutador
$destinatario = $email_funcionario;
$assunto = 'Nova Submissao da Candidatura ';
$url_painel_candidato = $url_sistema.'';
$url_logo = $url_sistema.'/img/logoedm.png';

$mensagem = "

                      Prezado $nome_funcionario 
                      	<br><br>
                      Um novo candidato da sua provincia acaba de submeter a sua candidatura no $nome_sistema!

                      <br><br> Nome do Candidato: $nome_candidato 
					  <br><br> Email do Candidato: $email_candidato 
                     
                   
                      <br><br>
                      

                      ";

$remetente = $email_adm;
$cabecalhos = 'MIME-Version: 1.0' . "\r\n";
$cabecalhos .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
$cabecalhos .= "From: " .$remetente;

@mail($destinatario, $assunto, $mensagem, $cabecalhos);

 
//envio para o administrador
$destinatario = $email_adm;
$assunto = 'Submissao das candidaturas';

$mensagem = "O Senhor(a) $nome_candidato, submeteu a sua candidatura ";

$remetente = $email_adm;
$cabecalhos = 'MIME-Version: 1.0' . "\r\n";
$cabecalhos .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
$cabecalhos .= "From: " .$remetente;

@mail($destinatario, $assunto, $mensagem, $cabecalhos);
	
	?>