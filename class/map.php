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

	class Map {

		private $width=0;
		private $height=0;
		private $eventsPos=array();
		private $tilesPos=array();
		private $tileSet='tileset1';
		private $playerPos=array('x' => 6, 'y' => 6);
		private $viewPort=array('w' => 12, 'h' => 12);
		const MAPDIR = './maps/';
		const TILES = './tiles/';

		public function __construct($mapName){
			$this->loadMap($mapName);
			$this->loadEvents($mapName);
		}

		private function loadMap($mapName){
			if(file_exists(self::MAPDIR.$mapName.'.map')){
				$map = fopen(self::MAPDIR.$mapName.'.map','r');
				$numLine=0;
				while(!feof($map)){
					$line = fgets($map,128);
					if($line){
						$arr = explode(',',$line);
						array_pop($arr); // remove line break
						$this->tilesPos[$numLine++] = $arr;
					}
				}
				fclose($map);
				$this->height = $numLine;
				$this->width = count($this->tilesPos[0]);
			}
		}

		private function loadEvents($mapName){
			if(file_exists(self::MAPDIR.$mapName.'.evn')){
				$events = fopen(self::MAPDIR.$mapName.'.evn','r');
				while(!feof($events)){
					$line = fgets($events,128);
					if($line){
						$arr = explode(',',$line);
						array_pop($arr); // remove line break
						$this->eventsPos[$arr[0]][$arr[1]] = $arr[2];
					}
				}
				fclose($events);
			}
		}

		public function drawMap(){
			echo '<div id="map" style="width:'.($this->viewPort['w']*32).'; height:'.($this->viewPort['h']*32).';">';
			$xmin = $this->playerPos['x']-($this->viewPort['w']/2);
			$xmax = $this->playerPos['x']+($this->viewPort['w']/2);
			$ymin = $this->playerPos['y']-($this->viewPort['h']/2);
			$ymax = $this->playerPos['y']+($this->viewPort['h']/2);
			for($ymin;$ymin<$ymax;$ymin++){
				for($xcur=$xmin;$xcur<$xmax;$xcur++){
					if(isset($this->tilesPos[$ymin][$xcur]) and file_exists('./'.self::TILES.'maps/'.$this->tileSet.'/'.$this->tilesPos[$ymin][$xcur].'.png')){
						echo '<img src="./'.self::TILES.'maps/'.$this->tileSet.'/'.$this->tilesPos[$ymin][$xcur].'.png">';
					}
					else{
						echo '<img src="./images/blank.png">';;
					}
				}
			}
			echo '<div id="player" style="top:'.($this->viewPort['h']/2*32-16).'; left:'.($this->viewPort['w']/2*32).';"><img src="'.self::TILES.'/chars/'.$_SESSION['player'].'/'.$_SESSION['tile'].'.png"></div>';
			echo '</div>';
		}

		public function setPlayerPos($x,$y){
			$this->playerPos['x'] = $x;
			$this->playerPos['y'] = $y;
		}

		public function setViewPort($w,$h){
			$this->viewPort['w'] = $w;
			$this->viewPort['h'] = $h;
		}

		public function &getEventsPos(){
			return $this->eventsPos;
		}

		public function &getTilesPos(){
			return $this->tilesPos;
		}

	}

?>
