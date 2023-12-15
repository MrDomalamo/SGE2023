<?php 
require_once("../../conexao.php");
$data_atual = date('Y-m-d');
@session_start();
$id_usuario = $_SESSION['id_usuario'];
$nivel_usuario = $_SESSION['nivel_usuario'];
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
echo <<<HTML
<small>
HTML;
if($nivel_usuario == 'Recrutador'){
	$query = $pdo->query("SELECT * FROM funcionarios where id = '$id_func' ORDER BY id desc");
}else{
	$query = $pdo->query("SELECT * FROM funcionarios ORDER BY id desc");
}
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	echo <<<HTML
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Nome</th>
	<th class="esc">Telefone</th> 
	<th class="esc">Código</th> 
	<th class="esc">Email</th>
	<th class="esc">Cargo</th>	 
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody> 
HTML;
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
			$id = $res[$i]['id'];
		$nome = $res[$i]['nome'];
		$telefone = $res[$i]['telefone'];
		$cpf = $res[$i]['cpf'];
		$email = $res[$i]['email'];
		$endereco = $res[$i]['endereco'];
		$cargo = $res[$i]['cargo'];
		$data_admissao = $res[$i]['data_admissao'];
		$creci = $res[$i]['creci']; 
		$foto = $res[$i]['foto'];
		$ativo = $res[$i]['ativo'];
		$genero = $res[$i]['genero'];
		$cidade = $res[$i]['cidade'];
		$bairro = $res[$i]['bairro'];
		

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


	


		$data_admissaoF = implode('/', array_reverse(explode('-', $data_admissao)));

		$query2 = $pdo->query("SELECT * FROM cargos where id = '$cargo'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_cargo = $res2[0]['nome'];
		}else{
			$nome_cargo = 'Sem Cargo';
		}


		$query2 = $pdo->query("SELECT * FROM cidades where id = '$cidade'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_cidade = $res2[0]['nome'];
		}else{
			$nome_cidade = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM bairros where id = '$bairro'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_bairro = $res2[0]['nome'];
		}else{
			$nome_bairro = 'Sem Registro';
		}

		echo <<<HTML
		<tr class="{$classe_linha}"> 
		<td>
		<img src="images/perfil/{$foto}" width="27px" class="mr-2">
		{$nome}
		</td> 
		<td class="esc">{$telefone}</td>
		<td class="esc">{$cpf}</td>
		<td class="esc">{$email}</td>
		<td class="esc">{$nome_cargo}</td>
		<td>

		<big><a href="#" onclick="editar('{$id}', '{$nome}', '{$telefone}', '{$cpf}', '{$email}', '{$endereco}', '{$cargo}', '{$data_admissao}', '{$creci}', '{$foto}', '{$genero}', '{$cidade}', '{$bairro}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

		<big><a href="#" onclick="mostrar('{$nome}', '{$telefone}', '{$cpf}', '{$email}', '{$endereco}', '{$nome_cargo}', '{$data_admissaoF}', '{$creci}', '{$foto}', '{$genero}', '{$nome_cidade}', '{$nome_bairro}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>

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



	function editar(id, nome, telefone, cpf, email, endereco, cargo, data_admissao, creci, foto, genero, cidade, bairro){


		$('#id').val(id);
		$('#nome').val(nome);
		$('#telefone').val(telefone);
		$('#cpf').val(cpf);
		$('#email').val(email);
		$('#endereco').val(endereco);
		$('#cargo').val(cargo).change();
		$('#data_adm').val(data_admissao);
		$('#creci').val(creci);
		$('#genero').val(genero);	
		$('#foto').val('');
		$('#target').attr('src','images/perfil/' + foto);

		$('#cidade').val(cidade).change();

		
		$('#bairro').val(bairro);
		

		$('#tituloModal').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#mensagem').text('');
	}



	function mostrar(nome, telefone, cpf, email, endereco, cargo, data_admissao, creci, foto, genero, cidade, bairro){

		
		$('#nome_mostrar').text(nome);
		$('#cpf_mostrar').text(cpf);
		$('#telefone_mostrar').text(telefone);
		$('#email_mostrar').text(email);
		$('#endereco_mostrar').text(endereco);
		$('#cargo_mostrar').text(cargo);		
		$('#data_adm_mostrar').text(data_admissao);			
		
		$('#creci_mostrar').text(creci);
		$('#target_mostrar').attr('src','images/perfil/' + foto);	

		$('#genero_mostrar').text(genero);
		$('#cidade_mostrar').text(cidade);
		$('#bairro_mostrar').text(bairro);
	

		$('#modalMostrar').modal('show');		
	}

	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');
		$('#telefone').val('');
		$('#cpf').val('');
		$('#email').val('');
		$('#endereco').val('');
		$('#creci').val('');

		$('#data_adm').val('<?=$data_atual?>');
		$('#target').attr('src','images/perfil/sem-perfil.jpg');

		$('#genero').val('');
		$('#agencia').val('');

	
	}


	

</script>



