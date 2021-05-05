<?php
    class Database {
        private static $dsn = 'mysql:host=y5svr1t2r5xudqeq.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=ofc7ux1rd6l05bls';
        private static $username = 'hxy2j1pex5ln4cvo';
        private static $password = 'ef1akxnoqlr5ln47';
        private static $option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION); // sets error mode for PDO
        private $conn;
        private $error;
    
        private function _construct() {}
    
        public function connect() {
            $this->conn = null;
            try {
                $this->conn = new PDO(self::$dsn,
                                    self::$username,
                                    self::$password,
                                    self::$option);
            } catch (PDOException $e) {
                $this->error = $e->getMessage();
            }
            return $this->conn;
        }

        public function get_error() {
            return $this->error;
        }
        public function connected() {
            if (isset($this->conn)) {
                return true;
            } else {
                return false;
            }
        }
    }
?>