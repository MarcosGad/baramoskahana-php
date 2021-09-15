<?php


$pagetitle='مقالات';


include 'init.php';


$do=isset($_GET['do'])?$_GET['do']:'manage';


?>


        


<!-- start art -->


        


<?php


/*


========================================================


==manage art page 


========================================================


*/


$do=isset($_GET['do'])?$_GET['do']:'manage';


//start manage page


if($do == 'manage'){


	//manage members page


	


	$stmt=$con->prepare("select headerartk,bodyartk from artk");


	//execute the statment


	$stmt->execute();


	//assign to variable


	$rows=$stmt->fetchall();


?>





    <div class="art-container">


    <div class="container"> 


    <div class="row">


        


    <div class="col-md-8 col-sm-12 art">





	<?php


	   


	


	foreach($rows as $row ){


        


	?> 


		





<!-- start info -->





		 


    <h1 class="art-h text-center"><?php echo $row['headerartk'];?> </h1>


            


    <div class="lead art-p">


           <?php echo $row['bodyartk']; ?> 


    </div>


    


		


	<?php 


	}


	


}


	





?> 


	


</div>


<div class="col-md-4 col-sm-12 art-img hidden-sm hidden-xs">


       <img class="img-thumbnail imgone" src="img/44bedd04-76a8-4b63-a838-f5fe56433d86.jpg" alt="" > 


	 <img class="img-thumbnail imgtwo" src="img/5896e54d-3c18-4113-a381-9cbe9ee4419d.jpg" alt="" > 


</div>


             


    </div>


    </div>


</div>





<!-- end info --> 














<!-- start copyright -->


        <div class="copyright footer-info">


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


        