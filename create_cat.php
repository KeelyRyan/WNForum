<?php
//create_cat.php
include 'connect.php';
include 'views/header.php';
if(isset($_POST['user_level'])==true){
if ($_SESSION['user_level']==1){
  if(isset($_POST['cat_description']))
  {
$cat_name=$conn->real_escape_string($_POST['cat_name']);
$cat_description=$conn->real_escape_string($_POST['cat_description']);

    $sql = "INSERT INTO categories(cat_name, cat_description)
       VALUES('$cat_name' , '$cat_description')";
    $result = mysqli_query($conn,$sql);
    if(!$result)
    {
        echo 'Error' . mysql_error();
    }
    else
    {
        echo 'New category successfully added.';
    }
}
}

else
{
    echo '<h3>Only the admin can create a category.</h3>';
}

include 'forms/new_category.html';
}
else
{
    echo '<h3> Sorry, you have to be <a href="/forum/signin.php">signed in</a> to access this area! </h3> ';
}
include 'views/footer.php';
?>
