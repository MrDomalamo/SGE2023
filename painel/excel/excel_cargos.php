 <?php
	session_start();
	require_once("../../conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Imóveis</title>
	<head>
	<body>
		<?php
		// Definimos o nome do arquivo que será exportado
		$arquivo = 'cargos.xls';
		
		// Criamos uma tabela HTML com o formato da planilha
		$html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="2" >Imoveis Cadastrados</tr>';
		$html .= '</tr>';
		
		
		$html .= '<tr>';
		$html .= '<td ><b>ID</b></td>';
		$html .= '<td><b>Nome</b></td>';
		$html .= '</tr>';




		
		//Selecionar todos os itens da tabela 
		$result_cargos = "SELECT * FROM cargos ORDER BY id desc";
		$resultado_cargos = mysqli_query($conn , $result_cargos);

		
		while($row_cargos = mysqli_fetch_assoc($resultado_cargos)){
			$html .= '<tr>';
			$html .= '<td>'.$row_cargos["id"].'</td>';
			$html .= '<td>'.$row_cargos["nome"].'</td>';
			$html .= '</tr>';
			
		}
		// Configurações header para forçar o download
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
		header ("Content-type: application/x-msexcel");
		header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
		header ("Content-Description: PHP Generated Data" );
		// Envia o conteúdo do arquivo
		echo $html;
		exit; ?>
	</body>
</html>