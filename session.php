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
/*
 * TODO: implement session with id dynamic
 * and ip address verification for more security
 */

	session_start();
	if(!isset($_SESSION['player'])){
		$_SESSION['player']='char1';
		$_SESSION['tile']='down';
		$_SESSION['y']=7;
		$_SESSION['x']=12;
		$_SESSION['w']=16;
		$_SESSION['h']=12;
		$_SESSION['totalEnemy']=10;
	}
?>
