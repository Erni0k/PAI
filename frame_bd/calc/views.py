from __future__ import annotations

from django.shortcuts import redirect, render

from .models import LoanUser


def _format_pln(value: float) -> str:
    formatted = f"{value:,.2f}"
    return formatted.replace(",", " ").replace(".", ",")


def login_view(request):
    if LoanUser.objects.filter(role=request.session.get("role")).exists():
        return redirect("loan_calculator")

    errors = []

    if request.method == "POST":
        role = request.POST.get("role", "")
        password = request.POST.get("password", "")

        user = LoanUser.objects.filter(role=role, password=password).first()
        if user is None:
            errors.append("Nieprawidlowe dane logowania.")
        else:
            request.session["role"] = user.role
            return redirect("loan_calculator")

    return render(request, "login.html", {"errors": errors})


def logout_view(request):
    request.session.pop("role", None)
    return redirect("login")


def loan_calculator(request):
    role = request.session.get("role")
    user = LoanUser.objects.filter(role=role).first()
    if user is None:
        return redirect("login")

    min_interest = user.min_interest

    errors = []
    result = None

    amount_raw = request.GET.get("amount", "")
    interest_raw = request.GET.get("interest", "")
    term_raw = request.GET.get("term", "")

    submitted = any(v != "" for v in (amount_raw, interest_raw, term_raw))

    amount = 0.0
    interest = 0.0
    term = 0.0

    if submitted:
        if amount_raw == "" or interest_raw == "" or term_raw == "":
            errors.append("Wszystkie pola sa wymagane.")

        try:
            amount = float(amount_raw)
        except ValueError:
            errors.append("Kwota kredytu musi byc liczba.")

        try:
            interest = float(interest_raw)
        except ValueError:
            errors.append("Oprocentowanie musi byc liczba.")

        try:
            term = float(term_raw)
        except ValueError:
            errors.append("Czas trwania kredytu musi byc liczba.")

        if not errors:
            if amount <= 0:
                errors.append("Kwota kredytu musi byc wieksza od zera.")
            if amount > 10_000_000:
                errors.append("Kwota kredytu jest zbyt duza (max 10 000 000).")
            if interest < 0:
                errors.append("Oprocentowanie nie moze byc ujemne.")
            if interest > 100:
                errors.append("Oprocentowanie nie moze przekraczac 100%.")
            if interest <= min_interest:
                errors.append(
                    f"Dla roli {role} oprocentowanie musi byc wieksze niz {int(min_interest)}%."
                )
            if term <= 0:
                errors.append("Czas trwania kredytu musi byc wiekszy od zera.")
            if term > 50:
                errors.append("Czas trwania kredytu jest zbyt dlugi (max 50 lat).")

        if not errors:
            total_amount = amount * pow(1 + (interest / 100), term)
            monthly_rate = interest / 100 / 12
            installments = term * 12

            if interest != 0:
                installment = (amount * monthly_rate) / (1 - pow(1 + monthly_rate, -installments))
            else:
                installment = amount / installments

            result = {
                "amount": _format_pln(amount),
                "interest": _format_pln(interest),
                "term": _format_pln(term),
                "installment": _format_pln(installment),
                "installments": installments,
                "total_amount": _format_pln(total_amount),
                "total_cost": _format_pln(total_amount - amount),
            }

    context = {
        "role": role,
        "min_interest": int(min_interest),
        "errors": errors,
        "result": result,
        "amount": amount_raw,
        "interest": interest_raw,
        "term": term_raw,
        "interest_options": range(int(min_interest) + 1, 21),
    }
    return render(request, "calc.html", context)
