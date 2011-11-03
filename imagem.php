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

	$src = 'pics/';
	$tileset_src = 'pics/tileset1.png';
	echo '<img src="'.$tileset_src.'">';

	// propriedades da imagem de origem
	$prop = getimagesize($tileset_src);
	// imagem de origem
	$img_src = imagecreatefrompng($tileset_src);

	var_dump($prop);
	$i=1;
	for($x=0;$x<$prop[0];$x+=32){
		for($y=0;$y<$prop[1];$y+=32){
			geraImagem($img_src,'pics/tileset1/'.$i++.'.png',$x,$y);
		}
	}

	function geraImagem($img_src,$img_dst,$src_x,$src_y){
		echo 'Generating image '.$img_dst.' from x:'.$src_x.' y:'.$src_y.' -> ';
		$img = imagecreatetruecolor(32,32);
		imagecopy($img,$img_src,0,0,$src_x,$src_y,32,32);
		imagepng($img,$img_dst);
		imagedestroy($img);
		echo '<img src="'.$img_dst.'"><br>';
	}

?>