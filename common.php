<?php

	// carrega arquivo do mapa
	function &carregaMapa($mapa){
		$map = fopen('maps/'.$mapa.'.txt','r');
		$i=0;
		$vetor_mapa = array();
		while(!feof($map)){
			$linha = fgets($map,128);
			if($linha){
				$vetor_mapa[$i] = &converteLinhaMapa($linha);
				$i++;
			}
		}
		fclose($map);
		return $vetor_mapa;
	}

	// gera um vetor de chars a partir uma string
	function &converteLinhaMapa(&$linha){
		$vet = explode(',',$linha);
		array_pop($vet); // remove a quebra de linha
		return $vet;
	}

	// carrega arquivo com os eventos do mapa e retorna vetor
	function &carregaEventos($mapa){
		$eventos = fopen('maps/'.$mapa.'.evn','r');
		$vetor_eventos = array();
		while(!feof($eventos)){
			$linha = fgets($eventos,128);
			if($linha){
				$ev = &converteLinhaEvento($vetor_eventos,$linha);
			}
		}
		fclose($eventos);
		return $vetor_eventos;		
	}

	/*	y,x,b			b = local bloqueado
	 *	y,x,e,evento	e = evento qualquer (trigger)
	 * */
	// retorna vetor com o evento da linha lida
	function &converteLinhaEvento(&$eventos,&$linha){
		$vet = explode(',',$linha);
		array_pop($vet); // remove a quebra de linha
		if($vet[2] === 'b'){
			$eventos[$vet[0]][$vet[1]] = 'b';
		}
		elseif($vet[2] === 'e'){
			$eventos[$vet[0]][$vet[1]] = array('e' =>  $vet[3]);
		}
		return $eventos;
	}

	// atualiza a sessao do player, posicao verifica se a nova posicao eh valida
	function atualizaPlayer(&$mapa,&$eventos){
		// posicao atual do player
		$x = $newX = $_SESSION['x'];
		$y = $newY = $_SESSION['y'];

		if(isset($_POST['cima'])){
			$newY--;
		}
		elseif(isset($_POST['baixo'])){
			$newY++;
		}
		elseif(isset($_POST['esquerda'])){
			$newX--;
		}
		elseif(isset($_POST['direita'])){
			$newX++;
		}

		if(existeNovaPosicao($mapa,$newY,$newX)){
			$evento = existeEvento($eventos,$newY,$newX);
			if($evento){
				if($evento !== 'b'){
					//var_dump($evento);
					$y = $newY;
					$x = $newX;
				}
			}
			else{
				$y = $newY;
				$x = $newX;
			}
		}

		// atualiza pos na sessao
		$_SESSION['x'] = $x;
		$_SESSION['y'] = $y;
	}

	function existeNovaPosicao(&$mapa,$y,$x){
		if(isset($mapa[$y][$x])){
			return true;
		}
		return false;
	}

	function existeEvento(&$eventos,$y,$x){
		if(isset($eventos[$y][$x])){
			return $eventos[$y][$x];
		}
		return false;
	}

?>
