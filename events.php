<?php 

$tbname = 'events';
include('header.php');
$filepath = "http://".$_SERVER['HTTP_HOST']."/school-plan/upload_file/";
if(isset($_POST['submit']) && $_POST['submit']=='add'){
    
    if(isset($_FILES['event_img']['name']) && $_FILES['event_img']['name']!=''){
        
        $target_dir = "upload_file/";
        $temp = explode(".", $_FILES["event_img"]["name"]);
        $newfilename = time(). $_FILES["event_img"]["name"];
        $target_file = $target_dir .$newfilename;
        
        if(move_uploaded_file($_FILES["event_img"]["tmp_name"], $target_file)){
            $_POST['event_img'] = $newfilename;
        };
    }
    
    $event_id = $_POST['event_id'];
    unset($_POST['submit']);
    unset($_POST['event_id']);
    //print_r($_POST); exit();
    if(isset($event_id) && $event_id!=''){
        
        $resp = update_new($tbname,$_POST,array('id'=>$event_id));
        if($resp){
            $msg ='<p>Updated Succcessfully</p>';
        }
    }else{
        $resp = insertdata($tbname,$_POST);
        if($resp){
            $msg ='<p>Added Succcessfully</p>';
        }
    }
    //print_r($resp);exit();
    
}

if(isset($_GET['delete_id']) && $_GET['delete_id']!=''){
    
    $resp = delete_row($tbname,$_GET['delete_id']);
    
    if($resp){
        $msg ='<p>Deleted Succcessfully</p>';
    }
    //print_r($resp);
}

