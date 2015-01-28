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