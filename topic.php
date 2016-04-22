<?php
include 'connect.php';
include 'header.php';

$sql = "SELECT
    		topic_id,
    		topic_subject
		FROM
    		topics
		WHERE
    		topics.topic_id = '" . mysql_real_escape_string($_GET['id']) ."'
		";
			
$result = mysql_query($sql); 
if(!$result)
{
	echo 'The topic could not be displayed, please try again later.' . mysql_error();
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo 'This category does not exist.';
	}
	else
	{
		$row = mysql_fetch_assoc($result);
		echo '<h2>Comments in ′' . $row['topic_subject'] . '′</h2>';
		
		$sql = "SELECT
				posts.post_id,
    				posts.post_topic,
    				posts.post_content,
    				posts.post_date,
    				posts.post_by,
    				users.user_id,
    				users.user_name
				FROM
    				posts
				LEFT JOIN
    				users
				ON
    				posts.post_by = users.user_id
				WHERE
    				posts.post_topic = '" . mysql_real_escape_string($_GET['id']) ."'
					";
		
		$result = mysql_query($sql);
		if(!$result)
		{
			echo 'The posts could not be displayed, please try again later.';
		}
		else
		{
       
    //    $num=mysql_num_rows($result);
        echo '<table border="1">';
        echo '<tr>';
            echo'<th></th>';
        echo '</tr>';  
        while($row = mysql_fetch_assoc($result))
            {   
		//$row = mysql_fetch_assoc($result);               
 		echo '<tr>';
                    echo '<td class="rightpart">';
                        echo '<b>'.$row["user_name"].'</b><br>'.date(($row["post_date"]));
                    echo '<td class="leftpart">';
                        echo $row['post_content'];
                    echo '</td>';
                echo '</tr>';
            }
            if($_SERVER['REQUEST_METHOD'] != 'POST')
            {
//            	$id = $_GET['id'];
//            	echo $id;
                echo "<h2>Reply</h2>";
                echo '<form method="post" action="reply.php?id='. $_GET['id'] . '">'; //echo 'You have successfully created <a href="topic.php?id='. $topicid . '">your new topic</a>.';
                echo "<textarea name='reply-content' required></textarea>";
                echo "<br><input type='submit' value='Submit reply'/>";
                echo "</form>";
            }
			
		//	echo '<p><a href="reply.php?=' . $row['topic_id'] . '">Post a reply</a></p>';
			//echo '<a href="reply.php?=' . $row['post_id'] . '"></a>';
		}
	}
}

?>