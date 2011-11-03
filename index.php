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
?>
<html>
	<head>
		<title>PHP RPG Tile Game</title>
		<link rel="stylesheet" type="text/css" media="screen" href="./css/style.css" />
		<script type="text/javascript" src="./js/jquery-1.6.4.min.js"></script>
		<script language="javascript">
			$(document).ready(function(){
				updateMap('center');
			});
			function updateMap(local){
				$.post("game.php", { position: local },
					function(data){
						$('#drawMap').html(data);
				});
			}
		</script>
		<style>
			body {
				padding:0px;
				margin:0px;
				background-image:url('images/background.jpg');
			}
		</style>
	</head>
	<body>
		<div id="drawMap"></div>
		<div id="nav">
			<div style="margin-left: 12px;"><a href="javascript:void(0);" onclick="updateMap('north');"><img alt="North" src="images/up.png"></a></div>
			<div>
				<a style="margin-left: -8px;" href="javascript:void(0);" onclick="updateMap('west');"><img alt="West" src="images/left.png"></a>
				<a style="margin-left: 14px;" href="javascript:void(0);" onclick="updateMap('east');"><img alt="East" src="images/right.png"></a>
			</div>
			<div style="margin-top:-5px; margin-left: 12px;"><a href="javascript:void(0);" onclick="updateMap('south');"><img alt="South" src="images/down.png"></a></div>
		</div>
	</body>
</html>