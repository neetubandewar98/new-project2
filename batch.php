<?php include('header.php');
$tbname = 'batch';
if(isset($_POST['submit']) && $_POST['submit']=='add'){
    $batch_id = $_POST['batch_id'];
    unset($_POST['submit']);
    unset($_POST['batch_id']);
    $_POST['day_name'] = (is_array($_POST['day_name']) && $_POST['day_name']!='') ? implode(',',$_POST['day_name']) : '';
    
    if(isset($batch_id) && $batch_id!=''){
        
        $resp = update_new($tbname,$_POST,array('id'=>$batch_id));
        if($resp){
            $msg ='<p>Updated Succcessfully</p>';
        }
    }else{
        $resp = insertdata($tbname,$_POST);
        if($resp){
            $msg ='<p>Added Succcessfully</p>';
        }
    }
    
    /*$resp = insertdata($tbname,$_POST);
    // print_r($resp);//exit();
    if($resp){
        $msg ='<p>Added Succcessfully</p>';
    }*/
}

if(isset($_GET['delete_id']) && $_GET['delete_id']!=''){
    
    $resp = delete_row($tbname,$_GET['delete_id']);
    
    if($resp){
        $msg ='<p>Deleted Succcessfully</p>';
    }
    //print_r($resp);
}
/*
$fetch_result = get_data('batch','batch_status=1 and trash=0');
print_($fetch_result);
if($fetch_result){
    echo $fetch_result;
print_r(mysqli_fetch_assoc($fetch_result)); exit();
}else{
    echo $fetch_result;
}

/**/
$sql_result = result_array($tbname,array('batch_status'=>1 ,'trash'=>0));
//$sql = 'SELECT * FROM '.$tbname.' WHERE batch_status=1 and trash=0';
//$sql_result = mysqli_query($conn,$sql);

