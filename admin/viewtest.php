<?php
include('header.php');
?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">View All Test</h4>

                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped ">
                            <thead>
                                <tr>
                                    <th>
                                        Sr. No.
                                    </th>
                                    <th>
                                        Test Name
                                    </th>
                                    <th>
                                        Publsihed Date
                                    </th>
                                    <th>
                                        Duration
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tabledata">


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
        xhr.open("POST", "codes/view-alltest.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // console.log(xhr.response);
                    var resp = JSON.parse(xhr.response);
                    console.log(resp)
                    var html = '';
                    var i = 1;
                    resp.forEach(test => {
                        html += "<tr>" +
                            "<td>" + i + "</td>" +
                            "<td>" + test.name + "</td>" +
                            "<td>" + formatDate(test.created_at) + "</td>" +
                            "<td>" + test.duration + "</td>" +

                            "<td>" + "<a class='editqust' href='edit-test.php?id=" + test.id + "'><i class='mdi mdi-lead-pencil text-primary'></i></a> <a href='javascript:void(0)' onclick='deletetest(" + test.id + ")'><i class='mdi mdi-delete-forever text-danger'></i></a> " + "</td>" +
                            "</tr>";
                        i++;
                    })

                    document.querySelector("#tabledata").innerHTML = html;
                    let table = new DataTable('#myTable');
                    if (resp.message) {
                        document.querySelector("#tabledata").innerHTML = resp.message;
                    }


                }
            }

        }
        xhr.send();
    }

    function deletetest(id) {
        var userConfirmed = confirm("Are you sure you want to delete? All the questions that associated with this test will be deleted.");
        if (userConfirmed) {
            // Perform the delete action
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "codes/deletetest.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var resp = JSON.parse(xhr.response);
                        if (resp.success) {
                            loadtests();
                            // You can add additional logic here to update the UI or reload the table
                        } else {
                            alert(resp.success);
                        }
                    } else {
                        console.error("Error: " + xhr.status);
                    }
                }
            };
            xhr.send("id=" + encodeURIComponent(id));
        } else {
            // User cancelled the deletion
            console.log("Item not deleted.");
        }
    }
</script>


<?php
include('script.php');
?>