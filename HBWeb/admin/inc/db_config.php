<?php

    $hostname="localhost";
    $uname="root";
    $pass="";
    $db="hbweb_db";

    $con = mysqli_connect($hostname,$uname,$pass,$db);

    if(!$con){
        die("Cannot Connect Database".mysqli_connect_error());
    }


    function filteration($data){
        foreach($data as $key=>$value){
            $value=trim($value);
            $value=stripcslashes($value);
            $value=htmlspecialchars($value);
            $value=strip_tags($value);

            $data[$key] = $value;
        }
        return $data;
    }


    function select($sql,$values,$datatypes){
        $con= $GLOBALS['con'];
        if($stmt = mysqli_prepare($con,$sql)){
            mysqli_stmt_bind_param($stmt,$datatypes,...$values); /// "..." it mean splate operator
            if(mysqli_stmt_execute($stmt)){
                $res =mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            }
            else{
                mysqli_stmt_close($stmt);
                die("Query cannot be Executed -select ");
            }   
        }
        else{
            die("Query cannot be Prepared -select ");
        }
    }

    function selectAll($table){
        $con = $GLOBALS['con'];
        $res = mysqli_query($con,"SELECT * FROM $table");
        return $res;
    }

    function update($sql,$values,$datatypes){
        $con= $GLOBALS['con'];
        if($stmt = mysqli_prepare($con,$sql)){
            mysqli_stmt_bind_param($stmt,$datatypes,...$values); /// "..." it mean splate operator
            if(mysqli_stmt_execute($stmt)){
                $res =mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            }
            else{
                mysqli_stmt_close($stmt);
                die("Query cannot be Executed -update ");
            }  
        }
        else{
            die("Query cannot be Prepared -update ");
        }
    }
    
     function insert($sql,$values,$datatypes){
        $con= $GLOBALS['con'];
        if($stmt = mysqli_prepare($con,$sql)){
            mysqli_stmt_bind_param($stmt,$datatypes,...$values); /// "..." it mean splate operator
            if(mysqli_stmt_execute($stmt)){
                $res =mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            }
            else{
                mysqli_stmt_close($stmt);
                die("Query cannot be Executed -Insert ");
            }  
        }
        else{
            die("Query cannot be Prepared -Insert ");
        }
    }

    function delete($sql,$values,$datatypes){
        $con= $GLOBALS['con'];
        if($stmt = mysqli_prepare($con,$sql)){
            mysqli_stmt_bind_param($stmt,$datatypes,...$values); /// "..." it mean splate operator
            if(mysqli_stmt_execute($stmt)){
                $res =mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            }
            else{
                mysqli_stmt_close($stmt);
                die("Query cannot be Executed -Deleted ");
            }  
        }
        else{
            die("Query cannot be Prepared -Deleted ");
        }
    }
    

     // fetching settings table to check website is shutdown or not
 $settings_q = "SELECT * FROM `settings` WHERE `sr_no`=1";
 $settings_r = mysqli_fetch_assoc(mysqli_query($con,$settings_q));
?>

