<?php 


session_start();


$pagetitle='aya';


if(isset($_SESSION['username'])){


include 'init.php';


$do=isset($_GET['do'])?$_GET['do']:'manage';


//start ads page


//select ads (adsmsg)


if($do == 'manage'){


	//manage ads page


	


	$stmt=$con->prepare("select * from aya limit 1");


	//execute the statment


	$stmt->execute();


	//assign to variable


	$rows=$stmt->fetchall();


?>





<h1 class="text-center">ادارة الأيات</h1>


<div class="container">


<div class="table-responsive">


<table class="main-table text-center table table-bordered ">


	<tr>


		<td>الرقم</td>


		<td>نص الأيه</td>


		<td>التحكم</td>


	<?php


	foreach($rows as $row ){


		echo "<tr>";


		echo "<td>".$row['ayaid']."</td>";


		echo "<td>".$row['ayamsg']."</td>";


		echo "<td>

		<a href='aya.php?do=edit&ayaid=".$row['ayaid']."'class='btn btn-success'><i class='fa fa-edit'></i>  تعديل</a>

		
		<a href='aya.php?do=delete&ayaid=".$row['ayaid']."'class='btn btn-danger confirm'><i class='fa fa-close'></i> حذف</a>


		</td>";


		echo "</tr>";


	}


	?>


	


	</table>


</div>


	


	<!-- add ads --> 


	<a href="aya.php?do=add" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة ايه </a>


	</div>





<?php 


	


//start add ads page


	


}elseif($do == 'add'){//add ads page?>


	<div class="container">


	<form class="form-horizontal" action="?do=insert" method="POST">


	<!--start message field-->


	<div class="form-group form-group-lg msg-ads">


	<label class="col-sm-2 control-label">الأيه</label>


		<div class="col-sm-10 col-md-6">


		<textarea class="form-control" name="ayamsg" required="required" placeholder="" ></textarea>


		</div>


	</div>


	<!--end message field-->


	<!--start submit field-->


	<div class="form-group form-group-lg">


	<div class="col-sm-offset-2 col-sm-10">


		<input type="submit" value="انشاء الأيه" class="btn btn-primary btn-lg"/>


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


		$ayamsg=$_POST['ayamsg'];


		


		//validate the form


		$formerrors=array();


		if(empty($ayamsg)){


			$formerrors[]='ayamsg cant be <strong>empty</strong>';


		}


		


		//loop into errors array and echo it


		foreach($formerrors as $error){


			echo '<div class="alert alert-danger">'.$error.'</div>';


		}


		//check if there's no error proceed the insert operation


		if(empty($formerrors)){


		//insert user info in database


		$stmt=$con->prepare("insert into aya (ayamsg) values(:zayamsg)");


		$stmt->execute(array(


		'zayamsg'=>$ayamsg,


		));


		//echo success message


		echo "<div class='alert alert-success msg-msg'>".' تم تسجيل التنبيه بنجاح</div>';


        header("refresh:3;url=aya.php");


		}


		}else{


		$errormsg='sorry you cant browse this page directly';


		redirecthome($errormsg);


	}


	


	echo "</div>";

}elseif($do == 'edit'){//edit page 



//check if get request idart is numeric & get the integer value of it



$ayaid=isset($_GET['ayaid'])&& is_numeric($_GET['ayaid'])? intval($_GET['ayaid']):0;



//select all data depend on this id



$stmt=$con->prepare("select * from aya where ayaid=? limit 1");



//execute query



$stmt->execute(array($ayaid));



//fetch the data



$row=$stmt->fetch();



//the row count



$count=$stmt->rowCount();



//if there's such id show the form



	if($stmt->rowCount()>0){



?>







<h1 class="text-center">تعديل الأيات</h1>



<div class="container">



<form class="form-horizontal" action="?do=update" method="POST">



	<input type="hidden" name="ayaid" value="<?php echo $row['ayaid']?>"/>



	<!--start message field-->


	<div class="form-group form-group-lg msg-ads">


	<label class="col-sm-2 control-label">الأيه</label>


		<div class="col-sm-10 col-md-6">


		<textarea class="form-control" name="ayamsg" required="required" placeholder="" ><?php echo $row['ayamsg']?></textarea>


		</div>


	</div>


	<!--end message field-->


	
	<!--start submit field-->



	<div class="form-group form-group-lg">



	<div class="col-sm-offset-2 col-sm-10">



		<input type="submit" value="تعديل الأيه" class="btn btn-primary btn-lg"/>



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



		$ayaid=$_POST['ayaid'];



		$ayamsg=$_POST['ayamsg'];




		//validate the form



		$formerrors=array();



		if(empty($ayamsg)){



			$formerrors[]='برجاء كتابة <strong> الأيه </strong>';



		}



		



		//loop into errors array and echo it



		foreach($formerrors as $error){



			echo '<div class="alert alert-danger">'.$error.'</div>';



		}



		//check if there's no error proceed the update operation



		if(empty($formerrors)){



		//update the database with this info



		$stmt=$con->prepare("update aya set ayamsg=? where ayaid=?");



		$stmt->execute(array($ayamsg,$ayaid));



		//echo success message



		echo "<div class='alert alert-success msg-msg'>".' تم التعديل بنجاح</div>';



        header("refresh:3;url=aya.php");;



		}



		



		



	}else{



		echo 'sorry you cant browse this page directly';



	}



	



	echo "</div>";









}elseif($do == 'delete'){//delete ads page


	echo "<div class='container'>";


//check if get request userid is numeric & get the integer value of it


$ayaid=isset($_GET['ayaid'])&& is_numeric($_GET['ayaid'])? intval($_GET['ayaid']):0;


//select all data depend on this id


$stmt=$con->prepare("select * from aya where ayaid=? limit 1");


//execute query


$stmt->execute(array($ayaid));


//the row count


$count=$stmt->rowCount();


//if there's such id show the form


	if($stmt->rowCount()>0){


	$stmt=$con->prepare("delete from aya where ayaid=:zayaid");


	$stmt->bindparam(":zayaid",$ayaid);


	$stmt->execute();


		echo  "<div class='alert alert-danger msg-msg'>".'  تم الحذف</div>';


        header("refresh:3;url=aya.php");


		


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











