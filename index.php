<?php
include "functions.php"; //functions page
?>

<script stype="textjavascript">
        function ShowDiv() {
          document.getElementById("add_new_user").style.display="block";
          }
</script>

<!DOCTYPE html>
<html lang="en">
<head>
   <link href='http://fonts.googleapis.com/css?family=Jost' rel='stylesheet' type='text/css'>
    <meta charset="UTF-8">
    <title>Mobile Brain Test</title>
</head>
<style>
    body {
      background-image: url('https://i.ibb.co/pLbgvGT/background-v3.jpg');
    }
    
    .content-table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 1.2em;
        font-family: Jost;
        min-width: 400px;
        border-radius: 5px 5px 0 0;
        overflow: hidden;
        box-shadow: 0 0 20px rbga(0, 0, 0, 0.15);
        text-align: center;
    }
    
    .content-table thead tr {
        background-color: #a061c0;
        color: #ffffff;
        text-align: center;
        font-weight: bold;
        font-size: 1.8em;
    }
    
    .content-table td {
        padding: 12px 15px;
    }
    
    .content-table tr {
        border-bottom: 1px solid #dddddd;
    }
    
    
</style>
<body>
<center>
    
<img src="https://i.ibb.co/6w5YcKp/Logo-nati.png">
<br><br><br><br><br><br>
<table class="content-table">
   <thead>
        <tr>
            <th>Email</th>
            <th>Phone</th>
            <th>Location</th>
            <th>Flag</th>
        </tr>
    </thead>
    
<?php 
        if (isset($_POST['submit'])){
        
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $ip = $_POST['ip'];

        $connection_add_user = mysqli_connect('5.153.13.148', 'kfkfk_user_test',
                                     'LKo7Xk5JdY8icAeH', 'kfkfk_test_db');
        if (!$connection_add_user){
            echo "<br>" . "Something is wrong. You are NOT connected.";
        } 

        $random_token = get_Rand_Token();
        
        $query_add_user = "INSERT INTO users(email,phone,token,ip) ";
        $query_add_user .= "VALUES ('$email', '$phone', '$random_token', '$ip')";
        
        mysqli_query($connection_add_user, $query_add_user);

        $connection_add_user ->close();  //closing DB connection 
    }
    
    //---------------------------------------------------------------------------------//
    
    
        $connection = mysqli_connect('5.153.13.148', 'kfkfk_user_test',
                                     'LKo7Xk5JdY8icAeH', 'kfkfk_test_db');
    
        if (!$connection){
            echo "<br>" . "Something is wrong. You are NOT connected.";
        } 

        $query = "SELECT * FROM users ORDER by id";

        $result_table = mysqli_query($connection, $query);

        if ($result_table-> num_rows > 0){ //Showing 'users' table in the test's requested format

            while ($row = $result_table->fetch_assoc()){
                $temp_array = get_Location_and_CounryGif($row["ip"]); //Temp array for each user

                if ($temp_array != 0){
                echo "<tr><td>" . $row["email"]. "</td><td>" . $row["phone"] . "</td><td>"
                . $temp_array[0] . "</td><td>". $temp_array[1] . "</td></tr>"; 
                }
            }
            echo "</table>";
        }
        else {
            echo "0 results";}

        $connection ->close(); //closing DB connection   
?>
    
</table>
<br><br><br><br><br>
<img src="https://i.ibb.co/fvDfrW9/Addnewuserbutton.png" onclick="ShowDiv()">
<br>
<br>
<br>
<div id="add_new_user" hidden>
   <table class="content-table">
      <form action="index.php" method="post">
         <tr>
             <td>Email: </td>
             <td><input type="text" name="email"></td>
         </tr>
         <tr>
             <td>Phone: </td>
             <td><input type="text" name="phone"></td>
         </tr>
         <tr>
             <td>IP: </td>
             <td><input type="text" name="ip"></td>
         </tr>
         <tr>
             <td colspan="2"><input type="submit" name="submit"></td>
         </tr>
      </form>
   </table>
</div>
    
</center> 
<br><br><br><br><br> 
</body>
</html>