<?php 
require_once("verificar.php");
require_once("../conexao.php");



$data_atual = date('Y-m-d');
$mes_atual = Date('m');
$ano_atual = Date('Y');
$data_mes = $ano_atual."-".$mes_atual."-01";
$data_ano = $ano_atual."-01-01";

$nivel_usuario = $_SESSION['nivel_usuario'];

$id_usuario = @$_SESSION['id_usuario'];
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

if($nivel_usuario == 'Administrador'){
	$ocultar_campos = 'ocultar';
	$ocultar_configuracoes = '';
}else{
	$ocultar_campos = '';
	$ocultar_configuracoes = 'ocultar';
}
$query = $pdo->query("SELECT * FROM funcionarios WHERE id = '$id_func'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$provincia_func = $res[0]['bairro'];
	
}

$pagina_inicial = 'home';
if( @$_SESSION['nivel_usuario'] != 'Administrador'){
	require_once("verificar-permissoes.php");
}

if( @$_GET['pagina'] == ""){
	$pagina = $pagina_inicial;
}else{
	$pagina = @$_GET['pagina'];	
}


?>
<!DOCTYPE HTML>
<html>
<head>
	<title><?php echo $nome_sistema; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Sistema para venda de viaturas" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />

	<!-- Custom CSS -->
	<link href="css/style.css" rel='stylesheet' type='text/css' />

	<!-- font-awesome icons CSS -->
	<link href="css/font-awesome.css" rel="stylesheet"> 
	<!-- //font-awesome icons CSS-->

	<!-- side nav css file -->
	<link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>
	<!-- //side nav css file -->

	<link rel="stylesheet" href="css/monthly.css">

	<!-- js-->
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/modernizr.custom.js"></script>

	<!--webfonts-->
	<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
	<!--//webfonts--> 

	<!-- chart -->
	<script src="js/Chart.js"></script>
	<!-- //chart -->

	<!-- Metis Menu -->
	<script src="js/metisMenu.min.js"></script>
	<script src="js/custom.js"></script>
	<link href="css/custom.css" rel="stylesheet">

	<!--//Metis Menu -->

	<link rel="icon" href="images/MediaMais.png" type="image/x-icon">
	<style>
		#chartdiv {
			width: 100%;
			height: 295px;
		}
		.edm img{

			width: 90%;
			margin-top: -35px;
		}
	</style>
	<!--pie-chart --><!-- index page sales reviews visitors pie chart -->
	<script src="js/pie-chart.js" type="text/javascript"></script>
	<script type="text/javascript">

		$(document).ready(function () {
			$('#demo-pie-1').pieChart({
				barColor: '#ffc168',
				trackColor: '#eee',
				lineCap: 'round',
				lineWidth: 8,
				onStep: function (from, to, percent) {
					$(this.element).find('.pie-value').text(Math.round(percent) + '%');
				}
			});

			$('#demo-pie-2').pieChart({
				barColor: '#09872d',
				trackColor: '#eee',
				lineCap: 'butt',
				lineWidth: 8,
				onStep: function (from, to, percent) {
					$(this.element).find('.pie-value').text(Math.round(percent) + '%');
				}
			});

			$('#demo-pie-3').pieChart({
				barColor: '#de1024',
				trackColor: '#eee',
				lineCap: 'square',
				lineWidth: 8,
				onStep: function (from, to, percent) {
					$(this.element).find('.pie-value').text(Math.round(percent) + '%');
				}
			});


		});

	</script>
	<!-- //pie-chart --><!-- index page sales reviews visitors pie chart -->

	<!-- requried-jsfiles-for owl -->
	<link href="css/owl.carousel.css" rel="stylesheet">
	<script src="js/owl.carousel.js"></script>
	<script>
		$(document).ready(function() {
			$("#owl-demo").owlCarousel({
				items : 3,
				lazyLoad : true,
				autoPlay : true,
				pagination : true,
				nav:true,
			});
		});
	</script>
	<!-- //requried-jsfiles-for owl -->

	<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
	<script type="text/javascript" src="DataTables/datatables.min.js"></script>

	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
		<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
			<!--left-fixed -navigation-->
			<aside class="sidebar-left">
				<nav class="navbar navbar-inverse" style="overflow:  scrollbar-width: thin;">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<h1><a class="navbar-brand" href="./"><span class=""></span><i class="fa fa-graduation-cap" aria-hidden="true"></i> Sistema<span class="dashboard_text">De Gestão de Estágios</span></a></h1>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="sidebar-menu">
							<li class="header">MENU DE NAVEGAÇÃO</li>
							<li class="treeview <?php echo @$home ?>">
								<a href="./">
									<i class="fa fa-desktop" aria-hidden="true"></i> <span>Home</span>
								</a>
							</li>
							<li class="treeview <?php echo @$ocultar_configuracoes?> <?php echo @$menu_cadastros ?>">
								<a href="#">
									<i class="fa fa-exchange" aria-hidden="true"></i>
									<span>Configurações</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li class="<?php echo @$cargos ?>"><a href="index.php?pagina=cargos"><i class="fa fa-angle-right"></i> Cargos</a></li>
									<li class="<?php echo @$nivel_academico ?>"><a href="index.php?pagina=nivel_academico"><i class="fa fa-angle-right"></i> Nível Académico</a></li>

									<li class="<?php echo @$cidades ?>"><a href="index.php?pagina=cidades"><i class="fa fa-angle-right"></i> Cidades</a></li-->
									
									<li class="<?php echo @$pelouros?>"><a href="index.php?pagina=pelouros"><i class="fa fa-angle-right"></i> Área</a></li>

									<li class="<?php echo @$direcoes ?>"><a href="index.php?pagina=direcoes"><i class="fa fa-angle-right"></i> Departamentos</a></li>
									

									<li class="<?php echo @$cursos ?>"><a href="index.php?pagina=cursos"><i class="fa fa-angle-right"></i> Cursos</a></li>  
									<li class="<?php echo @$instituicoes ?>"><a href="index.php?pagina=instituicoes"><i class="fa fa-angle-right"></i> Instituições</a></li>
									<li class="<?php echo @$acessos ?>"><a href="index.php?pagina=acessos"><i class="fa fa-angle-right"></i> Acessos</a></li>
								</ul>
							</li>

							<li class="treeview <?php echo @$vaga ?>">
								<a href="index.php?pagina=vagas">
									<i class="fa fa-desktop" aria-hidden="true"></i> <span>Vagas</span>
								</a>
							</li>
							<li class="treeview <?php echo @$menu_candidaturas ?>">
								<a href="#">
									<i class="fa fa-download" aria-hidden="true"></i>
									<span>Candidaturas</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li class="<?php echo @$ocultar_campos?> <?php echo @$candidaturas ?>"><a href="index.php?pagina=candidaturas"><i class="fa fa-angle-right"></i> Pedidos</a></li>
		
									<li class="<?php echo @$candidaturas_candidato ?>"><a href="index.php?pagina=candidaturas_candidato"><i class="fa fa-angle-right"></i> Ver Candidaturas</a></li>


									<li class="<?php echo @$candidaturas_indeferidas ?>"><a href="index.php?pagina=candidaturas_indeferidas"><i class="fa fa-angle-right"></i> Indeferidas</a></li>

									<li class="<?php echo @$candidaturas_em_andamento ?>"><a href="index.php?pagina=candidaturas_em_andamento"><i class="fa fa-angle-right"></i> Em Curso</a></li>

									<li class="<?php echo @$candidaturas_concluidas ?>"><a href="index.php?pagina=candidaturas_concluidas"><i class="fa fa-angle-right"></i> Concluidas</a></li>

									<!--<li class="<?php echo @$candidaturas_inativas ?>"><a href="index.php?pagina=candidaturas_inativas"><i class="fa fa-angle-right"></i> Inativas</a></li>-->

								</ul>
							</li>
								
								
							  <li class="treeview <?php echo @$ocultar_campos?> <?php echo @$menu_perfil ?> " >
								<a href="#">
									<i class="fa fa-user" aria-hidden="true"></i>
									<span>Perfil</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">								
									
									<li class="<?php echo @$atualizar_candidato ?>"><a href="index.php?pagina=atualizar_candidato"><i class="fa fa-angle-right"></i> Atualizar Dados</a></li>

								</ul>
							</li>

							<li class="treeview <?php echo @$ocultar_campos?> <?php echo @$menu_recrutador ?>">
								<a href="#">
									<i class="fa fa-user"></i>
									<span>Atualizar Dados</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">								
									
									<li class="<?php echo @$atualizar_recrutador ?>"><a href="index.php?pagina=atualizar_recrutador"><i class="fa fa-angle-right"></i> Atualizar Recrutador</a></li>

								</ul>
							</li> 
							
							<li class="treeview <?php echo @$menu_pessoas ?>">
								<a href="#">
									<i class="fa fa-users" aria-hidden="true"></i>
									<span>Colaboradores</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">								
									<li class="<?php echo @$funcionarios ?>"><a href="index.php?pagina=funcionarios"><i class="fa fa-angle-right"></i> Recrutador</a></li>

									<li class="<?php echo @$candidatos ?>"><a href="index.php?pagina=candidatos"><i class="fa fa-angle-right"></i> Candidatos</a></li>

									
									<li class="<?php echo @$usuarios ?>"><a href="index.php?pagina=usuarios"><i class="fa fa-angle-right"></i> Usuários</a></li>

								</ul>
							</li>

							<li class="treeview <?php echo @$menu_meus_candidatos ?>">
								<a href="#">
									<i class="fa fa-user-plus"></i>
									<span>Candidatos</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">								
									
									<li class="<?php echo @$meus_candidatos ?>"><a href="index.php?pagina=meus_candidatos"><i class="fa fa-angle-right"></i> Ver candidatos</a></li>

								</ul>
							</li>



							
							<li class="treeview <?php echo @$menu_aprovacao ?>">
								<a href="#">
									<i class="fa fa-check-square-o"></i>
									<span>Aprovação</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
														
								 <ul class="treeview-menu">								
									
									<li class=" <?php echo @$ocultar_campos?> <?php echo @$pedir_aprovacao_candidatura ?>"><a  href="index.php?pagina=pedir_aprovacao_candidatura"><i class="fa fa-angle-right"></i> Solicitar Aprovação</a></li>

								</ul> 

								<ul class="treeview-menu">								
									
									<li class="<?php echo @$aprovar_candidatura ?>"><a href="index.php?pagina=aprovar_candidatura"><i class="fa fa-angle-right"></i> Aprovar Pedido</a></li>

								</ul>
							</li>

							<li class="treeview <?php echo @$menu_rel_sistema ?>">
								<a href="#">
									<i class="fa fa-file-pdf-o" aria-hidden="true"></i>
									<span>Relatórios PDF</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<!-- <li class="<?php echo @$rel_candidaturas ?>"><a href="#" data-toggle="modal" data-target="#RelCan"><i class="fa fa-angle-right"></i> Pedidos</a></li> -->

									

									<!-- <li class="<?php echo @$rel_cand_indeferidas ?>"><a href="#" data-toggle="modal" data-target="#RelCin"><i class="fa fa-angle-right"></i> Candidatura Indeferidas</a></li> -->

									<li class="<?php echo @$rel_cand_andamento ?>"><a href="#" data-toggle="modal" data-target="#RelCem"><i class="fa fa-angle-right"></i> Candidatura Em Curso</a></li>

									<li class="<?php echo @$rel_cand_concluidas ?>"><a href="#" data-toggle="modal" data-target="#RelCon"><i class="fa fa-angle-right"></i> Candidaturas Concluídas</a></li>

