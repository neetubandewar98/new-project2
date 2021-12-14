<?php include('config.php'); 
$tbname = 'blog';
if(isset($_POST['submit']) && $_POST['submit']=='add'){
    // echo '<pre>';
    // print_r($_FILES);
    // print_r($_POST); //exit();
    
    if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=''){
        
        $target_dir = "upload_file/";
        $temp = explode(".", $_FILES["image"]["name"]);
        $newfilename = time(). $_FILES["image"]["name"];
        $target_file = $target_dir .$newfilename;
        
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
            $_POST['image'] = $newfilename;
        };
    }
    if(isset($_FILES['extratext']['name']) && $_FILES['extratext']['name']!=''){
        if(count($_FILES['extratext']['name'])>0){
            for($ei=0;$ei<count($_FILES['extratext']['name']);$ei++){
                if($_FILES['extratext']['name'][$ei]['image']!=''){
                    $target_dir = "upload_file/";
                    $temp = explode(".", $_FILES["extratext"]["name"][$ei]['image']);
                    $newfilename1 = time().$ei. $_FILES["extratext"]["name"][$ei]['image'];
                    $target_file = $target_dir .$newfilename1;
                    
                    if(move_uploaded_file($_FILES["extratext"]["tmp_name"][$ei]['image'], $target_file)){
                        // $_POST['image'] = $newfilename;
                        $_POST['extratext'][$ei]['image'] = $newfilename1;
                    };
                /*}else{
                    $_POST['extratext12'][$ei]['images'] = $_POST['extratext'][$ei]['images'];*/
                }
            }
        }
        
    }
    // echo '<pre>';print_r($_POST);exit();
    $blog_id = $_POST['blog_id'];
    $_POST['extratext'] = json_encode($_POST['extratext']);
    // echo '<pre>';print_r($_POST);//exit();
    unset($_POST['submit']);
    unset($_POST['blog_id']);
    
    
    //$_POST['day_name'] = (is_array($_POST['day_name']) && $_POST['day_name']!='') ? implode(',',$_POST['day_name']) : '';
    if(isset($blog_id) && $blog_id!=''){
        $resp = mysqli_query($conn,"UPDATE $tbname set topic='".$_POST['topic']."',thumbnail_title='".$_POST['thumbnail_title']."',blog_date='".$_POST['blog_date']."',author_name='".$_POST['author_name']."',description='".$_POST['description']."',reading_time='".$_POST['reading_time']."',extratext='".$_POST['extratext']."',image='".$_POST['image']."' where id = $blog_id");
        //exit();
        //mysqli_query($conn);
        //$resp = update_new($tbname,$_POST,array('id'=>$blog_id));
        
        if($resp){
            $msg ='<p>Updated Succcessfully</p>';
            $_SESSION['success_msg'] = $msg; 
            header("Location:blog.php");
        }
    }else{
        $resp =  mysqli_query($conn,"INSERT INTO blog(topic,thumbnail_title,blog_date,author_name,reading_time,extratext,image) VALUES('".$_POST['topic']."','".$_POST['thumbnail_title']."','".$_POST['blog_date']."','".$_POST['author_name']."','".$_POST['reading_time']."','".$_POST['extratext']."','".$_POST['image']."')");
        //$resp = insertdata($tbname,$_POST);
        if($resp){
            $msg ='<p>Added Succcessfully</p>';
            $_SESSION['success_msg'] = $msg; 
            header("Location:blog.php");
        }
    }
    // exit();
    
}

