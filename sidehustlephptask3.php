<?php 
include('dbconfig.php');
                                    //Add Task
if (isset($_POST['addtask'])) 
{
    $task = $_POST['task1'];
    $title = $_POST['title'];
    $sql =" INSERT INTO task(Task,Title) VALUES (:task,:title)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':task',$task,PDO::PARAM_STR);
     $query->bindParam(':title',$title,PDO::PARAM_STR);

    $query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="<br>Task Added successfully";
echo $msg;
}
else 
{
$error="Something went wrong. Please try again";
echo $error;
}

}
                                    //Delete Task
if (isset($_POST['deletetask'])) 
{
    $title = $_POST['title'];
    $sql =" DELETE FROM task WHERE Title='$title'";
    $query = $dbh->prepare($sql);
    $query->execute();
}
                                    //Update Task
if (isset($_POST['updatetask'])) 
{
    $task = $_POST['task2'];
    $title = $_POST['title'];
    $sql =" UPDATE task SET task = '$task' WHERE Title = '$title' ";
    $query = $dbh->prepare($sql);
    $query->bindParam(':task',$task,PDO::PARAM_STR);
    $query->execute();

    echo " <br> $title Task Updated Successfully";
}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>To Do List</title>
    <style >
        table, th,td
        {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td
        {
            padding: 5px;
            text-align: left;
        }

    </style>
 </head>
 <body>
 	<form method="post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" >
        <h3>Add Task </h3>  
 		Title: <input type="text" name="title" placeholder="Input task Title" required><br>
        Task: <textarea rows="3" cols="30" name="task1" required></textarea>
        <input type="submit" name="addtask" value="Add Task"><br><br>
    </form>
        
<form method="post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" >
        <h3>Delete Task</h3>    
        Title:<input type="text" name="title" placeholder="Input Task Title" required>
        <input type="submit" name="deletetask" value="Delete Task"><br><br>
    </form>

<form method="post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" >
        <h3>Update Task</h3>   
        Title:<input type="text" name="title" placeholder="Input task Title" required><br>
        Task:<textarea rows="3" cols="30" name="task2" required></textarea>
        <input type="submit" name="updatetask" value="Update task" >
 	</form>
    <table style="width:30%">
       <caption><h2> To-do List</h2></caption>
    <tr>
        <th>id</th>
        <th>Title</th>
        <th>Task</th>
    </tr>
    
 <?php  
$sql = "SELECT * from task ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>

     <tr>
       <td><?php echo htmlentities($result->id );?></td> 
        <td><?php echo htmlentities($result->Title );?></td>
        <td><?php echo htmlentities($result->Task );?></td>
     </tr>
     

<?php  }} ?>
 </body>
 </html>