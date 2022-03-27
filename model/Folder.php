<?php

require_once('File.php');
require_once('interfaces/FolderInterface.php');


/**
 * class Folder
 * 
 * This object is a folder objects that is liked to a directory object and contains either more folders or files
 * Folders will be stored as an array in child
 * Files will be stored as array in files
 * */
class Folder extends File implements FolderInterface {
	protected $name;
	public $id = 'FOLDER';
	protected $parent = null;
	protected $child = [];
	protected $files = [];

	public function __construct($name=''){
		$this->name = $name;
	}

    /**
     * getID
     * 
     * @param 
     * 
     * @return integer
     * */
	public function getID(): string{
		return $this->id;
	}
    
    /**
     * getFiles
     * 
     * @param
     * 
     * @return array
     * */
	public function getFiles(): Array{
		return $this->files;
	}
    
    /**
     * getName
     * 
     * @param
     * 
     * @return array
     * */
	public function getName(): String{
		return $this->name;
	}
    
    /**
     * getParent
     * 
     * @param
     * 
     * @return string
     * */
	public function getParent(): ?String{
		return $this->parent;
	}
    
    /**
     * getFolders
     * 
     * @param
     * 
     * @return array
     * */
	public function getFolders(): Array{
		return $this->child;
	}
    
    /**
     * getChildrens
     * 
     * @param
     * 
     * @return array
     * */
	public function getChildrens(): Array{
		return $this->child;
	}
    
    /**
     * addElement
     * 
     * check item extension if file add it to files
     * if folder add it to folders
     * 
     * @param string item
     * 
     * @return void
     * */
	public function addElement($item): void{
		if(strpos($item, ".")){
			$this->addFiles($item);
		}else{
			$this->addFolders($item);
		}
	}
    
    /**
     * addFolders
     * 
     * 
     * @param string child
     * 
     * @return void
     * */
	public function addFolders(String $child): void{
		array_push($this->child, $child);
	}
    
    /**
     * addFiles
     * 
     * @param strinf file
     * 
     * @return void
     * */
	public function addFiles(String $file): void{
		array_push($this->files, $file);
	}
    
    /**
     * setName
     * 
     * @param string name
     * 
     * @return void
     * */
	public function setName(String $name): void{
		$this->name = $name;
	}
    
    /**
     * setParent
     * 
     * @param string parent
     * 
     * @return void
     * */
	public function setParent($parent=''): void{
		$this->parent = $parent;
	}
}