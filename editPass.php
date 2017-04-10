<?php
include 'connect.php';
include 'views/header.php';
include 'functions/helperFunctionsDatabase.php';


if($_SERVER['REQUEST_METHOD'] != 'POST')
{
include 'forms/updatePassword.html';
}
else
{
    $errors = array();

    if(isset($_POST['user_password_new']))
    {
        if($_POST['user_password_new'] != $_POST['user_pass_check'])
        {
            $errors[] = 'The two passwords did not match.';
        }
    }
    else
    {
        $errors[] = 'The password field cannot be empty.';
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
      $user_pass=$conn->real_escape_string(sha1($_POST['user_password']));
      $user_pass_new=$conn->real_escape_string(sha1($_POST['user_password_new']));

      $user_id=($_SESSION['user_id']);
      $sql = "UPDATE users
              SET user_password = '$user_pass_new'
              WHERE user_id = $user_id AND user_password = '$user_pass';";

      if(query($conn,$sql)==1)
      {
          echo 'Password successfully changed.';
      }
        else{
          //something went wrong, display the error
          echo 'Something went wrong while registering. Please try again later.';
          // '$error = mysqli_error($conn)'; //debugging purposes, uncomment when needed

        }
      }
    }
include 'views/footer.php';
?>
