<?php

class City {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll($sortField = "Cities.ID", $sortDirection = "ASC", $filter = null) {
        $allowedSortFields = ['Cities.ID', 'COUNTRY', 'CITY'];
        $sortField = in_array($sortField, $allowedSortFields) ? $sortField : 'Cities.ID';
        $sortDirection = strtoupper($sortDirection) === 'DESC' ? 'DESC' : 'ASC';

        $query = "
            SELECT Cities.ID, Cities.CITY, Countries.COUNTRY, Cities.COUNTRY_ID
            FROM Cities 
            JOIN Countries ON Cities.COUNTRY_ID = Countries.ID
        ";

        $params = [];

        if ($filter !== null) { 
            if (isset($filter['name']) && !empty($filter['name'])) {
                $query .= " WHERE Cities.CITY LIKE ?";
                $params[] = "%{$filter["name"]}%";
            } elseif (isset($filter['id']) && !empty($filter['id'])) {
                $query .= " WHERE Cities.ID = ?";
                $params[] = "%{$filter["id"]}%";
            }
        }

        $query .= " ORDER BY {$sortField} {$sortDirection}";

        $result = $this->db->fetchAll($query, $params);
        return $result;
    }

    public function save($data): bool {
        if (!isset($data['CITY']) || empty($data['CITY']) || 
            !isset($data['COUNTRY_ID']) || empty($data['COUNTRY_ID'])) {
            return false;
        }

        $city = $data['CITY'];
        $countryId = (int)$data['COUNTRY_ID'];

        if (isset($data['ID']) && !empty($data['ID'])) {
            $id = (int)$data['ID'];
            $query = "UPDATE Cities SET CITY = ?, COUNTRY_ID = ? WHERE ID = ?";
            return $this->db->query($query, [$city, $countryId, $id]) !== false;
        }

        $query = "INSERT INTO Cities (CITY, COUNTRY_ID) VALUES (?, ?)";
        return $this->db->query($query, [$city, $countryId]) !== false;
    }

    public function getById($id) {
        $id = (int)$id;
        $query = "
            SELECT Cities.*, Countries.COUNTRY 
            FROM Cities 
            JOIN Countries ON Cities.COUNTRY_ID = Countries.ID 
            WHERE Cities.ID = ?";
        $result = $this->db->fetchColumn($query, [$id]);
        
        return $result;
    }

    public function delete($id) {
        $id = (int)($id);
        $query = "DELETE FROM Cities WHERE ID = ?";
        return $this->db->query($query, [$id]) !== false;
    }
}