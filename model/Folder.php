<?php

require_once('File.php');
require_once('interfaces/FolderInterface.php');

class Folder extends File implements FolderInterface {
	protected $name;
	public $id = 'FOLDER';
	protected $parent = null;
	protected $child = [];
	protected $files = [];

	public function __construct($name=''){
		$this->name = $name;
	}

	public function getID(): string{
		return $this->id;
	}

	public function getFiles(): Array{
		return $this->files;
	}

	public function getName(): String{
		return $this->name;
	}

	public function getParent(): ?String{
		return $this->parent;
	}

	public function getFolders(): Array{
		return $this->child;
	}

	public function getChildrens(): Array{
		return $this->child;
	}

	public function addElement($item): void{
		if(strpos($item, ".")){
			$this->addFiles($item);
		}else{
			$this->addFolders($item);
		}
	}

	public function addFolders(String $child): void{
		array_push($this->child, $child);
	}

	public function addFiles(String $file): void{
		array_push($this->files, $file);
	}

	public function setName(String $name): void{
		$this->name = $name;
	}

	public function setParent($parent=''): void{
		$this->parent = $parent;
	}
}