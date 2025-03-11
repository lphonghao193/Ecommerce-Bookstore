<?php 
class Users {
    private $connection;

    function __construct(Database $db) {
        $this->connection = $db->getConnection();
    }

    function getUser($username, $password) {
        $users = array();
        // TODO: Prepare statement to prevent SQL injection
        $query = "SELECT * FROM USER WHERE USERNAME = '$username' AND PASSWORD = '$password'";
        $result = $this->connection->query($query);   
        
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        
        return !empty($users) ? $users[0] : [];
    }

    function getUserCart($username) {
        $cart = array();

        $query = "SELECT PRODUCT_ID FROM CART WHERE USERNAME = '$username'";
        $result = $this->connection->query($query);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $cart[] = $row["PRODUCT_ID"];
            }
        }
        
        
        return !empty($cart) ? $cart : [];
    }

    function updateUser($arr) {
        // CREATE TABLE USER (
        //     FNAME VARCHAR(255) NOT NULL,
        //     LNAME VARCHAR(255) NOT NULL,
        //     USERNAME VARCHAR(255) NOT NULL PRIMARY KEY,
        //     PASSWORD VARCHAR(255) NOT NULL,
        //     PHONE_NUMBER VARCHAR(20) UNIQUE,
        //     EMAIL VARCHAR(255) UNIQUE,
        //     LOCATION VARCHAR(255),
        //     ROLE VARCHAR(5) NOT NULL CHECK (ROLE IN ('ADMIN', 'USER'))
        // );
        $username = $arr["USERNAME"];
        $fname = $arr["FNAME"];
        $lname = $arr["LNAME"];
        $pnum = $arr["PHONE_NUMBER"];
        $loca = $arr["LOCATION"];
        $email = $arr["EMAIL"];

        $query1 = "SELECT * FROM USER WHERE USERNAME<>'$username' AND PHONE_NUMBER='$pnum'";
        $result1 = $this->connection->query($query1);
        $query2 = "SELECT * FROM USER WHERE USERNAME<>'$username' AND EMAIL='$email'";
        $result2 = $this->connection->query($query2);
        if ($result1->num_rows != 0) {
            echo "<script>alert('Error: Phone Number already in use by another user.');</script>";
        }
        elseif ($result2->num_rows != 0) {
            echo "<script>alert('Error: Email already in use by another user.');</script>";           
        }
        else {
            $query = "UPDATE USER SET PHONE_NUMBER='$pnum' WHERE USERNAME='$username'";
            $this->connection->query($query);
            $query = "UPDATE USER SET EMAIL='$email' WHERE USERNAME='$username'";
            $this->connection->query($query);
            $query = "UPDATE USER SET FNAME='$fname' WHERE USERNAME='$username'";
            $this->connection->query($query);
            $query = "UPDATE USER SET LNAME='$lname' WHERE USERNAME='$username'";
            $this->connection->query($query);
            $query = "UPDATE USER SET LOCATION='$loca' WHERE USERNAME='$username'";
            $this->connection->query($query); 
            $_SESSION['user'] = $arr;
        }    
    }
}