<?php
include("../header.php");
?>

    <h2>Search Registration ID</h2>
    <form action="edit_result.php" method="GET">
        <label for="regId">Registration ID:</label>
        <input type="text" id="regId" name="regId" placeholder="Enter registration ID" required>
        <button type="submit">Search</button>
    </form>

    <?php 
include("../footer.php");
?>
