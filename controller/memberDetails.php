<?php
	include("databaseConnection.php");

	$selectedMemberId = $_REQUEST['selectedMemberId'];

	$query = mysql_query("SELECT Id,FirstName,LastName,Position,Mobile,Email,Course From members Where Id = '$selectedMemberId'");
	$result = mysql_fetch_assoc($query);

	$query1 = "SELECT bookId,issueDate From borrow Where issueId = '$selectedMemberId'";
	$return1 = mysql_query($query1);
	$return2 = mysql_query($query1);
	$result1 = mysql_fetch_assoc($return1);

?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../css/styleMemberInfo.css">
		<link rel="stylesheet" type="text/css" href="../css/styleTable.css">
	</head>
	<body>
		<div class="memberInfoTitle">Member Information</div>
		<div class="infoContainer">
			<div class="MemberName">
				<?php echo ucfirst($result['FirstName'])." ".ucfirst($result['LastName']); ?>[<?php echo $selectedMemberId; ?>]
			</div>

			<div class="memberInfo">
				<hr>
				<div class="posLabel">Position</div>
				<div class="pos"><?php echo ucfirst($result['Position']); ?></div>
				<hr>
				<div class="mobileLabel">Mobile No</div>
				<div class="mobile"><?php echo $result['Mobile']; ?></div>
				<hr>
				<div class="emailLabel">Email</div>
				<div class="email"><?php echo ucfirst($result['Email']); ?></div>
				<hr>
				<div class="courseLabel">Course</div>
				<div class="course"><?php echo ucfirst($result['Course']); ?></div>
				<hr>
			</div>

			<div class="memberInfoIssuedBook">
				<div class="issuedBookTitle">Issued Book</div>
				<table>
					<tr>
						<th>Book ID</th>
						<th>Date</th>
					</tr>
					<?php
						while($result2 = mysql_fetch_assoc($return2)){
							?>
							<tr>
								<td>
									<a href="home.php?activity=bookDetails&selectedBookId=<?php echo $result1['bookId']; ?>"> <?php echo $result2['bookId']; ?> </a>
								</td>
								<td><?php echo $result2['issueDate']; ?></td>
							</tr>
							<?php
						}
					?>
				</table>
			</div>
		</div>
	</body>
</html>  