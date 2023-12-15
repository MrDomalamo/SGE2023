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
$cargo = $_POST['cargo'];
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
$query2 = $pdo->query("SELECT * FROM cargos where id = '$cargo'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res2) > 0){
		$nome_cargo = $res2[0]['nome'];
	}




	if($id == ""){
		$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, telefone = :telefone, cpf = :cpf, email = :email, nacionalidade =:nacionalidade ,  endereco = :endereco, data_cadastro = curDate(), data_nasc = '$data_nasc' , idade =:idade, nivel_academico = '$nivel_academico', cargo = '$cargo',instituicoes = '$instituicoes', curso = '$curso' ,cidade = '$cidade', bairro = '$bairro' ,genero = '$genero' ,estado_civil = '$estado_civil' ,foto = '$foto', ativo = 'Sim' ");
	
	$query->bindValue(":nome", "$nome");
	$query->bindValue(":telefone", "$telefone");
	$query->bindValue(":cpf", "$cpf");
	$query->bindValue(":email", "$email");
	$query->bindValue(":endereco", "$endereco");
	$query->bindValue(":idade", "$idade");
	$query->bindValue(":nacionalidade", "$nacionalidade");
	$query->execute();
	$ult_id = $pdo->lastInsertId();
	
	
	//inserir o funcionário na tabela de usuários	
		if(@$nome_cargo != ""){
			$query_usu = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, cpf = :cpf,  email = :email, senha_crip = :senha_crip, senha = :senha ,genero = '$genero' , nivel = '$nome_cargo',  foto = '$foto' , id_candidato = '$ult_id', ativo = 'Sim', genero = '$genero', idade =:idade, bairro = '$bairro' ");
	
	
			$senha_crip = md5('123');
			$query_usu->bindValue(":nome", "$nome");
			$query_usu->bindValue(":email", "$email");
			$query_usu->bindValue(":cpf", "$cpf");
			$query_usu->bindValue(":senha_crip", "$senha_crip");
			$query_usu->bindValue(":senha", "123");	
			$query_usu->bindValue(":idade", "$idade");	
			$query_usu->execute();
		}
		
	}else{
		$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, telefone = :telefone, cpf = :cpf, email = :email,nacionalidade =:nacionalidade , data_nasc = '$data_nasc' , idade =:idade, nivel_academico = '$nivel_academico', cargo = '$cargo',instituicoes = '$instituicoes', curso = '$curso' ,cidade = '$cidade', bairro = '$bairro' ,genero = '$genero' , endereco = :endereco, estado_civil = '$estado_civil' ,foto = '$foto', ativo = 'Sim' WHERE id = '$id'");
	
	$query->bindValue(":nome", "$nome");
	$query->bindValue(":telefone", "$telefone");
	$query->bindValue(":cpf", "$cpf");
	$query->bindValue(":email", "$email");
	$query->bindValue(":endereco", "$endereco");
	$query->bindValue(":idade", "$idade");
	$query->bindValue(":nacionalidade", "$nacionalidade");
	$query->execute();
	
	
	//atualizar na tabela de usuários
		if(@$nome_cargo != ""){
			$query_usu = $pdo->prepare("UPDATE usuarios SET nome = :nome, cpf = :cpf,  email = :email ,genero = '$genero', idade =:idade, bairro = '$bairro', nivel = '$nome_cargo',  foto = '$foto' WHERE id_candidato = '$id'");
	
			if($query_usu != ""){
				$senha_crip = md5('123');
				$query_usu->bindValue(":nome", "$nome");
				$query_usu->bindValue(":email", "$email");
				$query_usu->bindValue(":cpf", "$cpf");
				$query_usu->bindValue(":idade", "$idade");			
				$query_usu->execute();
			}
		}
	
	}
	
	
	
	echo 'Salvo com Sucesso'; 
	
	?>