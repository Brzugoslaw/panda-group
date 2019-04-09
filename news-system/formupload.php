<?php
    require_once("Connector.php");
    $query_db = new Connector;
    $fname=$_POST['fname'];
    $sname=$_POST['sname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $gender=$_POST['gender'];
    $active="Y";
    $query_db->db_query('INSERT INTO users(first_name, last_name, email, password, gender, is_active) VALUES("' . $fname . '","' . $sname . '", "' . $email . '", "' . $password . '", "' . $gender . '", "Y")');
    header("Location: login.php");
    

