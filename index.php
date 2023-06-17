<?php 
    include("header.php");
?>

  <!-- Main content area -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Result Search</div>
                    <div class="card-body">
                        <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@ResultSearchForm@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
                        <form id="result-form" action="single_result.php" method="GET">
                            <div class="form-group row">
                                <label for="exam-type" class="col-md-4 col-form-label text-md-right">Exam Type</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="exam-type" name="">
                                        <option value="">--Select Exam Type--</option>
                                        <option value="final">Final</option>
                                        <option value="yearly">Yearly</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="passing-year" class="col-md-4 col-form-label text-md-right">Passing Year</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="passing-year" name="">
                                        <option value="">--Select Passing Year--</option>
                                        <option value="2023">2023</option>
                                        <option value="2022">2022</option>
                                        <option value="2021">2021</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="registration-id" class="col-md-4 col-form-label text-md-right">Registration Id</label>
                                <div class="col-md-6">
                                    <input id="registration-id" type="text" class="form-control" name="reg_id" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="roll-no" class="col-md-4 col-form-label text-md-right">Roll No</label>
                                <div class="col-md-6">
                                    <input id="roll-no" type="text" class="form-control" name="" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="math-problem" class="col-md-4 col-form-label text-md-right">What is <span id="num1"></span> + <span id="num2"></span>?</label>
                                <div class="col-md-6">
                                <input id="math-problem" type="text" class="form-control" name="" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="submit-btn" >Search Result</button>
                                    <!-- <button type="submit" class="btn btn-primary" id="submit-btn" disabled>Search Result</button> -->
                                </div>
                            </div>
                        </form>
                        <!-- result search form end -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Generate two random numbers between 1 and 9
        const num1 = Math.floor(Math.random() * 9) + 1;
        const num2 = Math.floor(Math.random() * 9) + 1;

        // Set the math problem label to display the two numbers
        document.getElementById("num1").textContent = num1;
        document.getElementById("num2").textContent = num2;

        // Disable submit button by default
        // document.getElementById("submit-btn").disabled = true;

        // Check the user's answer when the math problem input field changes
        document.getElementById("math-problem").addEventListener("input", function(event) {
            const answer = parseInt(event.target.value);
            const expectedAnswer = num1 + num2;

            // if (answer === expectedAnswer) {
            //     // Enable the form submission
            //     submitBtn.disabled = false;
            //     } else {
            //     // Disable the form submission
            //     submitBtn.disabled = true;
            // }
        });

    </script>
<?php 
    include("footer.php");
?>