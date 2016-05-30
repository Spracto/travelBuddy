<!DOCTYPE html>
<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
        <script>
            $(document).ready(function() {
                $( "#datepicker" ).datepicker({
                    dateFormat: "yy-mm-dd"
                });
                $( "#datepicker1" ).datepicker({
                    dateFormat: "yy-mm-dd"
                });
            });
            </script>
        <meta charset="utf-8">
        <style>
            h1{
                display: inline-block;
            }

            body {
                background-color: #ecf0f1;
            }
        </style>
        <title>Add a trip</title>
    </head>
    <body>
        <div class="container">
            <h1>Add a trip</h1>
            <?php if($this->session->flashdata('trip_errors'))
                    {
                        echo($this->session->flashdata('trip_errors')[0]);
                    } ?>
            <a class="btn pull-right" href="/users/profile">Home</a><a class="btn pull-right" href="/users/log_out">Logout</a>

                <form action="/users/add_trip" method="post">
                    <div class='row'>
                        <div id ="destination" class="form-group col-xs-4">
                            <label for="Destination">Destination</label>
                            <input type="text" class="form-control" placeholder="Destination" name="destination">
                        </div>
                    </div>
                    <div class="row">
                        <div id="description" class="form-group col-xs-4">
                            <label for="Description">Description</label>
                            <input type="text" class="form-control" placeholder="Desccription" name="description">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-2">
                            <label for="Travel Date From">Travel Date From</label>
                            <input type="date" class="form-control" placeholder="Destination" name="start_date">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-2">
                            <label for="Travel Date to">Travel Date to</label>
                            <input type="date" class="form-control" placeholder="Description" name="end_date">
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary col-xs-offset-3" value="Add">
                </form>

            <!-- <script src="http://code.jquery.com/jquery-latest.min.js"></script>
              <script src="js/bootstrap.min.js"></script> -->
          </div>
    </body>
</html>
