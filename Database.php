<?php

    class Database {	
	
        public $connection = null;
		public $sqlHostname = 'localhost';
		public $sqlUsername = 'root';
		public $sqlPassword = '';
		public $sqlDatabase = 'rfs';

        // this function is called everytime this class is instantiated		
        public function __construct(){
              try {
				$this->connection = new mysqli($this->sqlHostname, $this->sqlUsername, $this->sqlPassword, $this->sqlDatabase);

				if( mysqli_connect_errno() ){
					throw new Exception("Could not connect to database.");   
				}
			} catch(Exception $e){
				throw new Exception($e->getMessage());   
			}
        }
		
        // Insert a row/s in a Database Table
        public function Insert( ){
            
        }

        // Select a row/s in a Database Table
        public function Select($statement){
            
        }
		
        // Update a row/s in a Database Table
        public function Update( ){
            
        }		
		
        // Remove a row/s in a Database Table
        public function Remove( ){
            
        }		
        
        // execute statement
        public function executeStatement($query) {
		$params = [];
            $stmt = $this->connection->prepare($query);
		
            $stmt->execute();
			 $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);	
			return $result;
        }
		
    }
	
?>