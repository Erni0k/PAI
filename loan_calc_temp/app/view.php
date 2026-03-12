<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Kredytowy</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <noscript><link rel="stylesheet" href="../assets/css/noscript.css"></noscript>
</head>
<body class="is-preload">

    <div id="page-wrapper">

        <section id="banner">
            <div class="inner">
                <div class="logo"><span class="icon fa-gem"></span></div>
                <h2>Kalkulator Kredytowy</h2>
                <p>Oblicz miesięczną ratę oraz całkowity koszt kredytu</p>
            </div>
        </section>

        <section id="wrapper">

            <section id="one" class="wrapper spotlight style1">
                <div class="inner">
                    
                    <?php if (isset($errors) && !empty($errors)): ?>
                        <div class="box" style="background-color: #fee; border: 2px solid #c33;">
                            <h3 style="color: #c33;">Błędy walidacji:</h3>
                            <ul style="margin-left: 20px; color: #c33;">
                                <?php foreach ($errors as $error): ?>
                                    <li><?php echo htmlspecialchars($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="content">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" style="color: #000;">
                            <div class="row gtr-uniform">
                                <div class="col-12">
                                    <label for="amount" style="color: #000;">Kwota kredytu (zł):</label>
                                    <input type="number" id="amount" name="amount" step="0.01" value="<?php echo isset($kwota) ? $kwota : ''; ?>" required style="color: #000;">
                                </div>
                                <div class="col-12">
                                    <label for="interest" style="color: #000;">Oprocentowanie roczne (%):</label>
                                    <select id="interest" name="interest" required style="color: #000;">
                                        <?php for ($i = 1; $i <= 20; $i++): ?>
                                            <option value="<?php echo $i; ?>" <?php echo (isset($oprocentowanie) && $oprocentowanie == $i) ? 'selected' : ''; ?> style="color: #000;"><?php echo $i; ?>%</option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="term" style="color: #000;">Czas trwania kredytu (lata):</label>
                                    <input type="number" id="term" name="term" step="0.01" value="<?php echo isset($czas) ? $czas : ''; ?>" required style="color: #000;">
                                </div>
                                <div class="col-12">
                                    <ul class="actions">
                                        <li><input type="submit" value="Oblicz ratę" class="primary"></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </section>

            <?php if (isset($rata) && isset($kwota_cal)): ?>
            <section id="two" class="wrapper alt spotlight style2">
                <div class="inner">
                    <div class="content">
                        <h2 class="major">Wyniki obliczeń</h2>
                        <div class="table-wrapper">
                            <table class="alt">
                                <tbody>
                                    <tr>
                                        <td><strong>Kwota kredytu:</strong></td>
                                        <td><?php echo number_format($kwota, 2, ',', ' '); ?> zł</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Oprocentowanie roczne:</strong></td>
                                        <td><?php echo number_format($oprocentowanie, 2, ',', ' '); ?>%</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Czas trwania:</strong></td>
                                        <td><?php echo number_format($czas, 2, ',', ' '); ?> lat (<?php echo isset($n) ? $n : 0; ?> miesięcy)</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Miesięczna rata:</strong></td>
                                        <td><span style="font-size: 1.2em; color: #4c5c96;"><strong><?php echo number_format($rata, 2, ',', ' '); ?> zł</strong></span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Całkowita kwota do spłaty:</strong></td>
                                        <td><span style="font-size: 1.2em; color: #4c5c96;"><strong><?php echo number_format($kwota_cal, 2, ',', ' '); ?> zł</strong></span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Całkowity koszt kredytu:</strong></td>
                                        <td><?php echo number_format($kwota_cal - $kwota, 2, ',', ' '); ?> zł</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <?php endif; ?>

        </section>

        <section id="footer">
            <div class="inner">
                <h2 class="major">Informacje o kalkulatorze</h2>
                <p>Kalkulator kredytowy pozwala na szybkie obliczenie miesięcznej raty oraz całkowitego kosztu kredytu. Kalkulacja jest przybliżona i ma charakter informacyjny.</p>
                <ul class="copyright">
                    <li>&copy; 2026 Kalkulator Kredytowy. Wszelkie prawa zastrzeżone.</li>
                    <li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
                </ul>
            </div>
        </section>

    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/jquery.scrollex.min.js"></script>
    <script src="../assets/js/browser.min.js"></script>
    <script src="../assets/js/breakpoints.min.js"></script>
    <script src="../assets/js/util.js"></script>
    <script src="../assets/js/main.js"></script>

</body>
</html>