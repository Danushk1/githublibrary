<?php

	include("databaseConnection.php");

	$query = mysql_query("Select count(Id) From members Where position = 'student'");
	$result = mysql_fetch_assoc($query);

	$query2 = mysql_query("Select count(bookId) From books");
	$result2 = mysql_fetch_assoc($query2);

	$query3 = mysql_query("Select count(Id) From members Where position = 'faculty'");
	$result3 = mysql_fetch_assoc($query3);

	$query4 = mysql_query("Select count(publisher) From books Group By publisher");
	$result4 = mysql_num_rows($query4);
	
	$query5 = mysql_query("Select sum(price) From books");
	$result5 = mysql_fetch_assoc($query5);

	$query6 = mysql_query("Select count(bookId) From books Where available = 1");
	$result6 = mysql_fetch_assoc($query6);

?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../css/styleDashboard.css">
	</head>
	<body>
		<div class="containerDashboard">

			<div class="totalStudents">Total Student : <br> <?php echo $result['count(Id)'];?></div>

			<div class="totalBooks">Total Book : <br> <?php echo $result2['count(bookId)']; ?></div>

			<div class="totalFaculty">Total Faculty : <br> <?php echo $result3['count(Id)']?></div>			

			<div class="totalPublisher">Total Publishers: <br> <?php echo $result4; ?></div>

			<div class="bookPrice">Price of all books: <br> <?php echo $result5['sum(price)']; ?></div>

			<div class="bookInLibrary">Books in library: <br> <?php echo $result6['count(bookId)']; ?></div>

		</div>
	</body>
</html>