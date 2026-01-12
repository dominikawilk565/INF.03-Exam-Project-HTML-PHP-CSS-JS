<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biuro turystyczne</title>
    <link rel="stylesheet" href="./styl.css">
</head>
<body>
    <?php
        $name="root";
        $password="";
        $db_name="wyprawy";
        $server="localhost";

        $conn=mysqli_connect($server,$name,$password,$db_name);
    ?>
    
    <nav>
        <ul>
            <li><a href="./wczasy.html">Wczasy</a></li>
            <li><a href="./wycieczki.html">Wycieczki</a></li>
            <li><a href="./allinclusive.html">All inclusive</a></li>
        </ul>
    </nav>

    <main>
        <aside>
            <h3>Twój cel wyprawy</h3>
            <form action="./index.php" method="post">
                <label for="kierunek">Miejsce wycieczki</label><br>
                    <select name="kierunek" id="kierunek">
                        <!-- skrypt 1 -->
                         <?php
                            $zapytanie1="SELECT DISTINCT (nazwa) FROM `miejsca` ORDER BY nazwa ASC;";
                            $query1=mysqli_query($conn,$zapytanie1);

                            while($row1=mysqli_fetch_assoc($query1))
                                {
                                    echo "<option value='".$row1['nazwa']."'>".$row1['nazwa']."</option>";
                                }
                         ?>
                         
                    </select><br>
                <label for="dorosli">Ile dorosłych?</label><br>
                <input type="number" name="dorosli" id="dorosli" min="0"><br>
                <label for="dzieci">Ile dzieci?</label><br>
                <input type="number" name="dzieci" id="dzieci" min="0"><br>
                <label for="kiedy">Termin</label><br>
                <input type="date" id="kiedy" name="kiedy"><br>
                <input type="submit" value="Symulacja ceny">
            </form>
            <h4>Koszt wycieczki</h4>
            <!-- skrypt 2 -->
             <?php
             if(isset($_POST['kierunek'])&&isset($_POST['dorosli'])&&isset($_POST['dzieci'])&&isset($_POST['kiedy']))
                {
                    $gdzie=$_POST['kierunek'];
                    $dorosli=$_POST['dorosli'];
                    $dzieci=$_POST['dzieci'];
                    $termin=$_POST['kiedy'];

                    $zapytanie2="SELECT cena FROM `miejsca` where nazwa='$gdzie';";
                    $query2=mysqli_query($conn,$zapytanie2);
                    while($row2=mysqli_fetch_assoc($query2))
                        {
                            $koszty=0;
                            $cena_dorosli=$row2['cena'];
                            if(!empty($dzieci))
                            $cena_dzieci=$cena_dorosli/2;

                            
                        }
                        $k_dorosli=$cena_dorosli*$dorosli;
                        $k_dzieci=$cena_dzieci*$dzieci;
                     $koszty=$k_dorosli+$k_dzieci;

                     echo "<p>W dniu: $termin</p>";
                     echo "<p>$koszty złotych</p>";

                    }
             ?>
        </aside>

        <section>
            <h3>Wycieczki</h3>
            <!-- skrypt 3 -->
             <?php
                $zapytanie3="SELECT nazwa,cena,link_obraz FROM `miejsca` where link_obraz LIKE '0%';";
                $query3=mysqli_query($conn,$zapytanie3);

                while($row3=mysqli_fetch_assoc($query3))
                    {
                        echo "<div class='wycieczka'>";
                        echo "<img src='".$row3['link_obraz']."' alt='zdjęcie z wycieczki'>";
                        echo "<h2>".$row3['nazwa']."</h2>";
                        echo "<p>".$row3['cena']."</p>";
                        echo "</div>";
                    }
             ?>
        </section>
    </main>

    <footer><p>Autor: 00000000000000000 </p></footer>
</body>
</html>