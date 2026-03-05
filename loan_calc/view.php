<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Kredytowy</title>
</head>
<body>
    <h1>Loan Calculator</h1>
    <form action="calc.php" method="GET">
        <label for="amount">Kwota kredytu:</label><br>
        <input type="number" id="amount" name="amount" step="0.01" required><br><br>

        <label for="interest">Oprocentowanie roczne (%):</label><br>
        <input type="number" id="interest" name="interest" step="0.01" required><br><br>

        <label for="term">Czas trwania kredytu (lata):</label><br>
        <input type="number" id="term" name="term" step="0.01" required><br><br>

        <input type="submit" value="Oblicz">
    </form>
    
    <?php if (isset($rata) && isset($kwota_cal)): ?>
        <hr>
        <h2>Wyniki:</h2>
        <p><strong>Kwota kredytu:</strong> <?php echo number_format($kwota, 2, ',', ' '); ?> zł</p>
        <p><strong>Miesięczna rata:</strong> <?php echo number_format($rata, 2, ',', ' '); ?> zł</p>
        <p><strong>Liczba rat:</strong> <?php echo isset($n) ? $n : 0; ?></p>
        <p><strong>Całkowita kwota do spłaty:</strong> <?php echo number_format($kwota_cal, 2, ',', ' '); ?> zł</p>
    <?php endif; ?>
</body>
</html>