<?php
require_once('Folder.php');
require_once('File.php');
class Dir{
	private $name;
	protected $folders = [];
	protected $files = [];
	protected $structure = [];
	protected $structureParsed = [];
	public $uniques = [];

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

	public function getData(){
		return $this->uniques;
	}

	public function getStructure(){
		return $this->structure;
	}
}