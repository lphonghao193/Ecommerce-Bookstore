<?php 

function encryptPassword($psw) {
    return hash('sha256', $psw);
}

function sanitizeString($var) { 
	$var = stripslashes($var); 
	$var = htmlentities($var); 
	$var = strip_tags($var); 
	return $var; 
} 
function sanitizeMySQL($connection, $var) { 
	// Using the mysqli extension 
	$var = $connection->real_escape_string($var); 
	$var = sanitizeString($var); 
	return $var; 
}

class Users {
    private $connection;

    function __construct(Database $db) {
        $this->connection = $db->getConnection();
    }

    function getUser($username, $password, $type) {
        $role = $type == 0 ? "USER" : "ADMIN";
        $hashedPassword = hash('sha256', $password);
    
        $stmt = $this->connection->prepare(
            "SELECT * FROM USER WHERE USERNAME = ? AND PASSWORD = ? AND ROLE = ?"
        );
    
        if ($stmt === false) {
            // Handle error appropriately
            error_log("Prepare failed: " . $this->connection->error);
            return [];
        }
    
        $stmt->bind_param("sss", $username, $hashedPassword, $role);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result && $user = $result->fetch_assoc()) {
            return $user;
        }
    
        return [];
    }
    

    function getUSerInfo($id, $role) {       
        $query = "SELECT * FROM USER WHERE USER_ID = $id AND ROLE = '$role'";
        $result = $this->connection->query($query);   
        
        if ($result) {return $result->fetch_assoc();}
        
        return [];
    }

    function checkUsername($username) {

        $query = "SELECT USERNAME FROM USER";
        $result = $this->connection->query($query);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                if ($row['USERNAME'] == $username) return false;
            }
            return true;
        }
        return true;        
    }

    function checkEmail($email) {
        $query = "SELECT EMAIL FROM USER";
        $result = $this->connection->query($query);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                if ($row['EMAIL'] == $email) return false;
            }
            return true;
        }
        return true;        
    }

    function addUser($username, $password, $email) {
        sanitizeMySQL($this->connection, $username);
        sanitizeMySQL($this->connection, $password);
        sanitizeMySQL($this->connection, $email);

        $password = encryptPassword($password);
        $query = "INSERT INTO USER (USERNAME, PASSWORD, EMAIL, ROLE) VALUES 
        ('$username', '$password', '$email', 'USER')";
        if ($this->connection->query($query)) return true;
        return false;
    }
}