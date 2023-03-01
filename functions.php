<?php
//User Must be loged in, Check Login 
function check_login($conn)
{

	if(isset($_SESSION['id']))
	{

		$query = "select * from users where id = '$id' limit 1";
        $id = $_SESSION['id'];


		$result = mysqli_query($conn,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	//redirect to login
	header("Location: ../login.php");
	die;

}