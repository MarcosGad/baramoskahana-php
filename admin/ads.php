<?php 


session_start();


$pagetitle='ads';


if(isset($_SESSION['username'])){


include 'init.php';


$do=isset($_GET['do'])?$_GET['do']:'manage';


//start ads page


//select ads (adsmsg)


if($do == 'manage'){


	//manage ads page


	


	$stmt=$con->prepare("select * from ads limit 1");


	//execute the statment


	$stmt->execute();


	//assign to variable


	$rows=$stmt->fetchall();


?>





<h1 class="text-center">ادارة التنبيه</h1>


<div class="container">


<div class="table-responsive">


<table class="main-table text-center table table-bordered ">


	<tr>


		<td>الرقم</td>


		<td>نص التنبيه</td>


		<td>التحكم</td>


	<?php


	foreach($rows as $row ){


		echo "<tr>";


		echo "<td>".$row['adsid']."</td>";


		echo "<td>".$row['adsmsg']."</td>";


		echo "<td>

		<a href='ads.php?do=edit&adsid=".$row['adsid']."'class='btn btn-success'><i class='fa fa-edit'></i>  تعديل</a>
		
		<a href='ads.php?do=delete&adsid=".$row['adsid']."'class='btn btn-danger confirm'><i class='fa fa-close'></i> حذف</a>


		</td>";


		echo "</tr>";


	}


	?>


	


	</table>


</div>


	


	<!-- add ads --> 


	<a href="ads.php?do=add" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة تنبيه </a>


	</div>





<?php 


	


//start add ads page


	


}elseif($do == 'add'){//add ads page?>


	<div class="container">


	<form class="form-horizontal" action="?do=insert" method="POST">


	<!--start message field-->


	<div class="form-group form-group-lg msg-ads">


	<label class="col-sm-2 control-label">التنبيه</label>


		<div class="col-sm-10 col-md-6">


		<textarea class="form-control" name="adsmsg" required="required" placeholder="" ></textarea>


		</div>


	</div>


	<!--end message field-->


	<!--start submit field-->


	<div class="form-group form-group-lg">


	<div class="col-sm-offset-2 col-sm-10">


		<input type="submit" value="انشاء التنبيه" class="btn btn-primary btn-lg"/>


		</div>


	</div>


	<!--end submit field-->


</form>


</div>


    


<?php


}elseif($do=='insert'){


	


	//insert ads page


	


	if($_SERVER['REQUEST_METHOD']=='POST'){


		echo "<div class='container'>";


		//get variables from the form


		$adsmsg=$_POST['adsmsg'];


		


		//validate the form


		$formerrors=array();


		if(empty($adsmsg)){


			$formerrors[]='adsmsg cant be <strong>empty</strong>';


		}


		


		//loop into errors array and echo it


		foreach($formerrors as $error){


			echo '<div class="alert alert-danger">'.$error.'</div>';


		}


		//check if there's no error proceed the insert operation


		if(empty($formerrors)){


		//insert user info in database


		$stmt=$con->prepare("insert into ads (adsmsg) values(:zadsmsg)");


		$stmt->execute(array(


		'zadsmsg'=>$adsmsg,


		));


		//echo success message


		echo "<div class='alert alert-success msg-msg'>".' تم تسجيل التنبيه بنجاح</div>';


        header("refresh:3;url=ads.php");


		}


	}else{


		$errormsg='sorry you cant browse this page directly';


		redirecthome($errormsg);


	}


	


	echo "</div>";


}elseif($do == 'edit'){//edit page 



//check if get request idart is numeric & get the integer value of it



$adsid=isset($_GET['adsid'])&& is_numeric($_GET['adsid'])? intval($_GET['adsid']):0;



//select all data depend on this id



$stmt=$con->prepare("select * from ads where adsid=? limit 1");



//execute query



$stmt->execute(array($adsid));



//fetch the data



$row=$stmt->fetch();



//the row count



$count=$stmt->rowCount();



//if there's such id show the form



	if($stmt->rowCount()>0){



?>







<h1 class="text-center">تعديل التنبيهات</h1>



<div class="container">



<form class="form-horizontal" action="?do=update" method="POST">



	<input type="hidden" name="adsid" value="<?php echo $row['adsid']?>"/>



	<!--start message field-->


	<div class="form-group form-group-lg msg-ads">


	<label class="col-sm-2 control-label">التنبيه</label>


		<div class="col-sm-10 col-md-6">


		<textarea class="form-control" name="adsmsg" required="required" placeholder="" ><?php echo $row['adsmsg']?></textarea>


		</div>


	</div>


	<!--end message field-->



	
	<!--start submit field-->



	<div class="form-group form-group-lg">



	<div class="col-sm-offset-2 col-sm-10">



		<input type="submit" value="تعديل التنبيه" class="btn btn-primary btn-lg"/>



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



		$adsid=$_POST['adsid'];



		$adsmsg=$_POST['adsmsg'];




		//validate the form



		$formerrors=array();



		if(empty($adsmsg)){



			$formerrors[]='برجاء كتابة <strong> التنبيه </strong>';



		}



		



		//loop into errors array and echo it



		foreach($formerrors as $error){



			echo '<div class="alert alert-danger">'.$error.'</div>';



		}



		//check if there's no error proceed the update operation



		if(empty($formerrors)){



		//update the database with this info



		$stmt=$con->prepare("update ads set adsmsg=? where adsid=?");



		$stmt->execute(array($adsmsg,$adsid));



		//echo success message



		echo "<div class='alert alert-success msg-msg'>".' تم التعديل بنجاح</div>';



        header("refresh:3;url=ads.php");;



		}



		



		



	}else{



		echo 'sorry you cant browse this page directly';



	}



	



	echo "</div>";






		


	








}elseif($do == 'delete'){//delete ads page


	echo "<div class='container'>";


//check if get request userid is numeric & get the integer value of it


$adsid=isset($_GET['adsid'])&& is_numeric($_GET['adsid'])? intval($_GET['adsid']):0;


//select all data depend on this id


$stmt=$con->prepare("select * from ads where adsid=? limit 1");


//execute query


$stmt->execute(array($adsid));


//the row count


$count=$stmt->rowCount();


//if there's such id show the form


	if($stmt->rowCount()>0){


	$stmt=$con->prepare("delete from ads where adsid=:zadsid");


	$stmt->bindparam(":zadsid",$adsid);


	$stmt->execute();


		echo  "<div class='alert alert-danger msg-msg'>".'  تم الحذف</div>';


        header("refresh:3;url=ads.php");


		


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





