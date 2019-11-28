<?php
Class Conn {
    private $servername ="mysql:host=localhost;dbname=itnews";
    private $username = "root";
    private $password = "";
    private $options =array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
    protected $conn;

        public function openConnection()
        {
            try
            {
                $this->conn = new PDO($this->servername, $this->username, $this->password, $this->options);
                return $this->conn;
            }
            catch (PDOException $e)
            {
                echo "Connection failed: ". $e->getMessage();
            }
        }
        public function closeConnection(){
            $this->conn = null;
        }
}
?>