<?php
session_start();


$pagetitle='uploadfile';


if(isset($_SESSION['username'])){ 
	
	error_reporting( ~E_NOTICE ); // avoid notice
	
	include 'init.php';
	
	if(isset($_POST['btnsave']))
	{
		$username = $_POST['user_name'];// user name
		$userjob = $_POST['user_job'];// user email
		
		$imgFile = $_FILES['user_image']['name'];
		$tmp_dir = $_FILES['user_image']['tmp_name'];
		$imgSize = $_FILES['user_image']['size'];
		
		
		if(empty($username)){
			$errMSG = "Please Enter Username.";
		}
		else if(empty($userjob)){
			$errMSG = "Please Enter Your Job Work.";
		}
		else if(empty($imgFile)){
			$errMSG = "Please Select Image File.";
		}
		else
		{
			$upload_dir = 'user_images/'; // upload directory
	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
		
			// valid image extensions
			$valid_extensions = array("pdf","mp3", "mp4", "wma","rar"); // valid extensions
		
			// rename uploading image
			$userpic = rand(1000,1000000).".".$imgFile;
				
			// allow valid image file formats
			if(in_array($imgExt, $valid_extensions)){			
				// Check file size '5MB'
				if($imgSize < 134217728)				{
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				}
				else{
					
				$errMSG = 
                 
				
				"<div class='alert alert-danger msg-msg'>Sorry, your file is too large it should be less then 1GB</div>";
				
             
					
				}
			}
			else{
				$errMSG = 
			
				"<div class='alert alert-danger msg-msg'>Sorry only PDF, MP3, MP4, WMA & RAR files are allowed </div>"; 
					
			}
		}
		
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $con->prepare('INSERT INTO tbl_users(userName,userProfession,userPic) VALUES(:uname, :ujob, :upic)');
			$stmt->bindParam(':uname',$username);
			$stmt->bindParam(':ujob',$userjob);
			$stmt->bindParam(':upic',$userpic);
			
			if($stmt->execute())
			{
				$successMSG =  "<div class='alert alert-success msg-msg'>".' تم رفع الملف بنجاح</div>';
				header("refresh:3;upload.php"); // redirects image view page after 3 seconds.
			}
			else
			{
				$errMSG = "<div class='alert alert-danger msg-msg'>".' حدث خطأ</div>';
			}
		}
	}
?>

<div class="container">


	<?php
	if(isset($errMSG)){
			?>
            <div>
            	<?php echo $errMSG; ?>
            </div>
            <?php
	}
	else if(isset($successMSG)){
		?>
        <div>
              <?php echo $successMSG; ?>
        </div>
        <?php
	}
	?>  
<h1 class="text-center">رفع ملفات</h1>

<div class="container">

<form method="post" enctype="multipart/form-data" class="form-horizontal">
	<div class="form-group form-group-lg">
	    
<label class="col-sm-2 control-label">عنوان التحميل</label>

	
		<div class="col-sm-10 col-md-6">

			
		<input class="form-control" type="text" name="user_name" value="<?php echo $userName; ?>" required />

		</div>
	</div>
	
  
  
	
	<div class="form-group form-group-lg">

	<label class="col-sm-2 control-label">اسم التحميل</label>

		<div class="col-sm-10 col-md-6">

		<input type="text" class="form-control" name="user_job" required="required" placeholder="" value="<?php echo $userjob; ?>">

		</div>

	</div>
    
   
	
<!--start upload file-->

<div class="form-group form-group-lg">

<label class="col-sm-2 control-label">upload file</label> 

<div class="col-sm-10 col-md-6">

	<input type="file" name="user_image" required="required" class="form-control"/>

	</div>

</div>

<!--end upload file-->
	
<!--start submit field-->

	<div class="form-group form-group-lg">

	<div class="col-sm-offset-2 col-sm-10">

		<input name="btnsave" style="width: 25%;" type="submit" value="رفع" class="btn btn-primary btn-lg"/>

		</div>

	</div>

	<!--end submit field-->

    
</form>

<?php

	include $tpl.'footer.php';

}else{


	header('location:index.php');


	exit();


}
