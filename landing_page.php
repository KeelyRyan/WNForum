<?php
include 'connect.php';
include 'views/header.php';
include 'functions\helperFunctionsDatabase.php';
include 'functions\helperFunctionsTables.php';


$sql = "SELECT cat_id, cat_name, cat_description FROM categories";

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
        //prepare the table
        echo '<table border="1">
              <tr>
                <th>Category</th>
                <th>Last topic</th>
              </tr>';

        while($row = mysqli_fetch_assoc($result))
        {
            echo '<tr>';
                echo '<td class="leftpart">';
                    echo '<h3><a href="category.php?id=' . $row['cat_id'] . '">' . $row['cat_name'] . '</a><h3>'. $row['cat_description'];
                echo '</td>';
                echo '<td class="rightpart">';
    //fetch last topic for each cat
                        $topicsql = "SELECT
                                        topic_id,
                                        topic_subject,
                                        topic_date,
                                        topic_cat_id
                                    FROM
                                        topics
                                    WHERE
                                        topic_cat_id = " . $row['cat_id'] . "
                                    ORDER BY
                                        topic_date
                                    DESC
                                    LIMIT
                                        1";

                        $topicsresult = mysqli_query($conn, $topicsql);

                        if(!$topicsresult)
                        {
                            echo 'Last topic could not be displayed.';
                        }
                        else
                        {
                            if(mysqli_num_rows($topicsresult) == 0)
                            {
                                echo 'no topics';
                            }
                            else
                            {
                                while($topicrow = mysqli_fetch_assoc($topicsresult))
                                echo '<a href="topic.php?id=' . $topicrow['topic_id'] . '">' . $topicrow['topic_subject'] . '</a> <br> on ' . date('d-m-Y', strtotime($topicrow['topic_date']));
                            }
                        }

                echo '</td>';
            echo '</tr>';
        }
    echo'</table>';
  }
}

include 'views/footer.php';
?>
