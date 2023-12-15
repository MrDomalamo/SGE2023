<?php 
require_once("../../conexao.php");
$data_atual = date('Y-m-d');
echo <<<HTML
<small>
HTML;
$query = $pdo->query("SELECT * FROM pedidos ORDER BY id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	echo <<<HTML
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Codigo</th>
	<th>Nome</th>
	<th class="esc">Telefone</th> 
	<th class="esc">Email</th>
	<th class="esc">Comentario</th> 
	<th class="esc">Status</th>
	<th class="esc">Data Cadastro</th> 	
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
		$email = $res[$i]['email'];
		$comentario = $res[$i]['comentario'];
		$data_cad = $res[$i]['data_cad'];
		$corretor = $res[$i]['corretor'];
		$imoveis = $res[$i]['imoveis'];
		$tipo = $res[$i]['tipo'];
		$url = $res[$i]['url'];
		$status = $res[$i]['status'];

        if($status == 'Pendente'){			
			$classe_linha = 'text-muted';
		}else{			
			$classe_linha = '';
		}
		

//retirar quebra de texto docomentario
$comentario = mb_strimwidth($comentario, 0, 40, "...");
$data_cadF = implode('/', array_reverse(explode('-', $data_cad)));
		
$query2 = $pdo->query("SELECT * FROM usuarios where id = '$corretor'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_corretor = $res2[0]['nome'];
		}else{
			$nome_corretor = 'Sem Registro';
		}


		$query2 = $pdo->query("SELECT * FROM tipos where id = '$tipo'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_tipo = $res2[0]['nome'];
		}else{
			$nome_tipo = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM imoveis where id = '$imoveis'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_emoveis = $res2[0]['titulo'];
		}else{
			$nome_imoveis = 'Sem Registro';
		}


		echo <<<HTML
		<tr class="{$classe_linha}"> 
		<td class="esc">{$id}</td> 
		<td class="esc">{$nome}</td> 
		<td class="esc">{$telefone}</td>
		<td class="esc">{$email}</td>
		<td class="esc">{$comentario}</td>
		<td class="esc">{$status}</td>
		<td class="esc">{$data_cadF}</td>
		<td>

		<big><a href="#" onclick="editar('{$id}', '{$nome}', '{$telefone}', '{$email}', '{$comentario}', '{$status}', '{$data_cad}', '{$corretor}', '{$imoveis}', '{$tipo}', '{$url}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

		<big><a href="#" onclick="mostrar('{$id}', '{$nome}', '{$telefone}', '{$email}', '{$comentario}', '{$status}', '{$data_cad}', '{$corretor}', '{$imoveis}', '{$tipo}', '{$url}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>

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



	function editar(id, nome, telefone, cpf, email, endereco, cargo, data_admissao,comentario, creci, foto, banco, tipo, agencia, conta, pix){


		for (let letra ofcomentario){  				
					if (letra === '+'){
						obs =comentario.replace(' +  + ', '\n')
					}			
				}

		$('#id').val(id);
		$('#nome').val(nome);
		$('#telefone').val(telefone);
		$('#cpf').val(cpf);
		$('#email').val(email);
		$('#endereco').val(endereco);
		$('#cargo').val(cargo).change();
		$('#data_adm').val(data_admissao);
		$('#obs').val(obs);
		$('#creci').val(creci);	
		$('#foto').val('');
		$('#target').attr('src','images/perfil/' + foto);

		$('#tipo').val(tipo).change();
		$('#banco').val(banco);
		$('#agencia').val(agencia);
		$('#conta').val(conta);
		$('#pix').val(pix);			

		$('#tituloModal').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#mensagem').text('');
	}



	function mostrar(nome, telefone, cpf, email, endereco, cargo, data_admissao,comentario, creci, foto, banco, tipo, agencia, conta, pix){

		for (let letra ofcomentario){  				
					if (letra === '+'){
						obs =comentario.replace(' +  + ', '\n')
					}			
				}
		
		$('#nome_mostrar').text(nome);
		$('#cpf_mostrar').text(cpf);
		$('#telefone_mostrar').text(telefone);
		$('#email_mostrar').text(email);
		$('#endereco_mostrar').text(endereco);
		$('#cargo_mostrar').text(cargo);		
		$('#data_adm_mostrar').text(data_admissao);			
		$('#obs_mostrar').text(obs);		
		$('#creci_mostrar').text(creci);
		$('#target_mostrar').attr('src','images/perfil/' + foto);	

		$('#banco_mostrar').text(banco);
		$('#agencia_mostrar').text(agencia);
		$('#tipo_mostrar').text(tipo);
		$('#conta_mostrar').text(conta);
		$('#pix_mostrar').text(pix);

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
		$('#obs').val('');
		$('#data_adm').val('<?=$data_atual?>');
		$('#target').attr('src','images/perfil/sem-perfil.jpg');

		$('#banco').val('');
		$('#agencia').val('');
		$('#tipo').val('');
		$('#conta').val('');
		$('#pix').val('');
	}


	

</script>