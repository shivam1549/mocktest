<?php
include('header.php');
?>

<div class="container  pt-60 pb-60">
    <!-- User Details and Logout Button -->
    <div class="row mb-4">
        <div class="col-md-6">

            <h5>Hi! <span id="nameuser"></span></h5>
            <!-- <p><strong>Email:</strong> john.doe@example.com</p> -->
        </div>
        <!-- <div class="col-md-6 text-right">
                <button class="btn btn-danger">Logout</button>
            </div> -->
    </div>

    <!-- Attempted Tests Table -->
    <hr>
    <h2 class="text-center mb-4">Attempted Tests</h2>
    <div id="error">

    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Test Name</th>
                    <th scope="col">Marks Obtained</th>
                    <th scope="col">Total Marks</th>
                    <th scope="col">Questions Attempted</th>
                    <th scope="col">Total Questions</th>
                </tr>
            </thead>
            <tbody id="attemptedquestion">
                <!-- Sample data row -->
                
            </tbody>
        </table>
    </div>
</div>

<?php
include('footer.php');
?>

<script>
    checkloginStatus();
    showattemptedtest();

    function checkloginStatus() {
        // alert(testid);
        // var testid = testid;
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "codes/checklogin.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var resp = JSON.parse(xhr.response);
                    if (!resp.loggedIn) {
                        location.href = "/"
                    } else {

                        document.querySelector("#nameuser").innerHTML = resp.userdetails.name;
                    }
                } else {
                    console.error("Error: " + xhr.status);
                }
            }
        };
        xhr.send();
    }
    
    function showattemptedtest() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "codes/my-profile.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var resp = JSON.parse(xhr.response);
                    if (resp.data) {
                       var questiondata = resp.data;
                       
                       var html =''
                       questiondata.forEach(quesdata => {
                       html += `<tr>
                            <td>${quesdata.testname}</td>
                            <td>${quesdata.totmarks}</td>
                         
                            <td>${quesdata.total}</td>
                            <td>${quesdata.attempted}</td>
                            <td>${quesdata.total}</td>
                        </tr>`
                    })
                    document.querySelector("#attemptedquestion").innerHTML = html;
                    } 
                    if(resp.error){
                    document.querySelector("#error").innerHTML = resp.error;
                    }
                } else {
                    console.error("Error: " + xhr.status);
                }
            }
        };
        xhr.send();
    }
</script>

</body>

</html>