<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firma szkoleniowa</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <header>
        <img src="./baner.jpg" alt="Szkolenia">
    </header>

    <aside>
        <ul>
            <li><a href="index.html">Strona główna</a></li>
            <li><a href="szkolenia.php">Szkolenia</a></li>
        </ul>
    </aside>

    <article>
        <?php
            $server="localhost";
            $user="root";
            $password="";
            $dbname="firma";

            $conn=mysqli_connect($server,$user,$password,$dbname);

            $zapytanie="SELECT DATA,Temat FROM `szkolenia` ORDER by Data;";

            $wynik=mysqli_query($conn,$zapytanie);

            $plik = fopen("harmonogram.txt","w");

            if(mysqli_num_rows($wynik)>0){
                while($wiersz=mysqli_fetch_array($wynik))
                {
                    echo "<p>".$wiersz['DATA']." ".$wiersz['Temat']."</p>";

                    $linia=$wiersz['DATA']." ".$wiersz['Temat']."\n";
                    fwrite($plik,$linia);
                }
            }
            
            fclose($plik);
            mysqli_close($conn);

        ?>
    </article>

    <footer>
        <h2>Firma szkoleniowa, ul.Główna 1, 23-456 Warszawa</h2>
        <p>Autor: 0000000000000000000000000000</p>
    </footer>
</body>
</html>