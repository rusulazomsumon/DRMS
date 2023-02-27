<?php 
	include("header.php");


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include("connection.php");
        // retrieve the form data
        // id 	username 	email 	password 	role 	
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];
    
        // validate the form data (you can add more validation if needed)
        if (empty($username) || empty($email) || empty($password)) {
            echo "All fields are required.";
        } else {
            // hash the password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
            // set default role to "student" if not specified
            $role = isset($_POST['role']) ? $_POST['role'] : "student";
        
            // prepare and execute the SQL statement to insert the new user
            $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);
            if ($stmt->execute()) {
                // redirect to the login page on successful sign-up
                header('Location: login.php');
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
        }
        
    
        // close the database connection
        $conn->close();
    }

?>

    <div id="box">
		<form method="post" class="bg-light p-4">
			<h2 class="mb-4">Signup</h2>
            <div class="form-group">
                <label for="username" class="form-label">Your User Name</label>
                <input id="username" class="form-control" type="text" name="username">
		    </div>

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" class="form-control" type="email" name="email">
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Create Password</label>
                <input id="password" class="form-control" type="password" name="password">
            </div>

            <div class="form-group">
                <label for="role" class="form-label">Role</label>
                <select id="role" class="form-control" name="role">
                    <option value="admin">Admin</option>
                    <option value="staff">Staff</option>
                    <option value="student">Student</option>
                </select>
            </div>

            <button class="btn btn-primary" type="submit">Signup</button>
            <p class="mt-3">Already Registered?</p>
            <a href="login.php">Click Here to Login</a>
        </form>
    </div>

    <!-- footer -->
<?php 
	include("footer.php");
?>