<!-- 
									<li class="<?php echo @$rel_funcionarios ?>"><a href="#" data-toggle="modal" data-target="#RelFun"><i class="fa fa-angle-right"></i> Funcionários</a></li>

									<li class="<?php echo @$rel_candidatos ?>"><a href="#" data-toggle="modal" data-target="#RelCad"><i class="fa fa-angle-right"></i> Candidatos</a></li>
									<li class="<?php echo @$rel_candidatosidade ?>"><a href="#" data-toggle="modal" data-target="#RelCadIdade"><i class="fa fa-angle-right"></i> Candidatos Por Idade</a></li>
									<li class="<?php echo @$rel_candidatosgenero ?>"><a href="#" data-toggle="modal" data-target="#RelCadGenero"><i class="fa fa-angle-right"></i> Candidatos Por Genero</a></li> -->

								</ul>
							</li>

							<li class="treeview <?php echo @$menu_rel_sistema_excel ?>">
								<a href="#">
									<i class="fa fa-file-excel-o" aria-hidden="true"></i>
									<span>Relatórios EXCEL</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<!--li class="<?php echo @$excel_excel_candidaturas ?>"><a href="excel/excel_candidaturas.php"><i class="fa fa-angle-right"></i> Pedidos</a></li-->


									<!-- <li class="<?php echo @$excel_excel_cand_indeferidas ?>"><a href="excel/excel_cand_indeferidas.php"><i class="fa fa-angle-right"></i> Candidaturas Indeferidas</a></li> -->

									<li class="<?php echo @$excel_excel_cand_andamento ?>"><a href="excel/excel_cand_andamento.php"><i class="fa fa-angle-right"></i> Candidaturas Em Curso</a></li>

									<li class="<?php echo @$excel_excel_cand_concluidas ?>"><a href="excel/excel_cand_concluidas.php"><i class="fa fa-angle-right"></i> Candidaturas Concluidas</a></li>


									<!-- <li class="<?php echo @$excel_excel_funcionarios ?>"><a href="excel/excel_funcionarios.php"><i class="fa fa-angle-right"></i> Funcionários</a></li>

									<li class="<?php echo @$excel_excel_candidatos ?>"><a href="excel/excel_candidatos.php"><i class="fa fa-angle-right"></i> Candidatos</a></li> -->



									

								</ul>
							</li>	
	




							


							


						</ul>
					</div>
					<!-- /.navbar-collapse -->
					
				</nav>
				<!-- <div class="edm">
						<img src="../img/loogo.png">
					</div> -->

			</aside>
		</div>
		<!--left-fixed -navigation-->

		<!-- header-starts -->
		<div class="sticky-header header-section ">
			<div class="header-left">
				<!--toggle button start-->
				<button id="showLeftPush"><i class="fa fa-bars"></i></button>
				<!--toggle button end-->
				<div class="profile_details_left"><!--notifications of menu start -->
					


						<div class="clearfix"> </div>
					</div>
					<!--notification menu end -->
					<div class="clearfix"> </div>
				</div>
				<div class="header-right">




					<div class="profile_details">		
						<ul>
							<li class="dropdown profile_details_drop">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<div class="profile_img">	
										<span class="prfil-img"><img src="images/perfil/<?php echo $foto_usu ?>" alt="" width="50px" height="50px"> </span> 
										<div class="user-name">
											<p><?php echo $nome_user ?></p>
											<span><?php echo $nivel_usu ?></span>
										</div>
										<i class="fa fa-angle-down lnr"></i>
										<i class="fa fa-angle-up lnr"></i>
										<div class="clearfix"></div>	
									</div>	
								</a>
								<ul class="dropdown-menu drp-mnu">

									<li> <a href="#" data-toggle="modal" data-target="#modalPerfil"><i class="fa fa-user"></i> Perfil</a> </li> 

									<li class="<?php echo @$configuracoes ?>"> <a href="#" data-toggle="modal" data-target="#modalConfig"><i class="fa fa-cog"></i> Configurações</a> </li> 

									<li> <a href="../logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="clearfix"> </div>				
				</div>
				<div class="clearfix"> </div>	
			</div>
			<!-- //header-ends -->




			<!-- main content start-->
			<div id="page-wrapper">
				<?php 					
				require_once($pagina.'.php');	
				?>
			</div>



			

		</div>

		<!-- new added graphs chart js-->

		<script src="js/Chart.bundle.js"></script>
		<script src="js/utils.js"></script>

		

		<!-- Classie --><!-- for toggle left push menu script -->
		<script src="js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
			showLeftPush = document.getElementById( 'showLeftPush' ),
			body = document.body;

			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};


			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
		<!-- //Classie --><!-- //for toggle left push menu script -->

		<!--scrolling js-->
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
		<!--//scrolling js-->

		<!-- side nav js -->
		<script src='js/SidebarNav.min.js' type='text/javascript'></script>
		<script>
			$('.sidebar-menu').SidebarNav()
		</script>
		<!-- //side nav js -->

		<!-- for index page weekly sales java script -->
		<script src="js/SimpleChart.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.js"> </script>
		<!-- //Bootstrap Core JavaScript -->

		<!-- Mascaras JS -->
		<script type="text/javascript" src="js/mascaras.js"></script>
		<!-- Ajax para funcionar Mascaras JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script> 

	</body>
	</html>




	<!-- Modal -->
	<div class="modal fade" id="modalPerfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLabel">Editar Dados</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="post" id="form-usu">
					<div class="modal-body">

						<div class="row">
							<div class="col-md-6">						
								<div class="form-group"> 
									<label>Nome</label> 
									<input type="text" class="form-control" name="nome_usu" value="<?php echo $nome_user ?>" required> 
								</div>						
							</div>
							<div class="col-md-6">
								<div class="form-group"> 
									<label>BI</label> 
									<input type="text" class="form-control" id="cpf_usu" name="cpf_usu" value="<?php echo $cpf_user ?>" required> 
								</div>
							</div>

						</div>


						<div class="row">
							<div class="col-md-6">						
								<div class="form-group"> 
									<label>Email</label> 
									<input type="email" class="form-control" name="email_usu" value="<?php echo $email_usu ?>" required> 
								</div>						
							</div>
							<div class="col-md-6">
								<div class="form-group"> 
									<label>Senha</label> 
									<input type="password" class="form-control" name="senha_usu" value="<?php echo $senha_usu ?>" required> 
								</div>
							</div>

						</div>	


						<div class="row">
							<div class="col-md-8">						
								<div class="form-group"> 
									<label>Foto</label> 
									<input type="file" name="foto" onChange="carregarImg2();" id="foto-usu">
								</div>						
							</div>
							<div class="col-md-4">
								<div id="divImg">
									<img src="images/perfil/<?php echo $foto_usu ?>"  width="100px" id="target-usu">									
								</div>
							</div>

						</div>

						<input type="hidden" name="id_usu" value="<?php echo $id_usuario ?>">
						<input type="hidden" name="foto_usu" value="<?php echo $foto_usu ?>">

						<small><div id="msg-usu" align="center" class="mt-3"></div></small>					

					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" id="editar-dados.php">Editar Dados</button>
					</div>
				</form>

			</div>
		</div>
	</div>


