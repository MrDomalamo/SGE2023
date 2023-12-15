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
if($nivel_usuario == 'Candidato'){
	$query = $pdo->query("SELECT * FROM candidatos where id = '$id_candidato' ORDER BY id desc");
}else{
	$query = $pdo->query("SELECT * FROM candidatos ORDER BY id desc");
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
	<th class="esc">BI</th> 
	<th class="esc">Email</th>
	<th class="esc">Instituição</th>	 
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
		$nivel_academico = $res[$i]['nivel_academico'];
		$data_nasc = $res[$i]['data_nasc'];
		$idade = $res[$i]['idade'];
		$data_cadastro = $res[$i]['data_cadastro'];
		$genero= $res[$i]['genero']; 
		$cidade = $res[$i]['cidade'];
		$bairro = $res[$i]['bairro'];
		$foto = $res[$i]['foto'];
		$instituicoes = $res[$i]['instituicoes'];
		$curso = $res[$i]['curso'];
		$cargo = $res[$i]['cargo'];
		$ativo = $res[$i]['ativo'];
		$estado_civil = $res[$i]['estado_civil'];
		$nacionalidade = $res[$i]['nacionalidade'];
		

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


	


		$data_nascF = implode('/', array_reverse(explode('-', $data_nasc)));
		$data_cadF = implode('/', array_reverse(explode('-', $data_cadastro)));

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

		$query2 = $pdo->query("SELECT * FROM cursos where id = '$curso'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_curso = $res2[0]['nome'];
		}else{
			$nome_curso = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM nivel_academico where id = '$nivel_academico'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_nivel_academico = $res2[0]['nome'];
		}else{
			$nome_nivel_academico = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM instituicoes where id = '$instituicoes'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_instituicoes = $res2[0]['nome'];
		}else{
			$nome_instituicoes = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM cargos where id = '$cargo'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_cargo = $res2[0]['nome'];
		}else{
			$nome_cargo = 'Sem Cargo';
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
		<td class="esc">{$nome_instituicoes}</td>
		<td>

		<big><a href="#" onclick="editar('{$id}', '{$nome}', '{$telefone}', '{$cpf}', '{$email}', '{$endereco}', '{$cargo}', '{$data_nasc}', '{$idade}', '{$nacionalidade}', '{$foto}', '{$genero}', '{$cidade}', '{$bairro}', '{$instituicoes}', '{$curso}', '{$estado_civil}', '{$nivel_academico}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

		<big><a href="#" onclick="mostrar('{$nome}', '{$telefone}', '{$cpf}', '{$email}', '{$endereco}', '{$nome_cargo}', '{$data_nascF}', '{$idade}', '{$data_cadF}' ,'{$nacionalidade}', '{$foto}', '{$genero}', '{$nome_cidade}', '{$nome_bairro}', '{$nome_curso}', '{$nome_instituicoes}', '{$estado_civil}', '{$nome_nivel_academico}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>

		<a href="#" onclick="arquivo('{$id}', '{$nome}')" title="Inserir / Ver Arquivos"><i class="fa fa-file-o " style="color:#22146e"></i></a>

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


	function editar(id, nome, telefone, cpf, email, endereco, cargo, data_nasc , idade, nacionalidade, foto,genero, cidade, bairro, instituicoes,curso, estado_civil, nivel_academico){


$('#id').val(id);
$('#nome').val(nome);
$('#telefone').val(telefone);
$('#cpf').val(cpf);
$('#email').val(email);
$('#endereco').val(endereco);
$('#cargo').val(cargo).change();
$('#data_nasc').val(data_nasc);
$('#idade').val(idade);
$('#nacionalidade').val(nacionalidade);
$('#foto').val('');
$('#target').attr('src','images/perfil/' + foto);
$('#genero').val(genero).change();
$('#cidade').val(cidade).change();
$('#bairro').val(bairro).change();
$('#instituicoes').val(instituicoes).change();
$('#curso').val(curso).change();
$('#estado_civil').val(estado_civil).change();	
$('#nivel_academico').val(nivel_academico).change();

$('#tituloModal').text('Editar Registro');
$('#modalForm').modal('show');
$('#mensagem').text('');
}



	function mostrar(nome, telefone, cpf, email, endereco, cargo, data_nasc, idade, data_cadastro, nacionalidade, foto, genero, cidade, bairro, instituicoes, curso, estado_civil, nivel_academico){

		
		$('#nome_mostrar').text(nome);
		$('#cpf_mostrar').text(cpf);
		$('#telefone_mostrar').text(telefone);
		$('#email_mostrar').text(email);
		$('#endereco_mostrar').text(endereco);
		$('#cargo_mostrar').text(cargo);		
		$('#data_adm_mostrar').text(data_nasc);
		$('#idade_mostrar').text(idade);	
		$('#data_cad_mostrar').text(data_cadastro);	
		$('#nacionalidade_mostrar').text(nacionalidade);			
		
		// $('#creci_mostrar').text(creci);
		$('#target_mostrar').attr('src','images/perfil/' + foto);	

		$('#genero_mostrar').text(genero);
		$('#cidade_mostrar').text(cidade);
		$('#bairro_mostrar').text(bairro);
		$('#instituicoes_mostrar').text(instituicoes);
		$('#curso_mostrar').text(curso);
		$('#estado_civil_mostrar').text(estado_civil);
		$('#nivel_academico_mostrar').text(nivel_academico);
	

		$('#modalMostrar').modal('show');		
	}

	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');
		$('#telefone').val('');
		$('#cpf').val('');
		$('#email').val('');
		$('#endereco').val('');
		$('#genero').val('');
		$('#cidade').val('');
		$('#bairro').val('');
		$('#perfil').val('');
		$('#curso').val('');
		$('#instituicoes').val('');
		$('#estado_civil').val('');
		$('#nivel_academico').val('');
		$('#data_nasc').val('<?=$data_atual?>');
		$('#idade').val('');
		$('#target').attr('src','images/perfil/sem-perfil.jpg');

		
	
	}


	function arquivo(id, nome){
    $('#id-arquivo').val(id);    
    $('#nome-arquivo').text(nome);
    $('#modalArquivos').modal('show');
    $('#mensagem-arquivo').text(''); 
    listarArquivos();   
}

</script>



