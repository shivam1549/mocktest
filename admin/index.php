<?php
include('header.php');
require('./db.php');
include('codes/admin.php');
$data = new getAdmindata();
$appdata = $data->getData();
$getusers = $data->getAlluser();
?>

<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Welcome Admin</h3>
          <h6 class="font-weight-normal mb-0">Application to manage online test and manage users</h6>
        </div>

      </div>
    </div>
  </div>
  <div class="row">

    <div class="col-md-12 grid-margin transparent">
      <div class="row">
        <div class="col-md-6 mb-4 stretch-card transparent">
          <div class="card card-tale">
            <div class="card-body">
              <p class="mb-4">Total Users</p>
              <p class="fs-30 mb-2"><?php echo $appdata['totuser']?></p>
              <!-- <p>10.00% (30 days)</p> -->
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4 stretch-card transparent">
          <div class="card card-dark-blue">
            <div class="card-body">
              <p class="mb-4">Total Tests</p>
              <p class="fs-30 mb-2"><?php echo $appdata['testststol']?></p>
              <!-- <p>22.00% (30 days)</p> -->
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
          <div class="card card-light-blue">
            <div class="card-body">
              <p class="mb-4">Todays Attempted Test</p>
              <p class="fs-30 mb-2"><?php echo $appdata['test_count']?></p>
              <!-- <p>2.00% (30 days)</p> -->
            </div>
          </div>
        </div>
        <div class="col-md-6 stretch-card transparent">
          <div class="card card-light-danger">
            <div class="card-body">
              <p class="mb-4">Top Attempted Test (<?php echo str_replace('"', '', $appdata['testattemp']['testname']) ?>)</p>
              <p class="fs-30 mb-2"><?php echo $appdata['testattemp']['attemptedcount']?></p>
              <!-- <p>0.22% (30 days)</p> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
  <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-0">Registered Users</p>
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>Sr No.</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Date</th>
                        </tr>  
                      </thead>
                      <tbody>
                      <?php
                      if($getusers){
                        $i = 1;
                        foreach($getusers as $user){
                          $date = new DateTime($user['created_at']);

                      ?>
                      <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $user['name'];?></td>
                            <td><?php echo $user['email'];?></td>
                            <td><?php echo $date->format('Y M d')?></td>
                      </tr>

                      <?php
                      $i++;
                      }
                    }
                      else{
                        echo "No data found";
                      }
                      ?>

                      

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
  console.log("hello");
</script>
<?php
include('script.php');
?>