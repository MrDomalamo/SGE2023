<?php 
require_once("verificar.php");
require_once("../conexao.php");
@session_start();
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


$query2 = $pdo->query("SELECT * FROM usuarios where id = '$id_candidato'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$id_candidato = $res2[0]['id_candidato'];
}else{

	// $nome_candidato = 'Sem Registro';
}

$query2 = $pdo->query("SELECT * FROM candidatos where id = '$id_candidato'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_candidato = $res2[0]['nome'];
}


//verificar se ele tem a permissão de estar nessa página
if(@$home == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}

$total_corretores = 0;
$total_compradores = 0;
$total_vendedores = 0;
$total_imoveis = 0;
$total_locatarios = 0;
$total_vagas = 0;



$total_pelouros = 0;
$total_direcoes = 0;
$total_cursos = 0;
$total_instituicoes = 0;
$total_candidatos = 0;
$total_candidatos_inderefidas = 0;
$total_candidatos_em_andamento = 0;
$total_candidatos_concluidas = 0;
$total_diretores = 0;
$total_candidaturas = 0;
$total_recrutadores = 0;
$total_candidato_genero_masculino = 0;
$total_candidato_genero_feminino = 0;



$totalTarefasHoje = 0;
$totalTarefasConcluidasHoje = 0;
$porcentagemTarefas = 0;
$total_pedidos = 0;

$saldoDia = 0;
$saldoCaixaDia = 0;
$saldoDiaF = 0;
$saldoCaixaDiaF = 0;
$classe_saldo_caixa_dia = 'fundo-verde';

$contasReceberVencidas = 0;
$contasPagarVencidas = 0;
$contasReceberHoje = 0;
$contasPagarHoje = 0;
$contasReceberPendentes = 0;
$totalContasPagasHoje = 0;
$totalContasRecebidasHoje = 0;
$porcentagemReceber = 0;
$porcentagemPagar = 0;
$totalContasPgHoje = 0;
$totalContasRbHoje = 0;

$total_itens_preenchidos = 5;
$total_itens_perfil = 19;
$porcentagemPerfil = 0;



