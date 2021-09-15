<?php
session_start();


$pagetitle='upload';


if(isset($_SESSION['username'])){

	include 'init.php';
	
	if(isset($_GET['delete_id']))
	{
		// select image from db to delete
		$stmt_select = $con->prepare('SELECT userPic FROM tbl_users WHERE userID =:uid');
		$stmt_select->execute(array(':uid'=>$_GET['delete_id']));
		$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
		unlink("user_images/".$imgRow['userPic']);
		
		// it will delete an actual record from db
		$stmt_delete = $con->prepare('DELETE FROM tbl_users WHERE userID =:uid');
		$stmt_delete->bindParam(':uid',$_GET['delete_id']);
		$stmt_delete->execute();
		
		header("Location: upload.php");
	}

?>




<h1 class="text-center">ادارة التحميلات</h1>

<div class="container">
	
<div class="row">
<?php
	
	$stmt = $con->prepare('SELECT userID, userName, userProfession, userPic FROM tbl_users ORDER BY userID ASC');
	$stmt->execute();
	
	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			
			extract($row);
			?>
				
<div class="table-responsive">


<table class="main-table text-center table table-bordered ">


	<tr>


		<td>عنوان التحميل</td>
		<td>اسم التحميل</td>
		<td>اسم الملف</td>
		<td>التحكم</td>

	<?php
			


		echo "<tr>";


		echo "<td>".$userName."</td>";
			
		echo "<td>".$userProfession."</td>";
			
		echo "<td>".$userPic."</td>";
			
		echo "<td>"?>
		
			<span>
				<a class="btn btn-success" href="editform.php?edit_id=<?php echo $row['userID']; ?>" title="click for edit" ><i class='fa fa-edit'></i> تعديل</a> 
				<a class="btn btn-danger" href="?delete_id=<?php echo $row['userID']; ?>" title="click for delete" onclick="return confirm('sure to delete ?')"><i class='fa fa-close'></i> حذف</a>
				</span>
		
		<?php 
		"</td>";
		echo "</tr>";

			
    ?>
	</table>


</div>
	

			
				      
			<?php
		}
	}
	else
	{
		?>
        <div class="col-xs-12">
        	    <div class="container">
				<div class='alert alert-danger msg-msg'>لا يوجد ملفات</div>
				</div>
        </div>
        <?php
	}
	
?>
</div>	


<div class="page-header">
    	<h1 class="h2"><a class="btn btn-primary" href="addnew.php"> <i class='fa fa-plus'></i> اضافة ملف</a></h1> 
</div>
</div>

<?php

	include $tpl.'footer.php';

}else{


	header('location:index.php');


	exit();


}