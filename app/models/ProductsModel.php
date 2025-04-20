<?php 
class Products {
    private $connection; 

    function __construct(Database $db) {
        $this->connection = $db->getConnection();
    }

    function getProducts() {
        $products = Array();
        $result = $this->connection->query("SELECT PRODUCT_ID AS ID, P.NAME AS NAME, AUTHOR, P.DESCRIPTION AS DESCRIPTION, PRICE, C.NAME AS CNAME, IMAGE FROM PRODUCT AS P JOIN 
        CATEGORY AS C ON P.CATEGORY_ID = C.CATEGORY_ID");
        if ($result) { 
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        return $products;
    }

    function getFeatureProduct($limit = 4) {
        $products = Array();
        $result = $this->connection->query("SELECT * FROM PRODUCT LIMIT $limit");
        if ($result) { 
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        return $products;
    }
    
    function getProductsWithConditions($whereClauses, $orderBy, $limit= -1, $offset= -1) {
        $products = Array();    
        $query = "
        SELECT P.PRODUCT_ID, P.NAME, P.AUTHOR, P.PRICE, P.IMAGE, P.DESCRIPTION AS DESCRIPTION, COALESCE(C.NAME, 'Uncategorized') AS CNAME 
        FROM PRODUCT AS P 
        LEFT JOIN CATEGORY AS C ON P.CATEGORY_ID = C.CATEGORY_ID WHERE 1=1";

        foreach($whereClauses as $cond) {
            $query .= " AND " . $cond;
        }
        
        if (!empty($orderBy)) $query .= " ORDER BY " . implode(',', $orderBy);

        if ($limit != -1) $query .= ' LIMIT ' . $limit;
        if ($offset != -1) $query .= ' OFFSET ' . $offset;
        $result = $this->connection->query($query);
        if ($result) { 
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        return $products;
    }

    function getProductById($id) {
        $products = Array();    
        $query = "SELECT P.NAME AS PNAME, P.AUTHOR, P.DESCRIPTION, P.IMAGE, P.PRICE, C.NAME AS CNAME FROM PRODUCT AS P JOIN CATEGORY AS C ON P.CATEGORY_ID = C.CATEGORY_ID WHERE P.PRODUCT_ID = $id";
        $result = $this->connection->query($query);
        if ($result) { 
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        if (count($products) === 0) return [];
        return $products[0];
    }

    public function searchProducts($query) {
        $searchQuery = "%" . $query . "%";
        $stmt = $this->connection->prepare("
            SELECT P.PRODUCT_ID AS ID, P.NAME AS NAME, C.NAME AS CATEGORY, P.IMAGE
            FROM PRODUCT AS P 
            JOIN CATEGORY AS C ON P.CATEGORY_ID = C.CATEGORY_ID
            WHERE P.NAME LIKE ?
            LIMIT 8
        ");
        $stmt->bind_param("s", $searchQuery); // Fixed: Only one "s"
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Convert MySQLi result to an array
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
    
    public function searchCategories($query) {
        $searchQuery = "%" . $query . "%";
        $stmt = $this->connection->prepare("
            SELECT * FROM CATEGORY WHERE NAME LIKE ? 
            LIMIT 2
        ");
        $stmt->bind_param("s", $searchQuery); // Fixed: Only one "s"
        $stmt->execute();
        $result = $stmt->get_result();
    
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
    
    public function removeProduct($id) {   
        $query = "DELETE FROM PRODUCT WHERE ID = $id";
        $this->connection->query($query);
    }
}
