<?php 
require_once('conexao.php');
$senha = '123';
$senha_crip = md5($senha);

//CRIAR UM USUÁRIO ADMINISTRADOR CASO NÃO EXISTA NENHUM
$query = $pdo->query("SELECT * FROM usuarios WHERE nivel = 'Administrador'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg == 0){
	$pdo->query("INSERT INTO usuarios SET nome = 'Sistema de Gestao de Estágios', cpf='000.000.000-00', email='MediaMais@gmail.com', senha_crip='$senha_crip', senha='123', nivel='Administrador', foto = 'sem-perfil.jpg', id_func = '0',id_candidato = '0' ,ativo = 'Sim' ");
}


//inserir os cargos que geram níveis de usuários
$query = $pdo->query("SELECT * FROM cargos");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg == 0){	
	$pdo->query("INSERT INTO cargos SET nome = 'Candidato'");	
	$pdo->query("INSERT INTO cargos SET nome = 'Diretor'");
	$pdo->query("INSERT INTO cargos SET nome = 'Recrutador'");
}




?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de gestao dos estagiarios!">
		<meta name="author" content="Electricidade de Moçambique">
    <link rel="stylesheet" href="css/style.css">
    <title><?php echo $nome_sistema ?></title>

 
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="shortcut icon" href="img/MediaMais.png" type="image/x-icon">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
   <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">



	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    
</head>

<body style="background-color: #F5F5F5;">
    <header>
        <nav class="nav-bar">
            <div class="logo">
                <!-- <img src="<?php echo $url_sistema?>img/rel.png" width="185px" height="48px" class="d-inline-block align-top" alt=""> -->
            </div>
            
            <div class="login-buttonn">
                <button data-toggle="modal" data-target="#modalLogin"><a href="#" > <i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;&nbsp;Entrar / Registar</a></button>
            </div>

            
        </nav>
        
    </header>

    <div class="containerr">
                    
            <div class="cardd">
                <div class="imgBx">
                    <a class="navbar-brand" href="#"  >
    				<img src="<?php echo $url_sistema?>img/MediaMais.png"  width="100%" height="100%" alt="">
  </a>
                		<br><br>
                    <h5><b>Caro(a) Candidato(a)</b>  </h5>
                    </div>
                    <br>
                    <div class="cor">
                    <b><p  align="Justify">Para aceder ao sistema, introduza os seu dados de acesso. Caso não tenha uma conta, clicle no botão abaixo e se cadastre e de seguida efectur o seu login.
</br>
					</br>Para fins de candidatura às vagas de estágio, preencha os dados do seu perfil na íntegra, anexe a os documentos, acadêmicos assim como de identificação.</p>
                                
                        <p  align="Justify">Se o seu objetivo é coletar dados para fins académicos, selecione a opção correspondente e aguarde por uma resposta.</p>
                          <div class="nota">      
                        <p  align="Justify">Nota: Em todos os casos, é importante registar seu contacto telefónico, para que possamos contactá-lo quando necessário.
                        </p></div></b></div>            
                
            </div>
        
           <div class="login-buttonnn" style="text-align: center;">
                <button data-toggle="modal" data-target="#modalLogin"><a href="#" > <i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;&nbsp;Entrar / Registar</a></button>
            </div>
            
             
            
        </div>
    <footer class="footer">
     <div class="container">
        <div class="row">
            
            
            
            <div class="footer-col">
                <span><i class="fa fa-question-circle" aria-hidden="true"></i>&nbsp;Dúvidas / Apoio:</span>&nbsp;&nbsp;
                <span><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;<?php echo $tel_fixo_sistema ?></span>
                <span ><a href="mailto:atendimento@softdevweb.co.mz" style="color: white;"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp; E-mail: Mediamais@MediaMais.co.mz &nbsp;
		 	 </a> </span>

            </div>
        </div>
     </div>
  </footer>

    
</body>


</html>

<!-- Modal Cadastro -->
<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" >
	<div class="modal-dialog" role="document">
		<div class="modal-content" >
			<div class="modal-header" >
				<div class="foto" >
				<img src="<?php echo $url_sistema?>img/Mediamais.png" width="150px" height="150px"></div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="login100-form validate-form" action="autenticar.php" method="post" >
						
										<div class="form-outline mb-4" >
											<b ><span>Introduza as suas credencias</span></b>
											<input type="text" id="usuario" name="usuario" class="form-control form-control-lg"  placeholder="E-mail" required/>
											
										</div>

										<div class="form-outline mb-4" >
											
											<input type="password" id="senha" name="senha" class="form-control form-control-lg"  placeholder="Senha" required/>
											
										</div>



							<div class="container-login100-form-btn" >
								<div class="wrap-login100-form-btn">
								<div class="pt-1 mb-2" >
											<button class="btn  btn-lg btn-block" type="submit"  >Login</button>
										</div>

										<div class="recuperar">
										<span ><a href="" class="text-white" data-toggle="modal" data-target="#modalRecuperar">
								<b >Esqueceu da senha?</b> 
							</a></span>       
										
									</div>
									
								</div>
		

								<div class="pt-1 mb-2" >
											<button class="btn  btn-lg btn-block"   ><a  class="text" data-toggle="modal" data-target="#modalCadastro" ><span >Registar</span></a></button>
										</div>
							</div>

							

							
						</form>
		</div>
	</div>
