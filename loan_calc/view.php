<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Kredytowy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <h1>Kalkulator Kredytowy</h1>
    
    <?php if (isset($errors) && !empty($errors)): ?>
        <div class="error-box">
            <h3>Błędy walidacji:</h3>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    
    <form action="calc.php" method="GET">
        <label for="amount">Kwota kredytu:</label>
        <input type="number" id="amount" name="amount" step="0.01" required>

        <label for="interest">Oprocentowanie roczne (%):</label>
        <select id="interest" name="interest" required>
            <?php for ($i = 1; $i <= 20; $i++): ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?>%</option>
            <?php endfor; ?>
        </select>

        <label for="term">Czas trwania kredytu (lata):</label>
        <input type="number" id="term" name="term" step="0.01" required>

        <input type="submit" value="Oblicz">
    </form>
    
    <?php if (isset($rata) && isset($kwota_cal)): ?>
        <hr>
        <h2>Wyniki:</h2>
        <div class="results">
        <p><strong>Kwota kredytu:</strong> <?php echo number_format($kwota, 2, ',', ' '); ?> zł</p>
        <p><strong>Miesięczna rata:</strong> <?php echo number_format($rata, 2, ',', ' '); ?> zł</p>
        <p><strong>Liczba rat:</strong> <?php echo isset($n) ? $n : 0; ?></p>
        <p><strong>Całkowita kwota do spłaty:</strong> <?php echo number_format($kwota_cal, 2, ',', ' '); ?> zł</p>
        </div>
    <?php endif; ?>
    </div>
</body>
</html>