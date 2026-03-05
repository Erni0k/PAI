<?php
// Walidacja danych wejściowych
$errors = [];

// Sprawdzenie czy parametry istnieją
if (!isset($_GET['amount']) || !isset($_GET['interest']) || !isset($_GET['term'])) {
    $errors[] = "Wszystkie pola są wymagane.";
}

$kwota = $_GET['amount'] ?? 0;
$oprocentowanie = $_GET['interest'] ?? 0;
$czas = $_GET['term'] ?? 0;

// Sprawdzenie czy wartości są numeryczne
if (!is_numeric($kwota)) {
    $errors[] = "Kwota kredytu musi być liczbą.";
}
if (!is_numeric($oprocentowanie)) {
    $errors[] = "Oprocentowanie musi być liczbą.";
}
if (!is_numeric($czas)) {
    $errors[] = "Czas trwania kredytu musi być liczbą.";
}

// Konwersja na liczby
$kwota = floatval($kwota);
$oprocentowanie = floatval($oprocentowanie);
$czas = floatval($czas);

// Sprawdzenie zakresów wartości
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

// Jeśli są błędy, przekaż je do widoku
if (!empty($errors)) {
    include 'view.php';
    exit;
}

// Obliczenia
$kwota_cal = $kwota * pow(1 + ($oprocentowanie / 100), $czas);
$r = $oprocentowanie / 100 / 12; // miesięczna stopa procentowa
$n = $czas * 12; // liczba miesięcy

if ($oprocentowanie != 0) { 
    $rata = ($kwota * $r) / (1 - pow(1 + $r, -$n)); 
} else {
    $rata = $kwota / $n; 
}

// Dołącz widok z wynikami
include 'view.php';
?>