<?
	// inicializa a sessao
	session_start();
	// registra a sessao para o player
	if(!session_is_registered('player')){
		$_SESSION['player']='player.png';
		$_SESSION['y']=7;
		$_SESSION['x']=12;
	}
?>
