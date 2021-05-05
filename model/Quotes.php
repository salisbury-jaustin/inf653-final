<?php
    class Quotes {
        private $conn;
        public $id;
        public $quote;
        public $author;
        public $category;
        public $authorId;
        public $categoryId;
        public $limit;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function read() {
            $query = 'select 
                    q.id,
                    q.quote,
                    a.author,
                    c.category
                from 
                    quotes q
                left join 
                    authors a on q.authorId = a.id 
                left join 
                    categories c on q.categoryId = c.id';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }
        public function read_single_byId() {
            $query = 'select 
                    q.id,
                    q.quote,
                    a.author,
                    c.category
                from 
                    quotes q
                left join 
                    authors a on q.authorId = a.id 
                left join 
                    categories c on q.categoryId = c.id
                where q.id = :id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id', $this->id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->quote = $row['quote'];
            $this->author= $row['author'];
            $this->category= $row['category'];
        }
        public function read_byAuthorId() {
            $query = 'select 
                    q.id,
                    q.quote,
                    a.author,
                    c.category
                from 
                    quotes q
                left join 
                    authors a on q.authorId = a.id 
                left join 
                    categories c on q.categoryId = c.id
                where q.authorId = :authorId';
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':authorId', $this->authorId);
            $stmt->execute();

            return $stmt;
        }
        public function read_byCategoryId() {
            $query = 'select 
                    q.id,
                    q.quote,
                    a.author,
                    c.category
                from 
                    quotes q
                left join 
                    authors a on q.authorId = a.id 
                left join 
                    categories c on q.categoryId = c.id
                where q.categoryId = :categoryId';
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':categoryId', $this->categoryId);
            $stmt->execute();

            return $stmt;
        }
        public function read_byAuthor_byCategory() {
            $query = 'select 
                    q.id,
                    q.quote,
                    a.author,
                    c.category
                from 
                    quotes q
                left join 
                    authors a on q.authorId = a.id 
                left join 
                    categories c on q.categoryId = c.id
                where q.categoryId = :categoryId and q.authorId = :authorId';
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':categoryId', $this->categoryId);
            $stmt->bindValue(':authorId', $this->authorId);
            $stmt->execute();

            return $stmt;
        }
        public function read_limit() {
            $query = 'select 
                    q.id,
                    q.quote,
                    a.author,
                    c.category
                from 
                    quotes q
                left join 
                    authors a on q.authorId = a.id 
                left join 
                    categories c on q.categoryId = c.id
                limit ?';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->limit, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt;
        }
        public function create_quote() {
            $query = 'insert into quotes 
                (quote, authorId, categoryId)
                values
                (:quote, :authorId, :categoryId)';
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':quote', $this->quote);
            $stmt->bindValue(':authorId', $this->authorId);
            $stmt->bindValue(':categoryId', $this->categoryId);
            $stmt->execute();
        }
        public function update_quote() {
            $query = 'update quotes 
                set
                    quote = :quote,
                    authorId = :authorId,
                    categoryId = :categoryId
                where
                    id = :id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id', $this->id);
            $stmt->bindValue(':quote', $this->quote);
            $stmt->bindValue(':authorId', $this->authorId);
            $stmt->bindValue(':categoryId', $this->categoryId);
            $stmt->execute();
        }
        public function delete_quote() {
            $query = 'delete from quotes where id = :id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id', $this->id);
            $stmt->execute();
        }
    }
?>