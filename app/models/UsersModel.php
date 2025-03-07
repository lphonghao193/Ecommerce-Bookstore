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
}