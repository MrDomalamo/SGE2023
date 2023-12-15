<?php 
require_once("verificar.php");
require_once("../conexao.php");
$pag = 'usuarios';

//verificar se ele tem a permissão de estar nessa página
if(@$usuarios == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}

?>


<button onclick="inserir()" type="button" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Novo Administrador</button>

<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>




<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="tituloModal"></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-6">						
							<div class="form-group"> 
								<label>Nome</label> 
								<input type="text" class="form-control" name="nome" id="nome" required> 
							</div>						
						</div>	


						<div class="col-md-6">						
							<div class="form-group"> 
								<label>Email</label> 
								<input type="email" class="form-control" name="email" id="email" required> 
							</div>						
						</div>


					</div>



					<br>
					<input type="hidden" name="id" id="id"> 
					<small><div id="mensagem" align="center" class="mt-3"></div></small>					

				</div>


				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>



			</form>

		</div>
	</div>
</div>







<!-- Modal -->
<div class="modal fade" id="modalPermissoes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="nome-usuario"></h4>
				<button id="btn-fechar-permissoes" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<div class="modal-body">

				<div class="row" id="listar-permissoes">

				</div>

				<div class="row">	
					<div class="col-md-6">
						
					</div>	

					<div class="col-md-6">
						<input class="form-check-input" type="checkbox" id="input-todos" onchange="marcarTodos()">
						<label class="" >Marcar Todos</label>
					</div>	
				</div>	

				<br>
				<input type="hidden" name="id" id="id-usuario"> 
				<small><div id="mensagem-permissao" align="center" class="mt-3"></div></small>		

				

				


			</div>	


			

		</div>
	</div>
</div>



<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>


<script type="text/javascript">
	function listarPermissoes(id){
		$.ajax({
			url: pag + "/listar-permissoes.php",
			method: 'POST',
			data: {id},
			dataType: "html",

			success:function(result){
				$("#listar-permissoes").html(result);
				$('#mensagem-permissao').text('');
				//$('#input-todos').prop('checked', false);
			}
		});
	}


	function marcarTodos(){
		let checkbox = document.getElementById('input-todos');
		var usuario = $('#id-usuario').val();
		
		if(checkbox.checked) {
		    adicionarPermissoes(usuario);		    
		} else {
		    limparPermissoes(usuario);
		}
	}



	function adicionarPermissoes(id){
		$.ajax({
			url: pag + "/add-permissoes.php",
			method: 'POST',
			data: {id},
			dataType: "html",

			success:function(result){
				listarPermissoes(id)
			}
		});	
	}


	function limparPermissoes(id){
		$.ajax({
			url: pag + "/limpar-permissoes.php",
			method: 'POST',
			data: {id},
			dataType: "html",

			success:function(result){
				listarPermissoes(id)
			}
		});	
	}


	function adicionarPermissao(idpermissao, idusuario){
		
		$.ajax({
			url: pag + "/add-permissao.php",
			method: 'POST',
			data: {idpermissao, idusuario},
			dataType: "html",

			success:function(result){
				listarPermissoes(idusuario)
			}
		});	
	}

</script>