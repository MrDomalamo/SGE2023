<?php 
require_once("../../conexao.php");
$data_atual = date('Y-m-d');
@session_start();
$id_usuario = $_SESSION['id_usuario'];
$nivel_usuario = $_SESSION['nivel_usuario'];


echo <<<HTML
<small>
HTML;

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

		<big><a href="#" onclick="editar('{$id}', '{$nome}', '{$descricao}', '{$direcao}', '{$pelouro}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

		<big><a href="#" onclick="mostrar('{$nome}', '{$descricao}', '{$nome_direcao}', '{$nome_pelouro}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>

		<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

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


		$('#id').val(id);
		$('#nome').val(nome);
		$('#descricao').val(descricao);
		$('#direcao').val(direcao).change();		
		$('#pelouro').val(pelouro);	
		$('#tituloModal').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#mensagem').text('');
	}



	function mostrar(nome, descricao, direcao, pelouro){

		
		$('#nome_mostrar').text(nome);
		$('#descricao_mostrar').text(descricao);
		$('#direcao_mostrar').text(direcao);
		$('#pelouro_mostrar').text(pelouro);
	

		$('#modalMostrar').modal('show');		
	}

	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');
		$('#descricao').val('');
		$('#direcao').val('');
		$('#pelouro').val('');
	
	}


</script>



