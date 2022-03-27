<?php

/**
 * class Database
 * 
 * Provide Database conneciton and necesary functions
 * */
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


  /**
   * CheckFieldName
   * 
   * @param string file
   * 
   * @return integer
   * */
  public function CheckFieldName(String $file){
  	return $this->connection->query('SELECT * FROM files WHERE file_name="'.$file.'"')->num_rows;
  }
  
  /**
   * InsertField
   * 
   * @param string name
   * 
   * @return Query
   * */ 
  public function InsertField(String $name){
  	return $this->connection->query('INSERT INTO files (file_name, file_extension) VALUES ("'.$name.'", "dir")');
  }

  /**
   * ReturnQuery
   * 
   * @param string staement
   * 
   * @return SQL object
   * */
  public function ReturnQuery(String $statement){
    return $this->connection->query($statement)->fetch_assoc();
  }

  /**
   * InsertFieldDependent
   * 
   * @param String name, String parent, String root, String extension
   * 
   * @return Query
   * */
   public function InsertFieldDependent(String $name, String $parent, String $root, String $extension='folder'){
  	$root_id = $this->ReturnQuery('SELECT file_id FROM files WHERE file_name="'.$root.'"')['file_id'];
  	$parent_id = $this->ReturnQuery('SELECT file_id FROM files WHERE (file_name="'.$parent.'") AND (root_id='.$root_id.' OR file_id='.$root_id.')')['file_id'];
  	return $this->connection->query('INSERT INTO files (file_name, file_parent_id, root_id, file_extension) VALUES ("'.$name.'", '.$parent_id.', '.$root_id.', "'.$extension.'")');
  }

  /**
   * SearchByKeyword
   * 
   * @param string keyword
   * 
   * @return array
   * */
  public function SearchByKeyword(String $keyword){
    return $this->ExecuteStatement('SELECT * FROM files WHERE file_name LIKE "%'.$keyword.'%"');
  }
  
  /**
   * Delete
   * 
   * @param 
   * 
   * @return Query
   * */
  public function Delete(){
  	return $this->connection->query('DELETE FROM files ORDER BY file_id DESC');
  }
  
  /**
   * getFile
   * 
   * @param integer id
   * 
   * @return Query
   * */
  public function getFile($id){
    return $this->ReturnQuery('SELECT * FROM files WHERE file_id='.$id.'');
  }

  public function ExecuteStatement($statement){
  	//return $this->connection->query($statement);
    $params = [];

    $stmt = $this->connection->prepare($statement);

    $stmt->execute();

    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    return $result;
  }
}

?>