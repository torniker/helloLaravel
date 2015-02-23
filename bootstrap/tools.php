<?php

function mySplit($string,$size){
	$index = '';
	if($size>=strlen($string)){
		return $string;
	}
	for ($i=$size; $i < strlen($string); $i++) { 
		if($string[$i]=' ')
			$index=$i;
	}
	$index++;
	echo "$string[$index]";
	//return mb_substr($string,0,$index);
}


function pr($data){
	echo "<pre>";
	var_dump($data);
	echo "</pre>";
}

function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return strtoupper(random_color_part() . random_color_part() . random_color_part());
}