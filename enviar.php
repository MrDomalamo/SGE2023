<?php 
//envio para o candidato
@session_start();
$id_candidato = $_SESSION['id'];


$query = $pdo->query("SELECT * FROM usuarios where id = '$id_candidato'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$nome_candidato = $res[0]['nome']; 
	$email_candidato = $res[0]['usuario'];
    $senha_candidato = $res[0]['senha'];
	
}



$destinatario = $email_candidato;
$assunto = 'Cadastrodo no ' .$nome_sistema. ' com sucesso';
$url_painel_candidato = $url_sistema.'estagiario/sistema';
$url_logo = $url_sistema.'sistema/img/logo-email.png';

$mensagem = "

                      Olá  $nome_candidato 
                      <br>Bem vindo a nossa plataforma de controle de estagiários.

                      <br><br>O seu cadastro no $nome_sistema foi aprovado, abaixo as suas credências:
                      <br> Sua senha: $senha_candidato  
                      <br>atualizar os dados e fazer o seu devido pedido!! 
                     
                      <br><br> Ir Para o Painel do Candidato -> <a href='$url_painel_candidato' target='_blank'> Clique Aqui </a>

                      

                       <i>Plataforma - <a href='$url_sistema' target='_blank'>$url_sistema</a></i>
                      <br>
                      WhatsApp -> <a href='https://web.whatsapp.com/send?phone=258$tel_sistema' alt='$tel_sistema' target='_blank'><i class='fab fa-whatsapp'></i>$tel_sistema</a>

                      <br><br>
                    
                      

                      ";

$remetente = $email_adm;
$cabecalhos = 'MIME-Version: 1.0' . "\r\n";
$cabecalhos .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
$cabecalhos .= "From: " .$remetente;

@mail($destinatario, $assunto, $mensagem, $cabecalhos);






//envio para o administrador
$destinatario = $email_adm;
$assunto = 'Um novo candidato na Plataforma ' .$nome_candidato;

$mensagem = "Novo Candidato na Plataforma $nome_candidato!";

$remetente = $email_adm;
$cabecalhos = 'MIME-Version: 1.0' . "\r\n";
$cabecalhos .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
$cabecalhos .= "From: " .$remetente;

@mail($destinatario, $assunto, $mensagem, $cabecalhos);


 ?>


<!-- Atualizar Candidaturas-->
<!--


$query = $pdo->query("SELECT * FROM usuarios where id_candidato = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$nome_candidato = $res[0]['nome'];
	$email_candidato = $res[0]['email'];
	
}

$destinatario = $email_candidato;
$assunto = 'Atualizacao da candidatura na plataforma ' .$nome_sistema.' !';
$url_painel_candidato = $url_sistema.'estagiario/sistema';
$url_logo = $url_sistema.'sistema/img/logo-email.png';

$mensagem = "

                      Olá $nome_candidato, a sua candidatura foi atualizada na nossa plataforma $nome_sistema e foi dado como $estado! 
                     
                      <br><br> Ir Para o Painel do Candidato -> <a href='$url_painel_candidato' target='_blank'> Clique Aqui </a>

                      <a href='$url_sistema' target='_blank'><img src='$url_logo' width='300px'></a><br>

                       <i>A Nosso Plataforma - <a href='$url_sistema' target='_blank'>$url_sistema</a></i>
                      <br>
                      WhatsApp -> <a href='https://web.whatsapp.com/send?phone=258$tel_sistema' alt='$tel_sistema' target='_blank'><i class='fab fa-whatsapp'></i>$tel_sistema</a>

                      <br><br>
                    
                      

                      ";

$remetente = $email_adm;
$cabecalhos = 'MIME-Version: 1.0' . "\r\n";
$cabecalhos .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
$cabecalhos .= "From: " .$remetente;

@mail($destinatario, $assunto, $mensagem, $cabecalhos);






//envio para o administrador
$destinatario = $email_adm;
$assunto = 'Atualizacao da candidatura do Senhor/a ' .$nome_candidato;

$mensagem = "A candidatura do candidato $nome_candidato, foi dado como $estado";

$remetente = $email_adm;
$cabecalhos = 'MIME-Version: 1.0' . "\r\n";
$cabecalhos .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
$cabecalhos .= "From: " .$remetente;

@mail($destinatario, $assunto, $mensagem, $cabecalhos);


-->



$query = $pdo->prepare("INSERT INTO usuarios_permissoes SET usuario = "$id", permissao = '49' ");
$query = $pdo->prepare("INSERT INTO usuarios_permissoes SET usuario = "$id", permissao = '56' ");
$query = $pdo->prepare("INSERT INTO usuarios_permissoes  SET usuario = "$id", permissao = '57' ");

$query->execute();


aluno3@hotmail.comaluno3@hotmail.comaluno3@hotmail.com


 <!-- recrutador deve ver as candidaturas que foram direcionadas a sua provincia
	anexar ficheiro no envio de email

	diretor acesso

	
-->