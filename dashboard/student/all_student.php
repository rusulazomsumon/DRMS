<?php 
  include("../header.php");
  include("../../connection.php");  

?>

    <div class="all_student">
        <?php
            // Fetch student data
            $query = "SELECT * FROM students";
            $result = mysqli_query($conn, $query);
            // Display data in a table
            echo "<table>";
            echo "<tr><th>ID</th><th>Picture</th><th>Name</th><th>Reg. ID</th><th>Roll</th><th>Father's Name</th><th>Mother's Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Branch ID</th><th>Edit</th><th>Update</th><th>Delete</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td><img src='/drms/dashboard/student/imgs/" . $row['picture'] . "' width='50' height='50'></td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['reg_id'] . "</td>";
                echo "<td>" . $row['roll'] . "</td>";
                echo "<td>" . $row['f_name'] . "</td>";
                echo "<td>" . $row['m_name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['branch_id'] . "</td>";
                echo "<td><a href='edit_student.php?id=" . $row['id'] . "'>Edit</a></td>";
                echo "<td><a href='disable_student.php?id=" . $row['id'] . "'>Disable</a></td>";
                // delete button
                echo "<td><a href='delete_student.php?id=" . $row['id'] . "'>Delete</a></td>";
                ?>

                <!-- <td>
                  <form action="delete_student.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this student?')">Delete</button>
                  </form>
                </td> -->


                <?php
                echo "</tr>";
            }
            echo "</table>";

            // Close database connection
            mysqli_close($conn);
        ?>
       
    </div>

<?php 
  include("../footer.php");
?>