<?php
//create_cat.php
include 'connect.php';
include 'views/header.php';
echo '<div class="row"> <div class="col-sm-6">';
if(isset($_SESSION['user_level'])==true){
if ($_SESSION['user_level']==1){
  echo '<h2>Create a Category</h2>';
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
        echo 'New category successfully added. <br>';
    }
}
}


include 'forms/new_category.html';
}
else
{
    echo '<br> <br> <h3> Sorry, you need to be <a href="signin.php">signed in</a> and an administrator to <br> create a category! </h3> ';
}

echo '</div> <br><br><div class="col-sm-6"> <img src="images/logo.png" alt="Write Now logo"> </div></div>';
include 'views/footer.php';
?>
