<?php
//create_cat.php
include 'connect.php';
include 'views/header.php';

//first select the category based on $_GET['cat_id']

$topic_id=$conn->real_escape_string($_GET['id']);

$post_topic = $conn->real_escape_string($_GET['id']);
$sql = "SELECT
    topic_id,
    topic_subject
FROM
    topics
WHERE
    topics.topic_id = $post_topic";

$result = mysqli_query($conn, $sql);

if(!$result)
{
    echo 'The topic could not be displayed, please try again later.' . mysqli_error($conn);
}
else
{
    if(mysqli_num_rows($result) == 0)
    {
        echo 'This topic does not exist.';
    }
    else
    {

        //do a query for the topics
        $post_topic = $conn->real_escape_string($_GET['id']);
        $sql = "SELECT
	posts.post_topic_id,
    posts.post_content,
    posts.post_date,
    posts.posted_by,
    users.user_id,
    users.user_name
FROM
    posts
inner JOIN
    users
ON
    posts.posted_by = users.user_id
WHERE
    posts.post_topic_id = $post_topic";


        $result = mysqli_query($conn, $sql);

        if(!$result)
        {
            echo 'The topics could not be displayed, please try again later.';
        }
        else
        {
            if(mysqli_num_rows($result) == 0)
            {
                echo 'There are no topics in this category yet.';
            }
           else {
                  //prepare the table
                  echo '<table border="1">
                        <tr>
                          <th></th>
                          <th>' . $row['topic_subject'] . '</th>
                        </tr>';

                  while($row = mysqli_fetch_assoc($result))
                  {
                      echo '<tr>';
                          echo '<td class="leftpart">';
                              echo '<h3><a href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a><h3>';
                          echo '</td>';
                          echo '<td class="rightpart">';
                              echo date('d-m-Y', strtotime($row['topic_date']));
                          echo '</td>';
                      echo '</tr>';
                  }
                    echo'</table>';
              }
}}}
include 'views/footer.php';

?>
