<?php
session_start();


 ?>

<!doctype html>
<html>
<head>

  <title>Form assignment</title>

  <link rel="stylesheet" type="text/css" href="../assets/css/forms.css">


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</head>


<body>

  <div class='container'>
    <div class="row forms">
      <div class='col-md-6'>
        <?php

          if($this->session->flashdata('log_errors')){
            echo($this->session->flashdata('log_errors'));
          }
        ?>
        <h2>Log In</h2>
        <form action="/users/login" method="post" class="form-horizontal" role="form">

          <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-10">
              <input  type="text" name="email" class="form-control" id="email" placeholder="Enter Email">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="password">Password:</label>
            <div class="col-sm-10">
              <input  type="password" name="password" class="form-control" id="password" placeholder="Enter password">
            </div>
          </div>




          <div class="form-group">
            <div class=" col-sm-10 ">
              <button type="submit" value="add user!" class="btn btn-primary add button">Login</button>
            </div>
          </div>
        </form>

</div>
<div class='col-md-5 col-md-offset-1 '>
  <?php
  if($this->session->flashdata('reg_errors')){
    echo($this->session->flashdata('reg_errors')[0]);
  }


  ?>
  <h2>Register</h2>
  <form action="/users/register" method="post" class="form-horizontal" role="form">

    <div class="form-group">
      <label class="control-label col-sm-2" for="firstname">First Name:</label>
      <div class="col-sm-10">
        <input  type="name" name="firstname" class="form-control" id="firstname" placeholder="Enter First Name">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="lastname">Last Name:</label>
      <div class="col-sm-10">
        <input  type="name" name="lastname" class="form-control" id="lastname" placeholder="Enter Last Name">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
        <input  type="text" name="email" class="form-control" id="email" placeholder="Enter Email">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="password">Password:</label>
      <div class="col-sm-10">
        <input  type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="confirmpassword">Confirm Password:</label>
      <div class="col-sm-10">
        <input  type="password" name="confirmpassword" class="form-control" id="confirmpassword" placeholder="Confirm Password">
      </div>
    </div>




    <div class="form-group">
      <div class=" col-sm-10 ">
        <button type="submit" value="add user!" class="btn btn-primary add button">Register</button>
      </div>
    </div>
  </form>

</div>
</div>

</div>

</body>
</html>
