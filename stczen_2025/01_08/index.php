<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mieszalnia farb</title>
    <link href="./fav.png" rel="shortcut icon">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <header>
        <img src="./baner.png" alt="Mieszalnia farb">
    </header>

    <section id="formularz">
        <form action="./index.php" method="post">
            <label>Data odbioru od: <input type="date"></label>
            <label>do: <input type="date"></label>
            <input type="submit" value="Wyszukaj">
        </form>
    </section>

    <section id="glowny">
        <table>
            <th><td>Nr zamówienia</td><td>Nazwisko</td><td>Imię</td><td>Kolor</td><td>Pojemność[ml]</td><td>Data odbioru</td></th>
        </table>
    </section>

    <footer>
        <h3>Egzamin INF .03</h3>
        <p>Autor:00000000000000000</p>
    </footer>
</body>
</html>