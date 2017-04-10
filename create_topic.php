<?php
//create_cat.php
include 'connect.php';
include 'views/header.php';

echo '<div class="row"> <div class="col-sm-6">';

if(isset($_SESSION['signed_in']) == false)
{
    //the user is not signed in
    echo '<h3> Sorry, you need to <a href="signin.php">sign in</a> or <br><a href="/forum/create_account.php">create an account</a> to create a topic! </h3> ';
}
else
{
  echo '<h2>Create a Topic</h2>';
    //the user is signed in
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {
        //the form hasn't been posted yet, display it
        //retrieve the categories from the database for use in the dropdown
        $sql = "SELECT
                    cat_id,
                    cat_name,
                    cat_description
                FROM
                    categories";

        $result = mysqli_query($conn,$sql);

        if(!$result)
        {
            //the query failed, uh-oh :-(
            echo 'Error while selecting from database. Please try again later.';
        }
        else
        {
            if(mysqli_num_rows($result) == 0)
            {
                //there are no categories, so a topic can't be posted
                if($_SESSION['user_level'] == 1)
                {
                    echo 'You have not created categories yet.';
                }
                else
                {
                    echo 'Before you can post a topic, you must wait for an admin to create some categories.';
                }
            }
            else
            {

                echo '<form method="post" action="">
                    Subject: <input type="text" name="topic_subject" />
                    Category:';

                echo '<select name="topic_cat">';
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
                    }
                echo '</select>';
                  echo '<br>';
                echo 'Message: <br>';
                echo '<textarea name="post_content" /></textarea> <br>
                    <input type="submit" value="Create topic" />
                 </form>';
            }
        }
    }
    else
    {
        //start the transaction
        $query  = "BEGIN WORK;";
        $result = mysqli_query($conn, $query);

        if(!$result)
        {
            echo 'An error occured while creating your topic. Please try again later.';
        }
        else
        {
            //Insert the topic into the topics table first
            $topic_subject=$conn->real_escape_string($_POST['topic_subject']);
            $topic_cat=$conn->real_escape_string($_POST['topic_cat']);
            $user_name =$_SESSION['user_id'];
            $sql = "INSERT INTO
                        topics(topic_subject,
                               topic_date,
                               topic_cat_id,
                               topic_user_id)
                   VALUES('$topic_subject', NOW(), '$topic_cat', '$user_name')";

            $result = mysqli_query($conn, $sql);
            if(!$result)
            {
                //Error, roll back
                echo 'An error occured while inserting your data. Please try again later.' . mysqli_error($conn);
                $sql = "ROLLBACK;";
                $result = mysqli_query($conn, $sql);
            }
            else
            {
                //Second query, retrieve the id of the just created topic to use in the posts query
                $topicid = mysqli_insert_id($conn);
                $post_content=$conn->real_escape_string($_POST['post_content']);
                $user_name =$_SESSION['user_id'];


                $sql = "INSERT INTO
                            posts(post_content,
                                  post_date,
                                  posted_by,
                                  post_cat_id,
                                  post_topic_id)
                        VALUES
                            ('$post_content', NOW(), '$user_name','$topic_cat',$topicid)";
                $result = mysqli_query($conn, $sql);

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

                    echo 'You have successfully created <a href="topic.php?id='. $topicid . '">your new topic</a>.';
                }
            }
        }
    }
}
echo '</div>
<br><br><br>
<div class="col-sm-6"> <img src="images/logo.png" alt="Write Now logo"> </div></div>';

include 'views/footer.php';
?>
