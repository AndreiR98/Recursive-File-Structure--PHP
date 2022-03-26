<?php

require_once('Folder.php');
require_once('File.php');

class Process{
	private $data = [];

	private $dirs = [];

	private $dataParsed = [];

	private $uniques = [];

	public function __construct(){
		//
	}

	private function parseData(){
		foreach($this->data as $line){
			$explode = explode("/", $line);	
		}
		array_push($this->dataParsed, $explode);
	}

	public function setData($data){
		array_push($this->data, $data);

		$this->parseData();
		$this->createUniques();
	}

	public static function checkExtension(String $item){
		if(strpos($item, '.')){
			return new File($item);
		}else{
			return new Folder($item);
		}
	}

	public function createUniques(){
		$toDir = '';
		foreach($this->dataParsed as $items){
			foreach($items as $key=>$item){
				if(!in_array($item, $this->uniques)){
					next($items);
					$this->uniques[$item] = self::checkExtension($items[$key]);
				}

				//$hierarchy = [array_slice($items, 0, (count($items)))];
				$hierarchy = $items;

				
			}
		}
		array_push($this->dirs, $hierarchy);
         $flag = 1;
		foreach($this->dirs[0] as $key=>$hierarch){
			
			if(!strpos($hierarch, ".")){
				$this->uniques[$hierarch]->addContent($this->dirs[0][$flag]);
				$this->uniques[$hierarch]->setParent($this->dirs[0][$flag-2]);
			}
			$flag++;
			
		}
	}

	public function getData(){
		return $this->uniques;
	}
}