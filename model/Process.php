<?php

require_once('Folder.php');
require_once('File.php');

class Process{
	private $data = [];

	private $dirs = [];

	private $dataParsed = [];

	private $uniques = [];

	private $test = [];

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
		$this->createHierarchy();
	}

	public static function checkExtension(String $item){
		if(strpos($item, '.')){
			return new File($item);
		}else{
			return new Folder($item);
		}
	}

	public function createUniques(){
		foreach($this->dataParsed as $items){
			foreach($items as $key=>$item){
				if(!in_array($item, $this->uniques)){
					next($items);
					$this->uniques[$item] = self::checkExtension($items[$key]);
				}
			}
		}
	}

	public static function checkExist($item, $stack){
		if(strpos($item, '.')){
			return in_array($item, $stack->getFiles());
		}
		return in_array($item, $stack->getFolders());
	}

	public function createHierarchy(){
		foreach($this->data as $line){
			$relations = explode("/", $line);
			$i = 0;
			while($i < count($relations)-1){
				$prev = $relations[$i];

				//Check if next is in prev:
				if(!self::checkExist($relations[$i+1], $this->uniques[$prev])){
					$this->uniques[$prev]->addElement($relations[$i+1]);
					$this->uniques[$relations[$i+1]]->setParent($this->uniques[$prev]->getName());
				}
				$i++;
			}
		}
	}

	public function getData(){
		return $this->uniques;
	}
}