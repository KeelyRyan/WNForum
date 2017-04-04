<?php
//signin.php
include 'connect.php';
include 'views/header.php';
include 'functions/helperFunctionsDatabase.php';
include 'functions/helperFunctionsTables.php';
unset($_SESSION['loggedin']);
$_SESSION['loggedin'] = "false";

echo '<h3>Sign in</h3>';

//first, check if the user is already signed in. If that is the case, there is no need to display this page
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
    echo 'You are already signed in, you can <a href="signout.php">sign out</a> if you want.';
}
else
{
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {

          include 'forms\signin.html';

    }
    else
    {
        /* Validate data
           Re-enter data to fields
        */
        $errors = array();

        if(!isset($_POST['user_name']))
        {
            $errors[] = 'The username field must not be empty.';
        }

        if(!isset($_POST['user_password']))
        {
            $errors[] = 'The password field must not be empty.';
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
            // the sha1 function hashes the password
            $user_name=$conn->real_escape_string($_POST['user_name']);
            $password=$conn->real_escape_string(sha1($_POST['user_password']));

            $sqlData = "SELECT user_id, user_name, user_level
                    FROM users
                    WHERE user_name = '$user_name' AND user_password = '$password'";
          $result = mysqli_query($conn,$sqlData);

                    if(!$result)
                    {
                        //something went wrong, display the error
                        echo 'Error signing in. Please try again.';

                    }
                //the query was successfully executedg
                else {
                    //set the $_SESSION['signed_in'] variable to TRUE
                    $_SESSION['signed_in'] = true;


                    //Add the user_id and user_name values in the $_SESSION
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $_SESSION['user_id']    = $row['user_id'];
                        $_SESSION['user_name']  = $row['user_name'];
                        $_SESSION['user_level'] = $row['user_level'];
                      }

                    header('Location: signedIn.php');

            }
}

        }
    }

include 'views/footer.php';
?>
