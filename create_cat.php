<?php
//create_cat.php
include 'connect.php';
include 'views/header.php';

if ($_SESSION['user_level']==1){

include 'forms/new_category.html';

$cat_name=$conn->real_escape_string($_POST['cat_name']);
$cat_description=$conn->real_escape_string($_POST['cat_description']);

    //the form has been posted, so save it
    $sql = "INSERT INTO categories(cat_name, cat_description)
       VALUES('$cat_name' , '$cat_description')";
    $result = mysqli_query($conn,$sql);
    if(!$result)
    {
        //something went wrong, display the error
        echo 'Error' . mysql_error();
    }
    else
    {
        echo 'New category successfully added.';
    }
}

else
{
    echo 'Only the admin can create a category.';
}
include 'views/footer.php';
?>