<!--======================= Modal Relatório Candidaturas Recrutador =======================-->
<div class="modal fade" id="RelCan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLabel">Candidatura
						<small >(
							<a href="#" onclick="datas('1980-01-01', 'tudo-Can', 'Can')">
								<span style="color:#000" id="tudo-Can">Tudo</span>
							</a> / 
							<a href="#" onclick="datas('<?php echo $data_atual ?>', 'hoje-Can', 'Can')">
								<span id="hoje-Can">Hoje</span>
							</a> /
							<a href="#" onclick="datas('<?php echo $data_mes ?>', 'mes-Can', 'Can')">
								<span style="color:#000" id="mes-Can">Mês</span>
							</a> /
							<a href="#" onclick="datas('<?php echo $data_ano ?>', 'ano-Can', 'Can')">
								<span style="color:#000" id="ano-Can">Ano</span>
							</a> 
						)</small>



					</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="post" action="rel/candidaturas_class.php" target="_blank">
					<div class="modal-body" >

						<div class="row">
							<div class="col-md-6">						
								<div class="form-group"> 
									<label>Data Inicial</label> 
									<input type="date" class="form-control" name="dataInicial" id="dataInicialRel-Can" value="<?php echo date('Y-m-d') ?>" required> 
								</div>						
							</div>
							<div class="col-md-6">
								<div class="form-group"> 
									<label>Data Final</label> 
									<input type="date" class="form-control" name="dataFinal" id="dataFinalRel-Can" value="<?php echo date('Y-m-d') ?>" required> 
								</div>
							</div>

						</div>


						<div class="row">
									<div class="col-md-6">						
										<div class="form-group"> 
											<label>GENERO</label> 
											<select class="form-control" name="genero"  style="width:100%;">
												<option value="">Todos</option>
												<option value="Masculino">MASCULINO</option>
												<option value="Feminino">FEMININO</option>
												<option value="Outro">OUTRO</option>
											</select> 
										</div>						
									</div> 	


						

						
								
										<div class="col-md-3">						
											<div class="form-group"> 
												<label>IDADE</label> 
												<select class="form-control" name="idade"  style="width:100%;">
													<option value="">Todas</option>
													<option value="18">18</option>
													<option value="19">19</option>
													<option value="20">20</option>
													<option value="21">21</option>
													<option value="22">22</option>
													<option value="23">23</option>
													<option value="24">24</option>
													<option value="25">25</option>
													<option value="26">26</option>
													<option value="27">27</option>
													<option value="28">28</option>
													<option value="29">29</option>
													<option value="30">30</option>
													<option value="31">31</option>
													<option value="32">32</option>
													<option value="33">33</option>
													<option value="34">34</option>
													<option value="35">35</option>
												</select> 
											</div>						
										</div>



						</div>	


					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Gerar Relatório</button>
					</div>
				</form>

			</div>
		</div>
	</div>

	<!--======================= Modal Relatório Candidaturas Candidatos  ======================-->
	<div class="modal fade" id="RelCnd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLabel">Candidaturas
						<small >(
							<a href="#" onclick="datas('1980-01-01', 'tudo-Cnd', 'Cnd')">
								<span style="color:#000" id="tudo-Cnd">Tudo</span>
							</a> / 
							<a href="#" onclick="datas('<?php echo $data_atual ?>', 'hoje-Cnd', 'Cnd')">
								<span id="hoje-Alu">Hoje</span>
							</a> /
							<a href="#" onclick="datas('<?php echo $data_mes ?>', 'mes-Cnd', 'Cnd')">
								<span style="color:#000" id="mes-Cnd">Mês</span>
							</a> /
							<a href="#" onclick="datas('<?php echo $data_ano ?>', 'ano-Cnd', 'Cnd')">
								<span style="color:#000" id="ano-Cnd">Ano</span>
							</a> 
						)</small>



					</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="post" action="rel/cand_candidatos_class.php" target="_blank">
					<div class="modal-body" >

						<div class="row" >
							<div class="col-md-6">						
								<div class="form-group"> 
									<label>Data Inicial</label> 
									<input type="date" class="form-control" name="dataInicial" id="dataInicialRel-Cnd" value="<?php echo date('Y-m-d') ?>" required> 
								</div>						
							</div>
							<div class="col-md-6">
								<div class="form-group"> 
									<label>Data Final</label> 
									<input type="date" class="form-control" name="dataFinal" id="dataFinalRel-Cnd" value="<?php echo date('Y-m-d') ?>" required> 
								</div>
							</div>

						</div>


						

					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Gerar Relatório</button>
					</div>
				</form>

			</div>
		</div>
	</div>

	<!--======================= Modal Relatório Candidaturas Indeferidas  =====================-->
	<div class="modal fade" id="RelCin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLabel">Candidaturas
						<small >(
							<a href="#" onclick="datas('1980-01-01', 'tudo-Alu', 'Cin')">
								<span style="color:#000" id="tudo-Cin">Tudo</span>
							</a> / 
							<a href="#" onclick="datas('<?php echo $data_atual ?>', 'hoje-Cin', 'Cin')">
								<span id="hoje-Cin">Hoje</span>
							</a> /
							<a href="#" onclick="datas('<?php echo $data_mes ?>', 'mes-Cin', 'Cin')">
								<span style="color:#000" id="mes-Cin">Mês</span>
							</a> /
							<a href="#" onclick="datas('<?php echo $data_ano ?>', 'ano-Cin', 'Cin')">
								<span style="color:#000" id="ano-Cin">Ano</span>
							</a> 
						)</small>



					</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="post" action="rel/cand_indeferidas_class.php" target="_blank">
					<div class="modal-body" >

						<div class="row" >
							<div class="col-md-6">						
								<div class="form-group"> 
									<label>Data Inicial</label> 
									<input type="date" class="form-control" name="dataInicial" id="dataInicialRel-Cin" value="<?php echo date('Y-m-d') ?>" required> 
								</div>						
							</div>
							<div class="col-md-6">
								<div class="form-group"> 
									<label>Data Final</label> 
									<input type="date" class="form-control" name="dataFinal" id="dataFinalRel-Cin" value="<?php echo date('Y-m-d') ?>" required> 
								</div>
							</div>

						</div>


						


					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Gerar Relatório</button>
					</div>
				</form>

			</div>
		</div>
	</div>

	<!--======================= Modal Relatório Candidaturas Em Curso  ====================-->
	<div class="modal fade" id="RelCem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLabel">Candidaturas
						<small >(
							<a href="#" onclick="datas('1980-01-01', 'tudo-Cem', 'Cem')">
								<span style="color:#000" id="tudo-Cem">Tudo</span>
							</a> / 
							<a href="#" onclick="datas('<?php echo $data_atual ?>', 'hoje-Cem', 'Cem')">
								<span id="hoje-Cem">Hoje</span>
							</a> /
							<a href="#" onclick="datas('<?php echo $data_mes ?>', 'mes-Cem', 'Cem')">
								<span style="color:#000" id="mes-Cem">Mês</span>
							</a> /
							<a href="#" onclick="datas('<?php echo $data_ano ?>', 'ano-Cem', 'Cem')">
								<span style="color:#000" id="ano-Cem">Ano</span>
							</a> 
						)</small>



					</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="post" action="rel/cand_andamento_class.php" target="_blank">
					<div class="modal-body" >

						<div class="row" >
							<div class="col-md-6">						
								<div class="form-group"> 
									<label>Data Inicial</label> 
									<input type="date" class="form-control" name="dataInicial" id="dataInicialRel-Cem" value="<?php echo date('Y-m-d') ?>" required> 
								</div>						
							</div>
							<div class="col-md-6">
								<div class="form-group"> 
									<label>Data Final</label> 
									<input type="date" class="form-control" name="dataFinal" id="dataFinalRel-Cem" value="<?php echo date('Y-m-d') ?>" required> 
								</div>
							</div>

						</div>



						<div class="row">
									<div class="col-md-6">						
										<div class="form-group"> 
											<label>GENERO</label> 
											<select class="form-control" name="genero"  style="width:100%;">
												<option value="">Todos</option>
												<option value="Masculino">MASCULINO</option>
												<option value="Feminino">FEMININO</option>
												<option value="OUTRO">OUTRO</option>
											</select> 
										</div>						
									</div> 	


									
									<div class="col-md-3">						
											<div class="form-group"> 
												<label>IDADE</label> 
												<select class="form-control" name="idade"  style="width:100%;">
													<option value="">Todas</option>
													<option value="18">18</option>
													<option value="19">19</option>
													<option value="20">20</option>
													<option value="21">21</option>
													<option value="22">22</option>
													<option value="23">23</option>
													<option value="24">24</option>
													<option value="25">25</option>
													<option value="26">26</option>
													<option value="27">27</option>
													<option value="28">28</option>
													<option value="29">29</option>
													<option value="30">30</option>
													<option value="31">31</option>
													<option value="32">32</option>
													<option value="33">33</option>
													<option value="34">34</option>
													<option value="35">35</option>
												</select> 
											</div>						
										</div>

						</div>

							

					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Gerar Relatório</button>
					</div>
				</form>

			</div>
		</div>
	</div>

	<!--======================= Modal Relatório Candidaturas Concluídas  ====================-->
	<div class="modal fade" id="RelCon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLabel">Candidaturas
						<small >(
							<a href="#" onclick="datas('1980-01-01', 'tudo-Con', 'Con')">
								<span style="color:#000" id="tudo-Con">Tudo</span>
							</a> / 
							<a href="#" onclick="datas('<?php echo $data_atual ?>', 'hoje-Con', 'Con')">
								<span id="hoje-Con">Hoje</span>
							</a> /
							<a href="#" onclick="datas('<?php echo $data_mes ?>', 'mes-Con', 'Con')">
								<span style="color:#000" id="mes-Con">Mês</span>
							</a> /
							<a href="#" onclick="datas('<?php echo $data_ano ?>', 'ano-Con', 'Con')">
								<span style="color:#000" id="ano-Con">Ano</span>
							</a> 
						)</small>



					</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="post" action="rel/cand_concluidas_class.php" target="_blank">
					<div class="modal-body" >

						<div class="row" >
							<div class="col-md-6">						
								<div class="form-group"> 
									<label>Data Inicial</label> 
									<input type="date" class="form-control" name="dataInicial" id="dataInicialRel-Con" value="<?php echo date('Y-m-d') ?>" required> 
								</div>						
							</div>
							<div class="col-md-6">
								<div class="form-group"> 
									<label>Data Final</label> 
									<input type="date" class="form-control" name="dataFinal" id="dataFinalRel-Con" value="<?php echo date('Y-m-d') ?>" required> 
								</div>
							</div>

						</div>


						<div class="row">
									<div class="col-md-6">						
										<div class="form-group"> 
											<label>GENERO</label> 
											<select class="form-control" name="genero"  style="width:100%;">
												<option value="">Todos</option>
												<option value="Masculino">MASCULINO</option>
												<option value="Feminino">FEMININO</option>
												<option value="Outro">OUTRO</option>
											</select> 
										</div>						
									</div> 	

									
									<div class="col-md-3">						
											<div class="form-group"> 
												<label>IDADE</label> 
												<select class="form-control" name="idade"  style="width:100%;">
													<option value="">Todas</option>
													<option value="18">18</option>
													<option value="19">19</option>
													<option value="20">20</option>
													<option value="21">21</option>
													<option value="22">22</option>
													<option value="23">23</option>
													<option value="24">24</option>
													<option value="25">25</option>
													<option value="26">26</option>
													<option value="27">27</option>
													<option value="28">28</option>
													<option value="29">29</option>
													<option value="30">30</option>
													<option value="31">31</option>
													<option value="32">32</option>
													<option value="33">33</option>
													<option value="34">34</option>
													<option value="35">35</option>
												</select> 
											</div>						
										</div>


						</div>


					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Gerar Relatório</button>
					</div>
				</form>

			</div>
		</div>
	</div>

	<!--======================= Modal Relatório Candidaturas INAtivas  ====================-->
	<div class="modal fade" id="RelCiv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLabel">Candidaturas Inativas
						<small >(
							<a href="#" onclick="datas('1980-01-01', 'tudo-Con', 'Con')">
								<span style="color:#000" id="tudo-Con">Tudo</span>
							</a> / 
							<a href="#" onclick="datas('<?php echo $data_atual ?>', 'hoje-Con', 'Con')">
								<span id="hoje-Con">Hoje</span>
							</a> /
							<a href="#" onclick="datas('<?php echo $data_mes ?>', 'mes-Con', 'Con')">
								<span style="color:#000" id="mes-Con">Mês</span>
							</a> /
							<a href="#" onclick="datas('<?php echo $data_ano ?>', 'ano-Con', 'Con')">
								<span style="color:#000" id="ano-Con">Ano</span>
							</a> 
						)</small>



					</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="post" action="rel/cand_inactivas_class.php" target="_blank">
					<div class="modal-body" >

						<div class="row" >
							<div class="col-md-6">						
								<div class="form-group"> 
									<label>Data Inicial</label> 
									<input type="date" class="form-control" name="dataInicial" id="dataInicialRel-Con" value="<?php echo date('Y-m-d') ?>" required> 
								</div>						
							</div>
							<div class="col-md-6">
								<div class="form-group"> 
									<label>Data Final</label> 
									<input type="date" class="form-control" name="dataFinal" id="dataFinalRel-Con" value="<?php echo date('Y-m-d') ?>" required> 
								</div>
							</div>

						</div>

					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Gerar Relatório</button>
					</div>
				</form>

			</div>
		</div>
	</div>



	<!--======================= Modal Relatório Funcionários  ====================-->
	<div class="modal fade" id="RelFun" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLabel">Funcionarios
						<small hidden="">(
							<a href="#" onclick="datas('1980-01-01', 'tudo-Fun', 'Fun')">
								<span style="color:#000" id="tudo-Fun">Tudo</span>
							</a> / 
							<a href="#" onclick="datas('<?php echo $data_atual ?>', 'hoje-Fun', 'Fun')">
								<span id="hoje-Fun">Hoje</span>
							</a> /
							<a href="#" onclick="datas('<?php echo $data_mes ?>', 'mes-Fun', 'Fun')">
								<span style="color:#000" id="mes-Fun">Mês</span>
							</a> /
							<a href="#" onclick="datas('<?php echo $data_ano ?>', 'ano-Fun', 'Fun')">
								<span style="color:#000" id="ano-Fun">Ano</span>
							</a> 
						)</small>



					</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="post" action="rel/funcionarios_class.php" target="_blank" >
					<div class="modal-body" >

						<div class="row" hidden="">
							<div class="col-md-6">						
								<div class="form-group"> 
									<label>Data Inicial</label> 
									<input type="date" class="form-control" name="dataInicial" id="dataInicialRel-Fun" value="<?php echo date('Y-m-d') ?>" required> 
								</div>						
							</div>
							<div class="col-md-6">
								<div class="form-group"> 
									<label>Data Final</label> 
									<input type="date" class="form-control" name="dataFinal" id="dataFinalRel-Fun" value="<?php echo date('Y-m-d') ?>" required> 
								</div>
							</div>

						</div>


						


					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Gerar Relatório</button>
					</div>
				</form>

			</div>
		</div>
	</div>

