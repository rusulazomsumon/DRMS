<?php
    // connect to database
    include('connection.php');
    include('header.php');

    // retrieve roll and registration numbers from URL
    $roll = $_GET['roll'];
    $reg_id = $_GET['reg_id'];

    // select student info and their result from database
    $query = "SELECT students.name, students.dob, students.picture, students.roll, students.address, results.marks_obtained, subjects.sub_id, subjects.name AS subject_name, courses.name AS course_name, branches.name AS branch_name
	FROM students 
	INNER JOIN results ON students.s_id = results.s_id 
	INNER JOIN subjects ON results.sub_id = subjects.sub_id 
	INNER JOIN courses ON students.crs_id = courses.crs_id
	INNER JOIN branches ON students.branch_id = branches.branch_id
	WHERE students.reg_id = '$reg_id' OR students.roll = '$roll'";

    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "Error: " . mysqli_error($conn);
        exit;
    }
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Single Result</title>
</head>
<body>
			<?php
				// loop through each row of data and display in table
				while($row = mysqli_fetch_assoc($result)) {
			?>

<head>
	<style>
		/* Style for the top section */
		.top-section {
			display: flex;
			align-items: center;
			justify-content: space-between;
			padding: 20px;
			border: 1px solid #ccc;
			margin-bottom: 20px;
		}

		.top-section h4 {
			margin: 0;
		}

		.top-section img {
			max-height: 150px;
			max-width: 150px;
			border: 1px solid #ccc;
			object-fit: contain;
		}

		/* Style for the bottom section */
		.bottom-section {
			padding: 20px;
			border: 1px solid #ccc;
		}

		.bottom-section table {
			width: 100%;
			border-collapse: collapse;
		}

		.bottom-section th,
		.bottom-section td {
			padding: 10px;
			border: 1px solid #ccc;
			text-align: center;
		}

		.bottom-section th {
			background-color: #eee;
		}
	</style>
</head>
<body>
	<div class="top-section">
		<?php 
				$result = mysqli_query($conn, $query);

				if ($result) {
					// Fetch the result as an associative array
					$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
					$pass = true;
					$total_marks = 0;
					$total_subjects = count($data);
	
					foreach ($data as $row) {
						if ($row['marks_obtained'] < 33) {
							$pass = false;
							break;
						}
						$total_marks += $row['marks_obtained'];
					}
	
					$percentage = $total_marks / ($total_subjects * 100) * 100;
	
					if ($pass) {
						$result_status = "Passed";
					} else {
						$result_status = "Failed";
					}
	
					if ($percentage >= 80) {
						$grade = "A+";
					} else if ($percentage >= 60) {
						$grade = "A";
					} else if ($percentage >= 50) {
						$grade = "B+";
					} else if ($percentage >= 40) {
						$grade = "B";
					} else if ($percentage >= 33) {
						$grade = "C";
					} else {
						$grade = "F";
					}
	
				} else {
					// Display the MySQL error if the query fails
					echo "Error: " . mysqli_error($conn);
				}
	
			
		?>
		<div>
			<h4>Course: <?php echo  $row['course_name'] ; ?></h4>
			<h4>Center: <?php echo  $row['branch_name'] ; ?></h4>
			<h4>Result: <?php echo $result_status; ?></h4> 
			<h4>Grade: <?php echo $grade; ?></h4> 
		</div> 
		<div>
			<h4>Roll No: <?php echo $data[0]['roll']; ?></h4>
			<h4>Student Name: <?php echo "<td>" . $row['name'] . "</td>"; ?> </h4>
			<h4>Address:<?php echo  $row['address'] ; ?></h4>
			<h4>DOB: <?php echo date('j M Y', strtotime($row['dob'])); ?></h4>
		</div>
		<div>
			<?php 
				echo "<td><img src='/drms/dashboard/student/imgs/" . $row['picture'] . "' width='150' height='150'></td>"; 
			// end of white loop
			}

			?>
		</div>
	</div>

	<div class="bottom-section">
		

		<!-- HTML code for displaying the result in a table -->
		<table>
			<thead>
				<tr>
					<th>Serial</th>
					<th>Subject Code</th>
					<th>Subject Name</th>
					<th>Grade</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$serial = 1;
				foreach ($data as $row) { ?>
					<tr>
						<td><?php echo $serial++; ?></td>
						<td><?php echo $row['sub_id']; ?></td>
						<td><?php echo $row['subject_name']; ?></td>
						<td><?php 
							$marks = $row['marks_obtained'];
							if ($marks >= 80) {
								echo "A+";
							} elseif ($marks >= 70) {
								echo "A";
							} elseif ($marks >= 60) {
								echo "A-";
							} elseif ($marks >= 50) {
								echo "B";
							} elseif ($marks >= 40) {
								echo "C";
							} else {
								echo "F";
							}
						?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>


	</div>
</body>
</html>


<?php

// close database connection
mysqli_close($conn);
include('footer.php');

?>