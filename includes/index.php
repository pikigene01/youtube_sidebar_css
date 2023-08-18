<?php
include('includes/connection.php');

function create_table($con){
    $sql = "CREATE TABLE IF NOT EXISTS youtube_comments (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name text DEFAULT NULL,
        email text DEFAULT NULL,
        comment text DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

        if ($con->query($sql) === TRUE) { //full connection
         echo "table created successfully";
        return $con;
        } else {
        
            echo "Error creating table: " . $con->error;
        }

        return $con;

}

$get_data = $con->query("SELECT * FROM youtube_comments");


create_table($con);

if(isset($_POST['save_comment'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];

   $query = $con->query("INSERT INTO youtube_comments (name,email,comment) VALUES ('$name', '$email', '$comment')");

   if(($query) === TRUE){
     echo "Data saved successfully";
   }else{
    exit('Failed to save the comment');
   }
}

?>

<table>
    <thead>
        <th>Name</th>
        <th>Email</th>
        <th>Comment</th>
    </thead>

    <tbody>
 <?php  
 
 if(mysqli_num_rows($get_data) > 0){
    while($row = mysqli_fetch_assoc($get_data)){
        $name_data = $row['name'];
        $email_data = $row['email'];
        $comment_data = $row['comment'];

        echo "
        <tr>
        <td>$name_data</td>
        <td>$email_data</td>
        <td>$comment_data</td>
        </tr>
        ";

    }
 }
 
  ?>
    </tbody>
</table>

<form method="post" action="index.php">
</br>
<label>Name</label>
<br>
<input type="text" placeholder="Enter your name" name="name" />
</br>

<label>Email</label>
<br>
<input type="email" placeholder="Enter your email" name="email" />
</br>

<label>Comment</label>
<br>
<textarea cols="17" rows="6" name="comment" placeholder="Enter Your Comment"></textarea>
</br>

<button type="submit" name="save_comment">Save Comment</button>

</form>