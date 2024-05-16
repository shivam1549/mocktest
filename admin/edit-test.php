<?php
include('header.php');
?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <span id="sucessmsg" class="text-green"></span>
                    <h4 class="card-title">Edit test</h4>
                    <!-- <p class="card-description">
                    Basic form layout
                  </p> -->
                    <form class="forms-sample" id="testform">
                        <div id="containerform">

                        </div>


                        <button class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include('footer.php');
?>
<script>
    const queryString = window.location.search;
    // console.log(queryString);
    const urlParams = new URLSearchParams(queryString);
    const id = urlParams.get('id');
    // console.log(urlParams.get('id'))
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "codes/functions.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // console.log(xhr.response);
                var resp = JSON.parse(xhr.response);

                var html = "<div class='form-group'>" +
                    "<label>Title of test</label>" +
                    "<input type='text' name='title' value='"+resp.name+"' class='form-control' placeholder='Title'>" +
                    "<span class='text-danger title-error'></span>" +
                    "</div>" +
                    "<div class='form-group'>" +
                    "<label>Duration in hours</label>" +
                    "<input type='text' name='duration' value='"+resp.duration+"' class='form-control' placeholder='Duration'>" +
                    "<span class='text-danger duration-error'></span>" +
                    "</div>";

                    document.querySelector("#containerform").innerHTML = html;

            } else {
                console.log("Error: " + xhr.status);
            }
        }
    }
    xhr.send("id=" + encodeURIComponent(id));

    document.querySelector("#testform").addEventListener("submit", function(e){
    e.preventDefault();
    var title = document.getElementsByName("title")[0].value;
    var duration = document.getElementsByName("duration")[0].value;
    var valid = false;
    if(title.length === 0){
        
        document.querySelector(".title-error").innerHTML = "Please fill the title";
    }
    else{
        valid = true;
        document.querySelector(".title-error").innerHTML = ""; 
    }
    // console.log(duration.length + "duratu")
    if(duration.length === 0){
        document.querySelector(".duration-error").innerHTML = "Please fill the duration";
    }
    else{
        valid = true;
        document.querySelector(".duration-error").innerHTML = "";
    }

    if(valid){
        var form = document.querySelector("#testform");
        var formData = new FormData(form);
        formData.append('id', id);
        // console.log("Hi submit")
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "codes/update-test.php", true);
        xhr.onreadystatechange = function (){
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                  // console.log(xhr.response);
                 var resp = JSON.parse(xhr.response);
                //  console.log(resp.status);
                    if(resp.success === 'Updated successfully'){
                        document.querySelector("#sucessmsg").innerHTML= resp.success; 
                    }

                    if(resp.error === 'Some error'){
                        document.querySelector("#sucessmsg").innerHTML= resp.error; 
                    }
                    
                }
                else{
                    console.log("Error")
                }
            }
        }
        xhr.send(formData);
    }

   })
</script>
<?php
include('script.php');
?>