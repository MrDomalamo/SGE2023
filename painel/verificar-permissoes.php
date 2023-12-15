<?php 
$vagas = 'ocultar';
$home = 'ocultar';
$cargos = 'ocultar';
$cidades = 'ocultar';
$bairros = 'ocultar';
$contas_banco = 'ocultar';
$acessos = 'ocultar';
$funcionarios = 'ocultar';
$usuarios = 'ocultar';
$candidatos = 'ocultar';
$minhas_candidaturas = 'ocultar';
$candidaturas = 'ocultar';
$candidaturas_em_andamento = 'ocultar';
$candidaturas_candidato = 'ocultar';
$candidaturas_inativas = 'ocultar';
$candidaturas_indeferidas = 'ocultar';
$candidaturas_concluidas = 'ocultar';
$pelouros = 'ocultar';
$direcoes = 'ocultar';
$instituicoes = 'ocultar';
$cursos = 'ocultar';
$tarefas = 'ocultar';
$configuracoes = 'ocultar';
$nivel_academico = 'ocultar';
$menu_cadastros = 'ocultar';
$menu_candidaturas = 'ocultar';
$menu_pessoas = 'ocultar';
$menu_perfil = 'ocultar';
$atualizar_candidato = 'ocultar';
$menu_recrutador = 'ocultar';
$atualizar_recrutador = 'ocultar';
$menu_meus_candidatos = 'ocultar';
$meus_candidatos = 'ocultar';
$menu_aprovacao = 'ocultar';
$pedir_aprovacao_candidatura = 'ocultar';
$aprovar_candidatura = 'ocultar';

$rel_candidaturas= 'ocultar';
$rel_cand_indeferidas = 'ocultar';
$rel_cand_andamento = 'ocultar';
$rel_cand_concluidas = 'ocultar';
$rel_cand_inactivas = 'ocultar';
$rel_funcionarios = 'ocultar';
$rel_candidatos = 'ocultar';
$menu_rel_sistema = 'ocultar';


$excel_excel_candidaturas = 'ocultar';
$excel_excel_cand_candidatos = 'ocultar';
$excel_excel_cand_indeferidas = 'ocultar';
$excel_excel_cand_andamento = 'ocultar';
$excel_excel_cand_concluidas = 'ocultar';
$excel_excel_cand_inactivas = 'ocultar';
$excel_excel_funcionarios = 'ocultar';
$excel_excel_candidatos = 'ocultar';
$menu_rel_sistema_excel = 'ocultar';


$query = $pdo->query("SELECT * FROM usuarios_permissoes where usuario = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
		$permissao = $res[$i]['permissao'];
		
		$query2 = $pdo->query("SELECT * FROM acessos where id = '$permissao'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$nome = $res2[0]['nome'];
		$chave = $res2[0]['chave'];
		$id = $res2[0]['id'];



		if($chave == 'home'){
			$home = '';
		}

		if($chave == 'cargos'){
			$cargos = '';
		}


		if($chave == 'cidades'){
			$cidades = '';
		}

		if($chave == 'bairros'){
			$bairros = '';
		}

		if($chave == 'acessos'){
			$acessos = '';
		}


		if($chave == 'funcionarios'){
			$funcionarios = '';
		}

		if($chave == 'candidatos'){
			$candidatos = '';
		}
		if($chave == 'vagas'){
			$vagas = '';
		}
		if($chave == 'pedir_aprovacao_candidatura'){
			$pedir_aprovacao_candidatura = '';
		}

		if($chave == 'aprovar_candidatura'){
			$aprovar_candidatura= '';
		}

		if($chave == 'usuarios'){
			$usuarios = '';
		}

		if($chave == 'atualizar_candidato'){
			$atualizar_candidato = '';
		}

		if($chave == 'atualizar_recrutador'){
			$atualizar_recrutador = '';
		}

		if($chave == 'candidaturas_candidato'){
			$candidaturas_candidato = '';
		}


		if($chave == 'tarefas'){
			$tarefas = '';
		} 


		if($chave == 'candidaturas'){
			$candidaturas = '';
		}

		if($chave == 'candidaturas_inativas'){
			$candidaturas_inativas = '';
		}

		if($chave == 'candidaturas_em_andamento'){
			$candidaturas_em_andamento = '';
		}

		if($chave == 'candidaturas_indeferidas'){
			$candidaturas_indeferidas = '';
		}

		if($chave == 'candidaturas_concluidas'){
			$candidaturas_concluidas = '';
		}

		if($chave == 'pelouros'){
			$pelouros = '';
		}

		if($chave == 'direcoes'){
			$direcoes = '';
		}

		if($chave == 'instituicoes'){
			$instituicoes = '';
		}

		if($chave == 'cursos'){
			$cursos = '';
		}

		if($chave == 'meus_candidatos'){
			$meus_candidatos = '';
		}

		if($chave == 'tarefas'){
			$tarefas = '';
		}

		if($chave == 'nivel_academico'){
			$nivel_academico = '';
		}

		if($chave == 'configuracoes'){
			$configuracoes = '';
		}

		if($chave == 'rel_candidaturas'){
			$rel_candidaturas= '';
		}

		if($chave == 'rel_cand_indeferidas'){
			$rel_cand_indeferidas = '';
		}

		if($chave == 'rel_cand_andamento'){
			$rel_cand_andamento = '';
		}

		if($chave == 'rel_cand_concluidas'){
			$rel_cand_concluidas = '';
		}

		if($chave == 'rel_cand_inactivas'){
			$rel_cand_inactivas = '';
		}

		if($chave == 'rel_funcionarios'){
			$rel_funcionarios = '';
		}


		if($chave == 'rel_candidatos'){
			$rel_candidatos = '';
		}



		if($chave == 'excel_excel_candidaturas'){
			$excel_excel_candidaturas= '';
		}

		if($chave == 'excel_excel_cand_candidatos'){
			$excel_excel_cand_candidatos = '';
		}

		if($chave == 'excel_excel_cand_indeferidas'){
			$excel_excel_cand_indeferidas = '';
		}

		if($chave == 'excel_excel_cand_andamento'){
			$excel_excel_cand_andamento = '';
		}

		if($chave == 'excel_excel_cand_concluidas'){
			$excel_excel_cand_concluidas = '';
		}

		if($chave == 'excel_excel_cand_inactivas'){
			$excel_excel_cand_inactivas= '';
		}


		if($chave == 'excel_excel_funcionarios'){
			$excel_excel_funcionarios = '';
		}


		if($chave == 'excel_excel_candidatos'){
			$excel_excel_candidatos = '';
		}

	}
}

