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
	include('class/map.php');

	$map = new Map('map01');

	updatePlayerPos($map);

	$map->setPlayerPos($_SESSION['x'],$_SESSION['y']);
	$map->setViewPort($_SESSION['w'],$_SESSION['h']);
	$map->drawMap();

	function updatePlayerPos(&$map){
		// get the current position
		$x = $newX = $_SESSION['x'];
		$y = $newY = $_SESSION['y'];

		if(isset($_POST['position'])){
			switch($_POST['position']){
				case 'north':{
					$newY--;
					$_SESSION['tile'] = 'up';
					break;
				}
				case 'south':{
					$newY++;
					$_SESSION['tile'] = 'down';
					break;
				}
				case 'west':{
					$newX--;
					$_SESSION['tile'] = 'left';
					break;
				}
				case 'east':{
					$newX++;
					$_SESSION['tile'] = 'right';
					break;
				}
			}
		}

		if(existNewPosition($map,$newY,$newX)){
			$events = existEvents($map,$newY,$newX);
			if($events){
				if($events !== 'b'){
					$y = $newY;
					$x = $newX;
				}
			}
			else{
				$y = $newY;
				$x = $newX;
			}
		}

		// update session position
		$_SESSION['x'] = $x;
		$_SESSION['y'] = $y;
	}

	function existNewPosition(&$map,$y,$x){
		$mapLimits = $map->getTilesPos();
		if(isset($mapLimits[$y][$x])){
			return true;
		}
		return false;
	}

	function existEvents(&$map,$y,$x){
		$events = $map->getEventsPos();
		if(isset($events[$y][$x])){
			return $events[$y][$x];
		}
		return false;
	}


?>