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

	if(isset($_POST['position'])){
		switch($_POST['position']){
			case 'north':{
				$_SESSION['y'] -= 1;
				break;
			}
			case 'south':{
				$_SESSION['y'] += 1;
				break;
			}
			case 'west':{
				$_SESSION['x'] -= 1;
				break;
			}
			case 'east':{
				$_SESSION['x'] += 1;
				break;
			}
		}
	}
	$map->setPlayerPos($_SESSION['x'],$_SESSION['y']);
	$map->setViewPort(16,12);
	$map->drawMap();
?>