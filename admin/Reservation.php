<?php


/*


========================================================


==manage Reservation page


==you can manage|edit|update/send/delete Reservation from here


========================================================


*/


session_start();


$pagetitle='Reservation';


if(isset($_SESSION['username'])){





include 'init.php';


$do=isset($_GET['do'])?$_GET['do']:'manage';


//start manage page


//select all users 


if($do == 'manage'){


	//manage Reservation page


	


	$stmt=$con->prepare("select * from hagza where sendid != 1 AND sendid != 2");


	//execute the statment


	$stmt->execute();


	//assign to variable


	$rows=$stmt->fetchall();


?>





<h1 class="text-center">ادارة الحجز</h1>


<div class="container-fluid">


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


		<td>التحكم</td>


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





		echo "<td>


		<a href='Reservation.php?do=edit&id=".$row['id']."'class='btn btn-success'><i class='fa fa-send'></i> قبول </a>


		<a href='Reservation.php?do=reject&id=".$row['id']."'class='btn btn-danger'><i class='fa fa-close'></i> رفض </a>


		</td>";


		echo "</tr>";


	}


	?>


	


	</table>


</div>


		
	</div>







<?php





}elseif($do == 'edit'){//edit Reservation page 


//check if get request userid is numeric & get the integer value of it


$userid=isset($_GET['id'])&& is_numeric($_GET['id'])? intval($_GET['id']):0;


//select all data depend on this id


$stmt=$con->prepare("select * from hagza where id=? limit 1");


//execute query


$stmt->execute(array($userid));


//fetch the data


$row=$stmt->fetch();


//the row count


$count=$stmt->rowCount();


//if there's such id show the form


	if($stmt->rowCount()>0){


?>





<h1 class="text-center">تعديل الرسالة المرسلة</h1>


<div class="container">


<form class="form-horizontal" action="?do=update" method="POST">


	<input type="hidden" name="id" value="<?php echo $row['id']?>"/>


	<!--start email field-->


	<div class="form-group form-group-lg">


	<label class="col-sm-2 control-label">البريد الألكتروني</label>


		<div class="col-sm-10 col-md-6">


		<input type="text" name="email" readonly="readonly" class="form-control input-email" value="<?php echo $row['email']?>" autocomplete="off" />


		</div>


	</div>


	<!--end email field-->


	<!--start message field-->


	<div class="form-group form-group-lg">


	<label class="col-sm-2 control-label">الرسالة</label>


		<div class="col-sm-10 col-md-6">


		<textarea class="form-control" name="msg" placeholder="" ><?php echo $row['msg']?></textarea>


		</div>


	</div>


	<!--end message field-->


	<!--start submit field-->


	<div class="form-group form-group-lg">


	<div class="col-sm-offset-2 col-sm-10">


		<input type="submit" value="ارسال" class="btn btn-primary btn-lg"/>


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


	


// update Reservation page 


}elseif($do == 'update'){


$id=$_POST['id'];


$email=$_POST['email'];


$msg=$_POST['msg'];


$userid=isset($_GET['id'])&& is_numeric($_GET['id'])? intval($_GET['id']):0;


//select all data depend on this id


$stmt=$con->prepare("update hagza set sendid=1,


					email=?,msg=? where id=?");


//execute query


$stmt->execute(array($email,$msg,$id));





//send Reservation page 


	


$email=$_POST['email'];


$msg=$_POST['msg'];


$userid=isset($_GET['id'])&& is_numeric($_GET['id'])? intval($_GET['id']):0;


//select all data depend on this id


$stmt=$con->prepare("select email,msg from hagza where email=? and msg=?");


//execute query


$stmt->execute(array($email,$msg));


//fetch the data


$row=$stmt->fetch();


	


$count=$stmt->rowCount();


//if there's such id show the form


if($stmt->rowCount()>0){


	


// send email 


	


$smail = $_POST['email']; 


$smsg = $_POST['msg'];





require 'phpmailer/PHPMailerAutoload.php';


$mail = new PHPMailer();


$mail->SetLanguage("ar", 'phpMailer/language/');


//or more succinctly:


$mail->Host = 'ssl://relay-hosting.secureserver.net:25'; 


$mail->SMTPAuth = true;


$mail->Username = 'info@baramoskahana.com';


$mail->Password = '#Pola24846912';


$mail->Subject = 'Baramos Kahana';


$mail->Body = $smsg;


$mail->setFrom('info@baramoskahana.com','Baramos Kahana');


$mail->addAddress($smail);


if ($mail->send()){


	echo "<div class='container'>";


    echo "<div class='alert alert-success msg-msg'>".' ثم أرسال الرسالة بنجاح</div>';


	echo "</div>";


    header("refresh:3;url=Reservation.php");





}else{


	echo "<div class='container'>";


	echo "<div class='alert alert-danger msg-msg'>".' حدث خطأ </div>';


	echo "</div>";


        header("refresh:3;url=Reservation.php");





}


		      	


}


	


	


	


	


	


	


	


}elseif($do == 'reject'){


	//edit Reservation page 


//check if get request userid is numeric & get the integer value of it


$userid=isset($_GET['id'])&& is_numeric($_GET['id'])? intval($_GET['id']):0;


//select all data depend on this id


$stmt=$con->prepare("select * from hagza where id=? limit 1");


//execute query


$stmt->execute(array($userid));


//fetch the data


$row=$stmt->fetch();


//the row count


$count=$stmt->rowCount();


//if there's such id show the form


	if($stmt->rowCount()>0){


?>





<h1 class="text-center">تعديل الرسالة المرسلة</h1>


<div class="container">


<form class="form-horizontal" action="?do=updatetwo" method="POST">


	<input type="hidden" name="id" value="<?php echo $row['id']?>"/>


	<!--start email field-->


	<div class="form-group form-group-lg">


	<label class="col-sm-2 control-label">البريد الألكتروني</label>


		<div class="col-sm-10 col-md-6">


		<input type="text" name="email" readonly="readonly" class="form-control input-email" value="<?php echo $row['email']?>" autocomplete="off" />


		</div>


	</div>


	<!--end email field-->


	<!--start message field-->


	<div class="form-group form-group-lg">


	<label class="col-sm-2 control-label">الرسالة</label>


		<div class="col-sm-10 col-md-6">


		<textarea class="form-control" name="msgtwo" placeholder="" ><?php echo $row['msgtwo']?></textarea>


		</div>


	</div>


	<!--end message field-->


	<!--start submit field-->


	<div class="form-group form-group-lg">


	<div class="col-sm-offset-2 col-sm-10">


		<input type="submit" value="ارسال" class="btn btn-primary btn-lg"/>


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


	


// update Reservation page 


}elseif($do == 'updatetwo'){


$id=$_POST['id'];


$email=$_POST['email'];


$msgtwo=$_POST['msgtwo'];


$userid=isset($_GET['id'])&& is_numeric($_GET['id'])? intval($_GET['id']):0;


//select all data depend on this id


$stmt=$con->prepare("update hagza set sendid=2,


					email=?,msgtwo=? where id=?");


//execute query


$stmt->execute(array($email,$msgtwo,$id));





//send Reservation page 


	


$email=$_POST['email'];


$msgtwo=$_POST['msgtwo'];


$userid=isset($_GET['id'])&& is_numeric($_GET['id'])? intval($_GET['id']):0;


//select all data depend on this id


$stmt=$con->prepare("select email,msgtwo from hagza where email=? and msgtwo=?");


//execute query


$stmt->execute(array($email,$msgtwo));


//fetch the data


$row=$stmt->fetch();


	


$count=$stmt->rowCount();


//if there's such id show the form


if($stmt->rowCount()>0){


	


// send email 


	


$smail = $_POST['email']; 


$ssmsg = $_POST['msgtwo'];





require 'phpmailer/PHPMailerAutoload.php';


$mail = new PHPMailer();


$mail->SetLanguage("ar", 'phpMailer/language/');


//or more succinctly:


$mail->Host = 'ssl://relay-hosting.secureserver.net:25'; 


$mail->SMTPAuth = true;


$mail->Username = 'info@baramoskahana.com';


$mail->Password = '#Pola24846912';


$mail->Subject = 'Baramos Kahana';


$mail->Body = $ssmsg;


$mail->setFrom('info@baramoskahana.com','Baramos Kahana');


$mail->addAddress($smail);


if ($mail->send()){


	echo "<div class='container'>";


    echo "<div class='alert alert-success msg-msg'>".' ثم أرسال الرسالة بنجاح</div>';


	echo "</div>";


    header("refresh:3;url=Reservation.php");





}else{


	echo "<div class='container'>";


	echo "<div class='alert alert-danger msg-msg'>".' حدث خطأ </div>';


	echo "</div>";


        header("refresh:3;url=Reservation.php");





}	


}


}


	include $tpl.'footer.php';


}else{


	header('location:index.php');


	exit();


}











