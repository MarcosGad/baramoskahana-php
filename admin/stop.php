<?php 


session_start();


$pagetitle='stop';


if(isset($_SESSION['username'])){


include 'init.php';


$do=isset($_GET['do'])?$_GET['do']:'manage';


//start stop page


//select stop (stopmsg)


if($do == 'manage'){


	//manage stop page


	


	$stmt=$con->prepare("select * from stop limit 1");


	//execute the statment


	$stmt->execute();


	//assign to variable


	$rows=$stmt->fetchall();


?>





<h1 class="text-center">ادارة اغلاق الحجز</h1>


<div class="container">


<div class="table-responsive">


<table class="main-table text-center table table-bordered ">


	<tr>


		<td>الرقم</td>


		<td>نص الأغلاق</td>


		<td>التحكم</td>


	<?php


	foreach($rows as $row ){


		echo "<tr>";


		echo "<td>".$row['stopid']."</td>";


		echo "<td>".$row['stopmsg']."</td>";


		echo "<td>

		<a href='stop.php?do=edit&stopid=".$row['stopid']."'class='btn btn-success'><i class='fa fa-edit'></i>  تعديل</a>
		
		<a href='stop.php?do=delete&stopid=".$row['stopid']."'class='btn btn-danger confirm'><i class='fa fa-close'></i> حذف</a>


		</td>";


		echo "</tr>";


	}


	?>


	


	</table>


</div>


	


	<!-- add stop --> 


	<a href="stop.php?do=add" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة نص الأغلاق </a>


	</div>





<?php 


	


//start add stop page


	


}elseif($do == 'add'){//add stop page?>


	<div class="container">


	<form class="form-horizontal" action="?do=insert" method="POST">


	<!--start message field-->


	<div class="form-group form-group-lg msg-ads">


	<label class="col-sm-2 control-label">نص الأغلاق</label>


		<div class="col-sm-10 col-md-6">


		<textarea class="form-control" name="stopmsg" required="required" placeholder="" ></textarea>


		</div>


	</div>


	<!--end message field-->


	<!--start submit field-->


	<div class="form-group form-group-lg">


	<div class="col-sm-offset-2 col-sm-10">


		<input type="submit" value="انشاء نص الأغلاق" class="btn btn-primary btn-lg"/>


		</div>


	</div>


	<!--end submit field-->


</form>


</div>


    


<?php


}elseif($do=='insert'){


	


	//insert stop page


	


	if($_SERVER['REQUEST_METHOD']=='POST'){


		echo "<div class='container'>";


		//get variables from the form


		$stopmsg=$_POST['stopmsg'];


		


		//validate the form


		$formerrors=array();


		if(empty($stopmsg)){


			$formerrors[]='stopmsg cant be <strong>empty</strong>';


		}


		


		//loop into errors array and echo it


		foreach($formerrors as $error){


			echo '<div class="alert alert-danger">'.$error.'</div>';


		}


		//check if there's no error proceed the insert operation


		if(empty($formerrors)){


		//insert user info in database


		$stmt=$con->prepare("insert into stop (stopmsg) values(:zstopmsg)");


		$stmt->execute(array(


		'zstopmsg'=>$stopmsg,


		));


		//echo success message


		echo "<div class='alert alert-success msg-msg'>".' تم تسجيل رسالة الأغلاق بنجاح</div>';


        header("refresh:3;url=stop.php");


		}


	}else{


		$errormsg='sorry you cant browse this page directly';


		redirecthome($errormsg);


	}


	


	echo "</div>";


}elseif($do == 'edit'){//edit page 



//check if get request idart is numeric & get the integer value of it



$stopid=isset($_GET['stopid'])&& is_numeric($_GET['stopid'])? intval($_GET['stopid']):0;



//select all data depend on this id



$stmt=$con->prepare("select * from stop where stopid=? limit 1");



//execute query



$stmt->execute(array($stopid));



//fetch the data



$row=$stmt->fetch();



//the row count



$count=$stmt->rowCount();



//if there's such id show the form



	if($stmt->rowCount()>0){



?>







<h1 class="text-center">تعديل نص الأغلاق</h1>



<div class="container">



<form class="form-horizontal" action="?do=update" method="POST">



	<input type="hidden" name="stopid" value="<?php echo $row['stopid']?>"/>



	<!--start message field-->


	<div class="form-group form-group-lg msg-ads">


	<label class="col-sm-2 control-label">نص الأغلاق</label>


		<div class="col-sm-10 col-md-6">


		<textarea class="form-control" name="stopmsg" required="required" placeholder="" ><?php echo $row['stopmsg']?></textarea>


		</div>


	</div>


	<!--end message field-->



	
	<!--start submit field-->



	<div class="form-group form-group-lg">



	<div class="col-sm-offset-2 col-sm-10">



		<input type="submit" value="تعديل نص الأغلاق" class="btn btn-primary btn-lg"/>



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



		$stopid=$_POST['stopid'];



		$stopmsg=$_POST['stopmsg'];




		//validate the form



		$formerrors=array();



		if(empty($stopmsg)){



			$formerrors[]='برجاء كتابة <strong> نص الأغلاق </strong>';



		}



		



		//loop into errors array and echo it



		foreach($formerrors as $error){



			echo '<div class="alert alert-danger">'.$error.'</div>';



		}



		//check if there's no error proceed the update operation



		if(empty($formerrors)){



		//update the database with this info



		$stmt=$con->prepare("update stop set stopmsg=? where stopid=?");



		$stmt->execute(array($stopmsg,$stopid));



		//echo success message



		echo "<div class='alert alert-success msg-msg'>".' تم التعديل بنجاح</div>';



        header("refresh:3;url=stop.php");;



		}



		



		



	}else{



		echo 'sorry you cant browse this page directly';



	}



	



	echo "</div>";






		


	








}elseif($do == 'delete'){//delete stop page


	echo "<div class='container'>";


//check if get request userid is numeric & get the integer value of it


$stopid=isset($_GET['stopid'])&& is_numeric($_GET['stopid'])? intval($_GET['stopid']):0;


//select all data depend on this id


$stmt=$con->prepare("select * from stop where stopid=? limit 1");


//execute query


$stmt->execute(array($stopid));


//the row count


$count=$stmt->rowCount();


//if there's such id show the form


	if($stmt->rowCount()>0){


	$stmt=$con->prepare("delete from stop where stopid=:zstopid");


	$stmt->bindparam(":zstopid",$stopid);


	$stmt->execute();


		echo  "<div class='alert alert-danger msg-msg'>".'  تم الحذف</div>';


        header("refresh:3;url=stop.php");


		


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





