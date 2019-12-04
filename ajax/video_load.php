<?php
	error_reporting(E_ALL & ~E_NOTICE & ~8192);
	$id = $_POST['id'];
	$chuoi = '';
	if($id!=''){
		$chuoi .= '<div class="video-container">';
		    $chuoi .= '<iframe src="http://www.youtube.com/embed/'.$id.'?rel=0&amp;autoplay=1&amp;mute=1&amp;wmode=transparent" allowfullscreen frameborder="0" width="560" height="315"></iframe>';
		$chuoi .= '</div>';
		echo $chuoi;
	}else{
		$chuoi .= '<div class="video-container">';
		    $chuoi .= '<iframe src="http://www.youtube.com/embed/'.$id.'?rel=0&amp;autoplay=1&amp;mute=1&amp;wmode=transparent" allowfullscreen frameborder="0" width="560" height="315"></iframe>';
		$chuoi .= '</div>';
		echo $chuoi;
	}
?>