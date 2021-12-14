<?php include('header.php'); 
$tbname = 'blog';
if(isset($_POST['submit']) && $_POST['submit']=='add'){
    unset($_POST['submit']);
    $_POST['day_name'] = (is_array($_POST['day_name']) && $_POST['day_name']!='') ? implode(',',$_POST['day_name']) : '';
    $resp = insertdata($tbname,$_POST);
    // print_r($resp);//exit();
    if($resp){
        $msg ='<p>Added Succcessfully</p>';
    }
}

if(isset($_GET['delete_id']) && $_GET['delete_id']!=''){
    
    $resp = delete_row($tbname,$_GET['delete_id']);
    
    if($resp){
        $msg ='<p>Deleted Succcessfully</p>';
        $_SESSION['success_msg'] = $msg; 
        header('Location:blog.php');
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
$sql_result = result_array($tbname,array('blog_status'=>1 ,'trash'=>0));
//$sql = 'SELECT * FROM '.$tbname.' WHERE batch_status=1 and trash=0';
//$sql_result = mysqli_query($conn,$sql);

/**/
?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php echo (isset($_SESSION['success_msg']) && $_SESSION['success_msg']!='') ? '<div class="alert">'.$_SESSION['success_msg'].'</div>' : '';
                        unset($_SESSION['success_msg']);
                    ?>
                    
                    <!-- Page Heading -->
                    <div class="row justify-content-between mb-4">
                    <div class="col-sm-6"><!-- <h1 class="h3 pl-3 text-gray-800 mt-2">Add New Events</h1> --></div>
                    <div class="col-sm-6 d-flex justify-content-lg-end align-items-center">
                    <a class="btn btn-custom m-2" href="createblog.php">
                        Create New Blog
                    </a>
                    </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header bg-dark py-3">
                            <h6 class="m-0 font-weight-bold text-white">Blogs</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Topic</th>
                                            <th>Day</th>
                                            <th>Date</th>
                                            <th>Activity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(count($sql_result) > 0){
                                            foreach($sql_result as $k => $row){ ?>
                                        <tr>
                                            <td><?php echo $row['thumbnail_title'] ?></td>
                                            <td><?php echo $row['topic'] ?></td>
                                            <td><?php echo date('D',strtotime($row['blog_date'])) ?></td>
                                            <td><?php echo $row['blog_date'] ?></td>
                                            <td>
                                                <a href="createblog.php?editid=<?php echo base64_encode($row['id']) ?>" class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></a>
                                                <a class="p-1 btn-custom btn-custom-alert" onclick="return confirm('Are You Sure!')" href="?delete_id=<?php echo $row['id'] ?>"><i class="fas fa-fw fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php } }else{
                                        echo '<tr><th colspan="10">No record found</tr>'; 
                                        } ?>
                                        <!--
                                        <tr>
                                            <td>Photoshop</td>
                                            <td>New in Photoshop 2022</td>
                                            <td>Tuesday</td>
                                            <td>03:00 pm</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Figma</td>
                                            <td>Create components easily</td>
                                            <td>Tuesday</td>
                                            <td>02:00 pm</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Windows 11</td>
                                            <td>Problems in Windows 11</td>
                                            <td>Sunday</td>
                                            <td>11:00 pm</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Colors</td>
                                            <td>Choose colors for UI</td>
                                            <td>Thursday</td>
                                            <td>01:00 pm</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Adobe</td>
                                            <td>Photoshop New Update</td>
                                            <td>Friday</td>
                                            <td>04:00 pm</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>-->
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


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script>
        $(".alert").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert").slideUp(500);
        });
    </script>
</body>

</html>