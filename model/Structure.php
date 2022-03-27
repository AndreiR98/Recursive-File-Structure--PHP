<?php
require_once('Directory.php');


/**
 * class Structure
 * 
 * This objects stores each directory C:, D: and it's hierarchy
 * */
class Structure extends Dir{
	public $dirs = [];

	private $structure = [];

	private $sqlStructure = [];

	public $tree = [];

	public function __construct($structure=''){
		//array_push($this->sqlStructure, $this->setTree($structure));
		array_push($this->sqlStructure, $structure);

		//$this->setTree($this->sqlStructure);
	}
    
    /**
     * setStructure
     * 
     * @param string structure
     * 
     * Setting directory structure, setting hierarchy for C:, D:, E:
     * 
     * @return void
     * */
	public function setStructure(String $structure): void{
		array_push($this->structure, $structure);

		foreach($this->structure as $struct){
			$explode = explode("/", $struct);
			if(!in_array($explode[0], $this->dirs)){
				$this->dirs[$explode[0]] = new Dir($explode[0]);
			}
		}

		foreach($this->dirs as $key=>$dir){
			foreach($this->structure as $struct){
				$explode = explode("/", $struct);
				if($explode[0] == $key){
					$this->dirs[$key]->setStructure($struct);
				}
			}
		}
	}
    
    /**
     * getDirs
     * 
     * @param
     * 
     * @return array
     * */
	public function getDirs(){
		return $this->dirs;
	}
}