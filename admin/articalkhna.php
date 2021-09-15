<?php 



session_start();



$pagetitle='articalkhna';



if(isset($_SESSION['username'])){



include 'init.php';



$do=isset($_GET['do'])?$_GET['do']:'manage';



//start art page



//select art 



if($do == 'manage'){



	//manage art page



	



	$stmt=$con->prepare("select * from artk");



	//execute the statment



	$stmt->execute();



	//assign to variable



	$rows=$stmt->fetchall();



?>







<h1 class="text-center">ادارة المقال</h1>



<div class="container">



<div class="table-responsive">



<table class="main-table text-center table table-bordered ">



	<tr>



		<td>الرقم</td>



		<td>عنوان المقال</td>



		<td>نص المقال</td>



		<td>التحكم</td>



	<?php



	foreach($rows as $row ){



		echo "<tr>";



		echo "<td>".$row['idartk']."</td>";



		echo "<td>".$row['headerartk']."</td>";



		echo "<td>".$row['bodyartk']."</td>";



		echo "<td>



		<a href='articalkhna.php?do=edit&idartk=".$row['idartk']."'class='btn btn-success'><i class='fa fa-edit'></i>  تعديل</a>



		<a href='articalkhna.php?do=delete&idartk=".$row['idartk']."'class='btn btn-danger confirm'><i class='fa fa-close'></i> حذف</a>



		</td>";



		echo "</tr>";



	}



	?>



	



	</table>



</div>



	



	<!-- add art --> 



	<a href="articalkhna.php?do=add" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة مقال </a>



	</div>







<?php 



	



//start add art page



	



}elseif($do == 'add'){//add art page?>



	<div class="container">



	<form class="form-horizontal" action="?do=insert" method="POST">



	<!--start header art field-->



	<div style="margin-top: 45px;" class="form-group form-group-lg">



	<label class="col-sm-2 control-label">عنوان المقال</label>



		<div class="col-sm-10 col-md-6">



		<input type="text" class="form-control" name="headerartk" required="required" placeholder="">



		</div>



	</div>



	<!--end header art field-->



	<!--start message field-->



	<div class="form-group form-group-lg">



	<label class="col-sm-2 control-label"> المقال</label>



	 



		<div class="col-sm-10 col-md-6">




		<textarea id="example" style="height:500px; width: 590px;" class="form-control" name="bodyartk" placeholder=""></textarea>

			

		<input type="submit" value="انشاء المقال" class="bt-s btn btn-primary btn-lg"/>



		</div>



	</div>



	<!--end message field-->





</form>



</div>



    



<?php



}elseif($do=='insert'){



	



	//insert art page



	



	if($_SERVER['REQUEST_METHOD']=='POST'){



		echo "<div class='container'>";



		//get variables from the form



		$headerartk=$_POST['headerartk'];



		$bodyartk=$_POST['bodyartk'];



		



		//validate the form



		$formerrors=array();



		if(empty($headerartk)){



			$formerrors[]=' برجاء كتابة <strong> عنوان المقال </strong>';



		}



		



		$formerrors=array();



		if(empty($bodyartk)){



			$formerrors[]=' برجاء كتابة <strong> المقال </strong>';



		}



		



		//loop into errors array and echo it



		foreach($formerrors as $error){



			echo '<div class="alert alert-danger">'.$error.'</div>';



		}



		//check if there's no error proceed the insert operation



		if(empty($formerrors)){



		//insert user info in database



		$stmt=$con->prepare("insert into artk (headerartk , bodyartk) values(:zheaderartk , :zbodyartk)");



		$stmt->execute(array(



		'zheaderartk'=>$headerartk,



		'zbodyartk'=>$bodyartk



		));



		//echo success message



		echo  "<div class='alert alert-success msg-msg'>".'  تم تسجيل المقال بنجاح</div>';



        header("refresh:3;url=articalkhna.php");



		 



		}



	}else{



		$errormsg='sorry you cant browse this page directly';



		redirecthome($errormsg);



	}



	



	echo "</div>";



		



	



}elseif($do == 'edit'){//edit page 



//check if get request idart is numeric & get the integer value of it



$idartk=isset($_GET['idartk'])&& is_numeric($_GET['idartk'])? intval($_GET['idartk']):0;



//select all data depend on this id



$stmt=$con->prepare("select * from artk where idartk=? limit 1");



//execute query



$stmt->execute(array($idartk));



//fetch the data



$row=$stmt->fetch();



//the row count



$count=$stmt->rowCount();



//if there's such id show the form



	if($stmt->rowCount()>0){



?>







<h1 class="text-center">تعديل المقالات</h1>



<div class="container">



<form class="form-horizontal" action="?do=update" method="POST">



	<input type="hidden" name="idartk" value="<?php echo $row['idartk']?>"/>



	<!--start header art field-->



	<div class="form-group form-group-lg">



	<label class="col-sm-2 control-label">عنوان المقال</label>



		<div class="col-sm-10 col-md-6">



		<input type="text" class="form-control" name="headerartk" value="<?php echo $row['headerartk']?>" placeholder="">



		</div>



	</div>



	<!--end header art field-->



	<!--start message field-->



	<div class="form-group form-group-lg">



	<label class="col-sm-2 control-label"> المقال</label>







		<div class="col-sm-10 col-md-6 line-four">





<textarea id="example" style="height:500px; width: 590px;" class="form-control" name="bodyartk" placeholder=""><?php echo $row['bodyartk']?></textarea>


		</div>



	</div>



	<!--end message field-->



	<!--start submit field-->



	<div class="form-group form-group-lg">



	<div class="col-sm-offset-2 col-sm-10">



		<input type="submit" value="تعديل المقال" class="btn btn-primary btn-lg"/>



		</div>



	</div>



	<!--end submit field-->



	</form>



</div>







<?php



//if there's no such id show error message



}else{



		echo 'theres no such id';



	}



	



}elseif($do == 'update'){//update page



	echo "<div class='container'>";



	if($_SERVER['REQUEST_METHOD'] == 'POST'){



		//get variable from the form



		$idartk=$_POST['idartk'];



		$headerartk=$_POST['headerartk'];



		$bodyartk=$_POST['bodyartk'];



		//validate the form



		$formerrors=array();



		if(empty($headerartk)){



			$formerrors[]='برجاء كتابة <strong> عنوان المقال </strong>';



		}



		if(empty($bodyartk)){



			$formerrors[]=' برجاء كتابة <strong> المقال </strong>';



		}



		//loop into errors array and echo it



		foreach($formerrors as $error){



			echo '<div class="alert alert-danger">'.$error.'</div>';



		}



		//check if there's no error proceed the update operation



		if(empty($formerrors)){



		//update the database with this info



		$stmt=$con->prepare("update artk set headerartk=?,bodyartk=? where idartk=?");



		$stmt->execute(array($headerartk,$bodyartk,$idartk));



		//echo success message



		echo "<div class='alert alert-success msg-msg'>".' تم التعديل بنجاح</div>';



        header("refresh:3;url=articalkhna.php");;



		}



		



		



	}else{



		echo 'sorry you cant browse this page directly';



	}



	



	echo "</div>";



}







elseif($do == 'delete'){//delete ads page



	echo "<div class='container'>";



//check if get request userid is numeric & get the integer value of it



$idartk=isset($_GET['idartk'])&& is_numeric($_GET['idartk'])? intval($_GET['idartk']):0;



//select all data depend on this id



$stmt=$con->prepare("select * from artk where idartk=? limit 1");



//execute query



$stmt->execute(array($idartk));



//the row count



$count=$stmt->rowCount();



//if there's such id show the form



	if($stmt->rowCount()>0){



	$stmt=$con->prepare("delete from artk where idartk=:zidartk");



	$stmt->bindparam(":zidartk",$idartk);



	$stmt->execute();



		echo  "<div class='alert alert-danger msg-msg'>".'  تم الحذف</div>';



        header("refresh:3;url=articalkhna.php");;



		



}else{



		echo 'this id is not exist';



}



	echo '</div>';



}







include $tpl.'footer.php';



}else{



	header('location:index.php');



	exit();



}







