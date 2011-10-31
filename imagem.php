<?php

	$image = 'pics/teste.png';
	echo '<img src="'.$image.'">';

	// imagem de origem
	$org_img = imagecreatefrompng($image);
	// propriedades da imagem de origem
	$prop = getimagesize($image);

	var_dump($prop);

	for($x=0;$x<$prop[0];$x+=32){
		for($y=0;$y<$prop[1];$y+=32){
			geraImagem($org_img,'pics/teste'.$x.$y.'.png',$x,$y);
		}
	}

	function geraImagem($img_src,$img_dst,$src_x,$src_y){
		echo $img_dst.' x:'.$src_x.' y:'.$src_y.' -> ';
		$img = imagecreatetruecolor(32,32);
		imagecopy($img,$img_src,0,0,$src_x,$src_y,32,32);
		imagepng($img,$img_dst);
		imagedestroy($img);
		echo '<img src="'.$img_dst.'"><br>';
	}


?>

<?
/*
	$image = 'pics/teste.png';
	$dest_image = 'pics/cropped_teste.png';
	echo '<img src="'.$image.'">';

	// imagem de origem
	$org_img = imagecreatefrompng($image);

	// propriedades da imagem de origem
	$prop = getimagesize($image);

	// cria imagem destino
	$img = imagecreatetruecolor(32,32);

	// copia parte da imagem de origem e cola na imagem de destino
	//imagecopy(imagem_destino,imagem_origem,dest_x,dest_y,orig_x,orig_y,orig_w,orig_y);
	imagecopy($img,$org_img,0,0,64,64,32,32);

	// gera a imagem
	imagepng($img,$dest_image);

	// limpa o cache
	imagedestroy($img);
	echo '<br><br><br><img src="'.$dest_image.'">';
*/
?>