//$table_name,$where_condition,$extra_where=null)
$sql_result = result_array($tbname,array());
//print_r($sql_result);
//$sql = 'SELECT * FROM '.$tbname.' WHERE event_status=1 and trash=0';
//$sql_result = mysqli_query($conn,$sql);
?>

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php echo (isset($msg) && $msg!='') ? '<div class="alert">'.$msg.'</div>' : '' ?>
                    <!-- Page Heading -->
                    <div class="row justify-content-between mb-4">
                    <div class="col-sm-6"><!-- <h1 class="h3 pl-3 text-gray-800 mt-2">Add New Events</h1> --></div>
                    <div class="col-sm-6 d-flex justify-content-lg-end align-items-center">
                    <button type="button" class="btn btn-custom m-2 addeventpopup" data-toggle="modal" data-target="#exampleModal1">
                        Add New Event
                    </button>
                    </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header bg-dark py-3">
                            <h6 class="m-0 font-weight-bold text-white">Updated events list</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Event</th>
                                            <th>Date</th>
                                            <th>Day</th>
                                            <th>Time</th>
                                            <th>Activity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(count($sql_result) > 0){
                                            foreach($sql_result as $k => $row){ ?>
                                        <tr>
                                            <td><?php echo $row['title'] ?></td>
                                            <td><?php echo $row['event_date'] ?></td>
                                            <td><?php echo date('D',strtotime($row['event_date'])) ?></td>
                                            <td><?php echo date("H:i A",strtotime($row['event_start_time'])).' to '.date("H:i A",strtotime($row['event_end_time'])) ?></td>
                                            <td><button class="p-1 btn-custom mr-1 edit_event" data-eimg="<?php echo $row['event_img'] ?>" data-eventid="<?php echo $row['id'] ?>" data-title="<?php echo $row['title'] ?>" data-date="<?php echo $row['event_date'] ?>" data-stime="<?php echo $row['event_start_time'] ?>" data-etime="<?php echo $row['event_end_time'] ?>" data-eprice="<?php echo $row['event_price'] ?>" data-toggle="modal" data-target="#exampleModal1"><i class="fas fa-fw fa-pen"></i></button>
                                            <a class="p-1 btn-custom btn-custom-alert" onclick="return confirm('Are You Sure!')" href="?delete_id=<?php echo $row['id'] ?>"><i class="fas fa-fw fa-trash"></i></a></td>
                                        </tr>
                                        <?php } }else{
                                        echo '<tr><th colspan="10">No record found</tr>'; 
                                        } ?>
                                        <!--
                                        <tr>
                                            <td>Online</td>
                                            <td>02 Nov 2021</td>
                                            <td>Tuesday</td>
                                            <td>03:00 pm to 07:00 pm</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Offine</td>
                                            <td>04 Nov 2021</td>
                                            <td>Thursday</td>
                                            <td>09:00 am to 01:00 pm</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Online</td>
                                            <td>08 Nov 2021</td>
                                            <td>Monday</td>
                                            <td>07:00 pm to 09:00 pm</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Online</td>
                                            <td>14 Nov 2021</td>
                                            <td>Sunday</td>
                                            <td>06:00 pm to 08:00 pm</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Online</td>
                                            <td>6 Nov 2021</td>
                                            <td>Saturday</td>
                                            <td>10:00 am to 02:00 pm</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Online</td>
                                            <td>29 Oct 2021</td>
                                            <td>Friday</td>
                                            <td>03:00 pm to 07:00 am</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Online</td>
                                            <td>02 Nov 2021</td>
                                            <td>Tuesday</td>
                                            <td>03:00 pm to 07:00 pm</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Offine</td>
                                            <td>04 Nov 2021</td>
                                            <td>Thursday</td>
                                            <td>09:00 am to 01:00 pm</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Online</td>
                                            <td>08 Nov 2021</td>
                                            <td>Monday</td>
                                            <td>07:00 pm to 09:00 pm</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Online</td>
                                            <td>14 Nov 2021</td>
                                            <td>Sunday</td>
                                            <td>06:00 pm to 08:00 pm</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Online</td>
                                            <td>6 Nov 2021</td>
                                            <td>Saturday</td>
                                            <td>10:00 am to 02:00 pm</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Online</td>
                                            <td>29 Oct 2021</td>
                                            <td>Friday</td>
                                            <td>03:00 pm to 07:00 am</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Online</td>
                                            <td>02 Nov 2021</td>
                                            <td>Tuesday</td>
                                            <td>03:00 pm to 07:00 pm</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Offine</td>
                                            <td>04 Nov 2021</td>
                                            <td>Thursday</td>
                                            <td>09:00 am to 01:00 pm</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Online</td>
                                            <td>08 Nov 2021</td>
                                            <td>Monday</td>
                                            <td>07:00 pm to 09:00 pm</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Online</td>
                                            <td>14 Nov 2021</td>
                                            <td>Sunday</td>
                                            <td>06:00 pm to 08:00 pm</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Online</td>
                                            <td>6 Nov 2021</td>
                                            <td>Saturday</td>
                                            <td>10:00 am to 02:00 pm</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Online</td>
                                            <td>29 Oct 2021</td>
                                            <td>Friday</td>
                                            <td>03:00 pm to 07:00 am</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Online</td>
                                            <td>02 Nov 2021</td>
                                            <td>Tuesday</td>
                                            <td>03:00 pm to 07:00 pm</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Offine</td>
                                            <td>04 Nov 2021</td>
                                            <td>Thursday</td>
                                            <td>09:00 am to 01:00 pm</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Online</td>
                                            <td>08 Nov 2021</td>
                                            <td>Monday</td>
                                            <td>07:00 pm to 09:00 pm</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Online</td>
                                            <td>14 Nov 2021</td>
                                            <td>Sunday</td>
                                            <td>06:00 pm to 08:00 pm</td>
                                            <td><button class="p-1 btn-custom mr-1"><i class="fas fa-fw fa-pen"></i></button><button class="p-1 btn-custom btn-custom-alert"><i class="fas fa-fw fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>Online</td>
                                            <td>6 Nov 2021</td>
                                            <td>Saturday</td>
                                            <td>10:00 am to 02:00 pm</td>
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


    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModal1Label" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark p-2 px-4">
            <h5 class="modal-title text-white my-auto" id="exampleModal1Label">Add new event</h5>
            <button type="button" class="close my-auto" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-white">
            <form class="p-3" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="event_id">
                <div class="my-4 row">
                    <label for="Title" class="col-sm-4 col-form-label">Event title</label>
                    <div class="col-sm-8 pr-2">
                      <input type="text" name="title" placeholder="Type event title..." class="form-control" id="Title" required>
                    </div>
                </div>
                <div class="my-4 row">
                    <label for="Date" class="col-sm-4 col-form-label">Select date</label>
                    <div class="col-sm-8 pr-2">
                      <input type="date" name="event_date" class="form-control" id="Date" required>
                    </div>
                </div>
                  <div class="row my-4">
                    <label for="Time" class="col-sm-4 col-form-label">Event timing</label>
                    <div class="col-sm-8 row pr-0 mr-0">
                        <div class="col-sm-6 pr-0">
                        <input type="time" name="event_start_time" class="form-control" id="Time" required>
                        <small class="form-text text-muted">Start time</small>
                        </div>
                        <div class="col-sm-6 pr-0">
                        <input type="time" name="event_end_time" class="form-control" id="Time" required>
                        <small class="form-text text-muted">End time</small>
                        </div>
                    </div>
                </div>
                <div class="my-4 row">
                    <label for="Pricing" class="col-sm-4 col-form-label">Pricing</label>
                    <div class="col-sm-8 pr-2">
                      <input type="number" min="0" name="event_price" class="form-control" placeholder="₹" id="Pricing" required>
                    </div>
                </div>
                <div class="my-4 row">
                    <label for="file" class="col-sm-4 col-form-label">Select image</label>
                    <div class="col-sm-8 pr-2">
                      <input type="file" name="event_img" class="form-control pt-1 pl-1" id="file">
                    </div>
                    
                    <img src="" id="event_img" style="width:25%;display:hide;"/>
                </div>
                <button type="submit" name="submit" value="add" class="btn btn-custom float-end my-4 px-4">Publish</button>
            </form>
            </div>
        </div>
        </div>
    </div>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script>
        $(document).ready(function(){
            
            $('.addeventpopup').click(function(){
                console.log('asdsssss');
                $('#exampleModal1Label').text('Add new event');
                $('#event_img').attr('src','').hide();
                $('#exampleModal1').find('input').val('');
                
            });
            
            $('.edit_event').click(function(){
                var formdata = $(this).data('title');
                var values = $(this).data('title');
                $('input[name=event_id]').val($(this).data('eventid'));
                $('input[name=title]').val($(this).data('title'));
                $('input[name=event_date]').val($(this).data('date'));
                $('input[name=event_start_time]').val($(this).data('stime'));
                $('input[name=event_end_time]').val($(this).data('etime'));
                $('input[name=event_price]').val($(this).data('eprice'));
                if($(this).data('eimg')!=''){
                    $('#event_img').attr('src',"<?php echo $filepath ?>"+$(this).data('eimg')).show();
                }else{
                    $('#event_img').attr('src','').hide();
                }
                console.log('formdata',formdata,values);
                $('#exampleModal1Label').text('Edit Event');
            })
        })
    </script>
<?php include('footer_script.php') ?>