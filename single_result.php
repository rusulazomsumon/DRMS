<?php 
  include("header.php");
  include("connection.php");  
  
  $reg_id = $_GET['reg_id'];
  
  $sql = "SELECT students.name, students.dob, students.roll, students.picture, results.sub_id, results.marks_obtained, branches.name AS branch_name
	FROM students
	INNER JOIN results ON students.reg_id = results.reg_id
	INNER JOIN branches ON students.branch_id = branches.branch_id
	WHERE students.reg_id = '$reg_id';
	";
  
  $result = mysqli_query($conn, $sql);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
  
  if (mysqli_num_rows($result) > 0) {
	  // Display the result data
	  while ($row = mysqli_fetch_assoc($result)) {
        // Access the fields using $row['field_name']
        $name = $row['name'];
        $dob = $row['dob'];
        $roll = $row['roll'];
        $picture = $row['picture'];
        $sub_id = $row['sub_id'];
        $marks_obtained = $row['marks_obtained'];
		$branch_name = $row['branch_name'];

        // @@@@@@@@@@@@@@@@@@@@@@@ResultArea(DownloadArea)@@@@@@@@@@@@@@@@@@@@@@@@@@@
        echo "<div class='container m-3 p-3' id='resultArea'>";
			echo "<div class='card m-3'>";
				// #################ResultHeaderContent#############
				echo "<div class='row justify-content-center'>";
						// logo area
						echo "<div class='col-md-2' >";
							echo "<img src='resourse\imgs\dhitlogo.jpg'  width='150' height='150' class='img-thumbnail m-1' class='img-fluid' alt='Logo'>";
						echo "</div>";
						// main content
						echo "<div class='col-md-6 '>";
							echo "<h3 class='mb-3 text-primary'>Dream Health and Information Technology</h3>";
							echo "<p class='text-info'>web: www.dhitltd.com</p>";
							echo "<p class='text-secondary'>Mohammadpur, Dhaka-1207, Bangladesh</p>";
						echo "</div>";
				echo "</div>";
			echo "</div>";

			// #################RestMainContent#############
			echo "<div class='row justify-content-center mt-5'>";
				echo "<div class='col-md-8'>";
					echo "<div class='card'>";

						echo "<h4 class='text-success text-center p-3'>Final Result Card</h4>";

						// image
						echo "<div class='card-body text-center'>";
							echo "<img src='/drms/dashboard/student/imgs/" . $picture. "' width='150' height='150' class='img-thumbnail'>";
						echo "</div>";

						// Student info col1
						echo "<div class='container'>";
							echo "<div class='row'>";

								echo "<div class='col-md-6'>";
									echo "<div class='card-body text-left'>";
										echo "<h4 class='card-title'>Name: $name</h4>";
										echo "<p class='card-text'>Date of Birth: $dob</p>";
										echo "<p class='card-text'>Brach: $branch_name</p>";
									echo "</div>";
								echo "</div>";

								// Student info col2
								echo "<div class='col-md-6'>";
									echo "<div class='card-body text-left'>";
										echo "<p class='card-text'>Roll Number: $roll</p>";
										echo "<p class='card-text'>Subject ID: $sub_id</p>";
										echo "<p class='card-text'>Marks Obtained: $marks_obtained</p>";
									echo "</div>";
								echo "</div>";

							echo "</div>";
						echo "</div>";

					echo "</div>";
				echo "</div>";
			echo "</div>";
		echo "</div>";
		
		// @@@@@@@@@@@@@@@@@DownloadButtons@@@@@@@@@@@@@@@@
		echo "<div class='text-center'>";
			echo "<button onclick='downloadScreenshot()' class='btn btn-success m-5'>Download Your Result</button>";
		echo "</div>";


		echo "<script src='https://html2canvas.hertzen.com/dist/html2canvas.min.js'></script>";

		echo "<script>";
			echo "function downloadScreenshot() {";
				echo "    var contentDiv = document.getElementById('resultArea');";
				echo "    html2canvas(contentDiv).then(function(canvas) {";
				echo "        var link = document.createElement('a');";
				echo "        link.href = canvas.toDataURL();";
				echo "        link.download = '$name result_dhit_village_Doctor.png';";
				echo "        link.click();";
				echo "    });";
			echo "}";
		echo "</script>";


    }
  } else {
	  echo "No results found.";
  }
  
  mysqli_close($conn);
  
  include("footer.php");
?>