<?php

class Database
{
    private PDO $db;

    public function __construct()
    {
        $host = getenv('DB_HOST');
        $port = getenv('DB_PORT');
        $user = getenv('DB_USER');
        $password = getenv('DB_PASSWORD');
        $dbName = getenv('DB_NAME');
        $this->db = new PDO("mysql:host=$host:$port;dbname=$dbName", $user, $password);
    }

    public function getData(int $offset, $limit, string $direction = null, int $field = null): bool|array
    {
        if ($direction && $field) {
            return $this->fetchAllWithDirection($offset, $limit, $direction, $field);
        }

        return $this->fetchAll($offset, $limit);
    }


    private function fetchAll(int $offset, int $limit): bool|array
    {
        $query = $this->getQuery();
        $query.= "
            limit :limit
            offset :offset";
        $req = $this->db->prepare($query);
        $req->bindParam(':offset', $offset, PDO::PARAM_INT);
        $req->bindParam(':limit', $limit, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    private function fetchAllWithDirection($offset, $limit, $direction = null, $field = null): bool|array
    {
        $query = $this->getQuery();
        $query.= "
            order by :field $direction
            limit :limit
            offset :offset";
        $req = $this->db->prepare($query);
        $req->bindParam(':offset', $offset, PDO::PARAM_INT);
        $req->bindParam(':field', $field, PDO::PARAM_INT);
        $req->bindParam(':limit', $limit, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    private function getQuery(): string
    {
        return "SELECT f.title ,f.rental_rate,f.rating,
        c.name as category,
        (SELECT COUNT(inventory.film_id)
        FROM inventory 
        JOIN rental ON rental.inventory_id = inventory.inventory_id
        WHERE inventory.film_id = f.film_id GROUP BY inventory.film_id
        ) as rented_count
        FROM film as f 
        JOIN film_category as fc ON fc.film_id =f.film_id
        JOIN category AS c ON fc.category_id = c.category_id";
    }
}