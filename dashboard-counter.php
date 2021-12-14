<?php include('header.php');
$tbname = 'dashboard_counter';
if(isset($_POST['submit']) && $_POST['submit']=='add'){
    $dash_id = $_POST['dash_id'];
    unset($_POST['submit']);
    unset($_POST['dash_id']);
    //$_POST['day_name'] = (is_array($_POST['day_name']) && $_POST['day_name']!='') ? implode(',',$_POST['day_name']) : '';
    
    if(isset($dash_id) && $dash_id!=''){
        
        $resp = update_new($tbname,$_POST,array('id'=>$dash_id));
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
$sql_result = result_array($tbname,array());
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
                    <!--<button type="button" class="btn btn-custom m-2 addbatchpopup" data-toggle="modal" data-target="#exampleModal2">-->
                    <!--    Dashboard Counter-->
                    <!--</button>-->
                    </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header bg-dark py-3">
                            <h6 class="m-0 font-weight-bold text-white">Dashboard Counter</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Students Enrolled</th>
                                            <th>Cities</th>
                                            <th>Students Placed</th>
                                            <th>Workshop</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(count($sql_result) > 0){
                                            foreach($sql_result as $row){ ?>
                                        <tr>
                                            <td><?php echo ($row['students_enrolled']) ?></td>
                                            <td><?php echo ($row['cities']) ?></td>
                                            <td><?php echo $row['students_placed'] ?></td>
                                            <td><?php echo $row['workshop'] ?></td>
                                            <td><button class="p-1 btn-custom mr-1 edit_data" data-workshop="<?php echo $row['workshop'] ?>" data-studentsplaced="<?php echo $row['students_placed'] ?>" data-cities="<?php echo $row['cities'] ?>" data-studentsenrolled="<?php echo $row['students_enrolled'] ?>" data-dashid="<?php echo $row['id'] ?>" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-fw fa-pen"></i></button>
                                            </td>
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
                <input type="hidden" value="" id="dash_id" name="dash_id"/>
                <div class="my-4 row">
                    <label for="Pricing" class="col-sm-4 col-form-label">Students Enrolled</label>
                    <div class="col-sm-8 pr-2">
                      <input type="number" min="0" name="students_enrolled" class="form-control" placeholder="4102" id="students_enrolled" required>
                    </div>
                </div>
                <div class="my-4 row">
                    <label for="Pricing" class="col-sm-4 col-form-label">Cities</label>
                    <div class="col-sm-8 pr-2">
                      <input type="number" min="0" name="cities" class="form-control" placeholder="09" id="cities" required>
                    </div>
                </div>
                <div class="my-4 row">
                    <label for="Pricing" class="col-sm-4 col-form-label">Students Placed</label>
                    <div class="col-sm-8 pr-2">
                      <input type="number" min="0" name="students_placed" class="form-control" placeholder="4110" id="students_placed" required>
                    </div>
                </div>
                <div class="my-4 row">
                    <label for="Pricing" class="col-sm-4 col-form-label">Workshop</label>
                    <div class="col-sm-8 pr-2">
                      <input type="number" min="0" name="workshop" class="form-control" placeholder="20" id="workshop" required>
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
            
            $('.edit_data').click(function(){
                var bvalue = $(this);
                $('#exampleModal input[name=dash_id]').val($(this).data('dashid'));
                
                $('#exampleModal input[name=workshop]').val($(this).data('workshop'));
                $('#exampleModal input[name=students_placed]').val($(this).data('studentsplaced'));
                $('#exampleModal input[name=cities]').val($(this).data('cities'));
                $('#exampleModal input[name=students_enrolled]').val($(this).data('studentsenrolled'));
                
                
                
            })
        })
    </script>
<?php include('footer_script.php') ?>