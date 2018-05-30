<!DOCTYPE html>
<html>
<head>
	<title>
		Login
	</title>
</head>
<body>
	<form method="post" action="#">
		<table>
			<tr>
				<td>USERNAME : </td>
				<td><input type="text" name="txtUN" required /></td>
			</tr>
			<tr>
				<td>PASSWORD : </td>
				<td><input type="password" name="txtPW" required/></td>
			</tr>
			<tr>
				<td><input type="submit" name="btnLogin" value="Login"/></td>
				<td><input type="submit" name="btnNewMember" value="New Member" formnovalidate/></td>
			</tr>
		</table>
	</form>
</body>
</html>

<?php
if(isset($_COOKIE["user"]))
{
	header('Location:SS Assignment - Welcome Page.php');
}
else
{
	if(isset($_POST['btnLogin']))
	{	
		$username = $_POST['txtUN'];
		$password = $_POST['txtPW'];
		$con = mysqli_connect("localhost","root","","ss");
		$stmt = $con->prepare("SELECT username,password FROM users WHERE username = (?) AND password = (?)");
		$stmt->bind_param("ss", $username,$password);
		$stmt->execute();

		$result = $stmt->get_result();
		if ($result->num_rows == 1) 
		{
			setcookie("user","$username",time()+360);
    		header('Location:SS Assignment - Welcome Page.php');
		}
		else
			echo "No Username Password Found";
	
		$stmt->close();
		$con->close();
	}
	else if(isset($_POST['btnNewMember']))
	{
		header('Location:Member Registration.php');
	}

}
?>