<?php
include('header.php');
?>

<div class="content-wrapper">
    <div class="row">
    <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Create test</h4>
                  <!-- <p class="card-description">
                    Basic form layout
                  </p> -->
                  <form class="forms-sample" id="testform">
                   
                    <div class="form-group">
                      <label>Title of test</label>
                      <input type="text" name="title" class="form-control" placeholder="Title">
                      <span class="text-danger title-error"></span>
                    </div>
                    <div class="form-group">
                      <label>Duration in minutes</label>
                      <input type="text" name="duration" class="form-control"  placeholder="Duration">
                      <span class="text-danger duration-error"></span>
                      
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
        console.log("Hi submit")
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "submit-test.php", true);
        xhr.onreadystatechange = function (){
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                  // console.log(xhr.response);
                 var resp = JSON.parse(xhr.response);
                //  console.log(resp.status);
                    if(resp.status === 'Record Inserted'){
                          location.href= "edit-test.php?id="+resp.lastid;
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