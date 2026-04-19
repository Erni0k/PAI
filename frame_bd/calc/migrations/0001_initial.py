from django.db import migrations, models


def seed_loan_users(apps, schema_editor):
    LoanUser = apps.get_model("calc", "LoanUser")
    LoanUser.objects.update_or_create(
        role="pracownik",
        defaults={"password": "pracownik123", "min_interest": 5.0},
    )
    LoanUser.objects.update_or_create(
        role="menager",
        defaults={"password": "menager123", "min_interest": 1.0},
    )


def unseed_loan_users(apps, schema_editor):
    LoanUser = apps.get_model("calc", "LoanUser")
    LoanUser.objects.filter(role__in=["pracownik", "menager"]).delete()


class Migration(migrations.Migration):
    initial = True

    dependencies = []

    operations = [
        migrations.CreateModel(
            name="LoanUser",
            fields=[
                (
                    "id",
                    models.BigAutoField(
                        auto_created=True,
                        primary_key=True,
                        serialize=False,
                        verbose_name="ID",
                    ),
                ),
                (
                    "role",
                    models.CharField(
                        choices=[("pracownik", "pracownik"), ("menager", "menager")],
                        max_length=20,
                        unique=True,
                    ),
                ),
                ("password", models.CharField(max_length=128)),
                ("min_interest", models.FloatField()),
            ],
        ),
        migrations.RunPython(seed_loan_users, reverse_code=unseed_loan_users),
    ]
