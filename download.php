<?php

$pagetitle='التحميلات';

include 'init.php';

?>

<?php





$do=isset($_GET['do'])?$_GET['do']:'manage';

//start manage page

if($do == 'manage'){

	//manage members page

	

	$stmt=$con->prepare("select * from tbl_users");

	//execute the statment

	$stmt->execute();

	//assign to variable

	$rows=$stmt->fetchall();

	

	foreach($rows as $row ){

        

	?> 

		

      





   





<div class="vanda">

   		<div class="container">

   			<h1 class="vanda-h"><?php echo $row['userName']?></h1>

   			<div class="row text-center vanda-info">

   			    <div class="col-md-12">
					
   					<a class="vanda-bt-one btn-lg hvr-bounce-out"  href="http://baramoskahana.com/admin/user_images/<?php echo  $row['userPic']; ?> "> <?php echo $row['userProfession']?> <i class="fa fa-arrow-down"></i> </a>

   				</div>

			</div>

	   </div>

   </div>   

	<?php 

		

	}

	

}

	



?> 











<!-- start copyright -->

        <div class="copyright footer-info" style="margin-top: 500px;">

            <div class="container">

                <div class="row">

                    

                     <div class=" text-center">



                    <P>Copyright &copy; 2018 Baramos Kahana|Developed by ENG.Polycarpus Adel +201288019733
</p> 



                    </div>
                 

                </div>

            </div>

        </div>

        

<!-- end copyright --> 



<!-- start footer --> 



<?php 



include $tpl.'footer.php';



?> 



<!-- end footer --> 