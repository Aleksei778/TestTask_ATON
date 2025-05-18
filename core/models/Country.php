<?php

class Country {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll($sortField = "ID", $sortDirection = "ASC", $filter = null) {
        $allowedSortFields = ['ID', 'COUNTRY'];
        $sortField = in_array($sortField, $allowedSortFields) ? $sortField : 'ID';
        $sortDirection = strtoupper($sortDirection) === 'DESC' ? 'DESC' : 'ASC';

        $query = "SELECT ID, COUNTRY FROM Countries";

        $params = [];

        if ($filter !== null) { 
            if (isset($filter['name']) && !empty($filter['name'])) {
                $query .= " WHERE COUNTRY LIKE ?";
                $params[] = "%{$filter["name"]}%";
            } elseif (isset($filter['id']) && !empty($filter['id'])) {
                $query .= " WHERE ID = ?";
                $params[] = "%{$filter["id"]}%";
            }
        }

        $query .= " ORDER BY {$sortField} {$sortDirection}";

        $result = $this->db->fetchAll($query, $params);
        return $result;
    }

    public function save($data): bool {
        if (!isset($data['COUNTRY']) || empty($data['COUNTRY'])) {
            return false;
        }

        $country = $data['COUNTRY'];

        if (isset($data['ID']) && !empty($data['ID'])) {
            $id = (int)$data['ID'];
            $query = "UPDATE Countries SET COUNTRY = ? WHERE ID = ?";
            return $this->db->query($query, [$country, $id]) !== false;
        }

        $query = "INSERT INTO Countries (COUNTRY) VALUES (?)";
        return $this->db->query($query, [$country]) !== false;
    }

    public function getById($id) {
        $id = (int)$id;
        $query = "SELECT * FROM Countries WHERE ID = ?";
        $result = $this->db->fetchColumn($query, [$id]);
        
        return $result;
    }

    public function delete($id) {
        $id = (int)$id;
        $query = "DELETE FROM Countries WHERE ID = ?";
        return $this->db->query($query, [$id]) !== false;
    }
}