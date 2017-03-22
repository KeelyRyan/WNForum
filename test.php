<?php
include 'connect.php';
include 'views/header.php';


$sql = "SELECT* FROM categories";

$result = mysqli_query($conn,$sql);

if(!$result)
{
    echo 'The categories could not be displayed, please try again later.';
}
else
{
    if(mysqli_num_rows($result) == 0)
    {
        echo 'No categories defined yet.';
    }
    else
       {
            echo ' <tr>
                    <th>Category</th>
                    <th>Last topic</th>
                  </tr>';

      }

}

include 'views/footer.php';
?>
