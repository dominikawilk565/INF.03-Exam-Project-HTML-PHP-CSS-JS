<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obuwie</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>

    <header>
        <h1>Obuwie męskie</h1>
    </header>

    <section>
        <h2>Zamówienie</h2>    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $model=$_POST['model'];
        $rozmiar=$_POST['rozmiar'];
        $liczba_par=$_POST['liczba_par'];

        $server="localhost";
        $user="root";
        $password="";
        $dbname="obuwie";

        $conn=mysqli_connect($server,$user,$password,$dbname);
            if(!$conn)
                die("brak połączenia z bazą danych");

        $zapytanie3="SELECT nazwa, cena, kolor, kod_produktu, material, nazwa_pliku FROM `buty` JOIN produkt USING(model) where model='$model'";
        $wynik=mysqli_query($conn,$zapytanie3);

        if(mysqli_num_rows($wynik)>0){
            while($wiersz=mysqli_fetch_assoc($wynik))
            {
                echo "<img src='./".$wiersz['nazwa_pliku']."'>";
                echo "<h2>".$wiersz['nazwa']."</h2>";
                $liczbaCalkowita=$liczba_par*$wiersz['cena'];
                echo "<p>Cena za ".$liczba_par." par: $liczbaCalkowita </p>";
                echo "<p>Szczegóły produktu:".$wiersz['kolor'].",".$wiersz['material']." </p>";
                echo "<p>Rozmiar: $rozmiar </p>";

            }
        }
        mysqli_close($conn);
        }
?>

        <a href="index.php">Strona główna</a>
    </section>

    <footer>
        <p>Autor strony: 00000000000000000000000</p>
    </footer>
</body>
</html>