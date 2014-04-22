<?
	class database
	{
		protected $conn; // variable for connection
		protected $queryResult; //vairable to hold queryResult
	
		// constructor - need to set the user,pass,host,database, and port variables and connect
		public function __construct()
		{
			//connect to the database
			$this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DB);
			//make sure connection successful
			if (!$this->conn)
				die("Sorry. Unable to connect.");
		}
		//destructor closes connection
		public function __destruct()
		{
			$this->closeConnection();
		}	
		// this will close connection
		public function closeConnection()
		{
			//close connection to datbase
			if($this->conn)
				mysqli_close($this->conn);
		}
		//read data from the database - Select Statement
		public function select($table, $columns = '*', $where = null, $orderby = null, $limit = null)
		{
			$results = "";
			$q = "SELECT $columns FROM $table";
			if($where != null)
				$q .= " WHERE $where";
			if ($orderby != null)
				$q .= " ORDER BY $orderby";
			if ($limit != null)
				$q .= " LIMIT $limit";
			$q;			// issue query
			$this->queryResult = mysqli_query($this->conn, $q);			
			//query doesn't run
			if (!$this->queryResult)
			{
				echo 'Sorry. Unable to do as requested.' . $q;
			}
			//output two-dimensions array of all rows selected
			while($row = mysqli_fetch_array($this->queryResult, MYSQLI_ASSOC))
			{
				$results[] = $row;
			}
			return $results;
		}
		public function ugh()
		{
			$results = "";
			$q = "ALTER TABLE data_points MODIFY dp_long decimal(15,5)";
			$this->queryResult = mysqli_query($this->conn, $q);
			$q = "describe data_points";
			$this->queryResult = mysqli_query($this->conn, $q);
			while($row = mysqli_fetch_array($this->queryResult))
			{				$results[] = $row;
			}			echo "<pre>";
			print_r($results);			echo "</pre>";
			$results = "";
			$q = "describe history_entry";
			$this->queryResult = mysqli_query($this->conn, $q);
			while($row = mysqli_fetch_array($this->queryResult))
			{				$results[] = $row;
			}			echo "<pre>";
			
			print_r($results);
			
			echo "</pre>";			$results = "";
			$q = "describe images";
			$this->queryResult = mysqli_query($this->conn, $q);
			while($row = mysqli_fetch_array($this->queryResult))
			{				$results[] = $row;
			}			echo "<pre>";			print_r($results);			echo "</pre>";			$results = "";			$q = "describe links";			$this->queryResult = mysqli_query($this->conn, $q);			while($row = mysqli_fetch_array($this->queryResult))			{				$results[] = $row;			}			echo "<pre>";			print_r($results);			echo "</pre>";			$results = "";			$q = "describe ratings";			$this->queryResult = mysqli_query($this->conn, $q);			while($row = mysqli_fetch_array($this->queryResult))			{				$results[] = $row;			}			echo "<pre>";			print_r($results);			echo "</pre>";			$results = "";			$q = "describe users";			$this->queryResult = mysqli_query($this->conn, $q);			while($row = mysqli_fetch_array($this->queryResult))			{				$results[] = $row;			}			echo "<pre>";			print_r($results);			echo "</pre>";		}
		//insert data into the database - Insert Statement
		public function insert($table, $values, $columns=null)
		{
			//make INSERT INTO part
			$q = "INSERT INTO " . $table;
			//make rest of query based on if columns were sent
			if ($columns != null) // there are specified columns
			{
				$q .= " ($columns)";
			}
			//add values clause
			$q .= " VALUES ($values)";
			
			
			//run query
			mysqli_query($this->conn, $q);
			//tell me iff errors
			if (mysqli_error($this->conn) || mysqli_affected_rows($this->conn) == 0)
			{
				echo "Sorry. Unable to insert data.";
				
				return false;
			}
			return $this->conn->insert_id;
		}
		//update data in the database - Update statement
		public function update($table, $column, $where=null)
		{
			//make UPDATE .. SET .. part
			$q = "UPDATE $table SET $column";
			
			//if where set apply
			if ($where != null)
				$q .= " WHERE $where";
			
			//run query
			mysqli_query($this->conn, $q);
			
			//tell me if errors
			if (mysqli_error($this->conn))
			{
				echo "Sorry. Unable to update data. Query: " . $q;
			}
			
		}
		//delete data in the database
		public function delete($table, $where=null)
		{
			//make DELETE FROM part
			$q = "DELETE FROM $table";
			
			//add where if exists
			if($where != null)
			$q .= " WHERE $where";
			
			//run query
			mysqli_query($this->conn, $q);
			
			//tell me if errors
			if (mysqli_error($this->conn) || mysqli_affected_rows($this->conn) == 0)
				return false;			else				return true;
		}
		//count the rows in a last select query
		public function countRowsofLastSelect() 
		{ 
			//return num rows last select query
			if($this->queryResult)
				return mysqli_num_rows($this->queryResult); 
			else
				return "Sorry. Unable to count rows that don't exist.";
		} 		public function escape($string){			return  mysqli_real_escape_string($this->conn, $string);		}
	}
?>