from django.db import models


class LoanUser(models.Model):
    ROLE_CHOICES = [
        ("pracownik", "pracownik"),
        ("menager", "menager"),
    ]

    role = models.CharField(max_length=20, unique=True, choices=ROLE_CHOICES)
    password = models.CharField(max_length=128)
    min_interest = models.FloatField()

    def __str__(self) -> str:
        return self.role
