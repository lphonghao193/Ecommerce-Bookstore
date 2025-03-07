<?php 
class Categories {
    private $connection; 

    function __construct(Database $db) {
        $this->connection = $db->getConnection();
    }

    function getCategories() {
        $categories = Array();
        $result = $this->connection->query("SELECT * FROM CATEGORY");
        if ($result) { 
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }
        return $categories;
    }
}
