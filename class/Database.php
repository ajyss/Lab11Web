<?php
class Database {
    protected $host;
    protected $user;
    protected $password;
    protected $db_name;
    public $conn;

    public function __construct() {
        $this->loadConfig();
        $this->conn = new mysqli(
            $this->host,
            $this->user,
            $this->password,
            $this->db_name
        );

        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    private function loadConfig() {
        include __DIR__ . '/../config.php';
        $this->host = $config['host'];
        $this->user = $config['username'];
        $this->password = $config['password'];
        $this->db_name = $config['db_name'];
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function escape($value) {
        return $this->conn->real_escape_string($value);
    }

    public function getAll($table) {
        $sql = "SELECT * FROM {$table}";
        $result = $this->query($sql);

        $rows = [];
        if ($result) {
            while ($r = $result->fetch_assoc()) {
                $rows[] = $r;
            }
        }
        return $rows;
    }

    public function getById($table, $id_key, $id_value) {
        $id_value = $this->escape($id_value);
        $sql = "SELECT * FROM {$table} WHERE {$id_key} = '{$id_value}' LIMIT 1";
        $result = $this->query($sql);

        return $result ? $result->fetch_assoc() : null;
    }
}
?>