<!--======================= Modal Relatório Candidatos  ====================-->
<div class="modal fade" id="RelCad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLabel">Candidatos
						<small >(
							<a href="#" onclick="datas('1980-01-01', 'tudo-Cad', 'Cad')">
								<span style="color:#000" id="tudo-Cad">Tudo</span>
							</a> / 
							<a href="#" onclick="datas('<?php echo $data_atual ?>', 'hoje-Cad', 'Cad')">
								<span id="hoje-Cad">Hoje</span>
							</a> /
							<a href="#" onclick="datas('<?php echo $data_mes ?>', 'mes-Cad', 'Cad')">
								<span style="color:#000" id="mes-Cad">Mês</span>
							</a> /
							<a href="#" onclick="datas('<?php echo $data_ano ?>', 'ano-Cad', 'Cad')">
								<span style="color:#000" id="ano-Cad">Ano</span>
							</a> 
						)</small>



					</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="post" action="rel/candidatos_class.php" target="_blank">
					<div class="modal-body" >

								<div class="row" >
									<div class="col-md-6">						
										<div class="form-group"> 
											<label>Data Inicial</label> 
											<input type="date" class="form-control" name="dataInicial" id="dataInicialRel-Cad" value="<?php echo date('Y-m-d') ?>" required> 
										</div>						
									</div>
											<div class="col-md-6">
												<div class="form-group"> 
													<label>Data Final</label> 
													<input type="date" class="form-control" name="dataFinal" id="dataFinalRel-Cad" value="<?php echo date('Y-m-d') ?>" required> 
												</div>
											</div>

								</div>

								<div class="row">
									<div class="col-md-6">						
										<div class="form-group"> 
											<label>GENERO</label> 
											<select class="form-control" name="genero"  style="width:100%;">
												<!-- <option value="">Todos</option> -->
												<option value="Masculino">MASCULINO</option>
												<option value="Feminino">FEMININO</option>
												<<option value="Outro">OUTRO</option>>
											</select> 
										</div>						
									</div> 	


						</div>

					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Gerar Relatório</button>
					</div>
				</form>

			</div>
		</div>
	</div>

	<!--======================= Modal Relatório Candidatos  ====================-->
