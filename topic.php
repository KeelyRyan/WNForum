<?php
//create_cat.php
include 'connect.php';
include 'views/header.php';



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
    while($row = mysqli_fetch_assoc($result)) {   $topic_subject = $row['topic_subject'];}
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
inner JOIN
topics
ON
posts.post_topic_id = topics.topic_id
WHERE
    posts.post_topic_id = $post_topic";


        $result = mysqli_query($conn, $sql);

        if(!$result)
        {
            echo 'The posts could not be displayed, please try again later.';
        }
        else
        {
            if(mysqli_num_rows($result) == 0)
            {
                echo 'There are no posts for this topic yet.';
            }
           else {

                  //prepare the table
                        echo '<table border="1">
                              <tr>
                                <th>'. $topic_subject .' </th>
                                <th></th>
                              </tr>';

             while($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                          echo '<td class="leftpart">';
                              echo '<h3>' . $row['post_content'] . '<h3>';
                          echo '</td>';
                          echo '<td class="rightpart">';
                          echo '<h6>' . $row['user_name'] . '<h6>';
                              echo date('d-m-Y', strtotime($row['post_date']));
                          echo '</td>';
                      echo '</tr>';
}
                    echo'</table>';

}
include 'forms/reply.html';

    //check for sign in status
    if(!$_SESSION['signed_in'])
    {
        echo 'You must be signed in to post a reply.';
    }
    else
    {
      if(isset($_POST['cat_description']))
      {
      $topic_id= $conn->real_escape_string($_GET['id']);
      $content=$conn->real_escape_string($_POST['reply_content']);
      $user_id=$_SESSION['user_id'];
        //a real user posted a real reply
        $sql = "INSERT INTO
                    posts(post_content,
                          post_date,
                          post_topic_id,
                          posted_by)

                VALUES ('$content',
                        NOW(),
                        $topic_id,
                        $user_id)";

                        if(!$result)
                        {
                            //Error
                            echo 'An error occured while inserting your post. Please try again later.' . mysqli_error($conn);
                            $sql = "ROLLBACK;";
                            $result = mysqli_query($conn, $sql);
                        }
                        else
                        {
                            $sql = "COMMIT;";
                            $result = mysqli_query($conn, $sql);

                            echo 'You have successfully created <a href="topic.php?id='. $topicid . '">back to topic</a>.';
                        }

      }
    }

}}}

include 'views/footer.php';

?>
