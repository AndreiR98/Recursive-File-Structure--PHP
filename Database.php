<?php

class Database {	
	
	private $connection = null;
	private $sqlHostname = 'localhost';
	private $sqlUsername = 'root';
	private $sqlPassword = '';
	private $sqlDatabase = 'rfs';

  public function __construct(){
  	try{
  		$this->connection = new mysqli($this->sqlHostname, $this->sqlUsername, $this->sqlPassword);
  		mysqli_select_db($this->connection, $this->sqlDatabase);
  	}catch(Exception $e){
  		$errors[] = $e;
  		return false;
  	}
  }

  public function CheckFieldName($file){
  	return $this->ExecuteStatement('SELECT * FROM files WHERE file_name="'.$file.'"')->num_rows;
  }

  public function InsertField($name){
  	return $this->ExecuteStatement('INSERT INTO files (file_name) VALUES ("'.$name.'")');
  }

  public function ReturnQuery($statement){
  	return $this->ExecuteStatement($statement)->fetch_assoc();
  }

   public function InsertFieldDependent($name, $parent, $root, $extension='folder'){
  	$root_id = $this->ReturnQuery('SELECT file_id FROM files WHERE file_name="'.$root.'"')['file_id'];
  	$parent_id = $this->ReturnQuery('SELECT file_id FROM files WHERE (file_name="'.$parent.'") AND (root_id='.$root_id.' OR file_id='.$root_id.')')['file_id'];
  	return $this->ExecuteStatement('INSERT INTO files (file_name, file_parent_id, root_id, file_extension) VALUES ("'.$name.'", '.$parent_id.', '.$root_id.', "'.$extension.'")');
  }

  public function Delete(){
  	return $this->ExecuteStatement('DELETE FROM files ORDER BY file_id DESC');
  }

  public function ExecuteStatement($statement){
  	return $this->connection->query($statement);
  }

 

  

}

?>