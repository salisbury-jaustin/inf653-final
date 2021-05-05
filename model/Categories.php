<?php
    class Categories {
        private $conn;
        public $id;
        public $category;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function read() {
            $query = 'select
                    id,
                    category 
                from categories';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }
        public function read_single_byId() {
            $query = 'select
                    id,
                    category 
                from categories 
                where id = :id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id', $this->id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->category = $row['category'];
        }
        public function create_category() {
            $query = 'insert into categories 
                (category)
                values
                (:category)';
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':category', $this->category);
            $stmt->execute();
        }
        public function delete_category() {
            $query = 'delete from categories where id = :id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id', $this->id);
            $stmt->execute();
        }
        public function update_category() {
            $query = 'update categories 
                set
                    category = :category
                where
                    id = :id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':category', $this->category);
            $stmt->bindValue(':id', $this->id);
            $stmt->execute();
        }
    }
?>