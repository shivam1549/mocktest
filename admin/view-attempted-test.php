<?php
include('header.php');
?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">View Analytics of all attempted tests</h4>

                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped ">
                            <thead>
                                <tr>
                                    <th>
                                        Sr. No.
                                    </th>
                                    <th>
                                        Student Name
                                    </th>
                                    <th>
                                        Test Name
                                    </th>
                                    <th>
                                        Marks
                                    </th>
                                    <th>
                                        Total Marks
                                    </th>
                                    <th>
                                        Attempted Questions
                                    </th>
                                    <th>
                                        Total Questions
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="attemptedquestion">
                            

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>


<script>
    loadtests();
  

  
                  

    function formatDate(inputDate) {
        const date = new Date(inputDate);
        const options = {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        };
        return date.toLocaleDateString('en-GB', options);
    }

    function loadtests() {
        // alert("fffe")
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "codes/attemptedttest.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var resp = JSON.parse(xhr.response);
                    if (resp.data) {
                        var questiondata = resp.data;
                        var i = 1;
                        var html = ''
                        questiondata.forEach(quesdata => {
                            html += `<tr>
                            <td>${i}</td>
                            <td>${quesdata.username}</td>
                            <td>${quesdata.testname}</td>
                            <td>${quesdata.totmarks}</td>
                         
                            <td>${quesdata.total}</td>
                            <td>${quesdata.attempted}</td>
                            <td>${quesdata.total}</td>
                            <td>${quesdata.date}</td>
                        </tr>`
                            i++;
                        })
                        document.querySelector("#attemptedquestion").innerHTML = html;
                        let table = new DataTable('#myTable');
                      


                    }
                    if (resp.error) {
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


<?php
include('script.php');
?>