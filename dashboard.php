<html>
<head>
<link href="css/style.css" rel="stylesheet" />    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    <?php include('header.php'); 
          include('googleConfig.php');
          $login_button = '';

            //This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
            
          if(!isset($_SESSION['access_token']))
            {
                $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="https://www.oncrashreboot.com/images/create-apple-google-signin-buttons-quick-dirty-way-google.png" /></a>';
            }  
            if($login_button == ''){
    ?>
        <div class="container-fluid">
        <div class="response-msg">

        </div>
        <div class="employee-list">
            <button type="button" class="btn btn-dark add-record" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Record</button>
            <input id="myInput" type="text" placeholder="Search..">
            
            <!-- Scrollable modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="add_record" action="save_record.php" method="post" enctype="multipart/form-data" class="row g-3">
                            <div class="col-md-6">
                                <label for="Name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="Name" name="name">
                            </div>
                            <div class="col-md-6">
                                <label for="Email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="Email" name="email">
                            </div>
                            <div class="col-md-6">
                                <label for="dob" class="form-label">Age</label>
                                <input type="date" class="form-control" id="dob" name="dob">
                            </div>
                            <div class="col-md-6">
                                <label for="Education" class="form-label">Education</label>
                                <select id="Education" name="education" class="form-select">
                                <option selected value="none">-Select one-</option>
                                <option value="Elementary Education">Elementary Education</option>
                                <option value="Secondary & Higher Secondary Education">Secondary & Higher Secondary Education</option>
                                <option value="Higher Education">Higher Education</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="Address" class="form-label">Address</label>
                                <textarea class="form-control" id="Address" name="address" rows="3"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Country</label>
                                <select name="country" class="form-select country-list" onChange='getState(this.value)'>
                                <option selected value="none">- Select -</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">State</label>
                                <select id="State" name="state" class="form-select state-list" onChange='getCity(this.value)'>
                                <option selected value="none">- Select -</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">City</label>
                                <select id="City" name="city" class="form-select city-list">
                                <option selected value="none">- Select -</option>                             
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputZip" class="form-label">Zip</label>
                                <input type="text" class="form-control" id="inputZip" name="pin_code">
                            </div>
                            <div class="col-md-6">
                            <label for="formFile" class="form-label">Profile Picture</label>
                            <input type="file" accept="image/*" name="image"  size='50'/>
                            </div>
                            <span>Status</span>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="Status" name="status" value="approved">
                                    <label class="form-check-label" for="Status">Approve</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="Status" name="status" value="rejected">
                                    <label class="form-check-label" for="Status">Reject</label>
                                </div>
                            </div>
                            
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" data-bs-dismiss="modal" value="submit"></input>
                    </div>
                    </form>
                    </div>
                </div>
            </div>    
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">SN.</th>
                    <th scope="col">Profile Pic.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Age</th>
                    <th scope="col">Education</th>
                    <th scope="col">status</th>
                    <th scope="col">Address</th>
                    <th scope="col">Country</th>
                    <th scope="col">State</th>
                    <th scope="col">City</th>
                    <th scope="col">Pin Code</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="response-data" id="myTable"> 
                    
                </tbody>
            </table>
            <!-- for edit record -->
            <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form id="update_record" action="update_record.php" method="post" enctype="multipart/form-data" class="row g-3">
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" data-bs-dismiss="modal" value="Update"></button>
                    </div>
                    </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>

<script src="js/crudRecord.js"></script>
<script>
// $('#Profile').change(function(e) {
//         var file = e.target[0].files;
//         $('#Profile').attr('name',file);
//     });
</script>
<?php } else{
    header("location:index.php");
}?>
</body>

</html>
