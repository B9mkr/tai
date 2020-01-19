<?php
include_once('parsedown/Parsedown.php');
	// header('Content-Type: text/html; charset=utf8');
 
	// $tekst = 'Moja mama lubi koty, a tata nie. :)';
 
	// $text = explode(' ', $tekst);
	// $words = array();
	// $len = 0;
 
	// foreach ($text as $str) {
	// 	$word = preg_replace('#[^a-ząśżźćęłóń]+#i', '' ,$str);
	// 	if (mb_strlen($word) > 0) {
	// 		$words[] = $word;
	// 		$len += mb_strlen($word);
	// 	}
	// }
 
	// echo 'Słowa to: '.implode(', ', $words).'<br/>o łącznej długości: '.$len.' znaków.';

function file_get_tresc()
{
    $url="inf.md";
    $contents = file_get_contents($url);
    $Parsedown = new Parsedown();
    return "".$Parsedown->text($contents);
}

$text=file_get_tresc();

function ile_slow($text){
    $words = (count((array_count_values(str_word_count(strtolower($text),1)))) + str_word_count($text))/2;
    return $words;
}

echo ile_slow($text).' -> '.(ile_slow($text) / 200).' min';
echo '</br>';
echo str_word_count($text).' -> '.(str_word_count($text) / 200).' min';

echo '</br>';echo '</br>';

$contents = file_get_contents('inf.md');

echo ile_slow($contents).' -> '.(ile_slow($contents) / 200).' min';
echo '</br>';
echo str_word_count($contents).' -> '.(str_word_count($contents) / 200).' min';
echo '</br>';
// echo (str_word_count($contents)/200).' -> '.(int)(str_word_count($contents)/200).'</br>';



?>