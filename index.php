<?php
include('header.php')
?>

<section class="banner">
  <div class="content">
    <h2>Welcome to Online Test Series, your comprehensive platform for exam preparation</h2>
  </div>
</section>


<section class="courses pt-60 pb-60">
  <div class="container">
    <h4 class="mb-3">Popular tests</h4>
    <div class="row" id="populartest">

    </div>
  </div>
</section>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Please login to continue</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="true">Login</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="false">Register</button>
          </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
            <form id="loginForm">
              <div class="mb-3">
                <label for="loginEmail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="loginEmail" >
                <div id="emailError" class="text-danger"></div> <!-- Error message container -->
              </div>
              <input type="hidden" id="logintest" value="">
              <div class="mb-3">
                <label for="loginPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="loginPassword" >
                <div id="passwordError" class="text-danger"></div> <!-- Error message container -->
              </div>
              <button type="submit" class="btn btn-primary">Login</button>
            </form>

          </div>
          <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
            <form id="registerForm">
              <div class="mb-3">
              <input type="hidden" id="registertest" value="">
                <label for="registerEmail" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullname">
                <span class="text-danger nameerr"></span>
              </div>
              <div class="mb-3">
                <label for="registerEmail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="registerEmail">
                <span class="text-danger emailerr"></span>
              </div>
              <div class="mb-3">
                <label for="registerPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="registerPassword">
                <span class="text-danger passworderr"></span>
              </div>
              <div class="mb-3">
                <label for="registerConfirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="registerConfirmPassword">
                <span class="text-danger confpassworderr"></span>
              </div>
              <button type="submit" class="btn btn-primary">Register</button>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php
include("footer.php");
?>

<script>
  loadTest();

  function loadTest() {

    // console.log(urlParams.get('id'))
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "codes/load-test.php", true);
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
            html += `
                              <div class="col-md-3">
                              <a href="javascript:void(0)">
                                <div class="card test-cards">
                                  <div class="card-body">
                                    <p>${test.name}</p>
                                    <p>Duration: ${test.duration} minutes </p>
                                    <div class="card-footers">
                                  <a href="javascript:void(0)" data-testid="${test.id}" class="btn btn-info startest">Star Now</a>
                                  </div>
                                  </div>
                                  
                                </div>
                                </a>
                              </div>
                        `
          })
          document.querySelector("#populartest").innerHTML = html;
          document.querySelectorAll(".startest").forEach(elem => {
            elem.addEventListener("click", function() {
              console.log(this.getAttribute("data-testid"));
              checkloginStatus(this.getAttribute("data-testid"));
            })
          })
        }
      }
    };
    xhr.send();

  }

  function checkloginStatus(testid) {
    // alert(testid);
    var testid = testid;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "codes/checklogin.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          var resp = JSON.parse(xhr.response);
          if (resp.loggedIn) {
            // If logged in, redirect to the start test page
            window.location.href = `index.html?id=${testid}`;
          } else {
            // If not logged in, show an alert
            // alert("Please log in to start the test.");
            // getTestid(testid)
            document.querySelector("#logintest").value = testid;
            document.querySelector("#registertest").value = testid;
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
              keyboard: false
            });
            myModal.show();

          }
        } else {
          console.error("Error: " + xhr.status);
        }
      }
    };
    xhr.send();
  }

  // var testid = getTestid(testid);

  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('registerForm').addEventListener('submit', function(event) {
      event.preventDefault();

      // Clear previous error messages
      document.querySelector('.nameerr').textContent = '';
      document.querySelector('.emailerr').textContent = '';
      document.querySelector('.passworderr').textContent = '';
      document.querySelector('.confpassworderr').textContent = '';

      // Get form data
      const fullName = document.getElementById('fullname').value;
      const email = document.getElementById('registerEmail').value;
      const password = document.getElementById('registerPassword').value;
      const confirmPassword = document.getElementById('registerConfirmPassword').value;
      const testid = document.querySelector("#registertest").value


      // Basic validation
      let hasError = false;
      if (fullName === '') {
        document.querySelector('.nameerr').textContent = 'Full name is required';
        hasError = true;
      }
      if (email === '') {
        document.querySelector('.emailerr').textContent = 'Email is required';
        hasError = true;
      }
      if (password === '') {
        document.querySelector('.passworderr').textContent = 'Password is required';
        hasError = true;
      }
      if (confirmPassword !== password) {
        document.querySelector('.confpassworderr').textContent = 'Passwords do not match';
        hasError = true;
      }

      if (hasError) {
        return;
      }

      // Prepare data for submission
      const formData = new FormData();
      formData.append('fullname', fullName);
      formData.append('email', email);
      formData.append('password', password);
      

      // AJAX request to submit form data
      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'codes/register.php', true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {

            const response = JSON.parse(xhr.response);
            console.log(response);
            if (response.message == 'Account Created Successfully') {
              // Registration successful, handle success (e.g., redirect to login page)
              // alert(response.message);
              window.location.href = `index.html?id=${testid}`;
              // alert('Registration successful!');
              // location.reload();
            } else {
              // Handle server-side validation errors
              alert(response.message);
              // if (response.errors.name) {
              //   document.querySelector('.nameerr').textContent = response.errors.name;
              // }
              // if (response.errors.email) {
              //   document.querySelector('.emailerr').textContent = response.errors.email;
              // }
              // if (response.errors.password) {
              //   document.querySelector('.passworderr').textContent = response.errors.password;
              // }
            }
          } else {
            console.error('Error: ' + xhr.status);
          }
        }
      };
      xhr.send(formData);
    });
  });


  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('loginForm').addEventListener('submit', function(event) {
      event.preventDefault();

      // Clear previous error messages
      document.getElementById('emailError').textContent = '';
      document.getElementById('passwordError').textContent = '';

      // Get form data
      const email = document.getElementById('loginEmail').value;
      const password = document.getElementById('loginPassword').value;
      const testid = document.querySelector("#logintest").value

      // Validate email
      if (!isValidEmail(email)) {
        document.getElementById('emailError').textContent = 'Invalid email format';
        return;
      }

      // Validate password
      if (password.length <= 0) {
        document.getElementById('passwordError').textContent = 'Password required';
        return;
      }

      // Prepare data for submission
      const formData = new FormData();
      formData.append('email', email);
      formData.append('password', password);

      // AJAX request to submit form data
      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'codes/login.php', true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            const response = JSON.parse(xhr.response);
            if (response.message == 'Login success') {
              window.location.href = `index.html?id=${testid}`;
              // Login successful, redirect to dashboard or homepage
              // alert('Login successful!');
              // window.location.href = 'dashboard.php'; 
            } else {
              // Login failed, display error message
              alert(response.message);
            }
          } else {
            console.error('Error: ' + xhr.status);
          }
        }
      };
      xhr.send(formData);
    });
  });

  // Function to validate email format
  function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }
</script>
</body>

</html>