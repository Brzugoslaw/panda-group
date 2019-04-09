<?php

class Importer
{
    private $conn;

    //connecting and creating table user_data
    public function __construct()
    {
        $this->conn = mysqli_connect("", "", "", "");
        if (mysqli_connect_errno()) {
            echo "Connection failed: " . mysqli_connect_error();
        }
        $create_table = "CREATE TABLE IF NOT EXISTS user_data (id INT(4) PRIMARY KEY NOT NUll auto_increment, first_name VARCHAR(50),last_name VARCHAR(50),email VARCHAR(30),gender VARCHAR(6),ip_address VARCHAR(20), country_by_ip VARCHAR(50))";
        mysqli_query($this->conn, $create_table);
    }

    //transfering data from .csv to db
    public function reader($filename)
    {
        $csv_file = file($filename);
        $counter =count($csv_file);
        for ($i=1;$i<=$counter;$i++) {
            $row = explode(',', $csv_file[$i]);
            $row[5] = trim($row[5]);
            
            $res = file_get_contents('http://free.ipwhois.io/json/' . $row[5]);
            $res = json_decode($res);
            $res = $res->country ? $res->country : "Unknown";
            $insert_row = 'INSERT INTO user_data (first_name, last_name, email, gender, ip_address, country_by_ip) VALUES ("' . $row[1] . '", "' . $row[2] . '", "' . $row[3] . '", "' . $row[4] . '", "' . $row[5] . '", "' . $res . '" )';
            mysqli_query($this->conn, $insert_row);
        }
    }
};

$api = new Importer;
$api->reader("MOCK_DATA.csv");
