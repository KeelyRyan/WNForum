<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="A short description." />
    <meta name="keywords" content="write now, writing, forum, fyp" />
    <meta name="author" content="Keely Ryan">
    <title>WriteNow Forum</title>
    <link rel="icon" href="images/title.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css" type="text/css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <div id="container fliuid">
		<div class="row">
			<div class="col-sm-9">
        <nav class="navbar navbar-default">
            <div class="navbar-header">
              <a class="navbar-brand" href="index.php">WriteNow!</a>
            </div>
            <ul class="nav navbar-nav">
              <li class="active"><a href="landing_page.php">WriteNow Forum</a></li>
              <li><a href="create_cat.php">Categories</a></li>
              <li><a href="create_topic.php">Topics</a></li>
              <li><a href="#">Page 3</a></li>
            </ul>
        </nav>
      </div>
      <div class="col-sm-3">
        <nav class="navbar navbar-default">
            <div class="navbar-header">
              <a><?php
              session_start();
              if($_SESSION['loggedin'])
              {
                echo 'Hello ' . $_SESSION['user_name'] . '. Not you? <a href="signout.php">Sign out</a>';
              }
              else
              {
                echo '<a href="signin.php">Sign in</a> or <a href="create_account.php">Create an account</a>.';
              }
              ?></a>
            </div>
        </nav>
      </div>
    </div>
<div id="content">
