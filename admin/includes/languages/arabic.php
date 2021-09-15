<?php



function lang($phrase){



	static $lang=array(



	'home'=>'الصفحة الرئيسية',



	'Reservation'=>'ادارة الحجز',



	'Reservationtwo'=>'بيانات الحجز', 

	'printreport' => 'بيانات الطباعة',

	'ads'       =>'التنبيه',
		
	'stop'	    =>'أغلاق الحجز',



	'Members'   =>'الأعضاء',



	'artical'   =>' مقالات الصفحة الرئيسية',



	'info'   =>' التعليمات',



	'aya'   =>' الأيات',



	'artk'  => 'المقالات',



	'upload'=>'التحميلات'



	);



	return $lang[$phrase];



}