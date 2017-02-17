<?php
	$html = file_get_contents('http://practice.com/my-angular/the.html');

	preg_match_all('~<li>(.+?)</li>~si', $html, $match);

	echo '<pre>';
	print_r($match);