<?php
function min_maj($str1){
	for($i=0; $i<strlen($str1); $i++){
		if(64<ord($str1[$i]) && ord($str1[$i])<91){
			$str1[$i]=strtolower($str1[$i]);
		}
		elseif(96<ord($str1[$i]) && ord($str1[$i])<123){
			$str1[$i]=strtoupper($str1[$i]);
		}
	}
	return $str1;
}

function position($str2){
	$chain=explode(" ", $str2);
	$l=0;
	for($i=0; $i<count($chain); $i++){
		if(strlen($chain[$i])>$l){
			$l=strlen($chain[$i]);
			$mot=$chain[$i];
		}
	}
	return $mot." position: ".$l;
}

echo min_maj('wELCome nOm PrEnoM');
echo '<br>';
echo position("Mon premier cours commence aujourd'hui");
?>
