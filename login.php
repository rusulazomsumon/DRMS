<?php 
	include("header.php");
    include("connection.php");

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$email = $_POST['email'];
		$password = $_POST['password'];
	
		// prepare and execute the SQL statement to retrieve the user's password hash
		$stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$result = $stmt->get_result();
	
		if ($result->num_rows === 1) {
			$row = $result->fetch_assoc();
			$hash = $row['password'];
	
			if (password_verify($password, $hash)) {
				// password is correct, set session variables and redirect to dashboard

				// $_SESSION['email'] = $email;
				// assuming you have a 'role' column in your user table
				// $_SESSION['role'] = $row['role']; 
				header('Location: ../drms/dashboard/dashboard.php');
				exit();
			} else {
				// password is incorrect, show error message
				$error = "Invalid email or password.";
			}
		} else {
			// no user found with the given email, show error message
			$error = "Invalid email or password.";
		}
	}
	

?>



	<div id="box" class="container">
        <div class="row">
			<form method="post" class="col-6 bg-light p-4">
				<h2 class="mb-4">Login With Correct Information</h2>
				<div class="form-group">
					<label for="email" class="form-label">Your Email</label>
					<input id="email" class="form-control" type="text" name="email">
				</div>
				<div class="form-group">
					<label for="password" class="form-label">Password</label>
					<input id="password" class="form-control" type="password" name="password">
				</div>
				<button class="btn btn-primary" type="submit">Login</button>
				<p class="mt-3">Not Registered?</p>
				<a href="sign-up.php">Click Here to Signup</a>
			</form>
		</div>
    </div>
<?php 
	include("footer.php");
?>