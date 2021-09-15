<?php



/*



========================================================



==manage members page



==you can add|edit|delete members from here



========================================================



*/



ob_start();



$pagetitle='حجز الخلوة';



include 'init.php';



$do=isset($_GET['do'])?$_GET['do']:'manage';



?>



  



	







 



<?php



	//insert member page



	



	if($_SERVER['REQUEST_METHOD']=='POST'){



		



		echo "<div class='container the-erro'>";



		//date_default_timezone_set("AFRICA/CAIRO");



		//get variables from the form



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



		$msg=filter_var($_POST['msg'] ,FILTER_SANITIZE_STRING);



		$msgtwo=filter_var($_POST['msgtwo'] ,FILTER_SANITIZE_STRING);



		//validate the form



		



		$formerrors=array();



			



		if(empty($user)){



			$formerrors[]='برجاء ادخال <strong> الأسم </strong>';



		}



		



		if(empty($email)){



			$formerrors[]='برجاء ادخال <strong> الأيميل الألكتروني </strong>';



		}



		



		if(filter_var($email , FILTER_VALIDATE_EMAIL) != true ) {



				



			



				$formerrors[] = 'برجاء كتابة<strong> الأيميل الألكتروني  </strong> بشكل صحيح';



				



			}	



		



		if(empty($phone)){



			$formerrors[]='برجاء ادخال<strong> رقم التليفون </strong>';



		}



			



		



		if($father == ''){



			$formerrors[]='برجاء ادخال<strong> عدد الأباء القادمين</strong>';



		}



		



		if($father > 1 && $fatherone == ''){



			$formerrors[]='برجاء ادخال<strong> اسماء الأباء القادمين</strong>';



		}
		
		if($father > 2 && $fathertwo == ''){



			$formerrors[]='برجاء ادخال<strong> اسماء الأباء القادمين</strong>';



		}
		
		if($father > 3 && $fatherthree == ''){



			$formerrors[]='برجاء ادخال<strong> اسماء الأباء القادمين</strong>';



		}
		if($father > 4 && $fatherfour == ''){



			$formerrors[]='برجاء ادخال<strong> اسماء الأباء القادمين</strong>';



		}
		if($father > 5 && $fatherfive == ''){



			$formerrors[]='برجاء ادخال<strong> اسماء الأباء القادمين</strong>';



		}
		if($father > 6 && $fathersix == ''){



			$formerrors[]='برجاء ادخال<strong> اسماء الأباء القادمين</strong>';



		}
		if($father > 7 && $fatherseven == ''){



			$formerrors[]='برجاء ادخال<strong> اسماء الأباء القادمين</strong>';



		}
		if($father > 8 && $fathereight == ''){



			$formerrors[]='برجاء ادخال<strong> اسماء الأباء القادمين</strong>';



		}
		if($father > 9 && $fathernine == ''){



			$formerrors[]='برجاء ادخال<strong> اسماء الأباء القادمين</strong>';



		}
		
		

		if(empty($charch)){



			$formerrors[]='برجاء ادخال<strong> اسم الأيبارشية والكنيسة التابع لها </strong>';



		}



		



		if(empty($datec)){



			$formerrors[]='برجاء ادخال<strong> ساعة وتاريخ الوصول </strong>';



		}



		



		if(empty($datel)){



			$formerrors[]='برجاء ادخال<strong> ساعة وتاريخ المغادرة </strong>';



		}



		



		



		



		//loop into errors array and echo it



		foreach($formerrors as $error){



			echo '<div class="alert alert-danger">'.$error.'</div>';



			header("refresh:5;url=hagza.php");







			



		}



		//check if there's no error proceed the insert operation



		if(empty($formerrors)){



		//insert user info in database



		$stmt=$con->prepare("insert into 



		hagza (name,email,phone,charch,datec,datel,father,fatherone,fathertwo,fatherthree,fatherfour,fatherfive,fathersix,fatherseven,fathereight,fathernine,note,msg,msgtwo)



		values(:zname, :zemail, :zphone, :zcharch,  :zdatec, :zdatel, :zfather, :zfatherone, :zfathertwo, :zfatherthree, :zfatherfour, :zfatherfive, :zfathersix, :zfatherseven, :zfathereight, :zfathernine, :znote , :zmsg, :zmsgtwo)");



		$stmt->execute(array(



		'zname'=>$user,



		'zemail'=>$email,



		'zphone'=>$phone,



		'zcharch'=>$charch,



		'zdatec'=>$datec,



		'zdatel'=>$datel,

		'zfather'=>$father,
			
			'zfatherone'=>$fatherone,
		    'zfathertwo'=>$fathertwo,
			'zfatherthree'=>$fatherthree,
			'zfatherfour'=>$fatherfour,
			'zfatherfive'=>$fatherfive,
			'zfathersix'=>$fathersix,
			'zfatherseven'=>$fatherseven,
			'zfathereight'=>$fathereight,
			'zfathernine'=>$fathernine,
			
			

	



		'znote'=>$note,



		'zmsg'=>$msg,



		'zmsgtwo'=>$msgtwo



		));



		//echo success message



		echo "<div class='alert alert-success send-success'>".'تم الحجز بنجاح وسيتم الرد بالقبول او الرفض عن طريق البريد الألكتروني     </div>';



        header("refresh:5;url=index.php");



			



		}



	}



	



	



	echo "</div>";



		



	



	



?> 



<div class="container">



		<div class="row">



		<div class="col-md-7">



	<form style="position: relative;" id="reg_form" class="form-horizontal wow flipInY my-form" data-wow-duration="2s" data-wow-offset="200" data-wow-iteration="1" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
		
	<!-- start stop --> 
<?php


$do=isset($_GET['do'])?$_GET['do']:'manage';

//start manage page

if($do == 'manage'){

	//manage members page

	

	$stmt=$con->prepare("select stopmsg from stop limit 1");

	//execute the statment

	$stmt->execute();

	//assign to variable

	$rows=$stmt->fetchall();

?>



	<?php

	foreach($rows as $row ){

		

	?> 

		

		<!--start upper bar two --> 



                    

		<div class="stop">
			<p class="stop-text">
			<?php echo $row['stopmsg'];?> 
			</p>
		
		</div>

           


         <!-- end upper bar two -->

	



	

	<?php 

	}

}

	



?> 


	
	
		
	<!-- end stop --> 

		<!--start username field-->



		<div class="form-group form-group-lg">

		

		<label class="col-sm-4 control-label">اسم الأب </label>



		<div class="col-sm-8 col-md-8">



			<input id="firsttype" type="text" name="name" class="form-control" autocomplete="off" required="required" placeholder="" />



		</div>



		</div>



		<!--end username field-->



		<!--start email field-->



		<div class="form-group form-group-lg">



		<label class="col-sm-4 control-label">البريد الألكتروني</label>



		<div class="col-sm-8 col-md-8">



			<input type="email" name="email" class="form-control" autocomplete="off" required="required" placeholder="" />



		</div>



		</div>



		<!--end email field-->



		<!--start phone field-->



		<div class="form-group form-group-lg">



		<label class="col-sm-4 control-label">رقم الموبيل</label>



			<div class="col-sm-8 col-md-8">



			<input type="text" maxlength="11" name="phone" class="form-control phone" autocomplete="off" required="required"  placeholder=""/>



			</div>



		</div>



		<!--end phone field-->




<!--start father field-->



		<div class="form-group form-group-lg">



		<label class="col-sm-4 control-label" style=" font-size: 19px;">الأيبارشيه او الكنيسة التابع لها</label>



			<div class="col-sm-8 col-md-8">



			<input type="text" name="charch" class="form-control" autocomplete="off" required="required"  placeholder="" />



			</div>



		</div>



		<!--end father field-->



		



		<!--start date-->



		<div class="form-group form-group-lg">



			



		<label class="col-sm-4 control-label">ساعة وتاريخ الوصول</label>



			<div class="col-sm-8 col-md-8 one" style="direction: ltr;">



	           <div class="input-group date form_datetime one"  data-date-format="dd MM yyyy - HH:ii P" data-link-field="dtp_input1" >



                    <input class="form-control" name="datec" size="16" type="text"  value="" readonly>


                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>



					<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>



                </div>



				<input type="hidden" id="dtp_input1" value="" /><br/>



            </div>



		</div>

	





	<div class="form-group form-group-lg">



		



		<label class="col-sm-4 control-label">ساعة وتاريخ المغادرة</label>



			<div class="col-sm-8 col-md-8 two" style="direction: ltr;">



	           <div class="input-group date form_datetime two" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">



                    <input class="form-control" name="datel" size="16" type="text" value="" readonly >



                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>



					<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>



                </div>



				<input type="hidden" id="dtp_input1" value="" /><br/>



            </div>



		</div>



	<!--end date->



		<!--start father field-->



		<div class="form-group form-group-lg">



		<label class="col-sm-4 control-label">عدد الأباء القادمين</label>



			<div class="col-sm-8 col-md-8">

				
				<select class="form-control" id='father' name="father">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>	
					<option value="10">10</option>
				  </select>

			</div>



		</div>



		<!--end father field-->



		
<!--------------------------------------------------------------------------------------------------------------------> 


		
		
<!--start namefather field-->



<div class="form-group form-group-lg" style="padding: 0; margin: 0;">


<div class="col-sm-12 col-md-12">

<div id="secendtype" style="float:left; width: 65%;"  class="form-control"> </div>

</div>

</div>



<!--end namefather field-->
		
<!--start namefather field-->



<div class="form-group form-group-lg" style="padding: 0; margin: 0;">


<div class="col-sm-12 col-md-12">

<input  type="text" style="display: none; float:left; width: 65%;"  class="fatherone form-control" name="fatherone" placeholder="اسم الأب الثاني ثلاثي">

</div>

    </div>



<!--end namefather field-->
		
<!--start namefather field-->



	<div class="form-group form-group-lg" style="padding: 0; margin: 0;">


<div class="col-sm-12 col-md-12">

<input  type="text"  style="display: none; float:left; width: 65%;"  class="fathertwo form-control" name="fathertwo" placeholder="اسم الأب الثالث ثلاثي">

</div>

    </div>



<!--end namefather field-->

		
<!--start namefather field-->



	<div class="form-group form-group-lg" style="padding: 0; margin: 0;">


<div class="col-sm-12 col-md-12">

<input   type="text"  style="display: none; float:left; width: 65%;"  class="fatherthree form-control" name="fatherthree" placeholder="اسم الأب الرابع ثلاثي">

</div>

    </div>



<!--end namefather field-->
		
<!--start namefather field-->



	<div class="form-group form-group-lg" style="padding: 0; margin: 0;">


<div class="col-sm-12 col-md-12">

<input type="text"  style="display: none; float:left; width: 65%;"  class="fatherfour form-control" name="fatherfour" placeholder="اسم الأب الخامس ثلاثي">

</div>

    </div>



<!--end namefather field-->
		
<!--start namefather field-->



	<div class="form-group form-group-lg" style="padding: 0; margin: 0;">


<div class="col-sm-12 col-md-12">

<input  type="text"  style="display: none; float:left; width: 65%;"  class="fatherfive form-control" name="fatherfive" placeholder="اسم الأب السادس ثلاثي">

</div>

    </div>



<!--end namefather field-->
		
<!--start namefather field-->



	<div class="form-group form-group-lg" style="padding: 0; margin: 0;">


<div class="col-sm-12 col-md-12">

<input  type="text"  style="display: none; float:left; width: 65%;"  class="fathersix form-control" name="fathersix" placeholder="اسم الأب السابع ثلاثي">

</div>

    </div>



<!--end namefather field-->
		
<!--start namefather field-->



	<div class="form-group form-group-lg" style="padding: 0; margin: 0;">


<div class="col-sm-12 col-md-12">

<input type="text"  style="display: none; float:left; width: 65%;"  class="fatherseven form-control" name="fatherseven" placeholder="اسم الأب الثامن ثلاثي">

</div>

    </div>



<!--end namefather field-->
		
<!--start namefather field-->



	<div class="form-group form-group-lg" style="padding: 0; margin: 0;">


<div class="col-sm-12 col-md-12">

<input type="text"  style="display: none; float:left; width: 65%;"  class="fathereight form-control" name="fathereight" placeholder="اسم الأب التاسع ثلاثي">

</div>

    </div>



<!--end namefather field-->
		
<!--start namefather field-->



	<div class="form-group form-group-lg" style="padding: 0; margin: 0;">


<div class="col-sm-12 col-md-12">

<input type="text"  style="display: none; float:left; width: 65%;"  class="fathernine form-control" name="fathernine" placeholder="اسم الأب العاشر ثلاثي">

</div>

    </div>



<!--end namefather field-->
		

		


	

<!-------------------------------------------------------------------------------------------------------------------->

		



		



	 <!--start message field-->



	<div class="form-group form-group-lg">



	<label class="col-sm-4 control-label">ملاحظات</label>



		<div class="col-sm-8 col-md-8">



		<textarea style="height: 100px; margin-top: 15px;" class="form-control" name="note" placeholder=""></textarea>



		</div>



	</div>



	<!--end message field-->



			



	 <!--start message field-->



	<div class="form-group form-group-lg">



		<div class="col-sm-8 col-md-8">



		<textarea style="display:none;" class="form-control" name="msg" placeholder="Your Message!" >You Are Accepted 
		تم القبول</textarea>



		</div>



	</div>



	<!--end message field-->



		



	<!--start message field-->



	<div class="form-group form-group-lg">



		<div class="col-sm-8 col-md-8">



		<textarea style="display:none;" class="form-control" name="msgtwo" placeholder="Your Message!" >You Aren't Accepted 
		تم الرفض</textarea>



		</div>



	</div>



	<!--end message field-->



		



		



	<!--start submit field-->



	<div class="form-group form-group-lg">



	<div class="col-sm-offset-4 col-sm-8">



		<input class="btn btn-warning btn-lg btn-hagza" type="submit" value="ارســـــال الـطـلـب" />



	</div>



	</div>



	<!--end submit field-->







</form>



</div>



			



 <div class="col-md-5 hagza-img">







	 <img class="img-thumbnail hidden-sm hidden-xs" src="img/2e7a3b0d-855d-4210-aa83-6bab4b866b1b.jpg">


<!--
	 <div class="contact">



		<p class="contact-head">أتصل بنـــا : </p>



	 	<p class="contact-one">البريد الألكتروني : info@baramoskahana.com</p>



	 </div>-->

   <!--
	 <div class="contact">

		<p class="contact-two"> <a class="hvr-backward" href="http://baramoskhelwa.com/"><i class="fa fa-globe" aria-hidden="true"></i> لزيارة موقع بيت الخلوة</a></p>	

	 </div>-->

 </div>

<!-- start map --> 
<div id="map"></div>


	 <script>

      function initMap() {   

        var uluru = {lat: 30.357404, lng: 30.270664};

        var map = new google.maps.Map(document.getElementById('map'), {

          zoom: 15,

          center: uluru

        });

        var marker = new google.maps.Marker({

          position: uluru,

          map: map

        });

      }

    </script>

    

  <!-- end map --> 

		

			
</div>




</div>








    


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











<!-- start footer --> 







<?php 







include $tpl.'footer.php';



ob_end_flush();



?> 



<script type="text/javascript">



 



   $(document).ready(function() {



    $('#reg_form').bootstrapValidator({



       



        fields: {



            name: {



                validators: {



                        stringLength: {



                        min: 4,



						message: 'برجاء كتابة اربع حروف'



                    },



                        notEmpty: {



                        message: 'برجاء ادخال الاسم'



                    }



                }



            },



           email: {



                validators: {



                    notEmpty: {



                        message: 'برجاء ادخال الأيميل الألكتروني'



                    },



                    emailAddress: {



                        message: 'برجاء كتابة الأيميل الألكتروني بشكل صحيح'



                    }



                }



            },



			
/*


			 phone: {



                validators: {



                    notEmpty: {



                        message: 'برجاء كتابة رقم الموبيل المكون من 11 رقم'



                    },



                    phone: {



                        country: 'EG',



                        message: 'برجاء ادخال رقم الموبيل'



                    }



                }



            },
*/
			 phone: {



                validators:{



				 stringLength: {



                        min: 11,



                        max: 11,



                        message: 'برجاء كتابة رقم الموبيل المكون من 11 رقم'



                    },



                        notEmpty: {



                        message: 'برجاء ادخال رقم الموبيل'


                    }                



				}



            },


			 fatherone: {



                validators:{



				 stringLength: {



                        min: 5,



                        max: 255,



                        message:'<span class="fatherone">برجاء كتابة اكثر من 5 حروف</span>'



                    },



                        notEmpty: {



                        message: '<span class="fatherone">برجاء ادخال اسماء الأباء القادمين ثلاثى</span>'


                    }                



				}



            },

			

			 fathertwo: {



                validators:{



				 stringLength: {



                        min: 5,



                        max: 255,



                        message:'<span class="fathertwo">برجاء كتابة اكثر من 5 حروف</span>'



                    },



                        notEmpty: {



                        message: '<span class="fathertwo">برجاء ادخال اسماء الأباء القادمين ثلاثى</span>'



                    }                



				}



            },			
			
			
			 fatherthree: {



                validators:{



				 stringLength: {



                        min: 5,



                        max: 255,



                        message:'<span class="fatherthree">برجاء كتابة اكثر من 5 حروف</span>'



                    },



                        notEmpty: {



                        message: '<span class="fatherthree">برجاء ادخال اسماء الأباء القادمين ثلاثى</span>'



                    }                



				}



            },			
			
			
			fatherfour: {



                validators:{



				 stringLength: {



                        min: 5,



                        max: 255,



                        message:'<span class="fatherfour">برجاء كتابة اكثر من 5 حروف</span>'



                    },



                        notEmpty: {



                        message: '<span class="fatherfour">برجاء ادخال اسماء الأباء القادمين ثلاثى</span>'



                    }                



				}



            },			
			
			
			fatherfive: {



                validators:{



				 stringLength: {



                        min: 5,



                        max: 255,



                        message:'<span class="fatherfive">برجاء كتابة اكثر من 5 حروف</span>'



                    },



                        notEmpty: {



                        message: '<span class="fatherfive">برجاء ادخال اسماء الأباء القادمين ثلاثى</span>'



                    }                



				}



            },			
			
			
			fathersix: {



                validators:{



				 stringLength: {



                        min: 5,



                        max: 255,



                        message:'<span class="fathersix">برجاء كتابة اكثر من 5 حروف</span>'



                    },



                        notEmpty: {



                        message: '<span class="fathersix">برجاء ادخال اسماء الأباء القادمين ثلاثى</span>'



                    }                



				}



            },			
			
			
			fatherseven: {



                validators:{



				 stringLength: {



                        min: 5,



                        max: 255,



                        message:'<span class="fatherseven">برجاء كتابة اكثر من 5 حروف</span>'



                    },



                        notEmpty: {



                        message: '<span class="fatherseven">برجاء ادخال اسماء الأباء القادمين ثلاثى</span>'



                    }                



				}



            },			
			
			
			fathereight: {



                validators:{



				 stringLength: {



                        min: 5,



                        max: 255,



                        message:'<span class="fathereight">برجاء كتابة اكثر من 5 حروف</span>'



                    },



                        notEmpty: {



                        message: '<span class="fathereight">برجاء ادخال اسماء الأباء القادمين ثلاثى</span>'



                    }                



				}



            },			
			
			
			fathernine: {



                validators:{



				 stringLength: {



                        min: 5,



                        max: 255,



                        message:'<span class="fathernine">برجاء كتابة اكثر من 5 حروف</span>'



                    },



                        notEmpty: {



                        message: '<span class="fathernine">برجاء ادخال اسماء الأباء القادمين ثلاثى</span>'



                    }                



				}



            },			
			
			
			
			
			 
			/*


			datec: {



                validators: {



                        notEmpty: {



                        message: 'برجاء ادخال يوم الوصول'



                    }



                }



            },



			



			datel: {



                validators: {



                        notEmpty: {



                        message: 'برجاء ادخال يوم المغادرة'



                    }



                }



            },



		
*/


			



            



            }



        })



		



 	



        .on('success.form.bv', function(e) {



            $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...



                $('#reg_form').data('bootstrapValidator').resetForm();







            // Prevent form submission



            e.preventDefault();







            // Get the form instance



            var $form = $(e.target);







            // Get the BootstrapValidator instance



            var bv = $form.data('bootstrapValidator');







            // Use Ajax to submit form data



            $.post($form.attr('action'), $form.serialize(), function(result) {



                console.log(result);



            }, 'json');



        });



});











 



 </script>







<!-- end footer --> 



        



        



        



        



        































