<?php

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll($sortField = "ID", $sortDirection = "ASC", $filter = null) {
        $allowedSortFields = ['Users.ID', 'FULLNAME', 'Countries.COUNTRY', 'Cities.CITY'];
        $sortField = in_array($sortField, $allowedSortFields) ? $sortField : 'Users.ID';
        $sortDirection = strtoupper($sortDirection) === 'DESC' ? 'DESC' : 'ASC';

        $query = "
            SELECT Users.ID,
            Users.FIRST_NAME,
            Users.LAST_NAME,  
            CONCAT(Users.LAST_NAME, ' ', Users.FIRST_NAME) AS FULLNAME,
            Cities.CITY, 
            Countries.COUNTRY
            FROM Users
            JOIN Cities ON Users.CITY_ID = Cities.ID
            JOIN Countries ON Cities.COUNTRY_ID = Countries.ID
        ";
        
        $params = [];

        if ($filter !== null) { 
            if (isset($filter['name']) && !empty($filter['name'])) {
                $query .= " WHERE Users.FIRST_NAME LIKE ? OR Users.LAST_NAME LIKE ?";
                $params [] = "%{$filter["name"]}%";
                $params [] = "%{$filter["name"]}%";
            } elseif (isset($filter['location']) && !empty($filter['location'])) {
                $query .= " WHERE Countries.COUNTRY LIKE ?";
                $params [] = "%{$filter["location"]}%";
            }
        }

        $query .= " ORDER BY {$sortField} {$sortDirection}";

        $result = $this->db->fetchAll($query, $params);
        return $result;
    }

    public function save($data): bool {
        if (!isset($data["FIRST_NAME"]) || empty($data["FIRST_NAME"])
            || !isset($data["CITY_ID"]) || empty($data["CITY_ID"])) {
                return false;
        }

        $firstName = $data['FIRST_NAME'];
        $lastName = isset($data['LAST_NAME']) ? $data['LAST_NAME'] : '';
        $cityId = (int)$data['CITY_ID'];

        if (isset($data['ID']) && !empty($data['ID'])) {
            $id = (int)$data['ID'];
            $query = "
                UPDATE Users SET
                    FIRST_NAME = ?,
                    LAST_NAME = ?,
                    CITY_ID = ?
                WHERE ID = ?
            ";
            return $this->db->query($query, [$firstName, $lastName, $cityId, $id]) !== false;
        }

        $query = "
            INSERT INTO Users (FIRST_NAME, LAST_NAME, CITY_ID)
            VALUES (?, ?, ?);
        ";
        return $this->db->query($query, [$firstName, $lastName, $cityId]) !== false;
    }

    public function getById($id) {
        $id = (int)$id;
        $query = "
            SELECT Users.* 
            FROM Users
            JOIN Cities ON Users.CITY_ID = Cities.ID
            JOIN Countries ON Cities.COUNTRY_ID = Countries.ID
            WHERE Users.ID = ?";
        $result = $this->db->fetchColumn($query, [$id]);
        
        return $result;
    }

    public function delete($id) {
        $id = (int)($id);
        $query = "DELETE FROM Users WHERE ID = ?";
        return $this->db->query($query, [$id]) !== false;
    }
}