<?php
include("dbhelper.php");
session_start();

$total = 0;

$five_pm_sql = "SELECT original_amount FROM `transaction` 
                WHERE `date` = '" . $_SESSION['date'] . "'
                    AND (
                        TIME_FORMAT(`time`, '%h:%i:%s %p') >= '02:00:00 PM'
                        AND TIME_FORMAT(`time`, '%h:%i:%s %p') < '05:00:00 PM'
                    ) group by `number_id`";
$five_pm_query = mysqli_query(connect(),$five_pm_sql);

if (mysqli_num_rows($five_pm_query)>0) {
    while($row = mysqli_fetch_assoc($five_pm_query)){
        $total += $row['original_amount'];
    }

    if($total==0){
        echo "0.00";
    }else{
        echo $total . ".00";
    }
    
} else {
    echo "0.00";
}
