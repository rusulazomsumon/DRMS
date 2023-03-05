<?php
    // connect to database
    include('connection.php');
    include('header.php');

    // retrieve roll and registration numbers from URL
    $roll = $_GET['roll'];
    $reg_id = $_GET['reg_id'];

    // select student info and their result from database
    $query = "SELECT students.name, students.picture, students.roll, results.marks_obtained, subjects.name AS subject_name
            FROM students 
            INNER JOIN results ON students.s_id = results.s_id 
            INNER JOIN subjects ON results.sub_id = subjects.sub_id 
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
	<h1>Student Result</h1>
	<table>
		<thead>
			<tr>
				<th>Picture</th>
				<th>Name</th>
				<th>Roll</th>
				<th>Subject</th>
				<th>Marks Obtained</th>
			</tr>
		</thead>
		<tbody>
			<?php
			// loop through each row of data and display in table
			while($row = mysqli_fetch_assoc($result)) {
				echo "<tr>";
				echo "<td><img src='/drms/dashboard/student/imgs/" . $row['picture'] . "' width='50' height='50'></td>";
				echo "<td>" . $row['name'] . "</td>";
				echo "<td>" . $row['roll'] . "</td>";
				echo "<td>" . $row['subject_name'] . "</td>";
				echo "<td>" . $row['marks_obtained'] . "</td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
</body>
</html>

<?php
// close database connection
mysqli_close($conn);
include('footer.php');

?>
