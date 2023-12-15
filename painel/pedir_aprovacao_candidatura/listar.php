<?php 
require_once("../../conexao.php");
$data_atual = date('Y-m-d');
@session_start();
$id_usuario = $_SESSION['id_usuario'];
$nivel_usuario = $_SESSION['nivel_usuario'];
$nivel_academico = @$_SESSION['nivel_academico'];
$curso_candidato = @$_SESSION['curso_candidato'];
$instituicoes_candidato = @$_SESSION['instituicoes_candidato'];
$query = $pdo->query("SELECT * FROM usuarios WHERE id = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$nome_user = $res[0]['nome'];
	$foto_usu = $res[0]['foto'];
	$nivel_usu = $res[0]['nivel'];
	$cpf_usu = $res[0]['cpf']; 
	$cpf_user = $res[0]['cpf'];
	$senha_usu = $res[0]['senha'];
	$email_usu = $res[0]['email'];
	$id_usu = $res[0]['id'];
	$id_func = $res[0]['id_func'];
	$id_candidato = $res[0]['id_candidato'];
} 


$query = $pdo->query("SELECT * FROM usuarios WHERE id = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$id_recrutador = $res[0]['id_func'];
	
}


echo <<<HTML
<small>
HTML;
if($nivel_usuario == 'Recrutador' || $nivel_usu == 'Diretor'){
	$query = $pdo->query("SELECT * FROM aprovar_candidatura where recrutador = '$id_recrutador' ORDER BY id desc");
}else{
	$query = $pdo->query("SELECT * FROM aprovar_candidatura ORDER BY id desc");
}
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	echo <<<HTML
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Candidato</th>
	<th class="esc">Recrutador</th> 
	<th class="esc">Director</th> 
	<th class="esc">Estado</th> 
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody> 
HTML;
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
		$id = $res[$i]['id'];
		$candidato = $res[$i]['candidato'];
		$recrutador = $res[$i]['recrutador'];
		$diretor = $res[$i]['diretor'];
		$status = $res[$i]['status'];
		$data_cad = $res[$i]['data_cad'];                                     
		$data_aprovacao = $res[$i]['data_aprovacao'];
		$descricao = $res[$i]['descricao'];
		$arquivo = $res[$i]['arquivo'];
		$ativo = $res[$i]['ativo'];
		if($ativo == 'Sim'){
			$icone = 'fa-check-square';
			$titulo_link = 'Desativar Item';
			$acao = 'Não';
			$classe_linha = '';
		}else{
			$icone = 'fa-square-o';
			$titulo_link = 'Ativar Item';
			$acao = 'Sim';
			$classe_linha = 'text-muted';
		}




		// $query2 = $pdo->query("SELECT * FROM usuarios where id = '$candidato'");
		// $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		// if(@count($res2) > 0){
		// 	$idcandidato = $res2[0]['id'];
		// }else{
		
		// 	// $nome_candidato = 'Sem Registro';
		// }

		$query2 = $pdo->query("SELECT * FROM candidaturas where candidato = '$candidato'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$finalidade = $res2[0]['finalidade'];
		}else{
		
			$finalidade = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM candidatos where id = '$candidato'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			 $nome_candidato = $res2[0]['nome'];
			 $genero_candidato = $res2[0]['genero'];
			 $curso_candidato = $res2[0]['curso'];
			 $instituicoes_candidato = $res2[0]['instituicoes'];
			 $telefone_candidato = $res2[0]['telefone'];
			 $email_candidato = $res2[0]['email'];
			 $nivel_academico = $res2[0]['nivel_academico'];
		}else{
			$telefone_candidato = 'Sem Registro';
			$nome_candidato = 'Sem Registro';
			$genero_candidato = 'Sem Registro';
			$email_candidato = 'Sem Registro'; 
			$telefone_candidato = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM nivel_academico where id = '$nivel_academico'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_nivel_academico = $res2[0]['nome'];
		}else{
			$nome_nivel_academico = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM cursos where id = '$curso_candidato'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_curso = $res2[0]['nome'];
		}else{
			$nome_curso = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM instituicoes where id = '$instituicoes_candidato'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_instituicoes = $res2[0]['nome'];
		}else{
			$nome_instituicoes = 'Sem Registro';
		}

		// $query2 = $pdo->query("SELECT * FROM usuarios where id = '$recrutador'");
		// $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		// if(@count($res2) > 0){
		// 	$idrecrutador = $res2[0]['id_func'];
		// }else{
		
		// 	// $nome_candidato = 'Sem Registro';
		// }


		$query2 = $pdo->query("SELECT * FROM funcionarios where id = '$recrutador'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			 $nome_recrutador = $res2[0]['nome'];
			 $telefone_recrutador = $res2[0]['telefone'];
			 $email_recrutador = $res2[0]['email'];
		}else{
			$telefone_recrutador = 'Sem Registro';
			$nome_recrutador = 'Sem Registro';
			$email_recrutador = 'Sem Registro'; 
		}


		// $query3 = $pdo->query("SELECT * FROM usuarios where id = '$diretor'");
		// $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
		// if(@count($res3) > 0){
		// 	$iddiretor = $res3[0]['id'];
		// }else{
		
		// 	// $nome_candidato = 'Sem Registro';
		// }


		$query3 = $pdo->query("SELECT * FROM funcionarios where id = '$diretor'");
		$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res3) > 0){
			 $nome_diretor = $res3[0]['nome'];
			 $telefone_diretor = $res3[0]['telefone'];
			 $email_diretor = $res3[0]['email'];
		}else{
			$telefone_diretor = 'Sem Registro';
			$nome_diretor = 'Sem Registro';
			$email_diretor = 'Sem Registro'; 
		}




		$data_aprovacaoF = implode('/', array_reverse(explode('-', $data_aprovacao)));
		$data_cadF = implode('/', array_reverse(explode('-', $data_cad)));


		//extensão do arquivo
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
	
	
		

		echo <<<HTML
		<tr class="{$classe_linha}"> 
		 <td>
		 
		{$nome_candidato}
		</td> 
		<td class="esc">{$nome_recrutador}</td>
		<td class="esc">{$nome_diretor}</td>
		<td class="esc">{$status}</td>
		<td>

													

		<big><a href="#" onclick="editar('{$id}', '{$candidato}', '{$recrutador}', '{$diretor}', '{$status}', '{$data_aprovacao}', '{$descricao}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

		<big><a href="#" onclick="mostrar('{$nome_candidato}', '{$telefone_candidato}', '{$genero_candidato}', '{$nome_curso}', '{$nome_instituicoes}' , '{$nome_nivel_academico}', '{$finalidade}' ,'{$nome_recrutador}', '{$telefone_recrutador}' , '{$email_recrutador}' , '{$telefone_diretor}' , '{$email_diretor}'  , '{$nome_diretor}'  ,'{$status}' , '{$data_cadF}', '{$data_aprovacaoF}', '{$descricao}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>

		<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}', '{$nome_candidato}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
		</li>


		<!--<big><a href="#" onclick="ativar('{$id}', '{$nome_candidato}', '{$acao}')" title="{$titulo_link}"><i class="fa {$icone} text-success"></i></a></big>-->
		

		</td>  
		</tr> 
