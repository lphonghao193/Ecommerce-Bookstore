<?php 
class Products {
    private $connection; 

    function __construct(Database $db) {
        $this->connection = $db->getConnection();
    }

    function getProducts() {
        $products = Array();
        $result = $this->connection->query("SELECT * FROM PRODUCT");
        if ($result) { 
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        return $products;
    }

    function getFeatureProduct($limit = 4) {
        $products = Array();
        $result = $this->connection->query("SELECT * FROM PRODUCT ORDER BY SALES DESC LIMIT $limit");
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
        SELECT P.ID, P.NAME, P.AUTHOR, P.PRICE, P.IMAGE, COALESCE(C.NAME, 'Uncategorized') AS CNAME 
        FROM PRODUCT AS P 
        LEFT JOIN CATEGORY AS C ON P.CATEGORY_ID = C.ID WHERE 1=1";

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
        $query = "SELECT P.NAME AS PNAME, P.AUTHOR, P.DESCRIPTION, P.IMAGE, P.PRICE, C.NAME AS CNAME FROM PRODUCT AS P JOIN CATEGORY AS C ON P.CATEGORY_ID = C.ID WHERE P.ID = $id";
        $result = $this->connection->query($query);
        if ($result) { 
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        if (count($products) === 0) return [];
        return $products[0];
    }
}
