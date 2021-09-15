<?php



$pagetitle='الصفحة الرئيسية';



include 'init.php';



//include 'asddd.php';







?>



<!-- start carousel --> 







<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">



  <!-- Indicators -->



  <ol class="carousel-indicators">



    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>



    <li data-target="#carousel-example-generic" data-slide-to="1"></li>



    <li data-target="#carousel-example-generic" data-slide-to="2"></li>



    <li data-target="#carousel-example-generic" data-slide-to="3"></li>



  </ol>







  <!-- Wrapper for slides -->



  <div class="carousel-inner" role="listbox">



    <div class="item active">



     <img src="img/1.jpg" alt="...">



      



    </div>



    



     <div class="item">



     <img src="img/2.jpg" alt="...">



     



    </div>



     <div class="item">



     <img src="img/3.jpg" alt="...">



    </div>





	<div class="item">



     <img src="img/slider2.jpg" alt="..."> 



    </div>



  </div>







  <!-- Controls -->



</div>











<!-- end carousel --> 











        



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



	



	$stmt=$con->prepare("select headerart,bodyart from art");



	//execute the statment



	$stmt->execute();



	//assign to variable



	$rows=$stmt->fetchall();



?>







    <div class="art-container">



    <div class="container"> 



    <div class="row">



        



    <div class="col-md-12 col-sm-12 art">







	<?php



	   



	



	foreach($rows as $row ){



        



	?> 



		







<!-- start info -->







		 



    <h1 class="art-h text-center"><?php echo $row['headerart'];?> </h1>



            



    <div class="lead art-p">



           <?php echo $row['bodyart']; ?> 



    </div>



    



		



	<?php 



	}



	



}



	







?> 



	



</div>





             



    </div>



    </div>



</div>







<!-- end info --> 


<!-- start copyright -->



        <div class="copyright">



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







<!-- start scroll To top --> 



        <div id="scroll-top">



            <i class="fa fa-chevron-up fa-3x"></i>



        </div>



        



 <!-- end scroll To top --> 







<!-- start footer --> 







<?php 







include $tpl.'footer.php';







?> 







<!-- end footer --> 



     







        



