<?php 	
		
$redirect_page = 'http://attendance.birutekno.com/public/autocheckout';
$redirect = true;

if ($redirect == true) {
	header('Location: '. $redirect_page);
}

 ?>