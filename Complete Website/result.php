<?php

if(!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION['UserLogin'])){
    echo "Welcome ".$_SESSION['UserLogin'];
}else{
        echo "Welcome Guest";
}




include_once("connections/connection.php");

$con = connection();
$search = $_GET['search'];
$sql = "SELECT * FROM student_list WHERE firstname LIKE '%$search%' || lastname LIKE '%$search%'";
$students = $con->query($sql) or die ($con->error);
$row = $students->fetch_assoc();

// do{

//     echo $row['firstname']." "$row['lastname']. "<br/>";

// }while($row = $students->fetch_assoc());
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student Records Database</title>
        <link rel="stylesheet" href="css/style.css">

    </head>
    <body>
        <h1>Student Records Database</h1>
        <br/>
        <br/>

        <form action="result.php" method="get">
        <a href="index.php"> <-Back</a>
        <input type="text" name="search" id="search">
        <button type="submit">Search</button>
        </form>

        <?php if(isset($_SESSION['UserLogin'])){?> 
        <a href="logout.php">LOGOUT</a>
        <?php }
        else{ ?>
        <a href="login.php">LOGIN</a>
        <?php } ?>
        <a href="add.php"> Add New</a>
        <table>
            <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
            </tr>
            </thead>
            <tbody>
            <?php do{ ?>
            <tr>
                <td><a href="details.php?ID=<?php echo $row['id'];?>">view</a></td>
                <td><?php echo $row['firstname'];?></td>
                <td><?php echo $row['lastname'];?></td>
                </tr>
                <?php }while($row = $students->fetch_assoc()) ?>
                </tbody>
           </table>
    </body>
    </html>