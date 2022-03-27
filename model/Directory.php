<?php
require_once('Folder.php');
require_once('File.php');

/**
 * class Dir(Directory)
 * 
 * This object takes each line from .txt file stores it inside structure, this way it can be used latter as hierachy
 * Each line is then parsed and split at '/' inside structureParsed
 * */
class Dir{
	public $uniques = [];
	protected $structureParsed = [];
	private $name;
	private $structure = [];
	
	

	public function __construct(String $name=''){
		$this->name = $name;
	}

	public static function checkExtension(String $item): Object{
		if(strpos($item, '.')){
			return new File($item);
		}
		return new Folder($item);
	}

	public static function checkExist(String $item, Object $stack): bool{
		if(strpos($item, '.')){
			return in_array($item, $stack->getFiles());
		}
		return in_array($item, $stack->getFolders());
	}

	public function setStructure(String $struct): void{
		array_push($this->structure, $struct);

		foreach($this->structure as $line){
			$explode = explode("/", $line);
		}
		array_push($this->structureParsed, $explode);

		$this->createUniques();
		$this->createHierarchy();
	}
    
    /**
     * createUniques
     * 
     * This method takes each parsed structure and for it's each element and creates uniques files or folders objects
     * For example
     * C:/Documents/Images/Work/Desk.jpg
     * Dirc(C:)=[
     * Folder(Documents)
     * Folder(Images)
     * Folder(Work)
     * File(Desk.jpg)
     * ]
     * 
     * @param
     * 
     * @return void
     * */
	public function createUniques(): void{
		foreach($this->structureParsed as $struct){
			foreach($struct as $key=>$item){
				if(!in_array($item, $this->uniques)){
					next($struct);
					$this->uniques[$item] = self::checkExtension($struct[$key]);
				}
			}
		}
	}
    /**
     * createHierarchy
     * 
     * This method sets for each unique element(folder or file) it's hierarchy
     * So for example C:/Documents/Images/Work/Desk.jpg
     * Object_Dir(C:)->folders(Documents)
     * Object_Folder(Documents)->children(Images)
     * Object_Folder(Images)->children(Work)
     * Object_Folder(Work)->files(Desk.jpg)
     * 
     * @param
     * 
     * @return void
     * */
	public function createHierarchy(): void{
		foreach($this->structure as $line){
			$relations = explode("/", $line);
			$i = 0;
			while($i < count($relations)-1){
				$prev = $relations[$i];

				if(!self::checkExist($relations[$i+1], $this->uniques[$prev])){
					$this->uniques[$prev]->addElement($relations[$i+1]);
					$this->uniques[$relations[$i+1]]->setParent($this->uniques[$prev]->getName());
				}
				$i++;
			}
		}
	}
    /**
     * getData
     * 
     * @param
     * 
     * @return array
     * */
	public function getData(){
		return $this->uniques;
	}
    /**
     * getStructure
     * 
     * @param
     * 
     * @return array
     * */
	public function getStructure(){
		return $this->structure;
	}
}