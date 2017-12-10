<?php
/**
 * Created by PhpStorm.
 * User: muhib
 * Date: 11/27/17
 * Time: 1:13 AM
 */
function generateRandomString()  {
    $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $digits = '1234567890';
    $randomString = '';
    for ($i = 0; $i < 3; $i++) {
        $randomString .= $letters[rand(0, strlen($letters) - 1)];
    }
    for ($i = 0; $i < 3; $i++) {
        $randomString .= $digits[rand(0, strlen($digits) - 1)];
    }
    return $randomString;
}

function print_table($result){
    if(mysqli_num_rows($result)>0){
        echo "<table border='1'>";
        $i=0;

        echo "<tr>";
        while($i<mysqli_num_fields($result)){
            $column=mysqli_fetch_field_direct($result,$i);
            $columnName=$column->name;
            echo "<th>$columnName</th>";
            $i+=1;
        }
        echo "</tr>";

        while ($row=mysqli_fetch_assoc($result)){
            echo "<tr>";
            foreach($row as $data){
                echo "<td>$data</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
}

