<?php 
require_once("conexao.php");
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$conf_senha = $_POST['conf_senha'];
$senha_crip = md5($senha);



if($senha != $conf_senha){
	echo 'As senhas não se coincidem!!';
	exit();
} 




$query = $pdo->prepare("SELECT * FROM candidatos where email = :email");
$query->bindValue(":email", "$email");
$query->execute();
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	echo 'Este email já está cadastrado, escolha outro ou recupere sua senha!';
	exit();
}

$query = $pdo->prepare("INSERT INTO candidatos SET nome = :nome, email = :email, foto = 'sem-perfil.jpg', data_cadastro = curDate() , ativo = 'Sim' ");
$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email");
$query->execute();
$ult_id = $pdo->lastInsertId();

$query = $pdo->prepare("INSERT INTO usuarios SET nome = :nome,  email = :email, senha_crip = :senha_crip, senha = :senha  , nivel = 'Candidato',  foto = 'sem-perfil.jpg' , id_candidato = '$ult_id', ativo = 'Sim'");
$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email");
$query->bindValue(":senha", "$senha");
$query->bindValue(":senha_crip", "$senha_crip");
$query->execute();
$id_usu = $pdo->lastInsertId();
 

$query = $pdo->prepare("INSERT INTO usuarios_permissoes SET usuario = '$id_usu', permissao = '49' ");
$query->execute();
$query = $pdo->prepare("INSERT INTO usuarios_permissoes SET usuario = '$id_usu', permissao = '56' ");
$query->execute();
$query = $pdo->prepare("INSERT INTO usuarios_permissoes SET usuario = '$id_usu', permissao = '74' ");
$query->execute();
echo 'Cadastrado com Sucesso';



$query = $pdo->query("SELECT * FROM usuarios where id = '$id_usu'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$nome_candidato = $res[0]['nome'];
	$email_candidato = $res[0]['email'];
    $senha_candidato = $res[0]['senha'];
	
}



$destinatario = $email_candidato;
$assunto = 'Cadastro no ' .$nome_sistema.'!';
$url_painel_candidato = $url_sistema.'';
$url_logo = $url_sistema.'/img/logoedm.png';

$mensagem = "

                       Olá  $nome_candidato 
                      <br>Bem vindo a nossa plataforma de controle de estagiários.

                      <br><br>O seu cadastro no $nome_sistema foi aprovado, abaixo as suas credências:
                      <br> Seu email: $email_candidato
                      <br> Sua senha: $senha_candidato  
                      <br><br><b>Nota:</b>É necessário actualizar os dados antes de proceder com o pedido! 
                     
                    
                      

                      ";

$remetente = $email_adm;
$cabecalhos = 'MIME-Version: 1.0' . "\r\n";
$cabecalhos .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
$cabecalhos .= "From: " .$remetente;

@mail($destinatario, $assunto, $mensagem, $cabecalhos);




$destinatario = $email_adm;
$assunto = 'Novo Candidato no  Sistema';

$mensagem = "O Candidato $nome_candidato, registou-se com sucesso, email do candidato $email_candidato";

$remetente = $email_adm;
$cabecalhos = 'MIME-Version: 1.0' . "\r\n";
$cabecalhos .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
$cabecalhos .= "From: " .$remetente;

@mail($destinatario, $assunto, $mensagem, $cabecalhos);


 ?>