<div class="modal fade" id="RelCadIdade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLabel">Candidatos Por Idade
						<small >(
							<a href="#" onclick="datas('1980-01-01', 'tudo-CadIdade', 'CadIdade')">
								<span style="color:#000" id="tudo-CadIdade">Tudo</span>
							</a> / 
							<a href="#" onclick="datas('<?php echo $data_atual ?>', 'hoje-CadIdade', 'CadIdade')">
								<span id="hoje-CadIdade">Hoje</span>
							</a> /
							<a href="#" onclick="datas('<?php echo $data_mes ?>', 'mes-CadIdade', 'CadIdade')">
								<span style="color:#000" id="mes-CadIdade">Mês</span>
							</a> /
							<a href="#" onclick="datas('<?php echo $data_ano ?>', 'ano-CadIdade', 'CadIdade')">
								<span style="color:#000" id="ano-CadIdade">Ano</span>
							</a> 
						)</small>



					</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="post" action="rel/candidatosidade_class.php" target="_blank">
					<div class="modal-body" >

								<div class="row" >
									<div class="col-md-6">						
										<div class="form-group"> 
											<label>Data Inicial</label> 
											<input type="date" class="form-control" name="dataInicial" id="dataInicialRel-CadIdade" value="<?php echo date('Y-m-d') ?>" required> 
										</div>						
									</div>
											<div class="col-md-6">
												<div class="form-group"> 
													<label>Data Final</label> 
													<input type="date" class="form-control" name="dataFinal" id="dataFinalRel-CadIdade" value="<?php echo date('Y-m-d') ?>" required> 
												</div>
											</div>

								</div>


					
							

					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Gerar Relatório</button>
					</div>
				</form>

			</div>
		</div>
	</div>


	<!--======================= Modal Relatório Candidatos  ====================-->
