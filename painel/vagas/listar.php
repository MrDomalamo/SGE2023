<?php 
require_once("../../conexao.php");
$data_atual = date('Y-m-d');
@session_start();
$id_usuario = $_SESSION['id_usuario'];
$nivel_usuario = $_SESSION['nivel_usuario'];

$query3 = $pdo->query("SELECT * FROM usuarios where id = '$id_usuario'");
		$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res3) > 0){
			$id_funcionario = $res3[0]['id_func'];
		}else{
			$id_funcionario = ' ';
		}

	$query4 = $pdo->query("SELECT * FROM funcionarios where id = '$id_funcionario'");
		$res4 = $query4->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res4) > 0){
			$funcionario_direcao = $res4[0]['direcao'];
		}else{
			$funcionario_direcao = ' ';
		}		

echo <<<HTML
<small>
HTML;
if($nivel_usuario != 'Administrador'){
	$query = $pdo->query("SELECT * FROM vagas WHERE direcao = '$funcionario_direcao' ORDER BY id desc");
}

$query = $pdo->query("SELECT * FROM vagas ORDER BY id desc");

$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	echo <<<HTML
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Nome</th>
	<th class="esc">Departamento</th> 
	<th class="esc">Área</th> 	 
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody> 
HTML;
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
			$id = $res[$i]['id'];
		$nome = $res[$i]['nome'];
		$descricao = $res[$i]['descricao'];
		$direcao = $res[$i]['direcao'];
		$pelouro = $res[$i]['pelouro'];
		$descricao = str_replace('"',"**",$descricao);

		if($nivel_usuario == 'Candidato' || $nivel_usuario == 'Recrutador'){
			$editar_ususario = 'ocultar';
		}else{
			$editar_ususario = '';
		}
		if($nivel_usuario != 'Candidato'){
			$editar_user = 'ocultar';
		}else{
			$editar_user = '';
		}
		$query2 = $pdo->query("SELECT * FROM direcoes where id = '$direcao'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_direcao = $res2[0]['nome'];
		}else{
			$nome_direcao = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM pelouros where id = '$pelouro'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_pelouro = $res2[0]['nome'];
		}else{
			$nome_pelouro = 'Sem Registro';
		}

		echo <<<HTML
		<tr> 
		<td>
		{$nome}
		</td> 
		<td class="esc">{$nome_direcao}</td>
		<td class="esc">{$nome_pelouro}</td>
		<td>
		
	
		<big> <a class="$editar_ususario" href="#" onclick="editar('{$id}', '{$nome}', '{$descricao}', '{$direcao}', '{$pelouro}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>
		
		<big> <a class= "$editar_user" href="#" onclick="concorrer('{$id}', '{$nome}', '{$descricao}', '{$nome_direcao}', '{$nome_pelouro}')" title="Enviar"><i class="fa fa-paper-plane"></i></a></big> 

		<big><a href="#" onclick="mostrar('{$nome}', '{$descricao}', '{$nome_direcao}', '{$nome_pelouro}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>

		<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a class="$editar_ususario" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}', '{$nome}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
		</li>

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



	function editar(id, nome, descricao, direcao, pelouro){
		for(let letra of descricao){
			if(letra==='*'){
				descricao = descricao.replace('**','"');
	
			}
		}

		$('#id').val(id);
		$('#nome').val(nome);
		$('#descricao').val(descricao);
		// nicEditors.findEditor("descricao").setContent(descricao);
		$('#direcao').val(direcao).change();		
		$('#pelouro').val(pelouro);	
		$('#tituloModal').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#mensagem').text('');
	}

function concorrer(id, nome, descricao, direcao, pelouro){

	$('#id_concorrer').val(id);
	$('#nome_concorrer').text(nome);
	$('#descricao_concorrer').text(descricao);
	$('#direcao_concorrer').text(direcao);
	$('#pelouro_concorrer').text(pelouro);	
	$('#tituloModalConcorrer').text('Concorrer Vaga');
	$('#modalConcorrer').modal('show');
	$('#mensagemConcorrer').text('');
}

	function mostrar(nome, descricao, direcao, pelouro){

		
		$('#nome_mostrar').text(nome);
		$('#descricao_mostrar').html(descricao);
		$('#direcao_mostrar').text(direcao);
		$('#pelouro_mostrar').text(pelouro);
	

		$('#modalMostrar').modal('show');		
	}

	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');
		$('#descricao').val('');
		// nicEditors.findEditor("descricao").setContent('');
		$('#direcao').val('');
		$('#pelouro').val('');
	
	}


</script>



