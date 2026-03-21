<?php
require_once dirname(__FILE__).'/../config.php';
$rootPath = dirname(__DIR__);
//załaduj Smarty
require_once $rootPath.'/lib/smarty/libs/Smarty.class.php';

use Smarty\Smarty;

$smarty = new Smarty();
$smarty->setTemplateDir([
    $rootPath.'/templates/',
    $rootPath.'/app/'
]);
$smarty->setCompileDir($rootPath.'/templates_c/');
$smarty->setCacheDir($rootPath.'/cache/');
$smarty->setConfigDir($rootPath.'/configs/');

$errors = [];

// Initialize variables
$kwota = '';
$oprocentowanie = '';
$czas = '';
$rata = null;
$kwota_cal = null;
$n = null;

if (!isset($_GET['amount']) && !isset($_GET['interest']) && !isset($_GET['term'])) {
    $smarty->display('calc.tpl');
    exit;
}

if (!isset($_GET['amount']) || !isset($_GET['interest']) || !isset($_GET['term'])) {
    $errors[] = "Wszystkie pola są wymagane.";
}

$kwota = $_GET['amount'] ?? 0;
$oprocentowanie = $_GET['interest'] ?? 0;
$czas = $_GET['term'] ?? 0;

if (!is_numeric($kwota)) {
    $errors[] = "Kwota kredytu musi być liczbą.";
}
if (!is_numeric($oprocentowanie)) {
    $errors[] = "Oprocentowanie musi być liczbą.";
}
if (!is_numeric($czas)) {
    $errors[] = "Czas trwania kredytu musi być liczbą.";
}

$kwota = floatval($kwota);
$oprocentowanie = floatval($oprocentowanie);
$czas = floatval($czas);

if ($kwota <= 0) {
    $errors[] = "Kwota kredytu musi być większa od zera.";
}
if ($kwota > 10000000) {
    $errors[] = "Kwota kredytu jest zbyt duża (max 10 000 000).";
}
if ($oprocentowanie < 0) {
    $errors[] = "Oprocentowanie nie może być ujemne.";
}
if ($oprocentowanie > 100) {
    $errors[] = "Oprocentowanie nie może przekraczać 100%.";
}
if ($czas <= 0) {
    $errors[] = "Czas trwania kredytu musi być większy od zera.";
}
if ($czas > 50) {
    $errors[] = "Czas trwania kredytu jest zbyt długi (max 50 lat).";
}

if (!empty($errors)) {
    $smarty->assign('errors', $errors);
    $smarty->assign('kwota', $kwota);
    $smarty->assign('oprocentowanie', $oprocentowanie);
    $smarty->assign('czas', $czas);
    $smarty->display('calc.tpl');
    exit;
}

// Calculate loan values
$kwota_cal = $kwota * pow(1 + ($oprocentowanie / 100), $czas);
$r = $oprocentowanie / 100 / 12;
$n = $czas * 12;

if ($oprocentowanie != 0) { 
    $rata = ($kwota * $r) / (1 - pow(1 + $r, -$n)); 
} else {
    $rata = $kwota / $n; 
}

// Assign variables to template
$smarty->assign('kwota', $kwota);
$smarty->assign('oprocentowanie', $oprocentowanie);
$smarty->assign('czas', $czas);
$smarty->assign('rata', $rata);
$smarty->assign('kwota_cal', $kwota_cal);
$smarty->assign('n', $n);
$smarty->assign('errors', $errors);

$smarty->display('calc.tpl');
?>
