<?php 
  include("header.php");
  include("connection.php");  
  
  $reg_id = $_GET['reg_id'];
  
  $sql = "SELECT students.name, students.dob, students.sex, students.f_name, students.m_name, students.reg_id, students.roll, students.address, students.picture, grade.grade, grade.result, courses.name AS course, branches.name AS branch_name
	FROM students
	INNER JOIN grade ON students.reg_id = grade.reg_id
	INNER JOIN branches ON students.branch_id = branches.branch_id
	INNER JOIN courses ON students.crs_id = courses.crs_id
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
		$sex = $row['sex'];
		$f_name = $row['f_name'];
		$m_name = $row['m_name'];
		$reg_id = $row['reg_id'];
		$roll = $row['roll'];
		$address = $row['address'];
		$course = $row['course'];
		$grade_result = $row['result']; // Use a different variable name here, e.g., $grade_result
        $picture = $row['picture'];
        $grade = $row['grade'];
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
										echo "<h4 class='card-title'><strong>Name:</strong> $name</h4>";
										echo "<p class='card-text'><strong>Father Name:</strong> $f_name</p>";
										echo "<p class='card-text'><strong>Mother Name:</strong> $m_name</p>";
										echo "<p class='card-text'><strong>Sex:</strong> $sex</p>";
										echo "<p class='card-text'><strong>Address: </strong>$address</p>";
										echo "<p class='card-text'><strong>Date of Birth:</strong> $dob</p>";
									echo "</div>";
								echo "</div>";

								// Student info col2
								echo "<div class='col-md-6'>";
									echo "<div class='card-body text-left'>";
										echo "<p class='card-text'><strong>Training Center:</strong> $branch_name</p>";
										echo "<p class='card-text'><strong>Registration No:</strong> $reg_id</p>";
										echo "<p class='card-text'><strong>Roll Number:</strong> $roll</p>";
										echo "<p class='card-text'><strong>Course:</strong> $course</p>";
										echo "<p class='card-text'><strong>Result:</strong> <span class='text-success'>$grade_result</span></p>"; // Use the new variable name here
										echo "<p class='card-text'><strong>Grade:</strong> $grade</p>";
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
