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
	$query = $pdo->query("SELECT * FROM candidaturas where candidato = '$id_usuario' ORDER BY id desc");
}else{
	$query = $pdo->query("SELECT * FROM candidaturas ORDER BY id desc");
}

$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	echo <<<HTML
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Nome</th>
	<th class="esc">Gênero</th>
	<th class="esc">Idade</th>
	<th class="esc">Telefone</th>
	<th class="esc">Curso</th>	  
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
		$vaga = $res[$i]['vagas'];
		$recrutador = $res[$i]['recrutador'];
		$finalidade = $res[$i]['finalidade'];
		$cidade = $res[$i]['cidade'];
		$bairro = $res[$i]['bairro'];
		$direcoes = $res[$i]['direcoes'];
		$pelouro = $res[$i]['pelouro'];
		$data_cad = $res[$i]['data_cad'];                                     
		$data_inicio = $res[$i]['data_inicio'];
		$data_final = $res[$i]['data_final'];
		$estado = $res[$i]['estado'];
		$descricao = $res[$i]['descricao'];
		$arquivo = $res[$i]['arquivo'];
		$ativo = $res[$i]['ativo'];
		$curso_candidato = $res[$i]['candidato'];
		$instituicoes_candidato = $res[$i]['candidato'];
		$idcandidato = $res[$i]['candidato'];
		$nivel_academico = $res[$i]['candidato'];

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



		$query2 = $pdo->query("SELECT * FROM usuarios where id = '$candidato'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$idcandidato = $res2[0]['id_candidato'];
		}else{
		
			// $nome_candidato = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM vagas where id = '$vaga'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_vaga = $res2[0]['nome'];
			$codigo_direcao = $res2[0]['direcao'];
			$codigo_pelouro = $res2[0]['pelouro'];
			$descricao_vaga= $res2[0]['descricao'];
		}else{
		
			$nome_vaga = ' ';
			$codigo_direcao = ' ';
			$codigo_pelouro = ' ';
			$descricao_vaga = ' ';

		}
		$query5 = $pdo->query("SELECT * FROM candidaturas where vagas = '$vaga' and candidato = '$id_usuario'");
		$res5 = $query5->fetchAll(PDO::FETCH_ASSOC);
		if($res5 >= 0 && $nivel_usuario == 'Candidato'){
			$editar_ususario = 'ocultar';
		}else{
			$editar_ususario = '';
		}
		
		$query2 = $pdo->query("SELECT * FROM pelouros where id = '$codigo_pelouro'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_pelouro_vagas = $res2[0]['nome'];

		}else{
		
			$nome_pelouro_vagas = ' ';

		}

		$query2 = $pdo->query("SELECT * FROM direcoes where id = '$codigo_direcao'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_direcao_vagas = $res2[0]['nome'];

		}else{
		
			$nome_direcao_vagas = ' ';

		}

		$query2 = $pdo->query("SELECT * FROM candidatos where id = '$idcandidato'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			 $nome_candidato = $res2[0]['nome'];
			 $genero_candidato = $res2[0]['genero'];
			 $curso_candidato = $res2[0]['curso'];
			 $instituicoes_candidato = $res2[0]['instituicoes'];
			 $telefone_candidato = $res2[0]['telefone'];
			 $email_candidato = $res2[0]['email'];
			 $idade_candidato = $res2[0]['idade'];
			 $nivel_academico = $res2[0]['nivel_academico'];
		}else{
			$telefone_candidato = 'Sem Registro';
			$nome_candidato = 'Sem Registro';
			$genero_candidato = 'Sem Registro';
			$email_candidato = 'Sem Registro';
			$idade_candidato = 'Sem Registro'; 
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

		$query2 = $pdo->query("SELECT * FROM usuarios where id = '$recrutador'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$idrecrutador = $res2[0]['id_func'];
		}else{
		
			// $nome_candidato = 'Sem Registro';
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

		$query2 = $pdo->query("SELECT * FROM direcoes where id = '$direcoes'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_direcoes = $res2[0]['nome'];
		}else{
			$nome_direcoes = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM pelouros where id = '$pelouro'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_pelouro = $res2[0]['nome'];
		}else{
			$nome_pelouro = 'Sem Registro';
		}

		$data_inicioF = implode('/', array_reverse(explode('-', $data_inicio)));
		$data_finalF = implode('/', array_reverse(explode('-', $data_final)));
		$data_cadF = implode('/', array_reverse(explode('-', $data_cad)));
		$descricao = str_replace('"', "**", $descricao);
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
		
/*if($nivel_usuario == 'Candidato'){
	$editar_ususario = 'ocultar';
}else{
	$editar_ususario = '';
}*/

		echo <<<HTML
		<tr class="{$classe_linha}"> 
		 <td>
		 <a href="images/arquivos/{$arquivo}" target="_blank"><img src="images/arquivos/{$tumb_arquivo}" width="18px" height="18px" title="Clique para baixar o arquivo"></a>
		{$nome_candidato}
		</td>
		<td class="esc">{$genero_candidato}</td>
		<td class="esc">{$idade_candidato}</td>
		<td class="esc">{$telefone_candidato}</td>
		<td class="esc">{$nome_curso}</td>                                        
		<td class="esc">{$estado}</td>
		<td>

													

	
 
<big><a class="$editar_ususario" href="#" onclick="editar('{$id}', '{$candidato}', '{$finalidade}', '{$bairro}', '{$cidade}','{$descricao}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

<big><a href="#" onclick="mostrar('{$nome_candidato}', '{$telefone_candidato}', '{$genero_candidato}', '{$idade_candidato}', '{$nome_curso}', '{$nome_instituicoes}' , '{$nome_nivel_academico}', '{$finalidade}' ,'{$nome_bairro}' ,'{$nome_cidade}'  ,'{$nome_direcoes}' ,'{$nome_pelouro}' , '{$data_cadF}', '{$data_inicioF}','{$data_finalF}' ,'{$estado}', '{$descricao}', 
'{$nome_vaga}', '{$nome_pelouro_vagas}', '{$nome_direcao_vagas}', '{$descricao_vaga}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>



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


function editar(id, candidato, finalidade, bairro, cidade, descricao){
	for(let letra of descricao){
		if(letra == '+'){
			descricao = descricao.replace('+ +', '\n')
		}
	}

$('#id').val(id);
$('#candidato').val(candidato).change();
$('#finalidade').val(finalidade).change();
$('#bairro').val(bairro).change();
$('#cidade').val(cidade).change();
$('#descricao').val(descricao);

$('#tituloModal').text('Editar Registro');
$('#modalForm').modal('show');
$('#mensagem').text('');
}


function mostrar(nome, telefone, genero, idade, curso, instituicoes, nivel_academico, finalidade, bairro, cidade, direcoes, pelouro, data_cad, data_inicio, data_final, estado, descricao, nome_vaga, nome_pelouro_vagas, nome_direcao_vagas, descricao_vaga){
	for(let letra of descricao){
		if(letra == '+'){
			descricao = descricao.replace('+ +', '\n')
		}
	}

$('#nome_mostrar').text(nome);
$('#telefone_mostrar').text(telefone);
$('#genero_mostrar').text(genero);
$('#idade_mostrar').text(idade);
$('#curso_mostrar').text(curso);
$('#instituicoes_mostrar').text(instituicoes);
$('#nivel_academico_mostrar').text(nivel_academico);
$('#finalidade_mostrar').text(finalidade);
$('#bairro_mostrar').text(bairro);
$('#cidade_mostrar').text(cidade);
$('#direcoes_mostrar').text(direcoes);
$('#pelouro_mostrar').text(pelouro);
$('#data_cad_mostrar').text(data_cad);			
$('#data_inicio_mostrar').text(data_inicio);
$('#data_final_mostrar').text(data_final);		
$('#estado_mostrar').text(estado);	
// $('#target_mostrar').attr('src','images/arquivos/' + arquivo);		
$('#descricao_mostrar_mostrar').text(descricao);
$('#nome_pelouro_vagas_mostrar').text(nome_pelouro_vagas);
$('#nome_vaga_mostrar').text(nome_vaga);
$('#nome_pelouro_vagas_mostrar').text(nome_pelouro_vagas); 
$('#nome_direcao_vagas_mostrar').text(nome_direcao_vagas); 
$('#modalMostrar').modal('show');	

}

function limparCampos(){
$('#id').val('');
$('#candidato').val(''); 
$('#finalidade').val('');
$('#bairro').val('');-+
$('#cidade').val('');
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




