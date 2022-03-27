<?php

require_once('interfaces/FileInterface.php');

/**
 * class File
 * 
 * This object is ALWAYS liked to a folder object or a directory object
 * 
 * */
class File implements FileInterface{
	public $id = 'FILE';
	protected $name;
	private $extension;
	protected $parent = null;

	public function __construct($name=''){
		$explode = explode(".", $name);

		$this->name = $explode[0];
		$this->extension = $explode[1];
	}
    
    /**
     * getID
     * 
     * @param
     * 
     * string function will return file ID always file
     * This is used when checking is object is a file or folder inside a directory
     * 
     * @return string
     * */
	public function getID(): String{
		return $this->id;
	}
    
    /**
     * getName
     * 
     * @param
     * 
     * @return string
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
     * setParent
     * 
     * @param string parent
     * 
     * @return void
     * */
	public function setParent(String $parent=''): void{
		$this->parent = $parent;
	}
    
    /**
     * getExtension
     * 
     * @param
     * 
     * @return stirng
     * */
	public function getExtension(): String{
		return $this->extension;
	}


}