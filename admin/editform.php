<?php
session_start();


$pagetitle='edituploadfile';


if(isset($_SESSION['username'])){ 
	
	error_reporting( ~E_NOTICE );
	
	include 'init.php';
	
	if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
	{
		$id = $_GET['edit_id'];
		$stmt_edit = $con->prepare('SELECT userName, userProfession, userPic FROM tbl_users WHERE userID =:uid');
		$stmt_edit->execute(array(':uid'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: upload.php");
	}
	
	
	
	if(isset($_POST['btn_save_updates']))
	{
		$username = $_POST['user_name'];// user name
		$userjob = $_POST['user_job'];// user email
			
		$imgFile = $_FILES['user_image']['name'];
		$tmp_dir = $_FILES['user_image']['tmp_name'];
		$imgSize = $_FILES['user_image']['size'];
					
		if($imgFile)
		{
			$upload_dir = 'user_images/'; // upload directory	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array("pdf","mp3", "mp4", "wma","rar"); // valid extensions
			$userpic = rand(1000,1000000).".".$imgFile;
			if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize < 134217728)
				{
					unlink($upload_dir.$edit_row['userPic']);
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				}
				else
				{
					$errMSG = "<div class='alert alert-danger msg-msg'>Sorry, your file is too large it should be less then 1GB</div>";
				}
			}
			else
			{
				$errMSG = "<div class='alert alert-danger msg-msg'>Sorry only PDF, MP3, MP4, WMA & RAR files are allowed </div>"; 		
			}	
		}
		else
		{
			// if no image selected the old image remain as it is.
			$userpic = $edit_row['userPic']; // old image from database
		}	
						
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $con->prepare('UPDATE tbl_users 
									     SET userName=:uname, 
										     userProfession=:ujob, 
										     userPic=:upic 
								       WHERE userID=:uid');
			$stmt->bindParam(':uname',$username);
			$stmt->bindParam(':ujob',$userjob);
			$stmt->bindParam(':upic',$userpic);
			$stmt->bindParam(':uid',$id);
				
			if($stmt->execute()){
				echo '<div class="container">';
				echo "<div class='alert alert-success msg-msg'>".'تم التعديل بنجاح</div>';
				echo '</div>';
				header("refresh:3;upload.php"); // redirects image view page after 3 seconds.
			
			}else{
				$errMSG = "<div class='alert alert-danger msg-msg'>Sorry Data Could Not Updated !</div>";
			}
		
		}
		
						
	}
	
?>


<div class="container">


<form method="post" enctype="multipart/form-data" class="form-horizontal">
	
    
    <?php
	if(isset($errMSG)){
		?>
        <div class="alert alert-danger">
          <span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $errMSG; ?>
        </div>
        <?php
	}
	?>
   
  
<h1 class="text-center">رفع ملفات</h1>

<div class="container"> 
	
  

	<div class="form-group form-group-lg">
	    
<label class="col-sm-2 control-label">عنوان التحميل</label>

	
		<div class="col-sm-10 col-md-6">
			
		<input class="form-control" type="text" name="user_name" value="<?php echo $userName; ?>" required />

		</div>
	</div>
    	
	<div class="form-group form-group-lg">

	<label class="col-sm-2 control-label">اسم التحميل</label>

		<div class="col-sm-10 col-md-6">

		<input type="text" class="form-control" name="user_job" required="required" placeholder="" value="<?php echo $userProfession; ?>">

		</div>

	</div>
	
	<!--start upload file-->

<div class="form-group form-group-lg">

<label class="col-sm-2 control-label">اسم الملف</label> 

<div class="col-sm-10 col-md-6">

	<input type="text" class="form-control" readonly required value="<?php echo $userPic;?>" />
	<input style="margin-top: 15px;" class="form-control" type="file" name="user_image" />


	</div>

</div>

<!--end upload file-->
    
    
		<!--start submit field-->

	<div class="form-group form-group-lg">

	<div class="col-sm-offset-2 col-sm-10">

		<input name="btn_save_updates" style="width: 25%;" type="submit" value="تعديل" class="btn btn-primary btn-lg"/>

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