$query = $pdo->query("SELECT * FROM usuarios WHERE nivel = 'Corretor' and ativo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_corretores = @count($res);

$query = $pdo->query("SELECT * FROM usuarios WHERE nivel = 'Recrutador' and ativo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_recrutadores = @count($res);

$query = $pdo->query("SELECT * FROM vagas");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_vagas = @count($res);

$query = $pdo->query("SELECT * FROM usuarios WHERE nivel = 'Diretor' and ativo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_diretores = @count($res);

$query = $pdo->query("SELECT * FROM usuarios WHERE nivel = 'Candidato' and ativo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_candidatos = @count($res);

$query = $pdo->query("SELECT * FROM usuarios WHERE nivel = 'Candidato' and genero = 'Masculino' and ativo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_candidato_genero_masculino = @count($res);

$query = $pdo->query("SELECT * FROM usuarios WHERE nivel = 'Candidato' and genero = 'Feminino' and ativo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_candidato_genero_feminino = @count($res);

$query = $pdo->query("SELECT * FROM cursos where ativo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_cursos = @count($res);

$query = $pdo->query("SELECT * FROM candidaturas where ativo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_candidaturas = @count($res);


$query = $pdo->query("SELECT * FROM instituicoes where ativo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_instituicoes = @count($res);

$query = $pdo->query("SELECT * FROM pelouros where ativo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_pelouros = @count($res);

$query = $pdo->query("SELECT * FROM direcoes where ativo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_direcoes = @count($res);


$query = $pdo->query("SELECT * FROM compradores");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_compradores = @count($res);


$query = $pdo->query("SELECT * FROM vendedores");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_vendedores = @count($res);

$query = $pdo->query("SELECT * FROM imoveis");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_imoveis = @count($res);

$query = $pdo->query("SELECT * FROM pedidos");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_pedidos = @count($res);

$query = $pdo->query("SELECT * FROM locatarios");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_locatarios = @count($res);


$query = $pdo->query("SELECT * FROM tarefas where data = curDate() and usuario = '$id_usu'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$totalTarefasHoje = @count($res);

$query = $pdo->query("SELECT * FROM tarefas where data = curDate() and usuario = '$id_usu' and status = 'Concluída'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$totalTarefasConcluidasHoje = @count($res);

if($totalTarefasConcluidasHoje > 0 and $totalTarefasHoje > 0){
	$porcentagemTarefas = ($totalTarefasConcluidasHoje / $totalTarefasHoje) * 100;
}



$query = $pdo->query("SELECT * FROM pagar where data_venc < curDate() and pago != 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contasPagarVencidas = @count($res);

$query = $pdo->query("SELECT * FROM receber where data_venc < curDate() and pago != 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contasReceberVencidas = @count($res);


$query = $pdo->query("SELECT * FROM pagar where data_venc = curDate() and pago != 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contasPagarHoje = @count($res);

$query = $pdo->query("SELECT * FROM receber where data_venc = curDate() and pago != 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contasReceberHoje = @count($res);


$query = $pdo->query("SELECT * FROM receber where pago != 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contasReceberPendentes = @count($res);


$query = $pdo->query("SELECT * FROM receber where data_venc = curDate() and pago = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$totalContasRecebidasHoje = @count($res);

$query = $pdo->query("SELECT * FROM pagar where data_venc = curDate() and pago = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$totalContasPagasHoje = @count($res);


$query = $pdo->query("SELECT * FROM receber where data_venc = curDate()");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$totalContasRbHoje = @count($res);

$query = $pdo->query("SELECT * FROM pagar where data_venc = curDate()");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$totalContasPgHoje = @count($res);

if($totalContasRecebidasHoje > 0 and $totalContasRbHoje > 0){
	$porcentagemReceber = ($totalContasRecebidasHoje / $totalContasRbHoje) * 100;
}


if($totalContasPagasHoje > 0 and $totalContasPgHoje > 0){
	$porcentagemPagar = ($totalContasPagasHoje / $totalContasPgHoje) * 100;
}


//TOTALIZAR SALDO DO DIA
$query_t = $pdo->query("SELECT * from movimentacoes where data = curDate()");
$res_t = $query_t->fetchAll(PDO::FETCH_ASSOC);
if(@count($res_t)>0){
	for($it=0; $it < @count($res_t); $it++){
		foreach ($res_t[$it] as $key => $value){}			

		if($res_t[$it]['tipo'] == 'Entrada'){
			$saldoDia += $res_t[$it]['valor'];
		}else{
			$saldoDia -= $res_t[$it]['valor'];
		}

		if($res_t[$it]['lancamento'] == 'Caixa'){
			if($res_t[$it]['tipo'] == 'Entrada'){
				$saldoCaixaDia += $res_t[$it]['valor'];
			}else{
				$saldoCaixaDia -= $res_t[$it]['valor'];
			}
		}
	}	

	if($saldoDia < 0){
		$classe_saldo_dia = 'fundo-vermelho';
	}else{
		$classe_saldo_dia = 'fundo-verde-escuro';
	}


	if($saldoCaixaDia < 0){
		$classe_saldo_caixa_dia = 'fundo-vermelho';
	}else{
		$classe_saldo_caixa_dia = 'fundo-verde-claro';
	}

	$saldoDiaF = number_format($saldoDia, 2, ',', '.');
	$saldoCaixaDiaF = number_format($saldoCaixaDia, 2, ',', '.');
}






// $query = $pdo->query("SELECT * FROM candidatos where id = '$id_candidato' ");
// 		$res = $query->fetchAll(PDO::FETCH_ASSOC);

// 		if($res[0]['cpf'] != ""){
// 			$total_itens_preenchidos += 1;
// 		}

// 		if($res[0]['telefone'] != ""){
// 			$total_itens_preenchidos += 1;
// 		}

// 		if($res[0]['endereco'] != ""){
// 			$total_itens_preenchidos += 1;
// 		}

// 		if($res[0]['cidade'] != ""){
// 			$total_itens_preenchidos += 1;
// 		}

// 		if($res[0]['bairro'] != ""){
// 			$total_itens_preenchidos += 1;
// 		}

// 		if($res[0]['genero'] != ""){
// 			$total_itens_preenchidos += 1;
// 		}

// 		if($res[0]['data_nasc'] != ""){
// 			$total_itens_preenchidos += 1;
// 		}

// 		if($res[0]['cargo'] != ""){
// 			$total_itens_preenchidos += 1;
// 		}

// 		if($res[0]['instituicoes'] != ""){
// 			$total_itens_preenchidos += 1;
// 		}

// 		if($res[0]['curso'] != ""){
// 			$total_itens_preenchidos += 1;
// 		}

// 		if($res[0]['nivel_academico'] != ""){
// 			$total_itens_preenchidos += 1;
// 		}

// 		if($res[0]['nacionalidade'] != ""){
// 			$total_itens_preenchidos += 1;
// 		}

// 		if($res[0]['estado_civil'] != ""){
// 			$total_itens_preenchidos += 1;
// 		}

// 		if($res[0]['foto'] != "sem-perfil.jpg"){
// 			$total_itens_preenchidos += 1;
// 		}


// 		$porcentagemPerfil = ($total_itens_preenchidos / $total_itens_perfil) * 100;
// 		if($porcentagemPerfil < 100){
// 			$cor_porcent = 'demo-pie-3';
// 		}else{
// 			$cor_porcent = 'demo-pie-1';
// 		}

// 		$porcentagemPerfilF = round($porcentagemPerfil, 2);
	

		





$total_entradas_grafico = '';
$total_saidas_grafico = '';
//alimentar o gráfico de barras
for($i=1; $i <= 12; $i++){
	
	if($i < 10){
		$data_mes_atual = $ano_atual.'-0'.$i.'-01';
		$data_mes_final = $ano_atual.'-0'.$i.'-31';
	}else{
		$data_mes_atual = $ano_atual.'-'.$i.'-01';
		$data_mes_final = $ano_atual.'-'.$i.'-31';
	}

	$total_entradas = 0;
	$total_saidas = 0;

	$query_t = $pdo->query("SELECT * from movimentacoes where data >= '$data_mes_atual' and data <= '$data_mes_final'");
	$res_t = $query_t->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res_t)>0){
		for($it=0; $it < @count($res_t); $it++){
			foreach ($res_t[$it] as $key => $value){}			

			if($res_t[$it]['tipo'] == 'Entrada'){
				$total_entradas += $res_t[$it]['valor'];
			}else{
				$total_saidas += $res_t[$it]['valor'];
			}

		}
	}

	$total_entradas_grafico = $total_entradas_grafico. @$total_entradas . '-';
	$total_saidas_grafico = $total_saidas_grafico. @$total_saidas . '-';

}
 ?>



<input type="hidden" value="<?php echo $data_dias ?>" id="valor_coluna">
<input type="hidden" value="<?php echo $valor_pagar_dia ?>" id="valor_pagar_dia">
<input type="hidden" value="<?php echo $valor_receber_dia ?>" id="valor_receber_dia">

<input type="hidden" value="<?php echo $total_entradas_grafico ?>" id="total_entradas_grafico">
<input type="hidden" value="<?php echo $total_saidas_grafico ?>" id="total_saidas_grafico">

<div class="main-page">
			<div class="col_3">
							
			<a href="#">	
        	<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                    <i class="pull-left fa fa-desktop user01 icon-rounded"></i>
                    <div class="stats">
                      <h5><strong><?php echo @$total_vagas ?></strong></h5>
                      <span>Vagas</span>
                    </div>
                </div>
        	</div>
        	</a> 

        	<a href="#">
        	<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                    <i class="pull-left fa fa-user user1 icon-rounded"></i>
                    <div class="stats">
                      <h5><strong><?php echo @$total_recrutadores ?></strong></h5>
                      <span>Recrutadores</span>
                    </div>
                </div>
        	</div>
        	</a> 

        	<!-- <a href="#">
        	<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                    <i class="pull-left fa fa-university user02 icon-rounded"></i>
                    <div class="stats">
                      <h5><strong><?php echo @$total_instituicoes ?></strong></h5>
                      <span>Instituicoes</span>
                    </div>
                </div>
        	</div>
        	</a>
        	<a href="#">
        	<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                    <i class="pull-left fa fa-book user03 icon-rounded"></i>
                    <div class="stats">
                      <h5><strong><?php echo @$total_cursos ?></strong></h5>
                      <span>Cursos</span>
                    </div>
                </div>
        	 </div>
        	 </a> -->
			 <!-- <a href="#">
        	<div class="col-md-3 widget">
        		<div class="r3_counter_box">
                    <i class="pull-left fa fa-sitemap user04 icon-rounded"></i>
                    <div class="stats">
                      <h5><strong><?php echo @$total_pelouros ?></strong></h5>
                      <span>Pelouros</span>
                    </div>
                </div>
        	 </div>
        	</a> -->

        	<!-- <a href="#">
        	<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                   <i class="pull-left fa fa-sliders user05 <?php echo @$total_direcoes ?> icon-verde"></i>
                    <div class="stats">
                      <h5><strong><?php echo @$total_direcoes?></strong></h5>
                      <span>Direcoes</span>
                    </div>
                </div>
        	</div>
        	</a> -->

        	<a href="#">
        	<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                   <i class="pull-left fa fa-users user06 icon-vermelho"></i>
                    <div class="stats">
                      <h5><strong><?php echo @$total_candidatos ?></strong></h5>
                      <span>Candidatos</span>
                    </div>
                </div>
        	</div>
        	</a>

        	<!-- <a href="#">	
        	<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                   <i class="pull-left fa fa-male user07 icon-verde"></i>
                    <div class="stats">
                      <h5><strong><?php echo @$total_candidato_genero_masculino ?></strong></h5>
                      <span>Cand Masculino</span>
                    </div>
                </div>
        	</div>
        	</a> -->

        	<!-- <a href="#">	
        	<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                   <i class="pull-left fa fa-female user08 icon-vermelho"></i>
                    <div class="stats">
                      <h5><strong><?php echo @$total_candidato_genero_feminino ?></strong></h5>
                      <span>Cand Feminino</span>
                    </div>
                </div>
        	</div>
        	</a> -->


        	<a href="#">
        	<div class="col-md-4 widget">
        		<div class="r3_counter_box">
                    <i class="pull-left fa fa-archive user09 icon-rounded <?php echo @$total_candidaturas ?> icon-rounded"></i>
                    <div class="stats">
                      <h5><strong><?php echo @$total_candidaturas ?></strong></h5>
                      <span> Candidaturas</span>
                    </div>
                </div>
        	 </div>
        	 </a>


			 <!-- <a href="" data-toggle="modal" data-target="#modalPerfil">
				<div class="col-md-3 stat">
					<div class="content-top-1">
						<div class="col-md-6 top-content">
							<h5>Meu Perfil</h5>
							<label><?php echo $porcentagemPerfilF ?>%</label>
						</div>
						<div class="col-md-6 top-content1">	   
							<div id="<?php echo $cor_porcent ?>" class="pie-title-center" data-percent="<?php echo $porcentagemPerfil ?>"> <span class="pie-value"></span> </div>
						</div>
						<div class="clearfix"> </div>
					</div>
					

				</div>
			</a>
         -->


        	<div class="clearfix"> </div>
		</div>
		
		<div class="row-one widgettable">
			
			<div class="col-md-4 stat">

				
			</div>
			
			<div class="clearfix"> </div>
		</div>

		<div class="col-md-12 content-top-2 card" style="padding:20px">			
		<div id="columnchart_material" style="width: 950px; height: 500px;"></div>
		
		
		
		</div>	


				
				
		</div>	

		<!-- <div class="footer">
	   			<small><p>Copyrigth &copy; <?php echo date('Y') ?> <?php echo $nome_sistema ?>. Todos os Direitos Reservados. </p>	</small>	
		</div>
  -->
<!-- 
	GRAFICO DE LINHA 
	<script type="text/javascript">
		$(document).ready(function() {

		var valor_col_graf_linha = $('#valor_coluna').val()
    	var colunas_graf_linha = valor_col_graf_linha.split("-");

    	var valor_linha_graf_linha_pagar = $('#valor_pagar_dia').val()
    	var linha_graf_linha_pagar = valor_linha_graf_linha_pagar.split("-");

    	var valor_linha_graf_linha_receber = $('#valor_receber_dia').val()
    	var linha_graf_linha_receber = valor_linha_graf_linha_receber.split("-");

    	
    	var maior_valor_linha_pagar = Math.max(...linha_graf_linha_pagar);
    	var maior_valor_linha_receber = Math.max(...linha_graf_linha_receber);
    	var maior_valor = Math.max(maior_valor_linha_pagar, maior_valor_linha_receber);
    	maior_valor = parseFloat(maior_valor) + 100;
    	
    	var menor_valor_linha_pagar = Math.min(...linha_graf_linha_pagar);
    	var menor_valor_linha_receber = Math.min(...linha_graf_linha_receber);
    	var menor_valor = Math.max(menor_valor_linha_pagar, menor_valor_linha_receber);

		var dadosReceber = {
    		linecolor: "green",
    		title: "Conta à Receber",
    		values: [
    		{ X: colunas_graf_linha[5], Y: linha_graf_linha_receber[5] },
    		{ X: colunas_graf_linha[4], Y: linha_graf_linha_receber[4] },
    		{ X: colunas_graf_linha[3], Y: linha_graf_linha_receber[3] },
    		{ X: colunas_graf_linha[2], Y: linha_graf_linha_receber[2] },
    		{ X: colunas_graf_linha[1], Y: linha_graf_linha_receber[1] },
    		{ X: colunas_graf_linha[0], Y: linha_graf_linha_receber[0] },
    		
    		]
    	};
    	var dadosPagar = {
    		linecolor: "#da2a2a",
    		title: "Conta à Pagar",
    		values: [
    		{ X: colunas_graf_linha[5], Y: linha_graf_linha_pagar[5] },
    		{ X: colunas_graf_linha[4], Y: linha_graf_linha_pagar[4] },
    		{ X: colunas_graf_linha[3], Y: linha_graf_linha_pagar[3] },
    		{ X: colunas_graf_linha[2], Y: linha_graf_linha_pagar[2] },
    		{ X: colunas_graf_linha[1], Y: linha_graf_linha_pagar[1] },
    		{ X: colunas_graf_linha[0], Y: linha_graf_linha_pagar[0] },
    		
    		]
    	};


    	var dataRangeLinha = {
    		linecolor: "transparent",
    		title: "",
    		values: [
    		{ X: colunas_graf_linha[5], Y: menor_valor },
    		{ X: colunas_graf_linha[4], Y: menor_valor },
    		{ X: colunas_graf_linha[3], Y: menor_valor },
    		{ X: colunas_graf_linha[2], Y: menor_valor },
    		{ X: colunas_graf_linha[1], Y: menor_valor },
    		{ X: colunas_graf_linha[0], Y: maior_valor },
    		
    		]
    	};

		
		$("#Linegraph").SimpleChart({
    			ChartType: "Line",
    			toolwidth: "50",
    			toolheight: "25",
    			axiscolor: "#E6E6E6",
    			textcolor: "#6E6E6E",
    			showlegends: true,
    			data: [dadosPagar, dadosReceber, dataRangeLinha],
    			legendsize: "30",
    			legendposition: 'bottom',
    			xaxislabel: 'Data',
    			title: 'Demonstrativo de Contas',
    			yaxislabel: 'Total de Contas MNZ',
    			responsive: true,
    		});

	})
	
	</script> -->

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Provincias', 'Masculinos', 'Femininos', 'Nao definidos'],
          ['Maputo C', <?php echo $alunos_maputo_cidade_masculino?>, <?php echo $alunos_maputo_cidade_feminino?>, 0],
          ['Maputo P', <?php echo $alunos_maputo_provincia_masculino?>, <?php echo $alunos_maputo_provincia_feminino?>, 0],
          ['Gaza', <?php echo $alunos_gaza_masculino?>, <?php echo $alunos_gaza_feminino?>, 0],
		  ['Inhambane', <?php echo $alunos_inhambane_masculino?>, <?php echo $alunos_inhambane_feminino?>, 0],
          ['Sofala', <?php echo $alunos_sofala_masculino?>, <?php echo $alunos_sofala_feminino?>, 0],
          ['Manica', <?php echo $alunos_manica_masculino?>, <?php echo $alunos_manica_feminino?>, 0],
		  ['Nampula', <?php echo $alunos_nampula_masculino?>, <?php echo $alunos_nampula_feminino?>, 0],
          ['Niassa', <?php echo $alunos_niassa_masculino?>, <?php echo $alunos_niassa_feminino?>, 0],
          ['Tete', <?php echo $alunos_tete_masculino?>, <?php echo $alunos_tete_feminino?>, 0],
		  ['Zambezia', <?php echo $alunos_zambezia_masculino?>, <?php echo $alunos_zambezia_feminino?>, 0],
		  ['Cabo D', <?php echo $alunos_cabo_delgado_masculino?>, <?php echo $alunos_cabo_delgado_feminino?>, 0]
        ]);

        var options = {
          chart: {
            title: 'Distribuicao de genero por provincia',
            subtitle: 'Periodo da apuracao 2022 - 2023',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>




		<!-- GRAFICO DE BARRAS -->
	<script type="text/javascript">
		$(document).ready(function() {

			var valor_graf_barra_saidas = $('#total_saidas_grafico').val()
    		var total_saidas = valor_graf_barra_saidas.split("-");

    		var valor_graf_barra_entradas = $('#total_entradas_grafico').val()
    		var total_entradas = valor_graf_barra_entradas.split("-");


				var color = Chart.helpers.color;
				var barChartData = {
					labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
					datasets: [{
						label: 'Maputo Cidade',
						backgroundColor: color('#191970').alpha(10).rgbString(),
						borderColor: '#191970',
						borderWidth: 0,
						data: [
						total_entradas[0],
						total_entradas[1],
						total_entradas[2],
						total_entradas[3],
						total_entradas[4],
						total_entradas[5],
						total_entradas[6],
						total_entradas[7],
						total_entradas[8],
						total_entradas[9],
						total_entradas[10],
						total_entradas[11],
						total_entradas[12],
						]
					}, {
						label: 'Maputo Provincia',
						backgroundColor: color('black').alpha(10).rgbString(),
						borderColor: 'black',
						borderWidth: 1,
						data: [
						total_saidas[0],
						total_saidas[1],
						total_saidas[2],
						total_saidas[3],
						total_saidas[4],
						total_saidas[5],
						total_saidas[6],
						total_saidas[7],
						total_saidas[8],
						total_saidas[9],
						total_saidas[10],
						total_saidas[11],
						total_saidas[12],
						]
					},
					{
						label: 'Inhambane',
						backgroundColor: color('#00FFFF').alpha(0.5).rgbString(),
						borderColor: '#00FFFF',
						borderWidth: 1,
						data: [
						total_saidas[0],
						total_saidas[1],
						total_saidas[2],
						total_saidas[3],
						total_saidas[4],
						total_saidas[5],
						total_saidas[6],
						total_saidas[7],
						total_saidas[8],
						total_saidas[9],
						total_saidas[10],
						total_saidas[11],
						total_saidas[12],
						]
					},
					{
						label: 'Gaza',
						backgroundColor: color('#008000').alpha(0.5).rgbString(),
						borderColor: '#008000',
						borderWidth: 1,
						data: [
						total_saidas[0],
						total_saidas[1],
						total_saidas[2],
						total_saidas[3],
						total_saidas[4],
						total_saidas[5],
						total_saidas[6],
						total_saidas[7],
						total_saidas[8],
						total_saidas[9],
						total_saidas[10],
						total_saidas[11],
						total_saidas[12],
						]
					}, {
						label: 'Sofala',
						backgroundColor: color('#808000').alpha(0.5).rgbString(),
						borderColor: '#808000',
						borderWidth: 1,
						data: [
						total_saidas[0],
						total_saidas[1],
						total_saidas[2],
						total_saidas[3],
						total_saidas[4],
						total_saidas[5],
						total_saidas[6],
						total_saidas[7],
						total_saidas[8],
						total_saidas[9],
						total_saidas[10],
						total_saidas[11],
						total_saidas[12],
						]
					}, {
						label: 'Tete',
						backgroundColor: color('#D2691E').alpha(10).rgbString(),
						borderColor: '#D2691E',
						borderWidth: 1,
						data: [
						total_saidas[0],
						total_saidas[1],
						total_saidas[2],
						total_saidas[3],
						total_saidas[4],
						total_saidas[5],
						total_saidas[6],
						total_saidas[7],
						total_saidas[8],
						total_saidas[9],
						total_saidas[10],
						total_saidas[11],
						total_saidas[12],
						]
					}, {
						label: 'Manica',
						backgroundColor: color('#C71585').alpha(0.5).rgbString(),
						borderColor: '#C71585',
						borderWidth: 1,
						data: [
						total_saidas[0],
						total_saidas[1],
						total_saidas[2],
						total_saidas[3],
						total_saidas[4],
						total_saidas[5],
						total_saidas[6],
						total_saidas[7],
						total_saidas[8],
						total_saidas[9],
						total_saidas[10],
						total_saidas[11],
						total_saidas[12],
						]
					}, {
						label: 'Nampula',
						backgroundColor: color('#8B0000').alpha(0.5).rgbString(),
						borderColor: '#8B0000',
						borderWidth: 1,
						data: [
						total_saidas[0],
						total_saidas[1],
						total_saidas[2],
						total_saidas[3],
						total_saidas[4],
						total_saidas[5],
						total_saidas[6],
						total_saidas[7],
						total_saidas[8],
						total_saidas[9],
						total_saidas[10],
						total_saidas[11],
						total_saidas[12],
						]
					}, {
						label: 'Cabo Delgado',
						backgroundColor: color('#FFA500').alpha(15).rgbString(),
						borderColor: '#FFA500',
						borderWidth: 1,
						data: [
						total_saidas[0],
						total_saidas[1],
						total_saidas[2],
						total_saidas[3],
						total_saidas[4],
						total_saidas[5],
						total_saidas[6],
						total_saidas[7],
						total_saidas[8],
						total_saidas[9],
						total_saidas[10],
						total_saidas[11],
						total_saidas[12],
						]
					}, {
						label: 'Niassa',
						backgroundColor: color('#FF0000').alpha(10).rgbString(),
						borderColor: '#FF0000',
						borderWidth: 1,
						data: [
						total_saidas[0],
						total_saidas[1],
						total_saidas[2],
						total_saidas[3],
						total_saidas[4],
						total_saidas[5],
						total_saidas[6],
						total_saidas[7],
						total_saidas[8],
						total_saidas[9],
						total_saidas[10],
						total_saidas[11],
						total_saidas[12],
						]
					}, {
						label: 'Zambezia',
						backgroundColor: color('#FFFF00').alpha(25).rgbString(),
						borderColor: '#FFFF00',
						borderWidth: 1,
						data: [
						total_saidas[0],
						total_saidas[1],
						total_saidas[2],
						total_saidas[3],
						total_saidas[4],
						total_saidas[5],
						total_saidas[6],
						total_saidas[7],
						total_saidas[8],
						total_saidas[9],
						total_saidas[10],
						total_saidas[11],
						total_saidas[12],
						]
					}]

				};

			var ctx = document.getElementById("canvas").getContext("2d");
					window.myBar = new Chart(ctx, {
						type: 'bar',
						data: barChartData,
						options: {
							responsive: true,
							legend: {
								position: 'top',
							},
							title: {
								display: true,
								text: 'Candidadaturas'
							}
						}
					});

	})
	
	</script>