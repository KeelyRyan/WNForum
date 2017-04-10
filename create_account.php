<?php
include 'connect.php';
include 'views/header.php';
include 'functions/helperFunctionsDatabase.php';

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
  include 'forms/Create_User.html';
}
else
{
    $errors = array();

    if(isset($_POST['user_name']))
    {
        //the user name exists
        if(!ctype_alnum($_POST['user_name']))
        {
            $errors[] = 'The username can only contain letters and digits.';
        }
        if(strlen($_POST['user_name']) > 45)
        {
            $errors[] = 'The username cannot be longer than 45 characters.';
        }
    }
    else
    {
        $errors[] = 'The username field must not be empty.';
    }


    if(isset($_POST['user_password']))
    {
        if($_POST['user_password'] != $_POST['user_pass_check'])
        {
            $errors[] = 'The two passwords did not match.';
        }
    }
    else
    {
        $errors[] = 'The password field cannot be empty.';
    }

        if(!isset($_POST['security_answer']))
        {

            $errors[] = 'The security question must be answered.';
        }

    if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
    {
        echo 'Uh-oh.. a couple of fields are not filled in correctly..';
        echo '<ul>';
        foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
        {
            echo '<li>' . $value . '</li>'; /* this generates a nice error list */
        }
        echo '</ul>';
    }
    else
    {
        $user_name=$conn->real_escape_string($_POST['user_name']);
        $Fname=$conn->real_escape_string($_POST['Fname']);
        $Surname=$conn->real_escape_string($_POST['Surname']);
        $password=$conn->real_escape_string(sha1($_POST['user_password']));
        $user_email=$conn->real_escape_string($_POST['user_email']);
        $security_answer=$conn->real_escape_string($_POST['security_answer']);

        $sql = "INSERT INTO
                    users(user_name, user_password, user_email ,user_date, user_level,  fname, surname, securityQ)
                VALUES('$user_name', '$password', '$user_email', NOW(), 0, '$Fname', '$Surname', '$security_answer')";

        if(query($conn,$sql)==1)
        {
            echo 'Successfully registered. You can now <a href="signin.php">sign in</a> and start posting! :-)';
        }
        else
        {
          //Check is user name is free.
          $error = mysqli_error($conn);
          if ($error == "Duplicate entry '$user_name' for key 'user_name_UNIQUE'"){
          echo 'User name is already in use, plese try something else';
        }
          else{
            //something went wrong, display the error
            echo 'Something went wrong while registering. Please try again later.';
            // '$error = mysqli_error($conn)'; //debugging purposes, uncomment when needed

          }
        }
    }
}

include 'views/footer.php';
?>