/**/
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php echo (isset($msg) && $msg!='') ? '<div class="alert">'.$msg.'</div>' : '' ?>
                    <!-- Page Heading -->
                    <div class="row justify-content-between mb-4">
                    <div class="col-sm-6"><!-- <h1 class="h3 pl-3 text-gray-800 mt-2">Add New Batch</h1>--></div> 
                    <div class="col-sm-6 d-flex justify-content-lg-end align-items-center">
                    <button type="button" class="btn btn-custom m-2 addbatchpopup" data-toggle="modal" data-target="#exampleModal2">
                        Add new Batch
                    </button>
                    </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header bg-dark py-3">
                            <h6 class="m-0 font-weight-bold text-white">New batch list</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Batch</th>
                                            <th>Date</th>
                                            <th>Days</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(count($sql_result) > 0){
                                            foreach($sql_result as $row){ ?>
                                        <tr>
                                            <td><?php echo ($row['batch_type']==1) ? 'Online' : 'Offline' ?></td>
                                            <td><?php echo $row['batch_date'] ?></td>
                                            <td><?php echo $row['day_name'] ?></td>
                                            <td><?php echo date("H:i A",strtotime($row['start_time'])).' to '.date("H:i A",strtotime($row['end_time'])) ?></td>
                                            <td><button class="p-1 btn-custom mr-1 edit_batch" data-bcity="<?php echo $row['batch_city'] ?>" data-bendtime="<?php echo $row['end_time'] ?>" data-bstarttime="<?php echo $row['start_time'] ?>" data-batch_day="<?php echo $row['batch_day'] ?>" data-day_name="<?php echo $row['day_name'] ?>" data-bdate="<?php echo $row['batch_date'] ?>" data-btype="<?php echo $row['batch_type'] ?>" data-batchid="<?php echo $row['id'] ?>" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-fw fa-pen"></i></button>
                                            <a class="p-1 btn-custom btn-custom-alert" onclick="return confirm('Are You Sure!')" href="?delete_id=<?php echo $row['id'] ?>"><i class="fas fa-fw fa-trash"></i></a></td>
                                        </tr>
                                        <?php } }else{
                                        echo '<tr><th colspan="10">No record found</tr>'; 
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include('footer.php') ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark p-2 px-4">
                <h5 class="modal-title text-white my-auto" id="exampleModal1Label">Add new batch</h5>
                <button type="button" class="close my-auto" data-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body bg-white">
            <form class="p-3" action="" method="post">
                <div class="my-4 row">
                    <label for="Batch" class="col-sm-4 col-form-label">Batch type</label>
                    <div class="col-sm-8 pl-4 row">
                        <div class="custom-control custom-radio my-auto col-4 text-center">
                            <input type="radio" id="customRadio21" name="batch_type" value="1" class="custom-control-input">
                            <label class="custom-control-label" for="customRadio21">Online</label>
                          </div>
                          <div class="custom-control custom-radio my-auto col-4 text-center">
                            <input type="radio" id="customRadio22" name="batch_type" value="2" class="custom-control-input">
                            <label class="custom-control-label" for="customRadio22">Offline</label>
                          </div>
                    </div>
                </div>
                <div class="my-4 row">
                    <label for="City" class="col-sm-4 col-form-label">Select City</label>
                    <div class="col-sm-8">
                        <select class="custom-select" name="batch_city" aria-label="City" id="City" required>
                            <option value="Bengaluru">Bengaluru</option>
                            <option value="Pune">Pune</option>
                            <option value="Mumbai">Mumbai</option>
                            <option value="Hyderabad">Hyderabad</option>
                            <option value="Chennai">Chennai</option>
                            <option value="Gurgaon">Gurgaon</option>
                            <option value="Noida">Noida</option>
                            <option value="Ahmedabad">Ahmedabad</option>
                          </select>
                    </div>
                </div>
                <div class="my-4 row">
                    <label for="Days" class="col-sm-4 col-form-label">Days</label>
                    <div class="col-sm-8">
                        <select class="custom-select" name="batch_day" aria-label="Days" id="Days" required>
                            <option value="Weekdays">Weekdays</option>
                            <option value="Weekends">Weekends</option>
                          </select>
                    </div>
                </div>
                <!-- checkbox -->
                <div>
                    <div class="form-check form-check-inline my-3">
                        <input class="form-check-input" name="day_name[]" type="checkbox" id="inlineCheckbox1" value="Sun">
                        <label class="form-check-label" for="inlineCheckbox1">Sun</label>
                      </div>
                      <div class="form-check form-check-inline my-3">
                        <input class="form-check-input" name="day_name[]" type="checkbox" id="inlineCheckbox2" value="Mon">
                        <label class="form-check-label" for="inlineCheckbox2">Mon</label>
                      </div>
                      <div class="form-check form-check-inline my-3">
                        <input class="form-check-input" name="day_name[]" type="checkbox" id="inlineCheckbox3" value="Tue">
                        <label class="form-check-label" for="inlineCheckbox3">Tue</label>
                      </div>
                      <div class="form-check form-check-inline my-3">
                        <input class="form-check-input" name="day_name[]" type="checkbox" id="inlineCheckbox4" value="Wed">
                        <label class="form-check-label" for="inlineCheckbox4">Wed</label>
                      </div>
                      <div class="form-check form-check-inline my-3">
                        <input class="form-check-input" name="day_name[]" type="checkbox" id="inlineCheckbox5" value="Thu">
                        <label class="form-check-label" for="inlineCheckbox5">Thu</label>
                      </div>
                      <div class="form-check form-check-inline my-3">
                        <input class="form-check-input" name="day_name[]" type="checkbox" id="inlineCheckbox6" value="Fri">
                        <label class="form-check-label" for="inlineCheckbox6">Fri</label>
                      </div>
                      <div class="form-check form-check-inline my-3">
                        <input class="form-check-input" name="day_name[]" type="checkbox" id="inlineCheckbox7" value="Sat">
                        <label class="form-check-label" for="inlineCheckbox7">Sat</label>
                      </div>
                </div>
                <div class="my-4 row">
                    <label for="Date" class="col-sm-4 col-form-label">Date</label>
                    <div class="col-sm-8">
                      <input type="date" name="batch_date" class="form-control" id="Date" required>
                    </div>
                </div>
                <div class="mb-4 row my-4">
                    <label for="Time" class="col-sm-4 col-form-label">Batch timing</label>
                    <div class="col-sm-8 row pr-0 mr-0">
                        <div class="col-sm-6 pr-0">
                        <input type="time" class="form-control" name="start_time" id="Time" required>
                        <small class="form-text text-muted">Start time</small>
                        </div>
                        <div class="col-sm-6 pr-0">
                        <input type="time" class="form-control" name="end_time" id="Time" required>
                        <small class="form-text text-muted">End time</small>
                        </div>
                    </div>
                </div>
                <button type="submit" name="submit" value="add" class="btn btn-custom float-end my-4 px-4" >Publish</button>
            </form>
            </div>
        </div>
        </div>
    </div>
    
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark p-2 px-4">
                <h5 class="modal-title text-white my-auto" id="exampleModal1Label2">Add new batch</h5>
                <button type="button" class="close my-auto" data-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body bg-white">
            <form class="p-3" action="" method="post">
                <div class="my-4 row">
                    <label for="Batch" class="col-sm-4 col-form-label">Batch type</label>
                    <div class="col-sm-8 pl-4 row">
                        <div class="custom-control custom-radio my-auto col-4 text-center">
                            <input type="radio" id="customRadio1" name="batch_type" value="1" class="custom-control-input" required checked>
                            <label class="custom-control-label" for="customRadio1">Online</label>
                          </div>
                          <div class="custom-control custom-radio my-auto col-4 text-center">
                            <input type="radio" id="customRadio2" name="batch_type" value="2" class="custom-control-input" required>
                            <label class="custom-control-label" for="customRadio2">Offline</label>
                          </div>
                    </div>
                </div>
                <div class="my-4 row">
                    <label for="City" class="col-sm-4 col-form-label">Select City</label>
                    <div class="col-sm-8">
                        <select class="custom-select" name="batch_city" aria-label="City" id="City" required>
                            <option value="Bengaluru">Bengaluru</option>
                            <option value="Pune">Pune</option>
                            <option value="Mumbai">Mumbai</option>
                            <option value="Hyderabad">Hyderabad</option>
                            <option value="Chennai">Chennai</option>
                            <option value="Gurgaon">Gurgaon</option>
                            <option value="Noida">Noida</option>
                            <option value="Ahmedabad">Ahmedabad</option>
                          </select>
                    </div>
                </div>
                <div class="my-4 row">
                    <label for="Days" class="col-sm-4 col-form-label">Days</label>
                    <div class="col-sm-8">
                        <select class="custom-select" name="batch_day" aria-label="Days" id="Days" required>
                            <option value="Weekdays">Weekdays</option>
                            <option value="Weekends">Weekends</option>
                          </select>
                    </div>
                </div>
                <!-- checkbox -->
                <div>
                    <div class="form-check form-check-inline my-3">
                        <input class="form-check-input" name="day_name[]" type="checkbox" id="inlineCheckbox1" value="Sun" checked>
                        <label class="form-check-label" for="inlineCheckbox1">Sun</label>
                      </div>
                      <div class="form-check form-check-inline my-3">
                        <input class="form-check-input" name="day_name[]" type="checkbox" id="inlineCheckbox2" value="Mon">
                        <label class="form-check-label" for="inlineCheckbox2">Mon</label>
                      </div>
                      <div class="form-check form-check-inline my-3">
                        <input class="form-check-input" name="day_name[]" type="checkbox" id="inlineCheckbox3" value="Tue">
                        <label class="form-check-label" for="inlineCheckbox3">Tue</label>
                      </div>
                      <div class="form-check form-check-inline my-3">
                        <input class="form-check-input" name="day_name[]" type="checkbox" id="inlineCheckbox4" value="Wed">
                        <label class="form-check-label" for="inlineCheckbox4">Wed</label>
                      </div>
                      <div class="form-check form-check-inline my-3">
                        <input class="form-check-input" name="day_name[]" type="checkbox" id="inlineCheckbox5" value="Thu">
                        <label class="form-check-label" for="inlineCheckbox5">Thu</label>
                      </div>
                      <div class="form-check form-check-inline my-3">
                        <input class="form-check-input" name="day_name[]" type="checkbox" id="inlineCheckbox6" value="Fri">
                        <label class="form-check-label" for="inlineCheckbox6">Fri</label>
                      </div>
                      <div class="form-check form-check-inline my-3">
                        <input class="form-check-input" name="day_name[]" type="checkbox" id="inlineCheckbox7" value="Sat">
                        <label class="form-check-label" for="inlineCheckbox7">Sat</label>
                      </div>
                </div>
                <div class="my-4 row">
                    <label for="Date" class="col-sm-4 col-form-label">Date</label>
                    <div class="col-sm-8">
                      <input type="date" name="batch_date" class="form-control" id="Date" required>
                    </div>
                </div>
                <div class="mb-4 row my-4">
                    <label for="Time" class="col-sm-4 col-form-label">Batch timing</label>
                    <div class="col-sm-8 row pr-0 mr-0">
                        <div class="col-sm-6 pr-0">
                        <input type="time" class="form-control" name="start_time" id="Time" required>
                        <small class="form-text text-muted">Start time</small>
                        </div>
                        <div class="col-sm-6 pr-0">
                        <input type="time" class="form-control" name="end_time" id="Time" required>
                        <small class="form-text text-muted">End time</small>
                        </div>
                    </div>
                </div>
                <button type="submit" name="submit" value="add" class="btn btn-custom float-end my-4 px-4" >Publish</button>
            </form>
            </div>
        </div>
        </div>
    </div>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script>
        $(document).ready(function(){
            
            // $('.addbatchpopup').click(function(){
            //     console.log('asdsssss');
            //     $('#exampleModal1Label').text('Add new batch');
                
            //     $('#exampleModal').find('input').val('');
            //     $('#exampleModal').find('input:checkbox').removeAttr('checked');
                
            // });
            
            $('.edit_batch').click(function(){
                
                var bvalue = $(this);
                $('#exampleModal input[name=batch_id]').val($(this).data('batchid'));
                
                $('#exampleModal input[name=batch_date]').val($(this).data('bdate'));
                $('#exampleModal input[name=start_time]').val($(this).data('bstarttime'));
                $('#exampleModal input[name=end_time]').val($(this).data('bendtime'));
                
                $('#exampleModal select[name=batch_city]  option[value="'+$(this).data('bcity')+'"]').prop("selected", true);
                $('#exampleModal select[name=batch_day]  option[value="'+$(this).data('batch_day')+'"]').prop("selected", true);
                
                var dayname = bvalue.data('day_name').split(',');
                $("#exampleModal input:checkbox[name^=day_name]").each(function(){
                    var checkboxthis = $(this);
                    console.log('day_name==',$('input[name=batch_type]').val(),bvalue.data('day_name'),checkboxthis.val(),dayname);
                    if(jQuery.inArray(checkboxthis.val(), dayname)!== -1){
                        checkboxthis.attr('checked','checked');
                    }
                });
                
                $("#exampleModal input[name=batch_type]").each(function(){
                    console.log('bytpe==',$('input[name=batch_type]').val(),bvalue.data('btype'),$(this).val());
                    if($(this).val()==bvalue.data('btype')){
                        $(this).attr('checked','checked');
                    }
                });
                
                
                $('#exampleModal1Label').text('Edit Batch');
            })
        })
    </script>
<?php include('footer_script.php') ?>