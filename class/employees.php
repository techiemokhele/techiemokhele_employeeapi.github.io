<?php 
	
	class Employee {
		//Establish database connection
	    private $conn;

	    //Dtabase table to be used
	    private $dbTable = "Employee";

	    //Database columns
	    public $id;
	    public $name;
	    public $email;
	    public $age;
	    public $designation;
	    public $created;

	    //Makes database connection ready
	    public function __construct($db) {
	    	$this->conn = $db;
	    }

	    //Get all data records
	    public function getEmployees() {
	    	$sqlQuery = "SELECT id, name, email, age, designation, created FROM ". $this->dbTable . "";
	    	$stmt = $this->conn->prepare($sqlQuery);
	    	$stmt->execute();
	    	return $stmt;
	    }

	    //Create new record
	    public function createEmployee() {
	    	$sqlQuery = "INSERT INTO ". $this->dbTable . " SET 
	    		name = :name,
	    		email = :email,
	    		age = :age,
	    		designation = :designation,
	    		created = :created
	    	";
	    	$stmt = $this->conn->prepare($sqlQuery);

	    	$this->name=htmlspecialchars(strip_tags($this->name));
	    	$this->email=htmlspecialchars(strip_tags($this->email));
	    	$this->age=htmlspecialchars(strip_tags($this->age));
	    	$this->designation=htmlspecialchars(strip_tags($this->designation));
	    	$this->created=htmlspecialchars(strip_tags($this->created));

	    	$stmt->bindParam(":name", $this->name);
	    	$stmt->bindParam(":email", $this->email);
	    	$stmt->bindParam(":age", $this->age);
	    	$stmt->bindParam(":designation", $this->designation);
	    	$stmt->bindParam(":created", $this->created);

	    	if ($stmt->execute()) {
	    		return true;
	    	} else {
	    		return false;
	    	}
	    }

	    //Read single data records
	    public function getSingleEmployee() {
	    	$sqlQuery = "SELECT id, name, email, age, designation, created FROM " . $this->dbTable . "WHERE id = ? LIMIT 0,1";

	    	$stmt = $this->conn->prepare($sqlQuery);
	    	$stmt->bindParam(1, $this->id);
	    	$stmt->execute();

	    	$dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

	    	$this->name = $dataRow['name'];
	    	$this->email = $dataRow['email'];
	    	$this->age = $dataRow['age'];
	    	$this->designation = $dataRow['designation'];
	    	$this->created = $dataRow['created'];
	    }

	    //Update selected data records
	    public function updateEmployee() {
	    	$sqlQuery = "UPDATE " . $this->dbTable . "SET 
	    		name = :name,
	    		email = :email,
	    		age = :age,
	    		designation = :designation,
	    		created = :created
	    		WHERE id = :id
	    	";

	    	$stmt = $this->conn->prepare($sqlQuery);

	    	$this->name = htmlspecialchars(strip_tags($this->name));
	    	$this->email = htmlspecialchars(strip_tags($this->email));
	    	$this->age = htmlspecialchars(strip_tags($this->age));
	    	$this->designation = htmlspecialchars(strip_tags($this->designation));
	    	$this->created = htmlspecialchars(strip_tags($this->created));
	    	$this->id = htmlspecialchars(strip_tags($this->id));

	    	$stmt->bindParam(":name", $this->name);
	    	$stmt->bindParam(":email", $this->email);
	    	$stmt->bindParam(":age", $this->age);
	    	$stmt->bindParam(":designation", $this->designation);
	    	$stmt->bindParam(":created", $this->created);
	    	$stmt->bindParam(":id", $this->id);

	    	if ($stmt->execute()) {
	    		return true;
	    	} else {
	    		return false;
	    	}
	    }

	    //Delete data record(s): fetch single record
	    function deleteEmployee() {
	    	$sqlQuery = "DELETE FROM " . $this->dbTable . "WHERE id = ?";
	    	$stmt = $this->conn->prepare($sqlQuery);

	    	$this->id=htmlspecialchars(strip_tags($this->id));

	    	$stmt->bindParam(1, $this->id);

	    	if ($stmt->execute()) {
	    		return true;
	    	} else {
	    		return false;
	    	}
	    }
	}
	

 ?>