<!DOCTYPE html>
<html>
  <head>
    <title>Test App</title>
    <!--Jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

  <style>
    .main {
      margin-top: 80px;
    }

    body {
        background-color: #ecf0f1;
    }

    .button {
      margin-left: 85%;
    }

    .register{
      margin-top:20px;
    }

    .top {
      margin-bottom: 25px;
    }

    .button2 {
      margin-left: 65%;
    }


  </style>
  </head>
  <body>
<div class="container main">
  <div class="row top">
      <a href="/users/log_out" class='btn btn-primary pull-right'>Logout</a>
    <div class="col-md-5  col-md-offset-2">
      <h1>Hello <?= $this->session->userdata['name'] ?> </h1>
    </div>
</div>

  <div class="row">
      <div class="col-md-8">
        <div class="submit">
          <h4>Your trip schedules:</h4> <?php  ?>
          <?php if($this->session->flashdata('trip_joined')){ echo "<h2>You're going to ".$this->session->flashdata('trip_joined')."!</h2>";} ?>
        </div>
      </div>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>destination</td>
                <td>travel start date</td>
                <td>travel end date</td>
                <td>plan</td>
                <td>Undo</td>

            </tr>
        </thead>
        <tbody>
                <?php
                    foreach ($users_trips as $key => $info)
                    {
                ?>
                         <tr>
                             <td><a href='info/<?= $info['id'] ?>'><?= $info['destination'] ?></a></td>
                             <td><?=$info['start_date'] ?></td>
                             <td><?= $info['end_date'] ?></td>
                             <td><?= $info['description'] ?></td>
                             <td><a href="cancel_trip/<?= $info['id'] ?>" class='btn btn-danger'>Cancel trip</a></td>
                         </tr>
                <?php
                    }
                ?>

        </tbody>
    </table>
    <p>Other users Travel plans:</p>
    <?php  ?>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>Name</td>
                <td>destination</td>
                <td>travel start date</td>
                <td>travel end date</td>
                <td>Do you want to join?</td>
            </tr>
        </thead>
        <tbody>
            <?php
                 foreach ($other_users_trips as $key => $trip)
                {
            ?>
                    <tr>
                        <td><?= $trip['creator'] ?></td>
                        <td><a href='info/<?= $trip['trip_id']?>'><?= $trip['destination'] ?></td>
                        <td><?= $trip['start_date'] ?></td>
                        <td><?= $trip['end_date'] ?></td>
                        <td><a href='join/<?= $trip['trip_id'] ?>'>Join</a></td>
                    </tr>
            <?php
                }
            ?>

        </tbody>
    </table>
    <a class="btn btn-default pull-right" href="add">Add Travel plan</a>
</div>

  </body>

</html>
