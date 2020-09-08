<html>
<head>
<link rel="stylesheet" href="stylesheet.css">
</head>

<body style='text-align: center;display: inline-block;'>
	<div>
	<center>
<form method="post">
<h1> XELPMOC PHP CALCULATOR </h1>
		<label for="num1">Operand 1:</label>
   <input type="text" name="num1" placeholder="Number 1">
   
	<label for="num2">Operand 2:</label>
   <input type="text" name="num2" placeholder="Number 2">
    
   <select name="operator" style="width:10%; font-family: Comic Sans MS, cursive, sans-serif">
   	<option>+</option>
   	<option>-</option>
   	<option>*</option>
   	<option>/</option>
   </select>
   <br>
 <br>
   <button type="submit" name="submit" value="submit" style="width: 100%; font-family: Comic Sans MS, cursive, sans-serif">Calculate</button>
 


<br><br>
<p style="text-align: :center !important;">Result :</p>
<p>
	<?php
if(isset($_POST['submit'])){
	$operand1=$_POST['num1'];
	$operand2=$_POST['num2'];
    $operator=$_POST['operator'];
    $result=0;
switch($operator) {
   case '+': 
      $result=$operand1+$operand2;
      echo $result;
      break;
   case '-': 
   $result=$operand1-$operand2;
       echo $result;
      break;
   case '*':
   $result=$operand1*$operand2; 
       echo $result;  
         break;
   case '/': 
   $result=$operand1/$operand2;
      echo $result;
      break;
}
}
if(isset($_POST['submit']) && $_POST['num1']!=null && $_POST['num2']!=null) {
try{
$conn= mysqli_connect('localhost','root','','calculator');
 
 if(!$conn){
   echo 'Connection error:' . mysqli_connect_error();
 }
 $sql = "INSERT INTO calculate (number1, operator, number2,result)
VALUES ('$operand1','$operator', '$operand2', '$result')";
}
catch(Exception $e){
	echo "Error:".$e->getMessage();

}
if ($conn->query($sql) === TRUE) {

} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

}


?>
</b>
<button type="submit" name="view" value="view1" style="width: 100%; font-family: Comic Sans MS, cursive, sans-serif">View History</button>
<?php 
if(array_key_exists('view', $_POST)) { 
            button1(); 
        } 
        
        function button1() { 

$conn= mysqli_connect('localhost','root','','calculator');
 
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM calculate";
$results = $conn->query($sql);
if ($results->num_rows > 0) {
  // output data of each row
  while($row = $results->fetch_assoc()) {
    echo  $row["number1"]. " " . $row["operator"]. " " . $row["number2"]." = ".$row["result"]."<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
     } 
?>
<button type="submit" name="clear" value="clear" style="width: 100%; font-family: Comic Sans MS, cursive, sans-serif">Clear History</button>
<?php 
if(array_key_exists('clear', $_GET)) { 
            button2(); 
        }        
        function button2() { 
$conn= mysqli_connect('localhost','root','','calculator');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "DELETE FROM calculate";
if ($conn->query($sql) === TRUE) {
  echo "History Cleared.";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
        } 
?>
</form>
</center>
</div>
</body>
</html>
