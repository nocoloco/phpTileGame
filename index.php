<?
	// Inicializar a sessão
	session_start();
	// mapa
	$altura=16;
	$largura=26;

	// Registrar variáveis
	if(!session_is_registered('player')){
		$_SESSION['player']='P';
		$_SESSION['y']=8;
		$_SESSION['x']=13;
   }
   else{
		// atualiza sessao do player
		if(isset($_POST['cima'])){
			if($_SESSION['y'] > 1){
				$_SESSION['y'] = $_SESSION['y'] - 1;
			}
		}
		elseif(isset($_POST['baixo'])){
			if($_SESSION['y'] < $altura-2){
				$_SESSION['y'] = $_SESSION['y'] + 1;
			}
		}
		elseif(isset($_POST['esquerda'])){
			if($_SESSION['x'] > 1){
				$_SESSION['x'] = $_SESSION['x'] - 1;
			}
		}
		elseif(isset($_POST['direita'])){
			if($_SESSION['x'] < $largura-2){
				$_SESSION['x'] = $_SESSION['x'] + 1;
			}
		}
	}
	$player[$_SESSION['y']][$_SESSION['x']]=$_SESSION['player'];


	define('VAZIO','<div style="background-color:#FFF; display:block; width:32px; height:32px;"></div>');
	define('FIM_TELA','<div style="background-color:#000; display:block; width:32px; height:32px;"></div>');
	define('GRAMA', '<div style="background-color:#00E500; display:block; width:32px; height:32px;"><img src="images/grama.png" border="0"></div>');
	define('AGUA', '<div style="background-color:#1EADFF; display:block; width:32px; height:32px;"></div>');
	define('TERRA', '<div style="background-color:#AF8318; display:block; width:32px; height:32px;"></div>');


	// limites do mapa
	for($i=0;$i<$largura;$i++){
		$board[0][$i]=FIM_TELA;
		if($i>0 and $i<$altura){
			$board[$i][0]=FIM_TELA;
		}
	}
	for($i=0;$i<$largura;$i++){
		$board[$altura-1][$i]=FIM_TELA;	
		if($i>0 and $i<$altura){
			$board[$i][$largura-1]=FIM_TELA;
		}
	}

	// objetos no mapa
	$board[1][4]=AGUA;
	$board[1][5]=AGUA;
	$board[2][4]=AGUA;
	$board[2][5]=AGUA;
	$board[3][5]=AGUA;
	$board[3][6]=AGUA;
	$board[4][5]=AGUA;
	$board[4][6]=AGUA;
	$board[5][5]=AGUA;
	$board[5][6]=AGUA;
	$board[6][5]=AGUA;
	$board[6][6]=AGUA;
	$board[7][4]=AGUA;
	$board[7][5]=AGUA;
	$board[8][3]=AGUA;
	$board[8][4]=AGUA;
	$board[8][5]=AGUA;
	$board[8][6]=AGUA;
	$board[9][2]=AGUA;
	$board[9][3]=AGUA;
	$board[9][4]=AGUA;
	$board[9][5]=AGUA;
	$board[9][6]=AGUA;
	$board[9][7]=AGUA;
	$board[9][8]=AGUA;
	$board[10][2]=AGUA;
	$board[10][3]=AGUA;
	$board[10][4]=AGUA;
	$board[10][5]=AGUA;
	$board[10][6]=AGUA;
	$board[10][7]=AGUA;
	$board[10][8]=AGUA;
	$board[11][2]=AGUA;
	$board[11][3]=AGUA;
	$board[11][4]=AGUA;
	$board[11][5]=AGUA;
	$board[11][6]=AGUA;
	$board[11][7]=AGUA;
	$board[11][8]=AGUA;
	$board[11][9]=AGUA;
	$board[12][3]=AGUA;
	$board[12][4]=AGUA;
	$board[12][5]=AGUA;
	$board[12][6]=AGUA;
	$board[12][7]=AGUA;
	$board[13][7]=AGUA;
	$board[13][8]=AGUA;


?>
<table border="0" cellspacing="0" cellpadding="0" align="center">
	<?for($l=0;$l<$altura;$l++){?>
		<tr>
			<?for($c=0;$c<$largura;$c++){?>
				<td>
					<?
						if(isset($player[$l][$c])){
							echo $player[$l][$c];
						}
						elseif(isset($board[$l][$c])){
							echo $board[$l][$c];
						}
						else{
							echo GRAMA;
						}
					?>
				</td>
			<?}?>
		</tr>
	<?}?>
</table>
<form action="index.php" method="POST">
	<table align="center" border="1" height="120">
		<tr align="center" valign="middle">
			<td colspan="3" width="220"><input type="submit" name="cima" value="Cima"></td>
		</tr>
		<tr align="center" valign="middle">
			<td width="100"><input type="submit" name="esquerda" value="Esquerda"></td>
			<td width="20">&nbsp;</td>
			<td width="100"><input type="submit" name="direita" value="Direita"></td>
		</tr>
		<tr align="center" valign="middle">
			<td colspan="3"><input type="submit" name="baixo" value="Baixo"></td>
		</tr>
	</table>
</form>
