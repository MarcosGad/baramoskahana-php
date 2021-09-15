<?php


/*


========================================================


==manage Reservation page


==you can manage|edit|update/send/delete Reservation from here


========================================================


*/


session_start();


$pagetitle='Reservationtwo';


if(isset($_SESSION['username'])){



include 'init.php';


$do=isset($_GET['do'])?$_GET['do']:'manage';


//start manage page


//select all users 


if($do == 'manage'){


	//manage Reservation page


	


	$stmt=$con->prepare("select * from hagza where sendid = 1 or sendid = 2");


	//execute the statment


	$stmt->execute();


	//assign to variable


	$rows=$stmt->fetchall();


?>





<h1 class="text-center">بيانات الحجز</h1>


<div class="container-fluid">

<input class="btn-print" type='button' onclick='window.print()' value='طـبـاعــة'>


<div class="table-responsive">


<table class="main-table text-center table table-bordered ">


	<tr>


		<td>الرقم</td>


		<td>أسم الأب</td>


		<td>البريد الألكتروني</td>


		<td>رقم الموبيل</td>


		<td>الأيبارشيه او الكنيسة</td>


		<td>ساعة وتاريخ الوصول</td>


		<td>ساعة وتاريخ المغادرة</td>
		
		<td>عدد الأباء القادمين</td>
		
		
				<td>الأب الثاني</td>

				<td>الأب الثالث</td>

				<td>الأب الرابع</td>

				<td>الأب الخامس</td>

				<td>الأب السادس</td>

				<td>الأب السابع</td>

				<td>الأب الثامن</td>

				<td>الأب التاسع</td>

				<td>الأب العاشر</td>

				


		<td>الملاحظات</td>


		<td>الحالة</td>


		<td class="thkom">التحكم</td>


	<?php


	foreach($rows as $row ){


		echo "<tr>";


	    echo "<td>".$row['id']."</td>";


		echo "<td>".$row['name']."</td>";


		echo "<td>".$row['email']."</td>";


		echo "<td>".$row['phone']."</td>";


		echo "<td>".$row['charch']."</td>";


		echo "<td>".$row['datec']."</td>";


		echo "<td>".$row['datel']."</td>";
		
		echo "<td>".$row['father']."</td>";
		
		echo "<td>".$row['fatherone']."</td>";
		echo "<td>".$row['fathertwo']."</td>";
		echo "<td>".$row['fatherthree']."</td>";
		echo "<td>".$row['fatherfour']."</td>";
		echo "<td>".$row['fatherfive']."</td>";
		echo "<td>".$row['fathersix']."</td>";
		echo "<td>".$row['fatherseven']."</td>";
		echo "<td>".$row['fathereight']."</td>";
		echo "<td>".$row['fathernine']."</td>";
		


		echo "<td>".$row['note']."</td>";


		echo "<td>";
			

			


		?>


		


		


		<?php 


			


			if($row["sendid"] == 1){


			echo "<div class='acp'>تم القبول</div>";


		      }else {


				


			     echo "<div class='nacp'>تم الرفض</div>";


				


			    }


			


		?>


		


		<?php


         echo "</td>";


		echo "<td class='tdthkom'>
		
		

		<a href='Reservationtwo.php?do=edit&id=".$row['id']."'class='btn btn-success'><i class='fa fa-edit'></i>تعديل</a>

		<a href='Reservationtwo.php?do=delete&id=".$row['id']."'class='btn btn-danger confirm'><i class='fa fa-close'></i> حذف</a>


		</td>";


		echo "</tr>";


	}


	?>


	


	</table>


</div>


		





	</div>





<?php
	
$stmt=$con->prepare("select SUM(father) AS father_total from hagza where sendid = 1");

	//execute the statment


	$stmt->execute();


	//assign to variable


	$rows=$stmt->fetchall();

	foreach($rows as $row ){
 	
	echo "<div class='container-fluid'>";
 	echo "<p class='count'>"."<span class='count-text'>  مجموع الأباء القادمين  = </span>".$row['father_total']."</p>";
	echo "</div>";
}

}
elseif($do == 'edit'){//edit page 





$id=isset($_GET['id'])&& is_numeric($_GET['id'])? intval($_GET['id']):0;


$stmt=$con->prepare("select * from hagza where id=? limit 1");

$stmt->execute(array($id));

$row=$stmt->fetch();

$count=$stmt->rowCount();


	if($stmt->rowCount()>0){


?>





<h1 class="text-center">تعديل بيانات الأب</h1>


<div class="container">


<form class="form-horizontal" action="?do=update" method="POST">


	<input type="hidden" name="id" value="<?php echo $row['id']?>"/>


	<!--start name field-->


	<div class="form-group form-group-lg">


	<label class="col-sm-2 control-label"> اسم الأب</label>


		<div class="col-sm-10 col-md-6">


		<input type="text" name="name" class="form-control" value="<?php echo $row['name']?>" autocomplete="off" />


		</div>


	</div>


	<!--end name field-->
	
	<!--start email field-->


	<div class="form-group form-group-lg">


	<label class="col-sm-2 control-label"> البريد الألكترونى</label>


		<div class="col-sm-10 col-md-6">


			<input type="email" name="email" class="form-control" value="<?php echo $row['email']?>" autocomplete="off" placeholder="" />


		</div>


	</div>


	<!--end email field-->
	
	<!--start name field-->


	<div class="form-group form-group-lg">


	<label class="col-sm-2 control-label">  رقم الموبيل</label>


		<div class="col-sm-10 col-md-6">

				<input type="text" maxlength="11" name="phone" class="form-control phone" autocomplete="off" value="<?php echo $row['phone']?>" />



		</div>


	</div>


	<!--end name field-->
	
	<!--start name field-->


	<div class="form-group form-group-lg">


	<label class="col-sm-2 control-label" style=" font-size: 16px;">  الأيبارشيه او الكنيسة التابع لها</label>


		<div class="col-sm-10 col-md-6">
			

			<input type="text" value="<?php echo $row['charch']?>" name="charch" class="form-control" autocomplete="off"  placeholder="" />



		</div>


	</div>


	<!--end name field-->
	
	
		<!--start date-->



		<div class="form-group form-group-lg">



			



		<label class="col-sm-2 control-label">ساعة وتاريخ الوصول</label>



			<div class="col-sm-10 col-md-6 one" style="direction: ltr;">



	           <div class="input-group date form_datetime one"  data-date-format="dd MM yyyy - HH:ii P" data-link-field="dtp_input1" >



                    <input class="form-control" name="datec" size="16" type="text"  value="<?php echo $row['datec']?>" readonly>


                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>



					<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>



                </div>



				<input type="hidden" id="dtp_input1" value="" /><br/>



            </div>



		</div>

	





	<div class="form-group form-group-lg">



	
		<label class="col-sm-2 control-label">ساعة وتاريخ المغادرة</label>



			<div class="col-sm-10 col-md-6 two" style="direction: ltr;">



	           <div class="input-group date form_datetime two" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">



                    <input class="form-control" name="datel" size="16" type="text" value="<?php echo $row['datel']?>"  readonly >



                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>



					<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>



                </div>



				<input type="hidden" id="dtp_input1" value="" /><br/>



            </div>



		</div>
	


	<!--end date-->
	
	
	
		<!--start father field-->



		<div class="form-group form-group-lg">



		<label class="col-sm-2 control-label">عدد الأباء القادمين</label>



			<div class="col-sm-10 col-md-6">

				
				<select class="form-control" id='father' name="father">
					<option  value="<?php echo $row['father']?>"> <?php echo $row['father']?> </option>
					
				  </select>

			</div>



		</div>



		<!--end father field-->



		
<!--------------------------------------------------------------------------------------------------------------------> 


		
		

		
<!--start namefather field-->



<div class="form-group form-group-lg" style="padding: 0; margin: 0;">


<div class="col-sm-8 col-md-8">

<input  type="text" value="<?php echo $row['fatherone']  ?> " style="display: none; float:left; width: 65%;"  class="fatherone form-control" name="fatherone" placeholder="اسم الأب الثاني ثلاثي">

</div>

    </div>



<!--end namefather field-->
		
<!--start namefather field-->



	<div class="form-group form-group-lg" style="padding: 0; margin: 0;">


<div class="col-sm-8 col-md-8">

<input  type="text" value="<?php echo $row['fathertwo']  ?>"  style="display: none; float:left; width: 65%;"  class="fathertwo form-control" name="fathertwo" placeholder="اسم الأب الثالث ثلاثي">

</div>

    </div>



<!--end namefather field-->

		
<!--start namefather field-->



	<div class="form-group form-group-lg" style="padding: 0; margin: 0;">


<div class="col-sm-8 col-md-8">

<input   type="text" value="<?php echo $row['fatherthree']  ?>"  style="display: none; float:left; width: 65%;"  class="fatherthree form-control" name="fatherthree" placeholder="اسم الأب الرابع ثلاثي">

</div>

    </div>



<!--end namefather field-->
		
<!--start namefather field-->



	<div class="form-group form-group-lg" style="padding: 0; margin: 0;">


<div class="col-sm-8 col-md-8">

<input type="text" value="<?php echo $row['fatherfour']  ?>"  style="display: none; float:left; width: 65%;"  class="fatherfour form-control" name="fatherfour" placeholder="اسم الأب الخامس ثلاثي">

</div>

    </div>



<!--end namefather field-->
		
<!--start namefather field-->



	<div class="form-group form-group-lg" style="padding: 0; margin: 0;">


<div class="col-sm-8 col-md-8">

<input  type="text" value="<?php echo $row['fatherfive']  ?>"  style="display: none; float:left; width: 65%;"  class="fatherfive form-control" name="fatherfive" placeholder="اسم الأب السادس ثلاثي">

</div>

    </div>



<!--end namefather field-->
		
<!--start namefather field-->



	<div class="form-group form-group-lg" style="padding: 0; margin: 0;">


<div class="col-sm-8 col-md-8">

<input  type="text"  value="<?php echo $row['fathersix']  ?>"  style="display: none; float:left; width: 65%;"  class="fathersix form-control" name="fathersix" placeholder="اسم الأب السابع ثلاثي">

</div>

    </div>



<!--end namefather field-->
		
<!--start namefather field-->



	<div class="form-group form-group-lg" style="padding: 0; margin: 0;">


<div class="col-sm-8 col-md-8">

<input type="text" value="<?php echo $row['fatherseven']  ?>"   style="display: none; float:left; width: 65%;"  class="fatherseven form-control" name="fatherseven" placeholder="اسم الأب الثامن ثلاثي">

</div>

    </div>



<!--end namefather field-->
		
<!--start namefather field-->



	<div class="form-group form-group-lg" style="padding: 0; margin: 0;">


<div class="col-sm-8 col-md-8">

<input type="text" value="<?php echo $row['fathereight']  ?>"   style="display: none; float:left; width: 65%;"  class="fathereight form-control" name="fathereight" placeholder="اسم الأب التاسع ثلاثي">

</div>

    </div>



<!--end namefather field-->
		
<!--start namefather field-->



	<div class="form-group form-group-lg" style="padding: 0; margin: 0;">


<div class="col-sm-8 col-md-8">

<input type="text" value="<?php echo $row['fathernine']  ?>"   style="display: none; float:left; width: 65%;"  class="fathernine form-control" name="fathernine" placeholder="اسم الأب العاشر ثلاثي">

</div>

    </div>



<!--end namefather field-->
		

		


	

<!-------------------------------------------------------------------------------------------------------------------->

	 <!--start message field-->



	<div class="form-group form-group-lg">



	<label class="col-sm-2 control-label">ملاحظات</label>



		<div class="col-sm-10 col-md-6">



		<textarea style="height: 100px; margin-top: 15px;" class="form-control" name="note" placeholder=""><?php echo $row['note']?></textarea>



		</div>



	</div>



	<!--end message field-->		

<!--start submit field-->


	<div class="form-group form-group-lg">


	<div class="col-sm-offset-2 col-sm-10">


		<input type="submit" value="تعديل" class="btn btn-primary btn-lg"/>


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

	
		//get variables from the form

		
		$id=$_POST['id']; 


		$user=filter_var($_POST['name'] ,FILTER_SANITIZE_STRING);



		$email=filter_var($_POST['email'] ,FILTER_SANITIZE_STRING);



		$phone=filter_var($_POST['phone'] ,FILTER_SANITIZE_STRING);



		$charch=filter_var($_POST['charch'] ,FILTER_SANITIZE_STRING);



		$datec=$_POST['datec'];



		$datel=$_POST['datel'];
		
		
		$father=filter_var($_POST['father'] ,FILTER_SANITIZE_STRING);
		
		$fatherone=filter_var($_POST['fatherone'] ,FILTER_SANITIZE_STRING);
		$fathertwo=filter_var($_POST['fathertwo'] ,FILTER_SANITIZE_STRING);
		$fatherthree=filter_var($_POST['fatherthree'] ,FILTER_SANITIZE_STRING);
		$fatherfour=filter_var($_POST['fatherfour'] ,FILTER_SANITIZE_STRING);
		$fatherfive=filter_var($_POST['fatherfive'] ,FILTER_SANITIZE_STRING);
		$fathersix=filter_var($_POST['fathersix'] ,FILTER_SANITIZE_STRING);
		$fatherseven=filter_var($_POST['fatherseven'] ,FILTER_SANITIZE_STRING);
		$fathereight=filter_var($_POST['fathereight'] ,FILTER_SANITIZE_STRING);
		$fathernine=filter_var($_POST['fathernine'] ,FILTER_SANITIZE_STRING);
		

		$note=filter_var($_POST['note'] ,FILTER_SANITIZE_STRING);


	

		$formerrors=array();


		
		
		//loop into errors array and echo it


		foreach($formerrors as $error){
			
			echo '<div class="container">'; 

			echo '<div class="alert alert-danger msg-msg">'.$error.'</div>';
			
			echo '</div>'; 

		}

	//check if there's no error proceed the update operation


		if(empty($formerrors)){


		//update the database with this info


		$stmt=$con->prepare("update hagza set name=?,email=?,phone=?,charch=?,datec=?,datel=?,father=?,fatherone=?,fathertwo=?,fatherthree=?,fatherfour=?,fatherfive=?,fathersix=?,fatherseven=?,fathereight=?,fathernine=?,note=? where id=?");


		$stmt->execute(array($user,$email,$phone,$charch,
							 $datec,$datel,$father,$fatherone,$fathertwo,
							 $fatherthree,$fatherfour,$fatherfive,$fathersix,
							 $fatherseven,$fathereight,$fathernine,$note,$id));


		//echo success message


				echo "<div class='alert alert-success msg-msg'>".' تم التعديل بنجاح</div>';



				header("refresh:3;url=Reservationtwo.php");

		}


		


		


	}else{


		echo 'sorry you cant browse this page directly';


	}


	


	echo "</div>";




}elseif($do == 'delete'){//delete Reservation page


	echo "<div class='container'>";


//check if get request userid is numeric & get the integer value of it


$userid=isset($_GET['id'])&& is_numeric($_GET['id'])? intval($_GET['id']):0;


//select all data depend on this id


$stmt=$con->prepare("select * from hagza where id=? limit 1");


//execute query


$stmt->execute(array($userid));


//the row count


$count=$stmt->rowCount();


//if there's such id show the form


	if($stmt->rowCount()>0){


	$stmt=$con->prepare("delete from hagza where id=:zuser");


	$stmt->bindparam(":zuser",$userid);


	$stmt->execute();


		echo  "<div class='alert alert-danger msg-msg'>".'  تم الحذف</div>';


        header("refresh:3;url=Reservationtwo.php");


		


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


	








