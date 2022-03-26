<?php

require_once('interfaces/FolderInterface.php');

class Folder implements FolderInterface {
	protected $name;
	private $id = 'FOLDER';
	protected $parent;
	protected $child = [];
	protected $files = [];

	public function __construct($name=''){
		$this->name = $name;
	}

	public function getID(){
		return $this->id;
	}

	public function getChildrens(){
		return $this->child;
	}

	public function addContent($item){
		if(strpos($item, ".")){
			return $this->addFiles($item);
		}else{
			return $this->addFolders($item);
		}
	}

	public function addFolders($child){
		array_push($this->child, $child);
	}

	public function addFiles($file){
		array_push($this->files, $file);
	}

	public function setName($name){
		$this->name = $name;
	}

	public function setParent($parent=''){
		$this->parent = $parent;
	}
}