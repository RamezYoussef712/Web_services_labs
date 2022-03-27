<?php
require("autoload.php");
ini_set('memory_limit', '-1');
$weather = new Weather();
$egyptian_cities = $weather->get_cities();
// if (isset($_POST[""])) {
  
// }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="" method="get">
            <label for="city">Choose City</label> <br/>
            <select name="city" id="city">
                <?php
                foreach($egyptian_cities as $city){
                    echo "<option value='$city[id]'>$city[name]</option>";
                }
                ?>
            </select>
            <button type="submit">Show Weather</button>
            <?php
                if(isset($_GET["city"])){
                    $current_weather = json_decode($weather->get_weather($_GET['city']), true);
                    $current_time = $weather->get_current_time();
                    
                    $x = explode("  ", $current_time);
                    $icon_id = $current_weather['weather'][0]['icon'];
                    $icon_url = "http://openweathermap.org/img/wn/$icon_id@2x.png"; 
                    ?>

            <div>
                <h2><?= $current_weather['name'] ?> Weather Status</h2>
                <p>
                    <?= $x[0] ?>
                    </br>
                    <?= $x[2] ?>
                </p>
                <img src="<?= $icon_url ?>">
                <p> <?= $current_weather['weather'][0]['description'] ?></p>
                <p> <?= $current_weather['main']['temp_min'] ?>&degC - <?= $current_weather['main']['temp_max'] ?>&degC</p>
                <p> Humidity: <?= $current_weather['main']['humidity'] ?>%</p>
                <p> Wind: <?= round(($current_weather['wind']['speed']) * 3.6, 2) ?> km/h</p>
            </div>
            <?php
                }
            ?>
        </form>
    </body>
</html>