<div class="modal fade" id="RelCadGenero" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header"> 
					<h4 class="modal-title" id="exampleModalLabel">Candidatos Por Genero
						<small >(
							<a href="#" onclick="datas('1980-01-01', 'tudo-CadGenero', 'CadGenero')">
								<span style="color:#000" id="tudo-Cad">Tudo</span>
							</a> / 
							<a href="#" onclick="datas('<?php echo $data_atual ?>', 'hoje-CadGenero', 'CadGenero')">
								<span id="hoje-CadGenero">Hoje</span>
							</a> /
							<a href="#" onclick="datas('<?php echo $data_mes ?>', 'mes-CadGenero', 'CadGenero')">
								<span style="color:#000" id="mes-CadGenero">Mês</span>
							</a> /
							<a href="#" onclick="datas('<?php echo $data_ano ?>', 'ano-CadGenero', 'CadGenero')">
								<span style="color:#000" id="ano-CadGenero">Ano</span>
							</a> 
						)</small>



					</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="post" action="rel/candidatosgenero_class.php" target="_blank">
					<div class="modal-body" >

								<div class="row" >
									<div class="col-md-6">						
										<div class="form-group"> 
											<label>Data Inicial</label> 
											<input type="date" class="form-control" name="dataInicial" id="dataInicialRel-CadGenero" value="<?php echo date('Y-m-d') ?>" required> 
										</div>						
									</div>
											<div class="col-md-6">
												<div class="form-group"> 
													<label>Data Final</label> 
													<input type="date" class="form-control" name="dataFinal" id="dataFinalRel-CadGenero" value="<?php echo date('Y-m-d') ?>" required> 
												</div>
											</div>

								</div>


					
							<div class="row">
									<div class="col-md-6">						
										<div class="form-group"> 
											<label>GENERO</label> 
											<select class="form-control" name="genero"  style="width:100%;">
												<!-- <option value="">Todos</option> -->
												<option value="Masculino">MASCULINO</option>
												<option value="Feminino">FEMININO</option>
												<option value="Outro">OUTRO</option>
											</select> 
										</div>						
									</div> 	


						</div>	


					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Gerar Relatório</button>
					</div>
				</form>

			</div>
		</div>
	</div>




	<!-- Modal CONFIG-->
	<div class="modal fade" id="modalConfig" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLabel">Configurações do SGDE</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="post" id="form-config">
					<div class="modal-body">

						<div class="row">
							<div class="col-md-3">						
								<div class="form-group"> 
									<label>Nome</label> 
									<input type="text" class="form-control" name="nome_config" value="<?php echo $nome_sistema ?>" required> 
								</div>						
							</div>
							<div class="col-md-3">						
								<div class="form-group"> 
									<label>Whatsapp</label> 
									<input type="text" class="form-control" name="tel_config" id="tel_config" value="<?php echo $tel_sistema ?>" > 
								</div>						
							</div>

							<div class="col-md-3">						
								<div class="form-group"> 
									<label>Telefone Fixo</label> 
									<input type="text" class="form-control" name="tel_fixo_config" id="tel_fixo_config" value="<?php echo $tel_fixo_sistema ?>" > 
								</div>						
							</div>

							<div class="col-md-3">						
								<div class="form-group"> 
									<label>Email</label> 
									<input type="email" class="form-control" name="email_config" value="<?php echo $email_adm ?>" required> 
								</div>						
							</div>

							

						</div>



						<div class="row">

						

							<div class="col-md-6">
								<div class="form-group"> 
									<label>Endereço</label> 
									<input type="text" class="form-control" name="end_config" value="<?php echo $end_sistema ?>" > 
								</div>
							</div>


								<div class="col-md-3">
								<div class="form-group"> 
									<label>Cidade</label> 
									<input type="text" class="form-control" name="cidade_config" value="<?php echo $cidade_imob ?>" > 
								</div>
							</div>


							<div class="col-md-3">						
								<div class="form-group"> 
									<label>Relatório PDF/HTML</label> 
									<select class="form-control" name="rel"  required> 
										<option <?php if($relatorio_pdf == 'pdf'){ ?>selected <?php } ?> value="pdf">PDF</option>
										<option <?php if($relatorio_pdf == 'html'){ ?>selected <?php } ?> value="html">HTML</option>
									</select>
								</div>						
							</div>

						</div>	

						<div class="row">
							<div class="col-md-2">						
								<div class="form-group"> 
									<label>Logo</label> 
									<input type="file" name="logo" onChange="carregarImgLogo();" id="foto-logo">
								</div>						
							</div>
							<div class="col-md-4">
								<div id="divImgLogo">
									<img src="../imagens/<?php echo $logo ?>"  width="100px" id="target-logo">									
								</div>
							</div>



							<div class="col-md-4">						
								<div class="form-group"> 
									<label>Favicon (ico)</label> 
									<input type="file" name="favicon" onChange="carregarImgFavicon();" id="foto-favicon">
								</div>						
							</div>
							<div class="col-md-2">
								<div id="divImgFavicon">
									<img src="../imagens/<?php echo $favicon ?>"  width="20px" id="target-favicon">									
								</div>
							</div>





						</div>
						

						<div class="row">

							<div class="col-md-3">						
								<div class="form-group"> 
									<label>Img Relatório (*jpg) 200x60</label> 
									<input type="file" name="imgRel" onChange="carregarImgRel();" id="foto-rel">
								</div>						
							</div>
							<div class="col-md-3">
								<div id="divImgRel">
									<img src="../imagens/<?php echo $logo_rel ?>"  width="100px" id="target-rel">									
								</div>
							</div>


							<div class="col-md-4">						
								<div class="form-group"> 
									<label>QRCode <small>(*jpg) Min 200x200</small></label> 
									<input type="file" name="imgQRCode" onChange="carregarImgQRCode();" id="foto-QRCode">
								</div>						
							</div>
							<div class="col-md-2">
								<div id="divImgQRCode">
									<img src="../imagens/<?php echo $qr_code_pix_imob ?>"  width="80px" id="target-QRCode">									
								</div>
							</div>

						</div>



						<small><div id="msg-config" align="center" class="mt-3"></div></small>					

					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Editar Dados</button>
					</div>
				</form>

			</div>
		</div>
	</div>




	<script type="text/javascript">
		$(document).ready(function() {
			$('.sel12').select2({
				dropdownParent: $('#RelCan')
			});	

			$('.sel13').select2({
				dropdownParent: $('#RelVen')
			});	

			
			$('.sel18').select2({
				dropdownParent: $('#RelCad')
			});

			$('.sel20').select2({
				dropdownParent: $('#RelCadIdade')
			});

			$('.sel21').select2({
				dropdownParent: $('#RelCadGenero')
			});

			$('.sel19').select2({
				dropdownParent: $('#RelCem')
			});		
		});
	</script>

	<script type="text/javascript">
		function datas(data, id, campo){		

			var data_atual = "<?=$data_atual?>";
			var separarData = data_atual.split("-");
			var mes = separarData[1];
			var ano = separarData[0];

			var separarId = id.split("-");

			if(separarId[0] == 'tudo'){
				data_atual = '2100-12-31';
			}

			if(separarId[0] == 'ano'){
				data_atual = ano + '-12-31';
			}

			if(separarId[0] == 'mes'){
				if(mes == 1 || mes == 3 || mes == 5 || mes == 7 || mes == 8 || mes == 10 || mes == 12){
					data_atual = ano + '-'+ mes + '-31';
				}else if (mes == 4 || mes == 6 || mes == 9 || mes == 11){
					data_atual = ano + '-'+ mes + '-30';
				}else{
					data_atual = ano + '-'+ mes + '-28';
				}

			}

			$('#dataInicialRel-'+campo).val(data);
			$('#dataFinalRel-'+campo).val(data_atual);

			document.getElementById('hoje-'+campo).style.color = "#000";
			document.getElementById('mes-'+campo).style.color = "#000";
			document.getElementById(id).style.color = "blue";	
			document.getElementById('tudo-'+campo).style.color = "#000";
			document.getElementById('ano-'+campo).style.color = "#000";
			document.getElementById(id).style.color = "blue";		
		}
	</script>


	<script type="text/javascript">
		function carregarImg2() {
			var target = document.getElementById('target-usu');
			var file = document.querySelector("#foto-usu").files[0];

			var reader = new FileReader();

			reader.onloadend = function () {
				target.src = reader.result;
			};

			if (file) {
				reader.readAsDataURL(file);

			} else {
				target.src = "";
			}
		}
	</script>



	<script type="text/javascript">
		$("#form-usu").submit(function () {

			event.preventDefault();
			var formData = new FormData(this);

			$.ajax({
				url: "editar-dados.php",
				type: 'POST',
				data: formData,

				success: function (mensagem) {
					$('#msg-usu').text('');
					$('#msg-usu').removeClass()
					if (mensagem.trim() == "Salvo com Sucesso") {					
						location.reload();
					} else {

						$('#msg-usu').addClass('text-danger')
						$('#msg-usu').text(mensagem)
					}


				},

				cache: false,
				contentType: false,
				processData: false,

			});

		});
	</script>



	<style type="text/css">
		.select2-selection__rendered {
			line-height: 36px !important;
			font-size:16px !important;
			color:#666666 !important;

		}

		.select2-selection {
			height: 36px !important;
			font-size:16px !important;
			color:#666666 !important;

		}
	</style>  




	<script type="text/javascript">
		function carregarImgLogo() {
			var target = document.getElementById('target-logo');
			var file = document.querySelector("#foto-logo").files[0];

			var reader = new FileReader();

			reader.onloadend = function () {
				target.src = reader.result;
			};

			if (file) {
				reader.readAsDataURL(file);

			} else {
				target.src = "";
			}
		}
	</script>




	<script type="text/javascript">
		function carregarImgFavicon() {
			var target = document.getElementById('target-favicon');
			var file = document.querySelector("#foto-favicon").files[0];

			var reader = new FileReader();

			reader.onloadend = function () {
				target.src = reader.result;
			};

			if (file) {
				reader.readAsDataURL(file);

			} else {
				target.src = "";
			}
		}
	</script>



	<script type="text/javascript">
		function carregarImgRel() {
			var target = document.getElementById('target-rel');
			var file = document.querySelector("#foto-rel").files[0];

			var reader = new FileReader();

			reader.onloadend = function () {
				target.src = reader.result;
			};

			if (file) {
				reader.readAsDataURL(file);

			} else {
				target.src = "";
			}
		}
	</script>



	<script type="text/javascript">
		function carregarImgQRCode() {
			var target = document.getElementById('target-QRCode');
			var file = document.querySelector("#foto-QRCode").files[0];

			var reader = new FileReader();

			reader.onloadend = function () {
				target.src = reader.result;
			};

			if (file) {
				reader.readAsDataURL(file);

			} else {
				target.src = "";
			}
		}
	</script>



	<script type="text/javascript">
		function carregarImgAssinatura() {
			var target = document.getElementById('target-assinatura');
			var file = document.querySelector("#foto-assinatura").files[0];

			var reader = new FileReader();

			reader.onloadend = function () {
				target.src = reader.result;
			};

			if (file) {
				reader.readAsDataURL(file);

			} else {
				target.src = "";
			}
		}
	</script>





	<script type="text/javascript">
		$("#form-config").submit(function () {

			event.preventDefault();
			var formData = new FormData(this);

			$.ajax({
				url: "editar-config.php",
				type: 'POST',
				data: formData,

				success: function (mensagem) {
					$('#msg-config').text('');
					$('#msg-config').removeClass()
					if (mensagem.trim() == "Salvo com Sucesso") {					
						location.reload();
					} else {

						$('#msg-config').addClass('text-danger')
						$('#msg-config').text(mensagem)
					}


				},

				cache: false,
				contentType: false,
				processData: false,

			});

		});
	</script>





