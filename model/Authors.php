<?php
    class Authors {
        private $conn;
        public $id;
        public $author;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function read() {
            $query = 'select
                    id,
                    author
                from authors';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }
        public function read_single_byId() {
            $query = 'select
                    id,
                    author
                from authors
                where id = :id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id', $this->id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->author = $row['author'];
        }
        public function create_author() {
            $query = 'insert into authors
                (author)
                values
                (:author)';
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':author', $this->author);
            $stmt->execute();
        }
        public function delete_author() {
            $query = 'delete from authors where id = :id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id', $this->id);
            $stmt->execute();
        }
        public function update_author() {
            $query = 'update authors
                set
                    author = :author
                where
                    id = :id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':author', $this->author);
            $stmt->bindValue(':id', $this->id);
            $stmt->execute();
        }
    }
?>