<?php
/**
 * Short description for code
 * php version 7.2.10
 * 
 * @category Category_Name
 * @package  PackageName
 * @author   Abhishek Singh <author@example.com>
 * @license  http://www.php.net/license/3_01.txt 
 * @link     http://pear.php.net/package/PackageName 
 * 
 * This is a "Docblock Comment," also known as a "docblock."
 */
if (isset($_POST['submit'])) {
    $city = $_POST['name'];
    //echo $city;
    $key = '9270baa4444aa839eaeecc0357f0837d';
    // $city = 'Lucknow';
    $url = 'api.openweathermap.org/data/2.5/weather/?q='.$city.'&appid='.$key.'';
    //$url  = "api.openweathermap.org/data/2.5/forecast/daily?q='.$city.'&mode=xml&units=metric&cnt=7&appid='.$key.'";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    $res = curl_exec($ch); 
    $result = json_decode($res);
    curl_close($ch);
    // echo '<pre>';
    // print_r($result); 
    // echo '</pre>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forecast</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body style="background-color:LightGray;">
    <div class="container text-center mt-5">
        <h2 class="mb-5" style="color:red;text-decoration:underline;">SEE WEATHER FORECAST OF YOUR CITY</h2>
        <form class="form-group" action="" method="POST">
            <p><input type="text" name="name" placeholder="Enter City Name"></p>
            <input type="submit" class="btn btn-success" name="submit" value="SEE FORECAST">
        </form>
    </div>
    <div class="container-fluid">
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>LONGITUDE</th>
                <th>LATITUDE</th>
                <th>TEMPERATURE</th>
                <th>HUMIDITY</th>
                <th>COUNTRY</th>
                <th>SUNRISE</th>
                <th>SUNSET</th>              
                <th>CITY</th>               
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                if (isset($result)) {
                    foreach ($result as $key1=>$val1) {
                        if ($key1=="coord") {                       
                            foreach ($val1 as $key2=>$val2) {
                                ?>
                                <td><?php echo $val2;?></td>
                                <?php

                            }
                        }
                        if ($key1=="main") {
                            foreach ($val1 as $key2=>$val2) {
                                if ($key2 == "temp") {
                                    ?>
                                    <td><?php echo ($val2-273);?></td>
                                    <?php
                                } 
                                if ($key2 == "humidity") {
                                    ?>
                                    <td><?php echo $val2;?></td>
                                    <?php
                                }                                                
                            }
                        }
                        if ($key1=="sys") {
                            foreach ($val1 as $key2=>$val2) {
                                if ($key2 == "sunrise") {
                                    ?>
                                    <td><?php echo $val2;?></td>
                                    <?php
                                } 
                                if ($key2 == "sunset") {
                                    ?>
                                    <td><?php echo $val2;?></td>
                                    <?php
                                }
                                if ($key2 == "country") {
                                    ?>
                                    <td><?php echo $val2;?></td>
                                    <?php
                                }                                                   
                            }
                        }
                        if ($key1=="name") {
                            ?>
                                <td><?php echo $val1;?></td>
                            <?php
                        }
                    }
                }
                ?>
            </tr>
        </tbody>
    </table>
    </div>
</body>
</html>