if(isset($_GET['delete_id']) && $_GET['delete_id']!=''){
    
    $resp = delete_row($tbname,$_GET['delete_id']);
    
    if($resp){
        $msg ='<p>Deleted Succcessfully</p>';
    }
    //print_r($resp);
}
if(isset($_GET['editid']) && $_GET['editid']!=''){
    $edit_id = base64_decode($_GET['editid']); 
    $sql_result = result_array($tbname,array('blog_status'=>1 ,'trash'=>0,'id'=>$edit_id));
    
    $row = $sql_result[0];
    
    // print_r($row);
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
//$sql = 'SELECT * FROM '.$tbname.' WHERE batch_status=1 and trash=0';
//$sql_result = mysqli_query($conn,$sql);

/**/
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blogs</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/custombutton.css">
    <link rel="stylesheet" href="css/customstyle.css">

    <!-- Custom styles for close button in modal -->
    <link rel="stylesheet" href="css/closebutton.css">
    <style>.hide{display:none;}</style>
</head>

<body id="page-top">
    <div class="container pt-5">
        <?php echo (isset($msg) && $msg!='') ? '<div class="alert">'.$msg.'</div>' : '' ?>
    <a class="text-decoration-none text-custom back-btn" href="blog.php"><i class="fas fa-arrow-left fa-sm fa-fw mr-2"></i>Back</a>
    <h1 class="h3 text-gray-800 my-4">Create a Blog</h1>
    <section>
        <div class="px-3">
            <form action="" class="custom-upload mt-4" method="post" enctype="multipart/form-data">
                <input type="hidden" name="blog_id" value="<?php echo (isset($row['id']) && $row['id']!='') ? $row['id']  : '' ?>" />
                <!-- file upload input -->
                <div class="my-4 row">
                <label for="file-upload" class="form-label col-sm-2 pl-0 my-auto">Upload thumbnail</label><br>
                <input type="file" class="col-sm-4" id="file-upload" name="image">
                <img src="img/upload.svg" class="custom-upload-over" alt="">
                </div>

                <!-- blog title input -->
                <div class="my-4 row">
                <label for="blog-topc" class="form-label col-sm-2 pl-0 my-auto">Topic</label><br>
                <input type="text" placeholder="Type your blog's topic here" class="col-sm-4" id="blog-topc" required name="topic" value="<?php echo (isset($row['topic']) && $row['topic']!='') ? $row['topic']  : '' ?>">
                </div>

                <!-- blog topic input -->
                <div class="my-4 row">
                <label for="blog-title" class="form-label col-sm-2 pl-0 my-auto">Thumbnail Title<br><small>(max 90 characters)</small></label><br>
                <input type="text" placeholder="Type your blog's title here" maxlength="90" class="col-sm-4" id="blog-title" required name="thumbnail_title" value="<?php echo (isset($row['thumbnail_title']) && $row['thumbnail_title']!='') ? $row['thumbnail_title']  : '' ?>">
                </div>
                
                <!-- blog date -->
                <div class="my-4 row">
                    <label for="blog-date" class="form-label col-sm-2 pl-0 my-auto">Date</label><br>
                    <input type="date" placeholder="Type your name here" class="col-sm-4 text-gray-800" id="blog-date" required name="blog_date" value="<?php echo (isset($row['blog_date']) && $row['blog_date']!='') ? $row['blog_date']  : '' ?>">
                </div>

                <!-- blog author input -->
                <div class="my-4 row">
                    <label for="blog-author" class="form-label col-sm-2 pl-0 my-auto">Author name</label><br>
                    <input type="text" placeholder="Type author's name here" class="col-sm-4" id="blog-author" required name="author_name" value="<?php echo (isset($row['author_name']) && $row['author_name']!='') ? $row['author_name']  : '' ?>">
                </div>

                <!-- blog description input -->
                <div class="my-4 row">
                <label for="blog-description" class="form-label col-sm-2 pl-0 mt-2">Description</label><br>
                <textarea rows="6" placeholder="Type your blog's description here" class="col-sm-10 blog-description" id="blog-description" name="description"><?php echo (isset($row['description']) && $row['description']!='') ? $row['description']  : '' ?></textarea>
                </div>

                <!-- blog reading time input -->
                <div class="my-4 row">
                <label for="blog-reading-time" class="form-label col-sm-2 pl-0 my-auto">Reading time</label><br>
                <input type="text" placeholder="add reading time" class="col-sm-4" id="blog-reading-time" required name="reading_time" value="<?php echo (isset($row['reading_time']) && $row['reading_time']!='') ? $row['reading_time']  : '' ?>">
                </div>
                
                <div class="wrapper">
                    <?php 
                    //echo '<pre>';print_r($row);echo '</pre>';
                    
                    if(isset($row['extratext']) && $row['extratext']!=''){
                        
                        // $row['extratext'] = stripslashes(html_entity_decode($row['extratext']));
                        $extra_text = json_decode($row['extratext'],true);
                        //echo json_last_error();
                        // var_dump($extra_text);
                        $h =$im=$de =0;
                        foreach($extra_text as $ei => $ext_row){ 
                        if(isset($ext_row['heading']) && $ext_row['heading']!=''){ ?>
                        <div class="my-4 row">
                        <label for="blog-topc" class="form-label col-sm-2 pl-0 my-auto">Heading</label><br>
                        <input type="text" placeholder="Type your blog's topic here" class="col-sm-4 extratext-heading" id="blog-topc" required name="extratext[<?php echo $h ?>][heading]" value="<?php echo (isset($ext_row['heading']) && $ext_row['heading']!='') ? $ext_row['heading'] : '' ?>">
                        </div> 
                        <?php $h+1;} if(isset($ext_row['image']) && $ext_row['image']!=''){ ?>
                        <div class="my-4 row">
                        <label for="file-upload" class="form-label col-sm-2 pl-0 my-auto">Image</label><br>
                        <input type="file" class="col-sm-4 extratext-img" id="file-upload" name="extratext[<?php echo $im ?>][image]">
                        <input type="hidden" class="col-sm-4 extratext-imgs" id="file-uploads" name="extratext[<?php echo $im ?>][image]" value="<?php echo (isset($ext_row['image']) && $ext_row['image']!='') ? $ext_row['image'] : '' ?>">
                        <img src="img/upload.svg" class="custom-upload-over" alt="">
                        <img src="<?php echo (isset($ext_row['image']) && $ext_row['image']!='') ? './upload_file/'.$ext_row['image'] : '' ?>" alt="" width="100">
                        </div>
                        <?php $im+1;} if(isset($ext_row['description']) && $ext_row['description']!=''){ ?>
                        <div class="my-4 row">
                        <label for="blog-description" class="form-label col-sm-2 pl-0 mt-2">Description</label><br>
                        <textarea rows="6" placeholder="Type your blog's description here" class="col-sm-10 blog-description extratext-desc" id="blog-description" name="extratext[<?php echo $de ?>][description]"><?php echo (isset($ext_row['description']) && $ext_row['description']!='') ? $ext_row['description'] : '' ?></textarea>
                        </div>
                        <?php $de+1;} }
                    } ?>
                </div>
                <div class="row">
                    <button type="button" id="add_heading" class="btn btn-outline-custom mr-3 text my-2 my-md-0">
                        Add Heading
                    </button>
                    <button type="button" id="add_image" class="btn btn-outline-custom mr-3 text my-2 my-md-0">
                        Add Image
                    </button>
                    <button type="button" id="add_desc" class="btn btn-outline-custom my-2 text my-md-0">
                        Add Description
                    </button>
                </div>

                <div class="row">
                    <button type="submit" name="submit" value="add" class="btn btn-custom ml-0 px-4 py-2 mt-4 mr-2">
                        Publish
                    </button>
                    <button type="reset" class="btn btn-custom-danger ml-0 px-4 py-2 mt-4">
                        Cancel
                    </button>
                </div>
            </form>
          </div>
    </section>
    </div>
    <div class="clonehtml-heading hide">
        <div class="my-4 row">
        <label for="blog-topc" class="form-label col-sm-2 pl-0 my-auto">Heading</label><br>
        <input type="text" placeholder="Type your blog's topic here" class="col-sm-4 extratext-heading" id="blog-topc" required name="extratext[0][heading]" value="">
        </div>
    </div>
    <div class="clonehtml-image hide">
        <div class="my-4 row">
        <label for="file-upload" class="form-label col-sm-2 pl-0 my-auto">Image</label><br>
        <input type="file" class="col-sm-4 extratext-img" id="file-upload" name="extratext[0][image]">
        <img src="img/upload.svg" class="custom-upload-over" alt="">
        </div>
    </div>
    <div class="clonehtml-desc hide">
        <div class="my-4 row">
        <label for="blog-description" class="form-label col-sm-2 pl-0 mt-2">Description</label><br>
        <textarea rows="6" placeholder="Type your blog's description here" class="col-sm-10 blog-description extratext-desc" id="blog-description" name="extratext[0][description]"><?php echo (isset($row['description']) && $row['description']!='') ? $row['description']  : '' ?></textarea>
        </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <!--<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
    <script type="text/javascript">
       CKEDITOR.replace('blog-description', {
            skin: 'moono',
            enterMode: CKEDITOR.ENTER_BR,
            shiftEnterMode:CKEDITOR.ENTER_P,
            toolbar: [{ name: 'basicstyles', groups: [ 'basicstyles' ], items: [ 'Bold', 'Italic', 'Underline', "-", 'TextColor', 'BGColor' ] },
                     { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
                     { name: 'scripts', items: [ 'Subscript', 'Superscript' ] },
                     { name: 'justify', groups: [ 'blocks', 'align' ], items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                     { name: 'paragraph', groups: [ 'list', 'indent' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
                     { name: 'links', items: [ 'Link', 'Unlink' ] },
                     { name: 'insert', items: [ 'Image'] },
                     { name: 'spell', items: [ 'jQuerySpellChecker' ] },
                     { name: 'table', items: [ 'Table' ] }
                     ],
            });</script>-->
    <script>
        $(document).ready(function(){
            $('body').on('click','.remove',function(){
                //console.log($(this).parent().find('input').attr('name'));
                $(this).parent().remove();
            })
            $('#add_image').click(function(){
                var imgcount = $('.extratext-img').length;
                imgcount = (imgcount-1);
                //console.log(imgcount);
                var headingimg = $('.clonehtml-image').clone();
                headingimg.find('input').attr('name','extratext['+imgcount+'][image]');
                headingimg.find('.row').append('<span class="btn btn-custom-danger ml-0 px-4 py-2 mt-4 remove">Remove</span>');
                headingimg=headingimg.html();
                // console.log();
                //headingimg+='<span>remove</span>';
                $('.wrapper').append(headingimg);
            });
            $('#add_desc').click(function(){
                var descount = $('.extratext-desc').length;
                descount = (descount-1);
                console.log(descount);
                var headingdesc = $('.clonehtml-desc').clone();
                headingdesc.find('textarea').attr('name','extratext['+descount+'][description]');
                headingdesc.find('.row').append('<span class="btn btn-custom-danger ml-0 px-4 py-2 mt-4 remove">Remove</span>');
                headingdesc=headingdesc.html();
                $('.wrapper').append(headingdesc);
            });
            $('#add_heading').click(function(){
                var headcount = $('.extratext-heading').length;
                headcount = (headcount-1);
                var headingclone = $('.clonehtml-heading').clone();
                headingclone.find('input').attr('name','extratext['+headcount+'][heading]');
                headingclone.find('.row').append('<span class="btn btn-custom-danger ml-0 px-4 py-2 mt-4 remove">Remove</span>');
                headingclone=headingclone.html();
                //console.log(headingclone);
                $('.wrapper').append(headingclone);
            })
        });
    </script>
    
</body>
</html>