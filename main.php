<?php
/*
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */

	include('session.php');
	include('common.php');

	$tiles = array(
					'1' => 'background-image:url(\'images/grama.png\');',
					'76' => 'background-image:url(\'images/block.png\');',
					'28' => 'background-image:url(\'images/calc.png\');',
				);
	$mapa = 'map01';
	$vetor_mapa = &carregaMapa($mapa);
	$vetor_eventos = &carregaEventos($mapa);

	atualizaPlayer($vetor_mapa,$vetor_eventos);
	$player[$_SESSION['y']][$_SESSION['x']]=$_SESSION['player'];
	// ramdomiza inimigos pelo mapa
	if($_SESSION['totalEnemy'] > 0){
		$posEnemys = ramdomEnemy($vetor_mapa,$vetor_eventos,$player);
	}

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
							elseif(isset($posEnemys[$y][$x])){
								$img = '<img src="images/'.$posEnemys[$y][$x].'" border="0">';
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
		<?verificaEnconterPlayer($posEnemys,$player);?>
		<form action="<?=$_SERVER['PHP_SELF'];?>" method="POST">
			<table align="center" border="1" height="120">
				<tr align="center" valign="middle">
					<td colspan="3" width="220"><input type="submit" name="cima" value="Norte"></td>
					<td rowspan="3" width="100">
						Pos Y: <?=$_SESSION['y'];?><br>
						Pos X: <?=$_SESSION['x'];?><br>
						Enemys: <?=$_SESSION['totalEnemy'];?>
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
