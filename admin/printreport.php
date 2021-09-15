<?php





session_start();


$pagetitle='printreport';


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





<h1 class="text-center">بيانات الطباعة</h1>


<div class="container-fluid">

<input class="btn-print" type='button' onclick='window.print()' value='طـبـاعــة'>


<div class="table-responsive">


<table class="main-table text-center table table-bordered">


	<tr>




		<td>أسم الأب</td>

		<td>ساعة وتاريخ الوصول</td>

		<td>ساعة وتاريخ المغادرة</td>
		
		<td>عدد الأباء القادمين</td>

	<?php


	foreach($rows as $row ){


		echo "<tr>";

		echo "<td>".$row['name']."</td>";


		echo "<td>".$row['datec']."</td>";


		echo "<td>".$row['datel']."</td>";
		
		echo "<td>".$row['father']."</td>";
		
	
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






include $tpl.'footer.php';
	

}

	
}else{


	header('location:index.php');


	exit();


}
?>

	








