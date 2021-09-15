<?php 



session_start();



$pagetitle='info';



if(isset($_SESSION['username'])){



include 'init.php';



$do=isset($_GET['do'])?$_GET['do']:'manage';



//start info page



//select info 



if($do == 'manage'){



	//manage info page



	



	$stmt=$con->prepare("select * from info");



	//execute the statment



	$stmt->execute();



	//assign to variable



	$rows=$stmt->fetchall();



?>







<h1 class="text-center">ادارة التعليمات</h1>



<div class="container">



<div class="table-responsive">



<table class="main-table text-center table table-bordered ">



	<tr>



		<td>الرقم</td>



		<td> نص التعليمات </td>



		<td>التحكم</td>



	<?php



	foreach($rows as $row ){



		echo "<tr>";



		echo "<td>".$row['idinfo']."</td>";



		echo "<td>".$row['bodyinfo']."</td>";



		echo "<td>



		<a href='info.php?do=edit&idinfo=".$row['idinfo']."'class='btn btn-success'><i class='fa fa-edit'></i>  تعديل</a>



		<a href='info.php?do=delete&idinfo=".$row['idinfo']."'class='btn btn-danger confirm'><i class='fa fa-close'></i> حذف</a>



		</td>";



		echo "</tr>";



	}



	?>



	



	</table>



</div>



	



	<!-- add info --> 



	<a href="info.php?do=add" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة </a>



	</div>







<?php 



	



//start add info page



	



	



}elseif($do == 'add'){//add info page?>



	<div class="container">



	<form class="form-horizontal" action="?do=insert" method="POST">



	<!--start message field-->



	<div style="margin-top: 30px; " class="form-group form-group-lg">



	<label class="col-sm-2 control-label"> التعليمات </label>






		<div class="col-sm-10 col-md-6">





<textarea id="example" style="height:500px; width: 590px;" class="form-control" name="bodyinfo" placeholder=""></textarea>
			

		<input type="submit" value="انشاء التعليمات" class="bt-s btn btn-primary btn-lg"/>



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



		$bodyinfo=$_POST['bodyinfo'];



		



		//validate the form



		



		$formerrors=array();



		if(empty($bodyinfo)){



			$formerrors[]=' برجاء كتابة <strong> التعليمات </strong>';



		}



		



		//loop into errors array and echo it



		foreach($formerrors as $error){



			echo '<div class="alert alert-danger">'.$error.'</div>';



		}



		//check if there's no error proceed the insert operation



		if(empty($formerrors)){



		//insert user info in database



		$stmt=$con->prepare("insert into info (bodyinfo) values (:zbodyinfo) ");



		$stmt->execute(array(



			



		'zbodyinfo'=>$bodyinfo



			



		));



		//echo success message



		echo  "<div class='alert alert-success msg-msg'>".'   تم تسجيل التعليمات بنجاح  </div>';



        header("refresh:3;url=info.php");



		 



		}



	}else{



		$errormsg='sorry you cant browse this page directly';



		redirecthome($errormsg);



	}



	



	echo "</div>";



		



	



}elseif($do == 'edit'){//edit page 



//check if get request idart is numeric & get the integer value of it



$idinfo=isset($_GET['idinfo'])&& is_numeric($_GET['idinfo'])? intval($_GET['idinfo']):0;



//select all data depend on this id



$stmt=$con->prepare("select * from info where idinfo=? limit 1");



//execute query



$stmt->execute(array($idinfo));



//fetch the data



$row=$stmt->fetch();



//the row count



$count=$stmt->rowCount();



//if there's such id show the form



	if($stmt->rowCount()>0){



?>







<h1 class="text-center">تعديل التعليمات</h1>



<div class="container">



<form class="form-horizontal" action="?do=update" method="POST">



	<input type="hidden" name="idinfo" value="<?php echo $row['idinfo']?>"/>



	



	<!--start message field-->



	<div class="form-group form-group-lg">



	<label class="col-sm-2 control-label"> التعليمات </label>






		<div class="col-sm-10 col-md-6 line-two">






		<textarea id="example" style="height:500px; width: 590px;" class="form-control" name="bodyinfo" placeholder=""><?php echo $row['bodyinfo']?></textarea>
			



		</div>



	</div>



	<!--end message field-->



	<!--start submit field-->



	<div class="form-group form-group-lg">



	<div class="col-sm-offset-2 col-sm-10">



		<input type="submit" value="تعديل التعليمات" class="btn btn-primary btn-lg"/>



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



		$idinfo=$_POST['idinfo'];



		$bodyinfo=$_POST['bodyinfo'];



		//validate the form



		$formerrors=array();



		if(empty($bodyinfo)){



			$formerrors[]=' برجاء كتابة <strong> التعليمات </strong>';



		}



		//loop into errors array and echo it



		foreach($formerrors as $error){



			echo '<div class="alert alert-danger">'.$error.'</div>';



		}



		//check if there's no error proceed the update operation



		if(empty($formerrors)){



		//update the database with this info



		$stmt=$con->prepare("update info set bodyinfo=? where idinfo=?");



		$stmt->execute(array($bodyinfo,$idinfo));



		//echo success message



		echo "<div class='alert alert-success msg-msg'>".' تم التعديل بنجاح</div>';



        header("refresh:3;url=info.php");;



		}



		



		



	}else{



		echo 'sorry you cant browse this page directly';



	}



	



	echo "</div>";



}







elseif($do == 'delete'){//delete ads page



	echo "<div class='container'>";



//check if get request userid is numeric & get the integer value of it



$idinfo=isset($_GET['idinfo'])&& is_numeric($_GET['idinfo'])? intval($_GET['idinfo']):0;



//select all data depend on this id



$stmt=$con->prepare("select * from info where idinfo=? limit 1");



//execute query



$stmt->execute(array($idinfo));



//the row count



$count=$stmt->rowCount();



//if there's such id show the form



	if($stmt->rowCount()>0){



	$stmt=$con->prepare("delete from info where idinfo=:zidinfo");



	$stmt->bindparam(":zidinfo",$idinfo);



	$stmt->execute();



		echo  "<div class='alert alert-danger msg-msg'>".'  تم الحذف</div>';



        header("refresh:3;url=info.php");;



		



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



