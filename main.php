<?php

	include('sessao.php');
	include('common.php');

	$tiles = array(
					'a' => 'background-image:url(\'images/grama.png\');',
					'b' => 'background-image:url(\'images/block.png\');',
					'c' => 'background-image:url(\'images/calc.png\');',
				);
	$mapa = 'map01';
	$vetor_mapa = &carregaMapa($mapa);
	$vetor_eventos = &carregaEventos($mapa);

	atualizaPlayer($vetor_mapa,$vetor_eventos);
	$player[$_SESSION['y']][$_SESSION['x']]=$_SESSION['player'];
?>

<html>
	<head>
	
	</head>
	<style>
		body {
			background-image:url('images/background.jpg');
		}
	</style>
	<body>
		<table border="0" cellpadding="0" cellspacing="0" align="center">
			<?foreach($vetor_mapa as $y => $colunas){?>
				<tr>
					<?foreach($colunas as $x => $item){?>
						<?if(isset($tiles[$item])){
							$style =  $tiles[$item];
						}
						else{
							$style = 'background-color:#FFFFFF;';
						}?>
						<td align="center" valign="center" style="<?=$style;?>" width="32" height="32">
							<?if(isset($player[$y][$x])){
								$img = '<img src="images/'.$player[$y][$x].'" border="0">';
							}
							else{
								$img = '&nbsp;';
							}?>
							<div style="position:fixed;margin-top:-32px;"><?=$img;?></div>
						</td>
					<?}?>
				</tr>
			<?}?>
		</table>
		<form action="<?=$_SERVER['PHP_SELF'];?>" method="POST">
			<table align="center" border="1" height="120">
				<tr align="center" valign="middle">
					<td colspan="3" width="220"><input type="submit" name="cima" value="Norte"></td>
					<td rowspan="3" width="100">
						Pos Y: <?=$_SESSION['y'];?><br>
						Pos X: <?=$_SESSION['x'];?>
					</td>
				</tr>
				<tr align="center" valign="middle">
					<td width="100"><input type="submit" name="esquerda" value="Oeste"></td>
					<td width="20">&nbsp;</td>
					<td width="100"><input type="submit" name="direita" value="Leste"></td>
				</tr>
				<tr align="center" valign="middle">
					<td colspan="3"><input type="submit" name="baixo" value="Sul"></td>
				</tr>
			</table>
		</form>
	</body>
</html>
