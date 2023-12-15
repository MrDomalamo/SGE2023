<?php 
$tabela = 'candidatos';
require_once("../../conexao.php");

$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$cpf = $_POST['cpf'];
$email = $_POST['email']; 
$data_nasc = $_POST['data_nasc'];
$idade = $_POST['idade'];
$endereco = $_POST['endereco'];
$nivel_academico = $_POST['nivel_academico'];
$id = $_POST['id'];
$genero = $_POST['genero'];
$cidade = $_POST['cidade'];
$bairro = $_POST['bairro'];
$instituicoes = $_POST['instituicoes'];
$estado_civil = $_POST['estado_civil'];
$nacionalidade = $_POST['nacionalidade'];
$curso= $_POST['curso'];

//validar cpf
$query = $pdo->query("SELECT * FROM $tabela where cpf = '$cpf'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'BI já Cadastrado, escolha Outro!';
	exit();
}

//validar email
$query = $pdo->query("SELECT * FROM $tabela where email = '$email'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'Email já Cadastrado, escolha Outro!';
	exit();
}


$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$foto = $res[0]['foto'];
}else{
	$foto = 'sem-perfil.jpg';
}


//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['foto']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);
$caminho = '../images/perfil/' .$nome_img;

$imagem_temp = @$_FILES['foto']['tmp_name']; 

if(@$_FILES['foto']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 

		if (@$_FILES['foto']['name'] != ""){

			//EXCLUO A FOTO ANTERIOR
			if($foto != "sem-perfil.jpg"){ 
				@unlink('images/perfil/'.$foto);
			}

			$foto = $nome_img;
		}

		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}

//recuperar o nome do cargo
$query2 = $pdo->query("SELECT * FROM cargos where nome = 'Candidato'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res2) > 0){
		$id_cargo = $res2[0]['id'];
	}





		$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, telefone = :telefone, cpf = :cpf, email = :email,nacionalidade =:nacionalidade , data_nasc = '$data_nasc' , idade =:idade, nivel_academico = '$nivel_academico', cargo = '$id_cargo',instituicoes = '$instituicoes', curso = '$curso' ,cidade = '$cidade', bairro = '$bairro' ,genero = '$genero' , endereco = :endereco, estado_civil = '$estado_civil' ,foto = '$foto', ativo = 'Sim' WHERE id = '$id'");
	
	$query->bindValue(":nome", "$nome");
	$query->bindValue(":telefone", "$telefone");
	$query->bindValue(":cpf", "$cpf");
	$query->bindValue(":email", "$email");
	$query->bindValue(":endereco", "$endereco");
	$query->bindValue(":idade", "$idade");
	$query->bindValue(":nacionalidade", "$nacionalidade");
	$query->execute();
	


$query2 = $pdo->query("SELECT * FROM cargos where id = '$id_cargo'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res2) > 0){
		$nome_cargo = $res2[0]['nome'];
	}
	
	//atualizar na tabela de usuários
		if(@$nome_cargo != ""){
			$query_usu = $pdo->prepare("UPDATE usuarios SET nome = :nome, cpf = :cpf,  email = :email ,genero = '$genero', nivel = '$nome_cargo',  foto = '$foto', idade = :idade, bairro = '$bairro' WHERE id_candidato = '$id'");
	
			if($query_usu != ""){
				$senha_crip = md5('123');
				$query_usu->bindValue(":nome", "$nome");
				$query_usu->bindValue(":email", "$email");
				$query_usu->bindValue(":cpf", "$cpf");	
				$query_usu->bindValue(":idade", "$idade");		
				$query_usu->execute();
			}
		}
	

	
	echo 'Salvo com Sucesso'; 
	
// Parte de mail, comeca aqui	
// $query = $pdo->query("SELECT * FROM usuarios where id = '$id'");
// $res = $query->fetchAll(PDO::FETCH_ASSOC);
// if(@count($res) > 0){
// 	$nome_candidato = $res[0]['nome'];
// 	$email_candidato = $res[0]['email'];
//     $senha_candidato = $res[0]['senha'];
// 	$id_candidato = $res[0]['id_candidato'];
	
// }

//$query = $pdo->query("SELECT * FROM candidatos where id = '$id'");
$query = $pdo->query("SELECT * FROM usuarios where id_candidato = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$bairro_candidato = $res[0]['bairro'];
	$nome_candidato = $res[0]['nome'];
	$email_candidato = $res[0]['email'];
    // $senha_candidato = $res[0]['senha'];
}else{
	$bairro_candidato = 0;
}

$query = $pdo->query("SELECT * FROM cargos where nome = 'Recrutador'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$cargo = $res[0]['id'];
	
}

$query = $pdo->query("SELECT * FROM bairros where id = '$bairro_candidato'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$nome_bairro_candidato = $res[0]['nome'];
	
}else{
	$nome_bairro_candidato = "Nenhum dado inserido!";
}

$query = $pdo->query("SELECT * FROM funcionarios where bairro = '$bairro_candidato' and cargo = '$cargo' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$nome_funcionario = $res[0]['nome'];
	$email_funcionario = $res[0]['email'];
	
}else{
	$nome_funcionario = 'Sem registro!';
	$email_funcionario = 'Sem registro!';
}







//Recrutador
$destinatario = $email_funcionario;
$assunto = 'Novo candidato na sua provincia ';
$url_painel_candidato = $url_sistema.'';
$url_logo = $url_sistema.'/img/logoedm.png';

$mensagem = "

                      Prezado $nome_funcionario 
                      	<br><br>
                      Um novo candidato da sua provincia acaba de se cadastrar no $nome_sistema!

                      <br><br> Nome do Candidato: $nome_candidato 
					  <br><br> Email do Candidato: $email_candidato 
                     
                   
                      <br><br>
                    
                      

                      ";

$remetente = $email_adm;
$cabecalhos = 'MIME-Version: 1.0' . "\r\n";
$cabecalhos .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
$cabecalhos .= "From: " .$remetente;

@mail($destinatario, $assunto, $mensagem, $cabecalhos);


//Candidato
$destinatario = $email_candidato;
$assunto = 'Atualizacao de dados no ' .$nome_sistema. '!';
$url_painel_candidato = $url_sistema.'';

$mensagem = "

                      Prezado $nome_candidato 
                      	<br><br>
                      Os seus dados foram atualizados com sucesso no  $nome_sistema!

                     

                      ";

$remetente = $email_adm;
$cabecalhos = 'MIME-Version: 1.0' . "\r\n";
$cabecalhos .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
$cabecalhos .= "From: " .$remetente;

@mail($destinatario, $assunto, $mensagem, $cabecalhos);


//Administrador

$destinatario = $email_adm;
$assunto = 'Atualizacao de dados no ' .$nome_sistema. '!';

$mensagem = "O Candidato $nome_candidato, acaba de atualizar os seus dados, e ele pertence a provincia de: $nome_bairro_candidato
			<br><br> Nome do Recrutador: $nome_candidato 
			<br><br> Email do Recrutador: $email_candidato 
			<br><br> Nome do Candidato: $nome_candidato 
			<br><br> Email do Candidato: $email_candidato ";

$remetente = $email_adm;
$cabecalhos = 'MIME-Version: 1.0' . "\r\n";
$cabecalhos .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
$cabecalhos .= "From: " .$remetente;

@mail($destinatario, $assunto, $mensagem, $cabecalhos);
//termina aqui

 ?>