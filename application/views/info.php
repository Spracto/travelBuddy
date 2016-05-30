<!DOCTYPE html>
<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <meta charset="utf-8">
        <style>
            #destination_info{
                margin-top: 90px;
                margin-bottom: 50px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <a class="btn pull-right" href="/profile">Home</a><a class="btn pull-right" href="#">Logout</a>
            <div id="destination_info">
                <h3><?= $trip_info[0]['destination'] ?></h3>

                    <p>Planned by: <?= $trip_info[0]['first_name'] ?> <?= $trip_info[0]['last_name']?></p>
                    <p>Description: <?= $trip_info[0]['description'] ?></p>
                    <p>Travel Date From: <?= $trip_info[0]['start_date'] ?></p>
                    <p>Travel Date to: <?= $trip_info[0]['end_date'] ?></p>



            </div>
            <div id="other_users">
                <h3>Other users Joining the trip</h3>
                <?php foreach($trip_info as $key => $users)
                        {
                            if($key > 0)
                                {
                 ?>
                                <ul>
                                    <li><?= $users['first_name'] ?></li>
                                </ul>

                <?php           }
                        }
                ?>
            </div>
        </div>
    </body>
