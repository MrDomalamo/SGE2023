<?php 
require_once("../../conexao.php");
$id_curso = @$_POST['curso'];

$query = $pdo->query("SELECT * FROM instituicoes where curso = '$id_curso' order by nome asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
echo <<<HTML
	<select class="form-control sel2" name="instituicoes" id="instituicoes" required style="width:100%;"> 
HTML;
for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}

		if($total_reg > 0){
		$nome = $res[$i]['nome'];
		$id = $res[$i]['id'];
		}else{
		$nome = "Nenhum Cadastro";
		$id = "";
		}

echo <<<HTML
			<option value="{$id}">{$nome}</option>
HTML;
}
echo <<<HTML
		</select> 
	
HTML;

?>




<style type="text/css">
	.sel2 {
		line-height: 36px !important;
		font-size:16px !important;
		color:#666666 !important;

	}
	
</style>  


