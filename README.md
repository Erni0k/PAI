# Projektowanie Aplikacji Internetowych (PAI)

Repozytorium zawiera warianty kalkulatora kredytowego realizowane w ramach zajęć.

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

---

### 4) Wersja Django (`frame_calc/`)

Kalkulator kredytowy przeniesiony do Django (Python), z wykorzystaniem szablonu HTML5 UP (Solid State).

**Najważniejsze elementy:**
- logika kalkulatora w `frame_calc/calc/views.py`,
- routing w `frame_calc/calc/urls.py`,
- szablon strony w `frame_calc/calc/templates/calc.html`,
- zasoby statyczne w `frame_calc/calc/static/assets/`,
- zależności projektu w `frame_calc/requirements.txt`.

## Uruchomienie

Przykładowe adresy lokalne:

- `http://localhost/loan_calc/`
- `http://localhost/loan_calc_temp/`
- `http://localhost/loan_calc_smarty/`

### Django (`frame_calc/`)

1. Wejdź do katalogu projektu:
	- `cd frame_calc`
2. Zainstaluj zależności:
	- `python -m pip install -r requirements.txt`
3. Wykonaj migracje:
	- `python manage.py migrate`
4. Uruchom serwer deweloperski:
	- `python manage.py runserver`
5. Otwórz:
	- `http://127.0.0.1:8000/`

Jeśli używasz wersji Smarty, upewnij się, że biblioteka Smarty jest dostępna pod ścieżką używaną w `loan_calc_smarty/app/calc.php`.
