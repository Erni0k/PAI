# Projektowanie Aplikacji Internetowych (PAI)

Repozytorium zawiera warianty kalkulatora kredytowego realizowane w ramach zajęć.

## Szybka aktualizacja

- `frame_calc/` - wersja Django kalkulatora kredytowego.
- `frame_ochrona/` - wersja Django z prostym logowaniem bez bazy uzytkownikow (role: `pracownik`, `menager`) oraz ograniczeniem oprocentowania:
	- pracownik: tylko > 5%
	- menager: tylko > 1%

## Struktura projektów

### 1) Wersja podstawowa (`loan_calc/`)

Prosty kalkulator kredytowy w PHP.

**Najważniejsze elementy:**
- obliczanie miesięcznej raty,
- obliczanie całkowitej kwoty do spłaty,
- podstawowa walidacja danych.

---

### 2) Wersja z szablonem HTML/CSS (`loan_calc_temp/`)

Kalkulator oparty o motyw HTML5 UP (Solid State), z rozdzieleniem logiki i widoku.

**Najważniejsze elementy:**
- walidacja danych wejściowych,
- obliczanie raty, całkowitej spłaty i kosztu kredytu,
- responsywny interfejs (`assets/` + `images/`),
- logika w `app/calc.php`, widok w `app/view.php`.

---

### 3) Wersja Smarty (`loan_calc_smarty/`)

Wersja po konwersji do Smarty, z rozdzieleniem layoutu i treści.

**Aktualny podział widoków:**
- `templates/calc.tpl` – layout strony (header + footer),
- `app/calc.html` – część środkowa (formularz + wyniki),
- `app/calc.php` – logika biznesowa i przypisanie danych do Smarty.

**Katalogi pomocnicze Smarty:**
- `templates_c/` – skompilowane szablony,
- `cache/` – cache szablonów,
- `configs/` – konfiguracja Smarty.

## Uruchomienie

Przykładowe adresy lokalne:

- `http://localhost/loan_calc/`
- `http://localhost/loan_calc_temp/`
- `http://localhost/loan_calc_smarty/`

Jeśli używasz wersji Smarty, upewnij się, że biblioteka Smarty jest dostępna pod ścieżką używaną w `loan_calc_smarty/app/calc.php`.