if($cargos != 'ocultar' || $vagas != 'ocultar'|| $nivel_academico != 'ocultar' || $cidades != 'ocultar' || $bairros != 'ocultar' || $pelouros != 'ocultar' || $direcoes != 'ocultar'  || $cursos != 'ocultar'|| $instituicoes != 'ocultar' || $acessos != 'ocultar'){
	$menu_cadastros = '';
}

if($funcionarios != 'ocultar' || $candidatos != 'ocultar' || $usuarios != 'ocultar'){
	$menu_pessoas = '';
}


if($candidaturas != 'ocultar' || $candidaturas_candidato != 'ocultar' || $candidaturas_indeferidas != 'ocultar' || $candidaturas_em_andamento != 'ocultar' || $candidaturas_concluidas != 'ocultar' || $candidaturas_inativas != 'ocultar'){
	$menu_candidaturas = '';
}

if($atualizar_candidato != 'ocultar'){
	$menu_perfil = '';
}

if($atualizar_recrutador != 'ocultar'){
	$menu_recrutador = '';
}

if($meus_candidatos != 'ocultar'){
	$menu_meus_candidatos = '';
}

if($pedir_aprovacao_candidatura != 'ocultar' || $aprovar_candidatura != 'ocultar'){
	$menu_aprovacao = '';
}

if($rel_candidaturas!= 'ocultar' || $excel_excel_cand_candidatos != 'ocultar' || $rel_cand_andamento != 'ocultar' || $rel_cand_concluidas != 'ocultar' || $rel_cand_inactivas != 'ocultar' || $rel_funcionarios != 'ocultar' || $rel_candidatos != 'ocultar'){
	$menu_rel_sistema = '';
}

if($excel_excel_candidaturas!= 'ocultar' || $excel_excel_cand_indeferidas != 'ocultar' || $excel_excel_cand_andamento != 'ocultar' || $excel_excel_cand_concluidas != 'ocultar' || $excel_excel_cand_inactivas != 'ocultar' || $excel_excel_funcionarios != 'ocultar' || $excel_excel_funcionarios != 'ocultar' || $excel_excel_candidatos != 'ocultar'){
	$menu_rel_sistema_excel = '';
}





if($home != 'ocultar'){
	$pagina_inicial = 'home';
}else if($tarefas != 'ocultar'){
	$pagina_inicial = 'tarefas';
}else{

	$query = $pdo->query("SELECT * FROM usuarios_permissoes where usuario = '$id_usuario' order by id asc limit 1");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){	
			$permissao = $res[0]['permissao'];		
			$query2 = $pdo->query("SELECT * FROM acessos where id = '$permissao'");
			$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);		
			$pagina_inicial = $res2[0]['chave'];		

	}

}

 ?>