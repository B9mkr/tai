<?php
require_once('t2.php');
 
function puste($t){
	return empty($t);
}
 
 
$smarty = new Smarty;
$smarty -> template_dir = './tpl';
$smarty -> compile_dir = './tpl_c';
$smarty -> cache_dir = './tpl_cache';
$smarty -> config_dir = './tpl_configs';
 
$form = new form('formularz_testowy', 'post', true, $_POST);
/* rozpoczynanie formularza */
$formularz_testowy[begin] = $form -> formBegin();
 
/* generowanie pola typu input */
$formularz_testowy[login] = $form -> genInput('puste','text', 'login', $_POST[formularz_testowy][login], 'test', 'Pole Login nie mo�e by� puste', 'a tutaj na przyklad jakies javascriptowegowienko');
/* za pomoca genInput generujemy tez pole typu checbox ;) */
$formularz_testowy[checked] = $form -> genInput('puste','checkbox', 'sex', $_POST[formularz_testowy][sex], '', 'teeeeeeeeeeeeeeerreeeeeeee', '');
$formularz_testowy[wyslij] = $form -> genInput('', 'submit', 'go', 'wy�lij', '');
 
/* generowanie pola typu texarea 
w warto�� $line[4] podajemy np <p>%</p> wtedy tam gdzie % zostanie wstawione pole <input type="radio" .....
taka o dekoracyjna funkcyjka jakby trzeba bylo dodac jakies <br> albo <p> przy radio biggrin.gif dobry jestem co nie ;p
*/
 
$formularz_testowy[tresc] = $form -> genTextarea('puste', 'tresc', $_POST[formularz_testowy][tresc], 'as', 'Tre�� nie mo�e by� pusta', '');
/* generowanie pola typu radio */
/* 0 - value, 1 - class, 2 - add(jakas java), 3 - checked, 4 - decorate */
 
$items = array();
$items[] = array('pierwsza', 'class', '', 'jakis java', '%<br />');
$items[] = array('drua', 'aasd', '', 'checked', '%<hr>');
$items[] = array('pierwsza', 'asd', '');
$formularz_testowy[radio] = $form -> genRadio('', 'radio', $items, 'wiadomosc bledu');
 
/* generowanie pola typu select */
/* 0 - value, 1 - tresc, 2 - class , 3 - add(jakas java), 4 - selected */
 
$items = array();
$items[] = array('', '-= wybierz =-', '', '');
$items[] = array('1', 'tresc', 'asd','', 'selected');
$items[] = array('2', 'tresc 1', '');
$items[] = array('3', 'tresc 2', '');
$formularz_testowy[select] = $form -> genSelect('puste', 'select', 'class', $items, 'wiadomosc bledu');
 
/* przes�anie ewentualnych b��d�w */
$formularz_testowy[errors] = $form -> errorMsg;
 
/* musi byc wywolane jako ostatnie */
$formularz_testowy[end] = $form -> formEnd();
 
if($form -> parse){
	echo "formulaz przeszed� test prawid�owo";
}
else{
	$smarty -> assign('formularz_testowy', $formularz_testowy);	
}
 
$smarty -> display('index.tpl');
?>