HTML;
	}
	echo <<<HTML
	</tbody> 
	<small><div align="center" id="mensagem-excluir"></div></small>
	</table>
	</small>
HTML;
}else{
	echo 'Não possui nenhum registro cadastrado!';
}

?>




<script type="text/javascript">


	$(document).ready( function () {
		$('#tabela').DataTable({
			"ordering": false,
			"stateSave": true,
		});
		$('#tabela_filter label input').focus();
	} );


	function editar(id, candidato, recrutador, diretor, status, data_aprovacao, descricao){


$('#id').val(id);
$('#candidato').val(candidato).change();
$('#recrutador').val(recrutador).change();
$('#diretor').val(diretor).change();
$('#status').val(status).change();
$('#data_aprovacao').val(data_aprovacao);
$('#descricao').val(descricao);

$('#tituloModal').text('Editar Registro');
$('#modalForm').modal('show');
$('#mensagem').text('');
}


	function mostrar(nome, telefone, genero, curso, instituicoes, nivel_academico, finalidade, recrutador, telefone_recrutador , email_recrutador , diretor, telefone_diretor , email_diretor , status, data_cad, data_aprovacao, descricao){
		
		$('#nome_mostrar').text(nome);
		$('#telefone_mostrar').text(telefone);
		$('#genero_mostrar').text(genero);
		$('#curso_mostrar').text(curso); 
		$('#instituicoes_mostrar').text(instituicoes);
		$('#nivel_academico_mostrar').text(nivel_academico);
		$('#finalidade_mostrar').text(finalidade);
		$('#recrutador_mostrar').text(recrutador);
		$('#telefone_recrutador_mostrar').text(telefone_recrutador);
		$('#email_recrutador_mostrar').text(email_recrutador);
		$('#diretor_mostrar').text(diretor);
		$('#telefone_diretor_mostrar').text(telefone_diretor);
		$('#email_diretor_mostrar').text(email_diretor);
		$('#status_mostrar').text(status);
		$('#data_cad_mostrar').text(data_cad);			
		$('#data_aprovacao_mostrar').text(data_aprovacao);		
		$('#descricao_mostrar').text(descricao);
		
		$('#modalMostrar').modal('show');	
	
	}

	function limparCampos(){
		$('#id').val('');
		$('#candidato').val(''); 
		$('#recrutador').val('');
		$('#finalidade').val('');
		$('#recrutador').val('');
		$('#diretor').val('');
		$('#status').val('');
		$('#data_aprovacao').val('<?=$data_atual?>');
		$('#target').attr('src','images/arquivos/sem-perfil.jpg');
		$('#descricao').val('');

	}


	function arquivo(id, nome){
    $('#id-arquivo').val(id);    
    $('#nome-arquivo').text(nome);
    $('#modalArquivos').modal('show');
    $('#mensagem-arquivo').text(''); 
    listarArquivos();   
}

</script>



