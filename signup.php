<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sginup</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/pidie-0.0.8.css">
  <body>
    <div class="row">
      <div class="col-sm-12">
        <div class="well">
          <center><h1 style="color: white;">WeShare</h1></center>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="main-content">
          <div class="header">
            <h3 style="text-align: center;"><strong>Join WeShare</strong></h3><hr/>
          </div>
          <div class="l-part">
            <form class="" action="" method="post">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                <input type="text" name="first_name" class="form-control" placeholder="First Name" required="required">
              </div><br/>
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                <input type="text" name="last_name" class="form-control" placeholder="Last Name" required="required">
              </div><br/>
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="password" id="password" name="u_pass" class="form-control" placeholder="Password" required="required">
              </div><br/>
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input id="email" type="email" name="u_email" class="form-control" placeholder="Email" required="required">
              </div><br/>
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
                <select class="form-control pd-countries" name="u_country" required></select>
              </div><br/>
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
                <select class="form-control input-md" name="u_gender" required>
                  <option disabled>Select your Gender</option>
                  <option>Male</option>
                  <option>Female</option>
                  <option>Others</option>
                </select>
              </div><br/>
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                <input type="date" name="u_birthday" class="form-control input-md" placeholder="Birthday" required="required">
              </div><br/>
              <a href="signin.php" style="text-decoration: none; float: right; color: #187FAB;" data-toggle="tooltip" title="Sginin">Already have an account?</a><br/><br/>
              <center><button id="signup" class="btn btn-info btn-lg" name="sign_up">Signup</button></center>
              <?php include 'insert_user.php'; ?>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="style/pidie-0.0.8.js"></script>
    <script type="text/javascript">
      new Pidie();
    </script>
  </body>
</html>
