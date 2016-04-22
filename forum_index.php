<?php
//create_cat.php
include 'connect.php';
include 'header.php';
 
$sql = "SELECT cat_name, cat_description, cat_id
 	FROM categories
 	WHERE cat_name
 	NOT LIKE '%/%'";
 
$result = mysql_query($sql);
 
if(!$result)
{
    echo 'The categories could not be displayed, please try again later.';
}
else
{
    if(mysql_num_rows($result) == 0)
    {
        echo 'No categories defined yet.';
    }
    else
    {
        //prepare the table
        echo '<table border="1">
              <tr>
                <th>Category</th>
                <th>Latest thread</th>
              </tr>'; 
             
        while($row = mysql_fetch_assoc($result))
        {               
        	$CATID = $row['cat_id'];
        	$tsql = "SELECT topic_id, topic_subject, topic_date
			FROM topics
			WHERE topic_cat=$CATID
			ORDER BY topic_date DESC";
        	$tres = mysql_query($tsql);
        
        
            echo '<tr>';
                echo '<td class="leftpart">';
                    echo '<h3><a href="category.php?id=' . $row['cat_id'] . '">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'];
                echo '</td>';
                echo '<td class="rightpart">';
                	if(mysql_num_rows($tres) == 0)
                	{
                		echo 'No threads yet.';
                	}
                	else
                	{
                		$TDATA = mysql_fetch_assoc($tres);
                		$TID = $TDATA['topic_id'];
                		$TTIME = $TDATA['topic_date'];
                		$TNAME = $TDATA['topic_subject'];
                     		echo '<a href="topic.php?id=' .$TDATA['topic_id'] .'"> '. $TNAME .'</a><br>'.date('d-m-Y', strtotime($TTIME)).'';
                     }
                echo '</td>';
            echo '</tr>';
        }
    }
}
 
include 'footer.php';
?>