<?php 
  include("../header.php");
  include("../../connection.php");  
  
  // Check if form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $s_id = $_POST["s_id"];
    $name = $_POST["name"];
    $dob = $_POST["dob"];
    $reg_id = $_POST["reg_id"];
    $roll = $_POST["roll"];
    $f_name = $_POST["f_name"];
    $m_name = $_POST["m_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $crs_id = $_POST["crs_id"];
    $branch_id = $_POST["branch_id"];
    
    // Check if 'picture' key is set in $_POST
    if (isset($_POST['picture'])) {
      $picture = $_POST['picture'];
    } else {
      $picture = '';
    }
    
    // Check if a new picture was uploaded
    if(isset($_FILES['picture']) && $_FILES['picture']['error'] == 0){
      $picture = $_FILES['picture']['name'];
      $temp_name = $_FILES['picture']['tmp_name'];
      $folder = "imgs/";
      
      // Delete old picture
      $old_picture = $_POST['picture'];
      if($old_picture) {
        unlink($folder . $old_picture);
      }
      
      // Upload new picture
      move_uploaded_file($temp_name, $folder.$picture);
    }
    
    // Update student information in database
    $query = "UPDATE students SET name='$name', dob='$dob', reg_id='$reg_id', roll='$roll', picture='$picture', f_name='$f_name', m_name='$m_name', email='$email', phone='$phone', address='$address', crs_id='$crs_id', branch_id='$branch_id' WHERE s_id=$s_id";
    $result = mysqli_query($conn, $query);
  
    if ($result) {
      echo "<script type='text/javascript'>alert('Student information updated successfully');window.location.href='all_student.php';</script>";  
    } else {
      echo "Error updating student information: " . mysqli_error($conn);
    }
  }
  
  
  // Check if s_id is provided in URL
  if (isset($_GET["id"])) {
      // Retrieve student information from database
      $s_id = $_GET["id"];
      $query = "SELECT * FROM students WHERE s_id=$s_id";
      $result = mysqli_query($conn, $query);
  
      if ($result) {
          $row = mysqli_fetch_assoc($result);
      } else {
          echo "Error retrieving student information: " . mysqli_error($conn);
      }
  }
  
  mysqli_close($conn);
  ?>
  
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
        <input type="hidden" name="s_id" value="<?php echo $row['s_id'];?>">
        <div class="form-group">
        <label for="picture">Picture:</label>
        <?php if($row['picture']) { ?>
            <img src="imgs/<?php echo $row['picture']; ?>" id="profile-pic"  alt="Current Image" style="cursor: pointer;" width="100"><br>
        <?php } ?>
        <input type="file" id="profile-pic-input" style="display: none;" class="form-control-file" id="picture" name="picture" placeholder="<?php echo $row['picture']; ?>" requred>
        </div>

        
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="<?php echo $row['name'];?>" value="<?php echo $row['name']; ?>">
        </div>
        
        <div class="form-group">
            <label for="dob">DOB:</label>
            <input type="date" class="form-control" id="dob" name="dob" placeholder="<?php echo $row['dob'];?>" value="<?php echo $row['dob']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="reg_id">Reg ID:</label>
            <input type="text" class="form-control" id="reg_id" name="reg_id" placeholder="<?php echo $row['reg_id'];?>" value="<?php echo $row['reg_id']; ?>">
        </div>
        
        <div class="form-group">
            <label for="roll">Roll:</label>
            <input type="text" class="form-control" id="roll" name="roll" placeholder="<?php echo $row['roll'];?>" value="<?php echo $row['roll']; ?>">
        </div>
        
        <div class="form-group">
            <label for="f_name">Father Name:</label>
            <input type="text" class="form-control" id="f_name" name="f_name" placeholder="<?php echo $row['f_name'];?>" value="<?php echo $row['f_name']; ?>">
        </div>
        
        <div class="form-group">
            <label for="m_name">Mother Name:</label>
            <input type="text" class="form-control" id="m_name" name="m_name" placeholder="<?php echo $row['m_name'];?>" value="<?php echo $row['m_name']; ?>">
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo $row['email'];?>" value="<?php echo $row['email']; ?>">
        </div>
        
        <div class="form-group">
        <label for="phone">Phone:</label>
        <input type="text" class="form-control" id="phone" name="phone" placeholder="<?php echo $row['phone'];?>" value="<?php echo $row['phone']; ?>">
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <textarea class="form-control" id="address" name="address" placeholder="<?php echo $row['address']; ?>"><?php echo $row['address']; ?></textarea>
        </div>

        <div class="form-group">
            <label for="branch_id">Branch Id:</label>
            <input type="text" class="form-control" id="branch_id" name="branch_id" value="<?php echo $row['branch_id']; ?>">
        </div>

        <div class="form-group">
            <label for="crs_id">Course Id:</label>
            <input type="text" class="form-control" id="crs_id" name="crs_id" placeholder="<?php echo $row['crs_id']; ?>" value="<?php echo $row['crs_id']; ?>">        
        </div>

        <input type="submit" class="btn btn-primary" name="submit" value="Update">
    </form>

    <script>
        // Get references to the image and file input fields
        const profilePic = document.getElementById('profile-pic');
        const profilePicInput = document.getElementById('profile-pic-input');
        
        // Add a click event listener to the image
        profilePic.addEventListener('click', () => {
            // Trigger the file input field to open
            profilePicInput.click();
        });
    </script>


<?php 
  include("../footer.php");
?>