<doctype html>
    <html>
    <head>
        <!-- the meta tags -->
        <meta charset="utf-8">
        <meta name="author" content="Jordan Garcia">
        <meta name="description" content="Buscador de climas">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width-devuce-widht, initial-scale=1">
        <meta http-equiv="content-language" content="EN"/>
        <!-- the icon of the page -->
        <title>Jordan Weather</title>
        <!-- the link tags -->
        <link rel="stylesheet" type="text/css" href="main.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
              crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Styles -->
        <style>

            .container {
                background-image: url(bg.jpg);
                width: 100%;
                height: 100%;
                background-size: cover;
                background-position: center;
                padding-top: 180px;
            }

            .center {
                text-align: center;
                align-items: center;
            }

            p {
                padding-bottom: 30px;
            }

            button {
                margin-top: 15px;
            }

            .search {

                border-radius: 25px 0 25px 0;
                border-bottom: 5px solid #61656B;
            }

        </style>
    </head>
    <body>
    <!-- the page body -->
    <!-- form -->

    <div class="container center">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-12">

                <h1>WEATHER API</h1>
                <p class="lead">Enter a city :</p>
                <form>
                    <div class="form-group ">
                        <input type="text" autocomplete="off" class="form-control search search-box" name="city"
                               placeholder="Ej. Miami, New York, Orlando...">
                    </div>
                    <button class="btn btn-success btn-lg">Search</button>

                </form>

            </div>
        </div>

        <div class="row">
            <?php

            error_reporting(0);
            //get the city name
            $location = strtolower($_GET['city']);

            $apiKey = "b17d222b3f223b119c6fdb7609a07a01";
            $city = str_replace(" ", "%20", $location);

            if (($_GET['city']) == false) {

                $contents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q='.$city .'&lang=en&units=metric&APPID='.$apiKey");
                preg_match('/<span class="phrase">(.*?)</s', $contents, $matches);

                echo "<br>";
                echo '<span style="color:#28a745;
                font-size: 35px;
                font-weight: 900;
                margin:10px 0px;
                text-shadow: 5px 8px rgba(0,0,0,0.3);
                text-align:center;border-bottom: 5px solid #28a745;">' . $city . '</span>';
                echo "<br>";

                echo '<span style="color:#fff;
                font-size: 20px;
                font-weight: 900;
                margin:10px 0px;
                text-shadow: 2px 8px rgba(0,0,0,0.4);border:solid 1px">' . print_r($matches) . '</span>';
            } else {
                $contents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=$city&lang=en&units=metric&APPID=$apiKey");
                $data = json_decode($contents);
                preg_match('/<span class="phrase">(.*?)</s', $contents, $matches);

                ?>
                <div class="container" style="margin-top: -12%;">

                    <div class="col-sm-15">
                        <div class="currentStats">
                            <h3 style="text-align: center;"><?php echo $data->name . "," . $data->sys->country; ?></h3>

                            <h3><span class="headingstats">
   <i style="font-size: 1em; vertical-align: middle;" class="wi wi-thermometer"></i>
   <img id="wicon" src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png"
        alt="Weather icon"><?php echo round($data->main->temp); ?>°C
<i style="font-size: 1.5em; vertical-align: middle;" class="wi wi-celsius"></i></span>


                                <span class="pull-right"
                                      style="font-size: 0.7em;"><?php echo $data->weather[0]->description; ?>
                                    <span class="ic_container"><i style="font-size: 1.3em;" class="wi wi-day-sunny"></i></span>


   </span></h3>

                            <div class="col-sm-12"></div>


                            <div style="">
                                <div class="col-sm-12" style="padding-right: 2px;font-size: 0.86em;">
                                    <span class="top_small_data"
                                          style="font-size: 1.1em;">Feels like: <?php echo $data->main->temp; ?> <i
                                                style="vertical-align: middle;" class="wi wi-celsius"></i></span>
                                </div>
                            </div>


                            <div class="col-sm-12"></div>

                            <hr>
                            <li><span class="wfproperty">Humidity:</span> <span
                                        class="wfvalue pull-right"><?php echo $data->main->humidity; ?>%  <i
                                            class="wi wi-humidity"></i></span></li>
                            <li><span class="wfproperty">Condition Now:</span> <span
                                        class="wfvalue pull-right"><?php echo $data->weather[0]->main; ?> sky <i
                                            class="wi wi-day-sunny circle-icon"></i></span></li>
                            <li><span class="wfproperty">Pressure:</span> <span
                                        class="wfvalue pull-right"><?php echo $data->main->pressure; ?> hPa  <i
                                            class="wi wi-barometer"></i></span></li>


                            <li><span class="wfproperty">Wind speed:</span> <span
                                        class="wfvalue pull-right"><?php echo $data->wind->speed; ?> km/hour   <i
                                            class="wi wi-strong-wind"></i></span></li>

                            <li><span class="wfproperty">Wind direction:</span> <span
                                        class="wfvalue pull-right"><?php echo $data->wind->deg; ?><i
                                            style="font-size: 1.2em;" class="wi wi-degrees"></i> <i
                                            class="wi wi-wind-direction"
                                            style="transform: rotate(<?php echo $data->wind->deg; ?>deg);"></i></span>
                            </li>
                            <li><span class="wfproperty">Visibility:</span> <span
                                        class="wfvalue pull-right"><?php echo $data->visibility; ?>km <i
                                            class="wi wi-alien"></i></span></li>
                        </div>


                    </div>

                    <footer>
                        <div class="col-sm-7">Jordan García @ All right reserve</div>
                        <div class="col-sm-5"></div>
                    </footer>
                </div>

                <?php
            }

            ?>

        </div>

    </div>

    <!-- js you need -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <!--.../js you need -->
    <script src="main.js"></script>

    </body>

    </html>