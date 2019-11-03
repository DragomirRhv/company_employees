<?php 
    session_start();
    require_once "config/db.php";
    require_once "config/settings.php";
    require_once "functions/functions.php";

    $sql = " SELECT 
            staff.first_name,
            staff.last_name,
            currency.currency_name,
            staff_position.position_name,
            staff.salary,
            staff.birth_date,
            staff.gender,
            staff.image
            FROM `staff` JOIN `currency`
            ON staff.currency_id = currency.id 
            JOIN staff_position 
            ON staff.position_id = staff_position.id
    ";
    $staff = [];
    if($result = mysqli_query($conn, $sql)) {
        while($row = mysqli_fetch_assoc($result)){
            $staff[] = $row;
        }
    }
    
    echo json_encode($staff);
?>