</div>

<!-- Modal Cadastro -->
<div class="modal fade" id="modalCadastro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" >
	<div class="modal-dialog" role="document">
		<div class="modal-content" >
			<div class="modal-header" >
				<h5 class="modal-title" id="exampleModalLabel">REGISTO DE CREDENCIAS</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-cadastro">
			<div class="modal-body">
				
				
				
					<div class="form-group">
						<label for="exampleFormControlInput1"><small>Nome</small></label>
						<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome e Sobrenome" required>
					</div>

					<div class="form-group">
						<label for="exampleFormControlInput1"><small>E-mail</small></label>
						<input type="email" class="form-control" id="email_cadastro" name="email" placeholder="Seu E-mail" required>
					</div>

					<div class="row">
						<div class="form-group col-md-6">
							<label for="exampleFormControlInput1"><small>Senha</small></label>
							<input type="password" class="form-control" id="senha_cadastro" name="senha" required>
						</div>

						<div class="form-group col-md-6">
							<label for="exampleFormControlInput1"><small>Confirmar Senha</small></label>
							<input type="password" class="form-control" id="conf_senha" name="conf_senha" required>
						</div>					

					</div>

					<div class="form-check">
						<input type="checkbox" class="form-check-input" id="termos" name="termos" value="Sim" required>
						<label class="form-check-label" for="exampleCheck1"><small>Aceitar <a href="#" target="_blank">Termos e Condições</a> e <a href="#" target="_blank">Politíca de Privacidade</a></small></label>
					</div>					
				
				<br><small><div align="center" id="mensagem-cadastro"></div></small>	
			</div>
			<div class="modal-footer">       
				<button type="submit" data-toggle="modal" class="btn btn-primary" >Cadastrar</button>
			</div>
			</form>

			

						<div class="text-center p-t-8 p-b-31" >
							Já tem cadastro?

							<a href="" class="text-white" data-toggle="modal" data-target="#modalCadastro"><b >Entrar</b></a>

						</div>
		</div>
	</div>
</div>







<!-- Modal -->
<div class="modal fade" id="modalRecuperar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #096b63; color: white;">
        <h5 class="modal-title" id="exampleModalLabel">Recuperar Senha</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
					<span aria-hidden="true">&times;</span>
				</button>
      </div>
      <form id="form-recuperar" method="POST">
      <div class="modal-body">
        <input type="email" id="email" name="email" class="form-control form-control-sm" required placeholder="Digite seu email de Cadastro" />
        <br>
         <small><div align="center" id="mensagem"></div></small>
      </div>
      <div class="modal-footer">
       
        <button type="submit" class="btn btn-secondary" style="background-color: #096b63; border-color: rgb(9, 45, 130);">Recuperar</button>
      </div>
      </form>
    </div>

  </div>
</div>




<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


	<script type="text/javascript">
		$("#form-recuperar").submit(function () {

			event.preventDefault();
			var formData = new FormData(this);

			$.ajax({
				url: "recuperar.php",
				type: 'POST',
				data: formData,

				success: function (mensagem) {

					 $('#mensagem').removeClass()
					  $('#mensagem').addClass('text-info')
            			$('#mensagem').text("Enviando!!")

                    if(mensagem.trim() === 'Senha Enviada para o Email!'){
                        
                        $('#mensagem').addClass('text-success')                       
                       
                        $('#email').val('');                      
                      
                        $('#mensagem').text(mensagem)
                        //$('#btn-fechar').click();
                        //location.reload();


                   } else {

                        $('#mensagem').addClass('text-danger')
                        $('#mensagem').text(mensagem)
                       
                    }


				},

				cache: false,
				contentType: false,
				processData: false,

			});

		});
	</script>


<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->


 <script type="text/javascript">
	$("#form-cadastro").submit(function () {
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: "cadastro.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {
				$('#mensagem-cadastro').text('');
				$('#mensagem-cadastro').removeClass()
				if (mensagem.trim() == "Cadastrado com Sucesso") {
					//$('#btn-fechar-usu').click();
					$('#mensagem-cadastro').addClass('text-success')
					$('#mensagem-cadastro').text(mensagem)	
					$('#usuario').val($('#email_cadastro').val())
					$('#senha').val($('#senha_cadastro').val())				

				} else {

					$('#mensagem-cadastro').addClass('text-danger')
					$('#mensagem-cadastro').text(mensagem)
				}


			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});
</script>