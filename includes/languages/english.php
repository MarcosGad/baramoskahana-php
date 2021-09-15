<?php
function lang($phrase){
	static $lang=array(
	//Navbar link
	'Home-Admin'=>'Home',
	'Reservation'=>'Reservation',
	'Items'     =>'Items',
	'Members'   =>'Members',
	'Statistics'=>'Statistics',
	'Logs'      =>'Logs',
	);
	return $lang[$phrase];
}