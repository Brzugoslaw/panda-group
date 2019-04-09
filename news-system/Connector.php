<?php

class Connector
{
    public function db_query($query)
    {
        $conn = mysqli_connect("", "", "", "");
        if (mysqli_connect_errno()) {
            echo "Connection failed: " . mysqli_connect_error();
        }
        $result = mysqli_query($conn, $query);
        return $result;
    }
}
