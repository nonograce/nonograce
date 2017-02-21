<?php
$s = 'a';
$s1 = 'c';
switch ($s) {
	case 'a' :
		if ($s1 == 'b')
			echo 'Hello';
		break;
		// breakした時点でswitch構造を抜けるから、通らない
		echo 'World';
		break;
}
?>