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
    $key = '9270baa4444aa839eaeecc0357f0837d';
    $url = 'api.openweathermap.org/data/2.5/weather/?q='.$city.'&appid='.$key.'';
   
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    $res = curl_exec($ch); 
    $result = json_decode($res);
    curl_close($ch);

    $lat = $result->coord->lat;
    $lon = $result->coord->lon;
    //echo $lat;

    $url2 = "https://api.openweathermap.org/data/2.5/onecall?lat=".$lat."&lon=".$lon."&exclude=minutely,hourly&units=metric&appid=".$key."";
    $ch1 = curl_init();
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch1, CURLOPT_URL, $url2); 
    $res1 = curl_exec($ch1); 
    $result1 = json_decode($res1);
    curl_close($ch1);

} else {
    //echo "No Data Found !";
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
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">  
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="/DataTables/datatables.css">
    <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>
</head>
<body style="background-color:LightGray;">
    <div class="container text-center mt-5">
        <h2 class="mb-5" style="color:red;text-decoration:underline;">SEE WEATHER FORECAST OF YOUR CITY</h2>
        <form class="form-group" action="" method="POST">
            <p><input type="text" id="nam" name="name" placeholder="Enter City Name"></p>
            <input type="submit" class="btn btn-success" id="sub" name="submit" value="SEE FORECAST">
        </form>
    </div>
    <div class="container-fluid">
    <table class="table table-bordered" id="display">
        <thead class="thead-dark">
            <tr>                          
                <th>LONGITUDE</th>
                <th>LATITUDE</th>
                <th>DATE</th>    
                <th>TEMPERATURE</th>
                <th>PRESSURE</th>
                <th>HUMIDITY</th>
                <th>VISIBILTY</th>
                <th>CITY</th>
                <th>COUNTRY</th>                          
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($result1)) {
                foreach ($result1->daily as $key=>$val2) {
                    echo '<tr>';
                    echo '<td>'.$result1->lat.'</td>';
                    echo '<td>'.$result1->lon.'</td>';
                    echo '<td>'.date('l F\'y, d', $val2->dt).'</td>'; 
                    echo '<td>'.$val2->temp->max.'</td>';
                    echo '<td>'.$val2->pressure.'</td>';
                    echo '<td>'.$val2->humidity.'</td>';
                    echo '<td>'.$result1->current->visibility.'</td>';
                    echo '<td>'.$result->name.'</td>';
                    echo '<td>'.$result->sys->country.'</td>';
                    echo '</tr>';
                }
            }            
            ?>
        </tbody>
    </table>
    </div>
    <script>
    $(document).ready(function(){
        $('#display').DataTable();

        $("#sub").click(function(){
            var name = $("#nam").val();
            if (name=='') {
                alert("Please Enter Location!")
                return false;
            }
        })
    });
</script>
</body>
</html>
