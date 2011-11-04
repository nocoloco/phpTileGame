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
				updateStatusPlayer();
			}
			function updateStatusPlayer(){
				$.post("status.php", function(data){
					$('#status').html(data);
				});
			}
			function setOptions(w,h){
				$.post("options.php", { width: w, height: h },
					function(data){
						updateMap('center');
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
			<table border="1" align="center">
				<tr>
					<td>Navegacao</td>
					<td>Informacoes</td>
					<td>Opcoes</td>
				</tr>
				<tr>
					<td>
						<table align="center" valign="middle">
							<tr>
								<td></td>
								<td align="center" valign="middle"><a href="javascript:void(0);" onclick="updateMap('north');"><img alt="North" src="images/up.png"></a></td>
								<td></td>
							</tr>
							<tr>
								<td align="center" valign="middle"><a href="javascript:void(0);" onclick="updateMap('west');"><img alt="West" src="images/left.png"></a></td>
								<td></td>
								<td align="center" valign="middle"><a href="javascript:void(0);" onclick="updateMap('east');"><img alt="East" src="images/right.png"></a></td>
							</tr>
							<tr>
								<td></td>
								<td align="center" valign="middle"><a href="javascript:void(0);" onclick="updateMap('south');"><img alt="South" src="images/down.png"></a></td>
								<td></td>
							</tr>
						</table>
					</td>
					<td>
						<div id="status"></div>
					</td>
					<td>
						<input type="button" onclick="setOptions(16,12);" value="16x12"><br>
						<input type="button" onclick="setOptions(22,18);" value="22x18">
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>