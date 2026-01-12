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
        <form action="./zamow.php" method="post">
            <label>Model: 
        <?php  
            $server="localhost";
            $user="root";
            $password="";
            $dbname="obuwie";

            $conn=mysqli_connect($server,$user,$password,$dbname);
            if(!$conn)
            {
                die("Błąd połączenia z bazą danych");
            }
            
            $zapytanie1="SELECT model FROM `produkt`;";
            $wynik=mysqli_query($conn,$zapytanie1);

           if(mysqli_num_rows($wynik)>0){
            echo "<select name='model' class='kontrolki'>";
                while($wiersz=mysqli_fetch_assoc($wynik))
                {
                     echo "<option name='".$wiersz['model']."' value='".$wiersz['model']."'>".$wiersz['model']."</option>";
                }
           echo "</select>";
           }

        ?>
        
        
        </label>

            <label>Rozmiar: <select  name="rozmiar" class="kontrolki">
                <option value="40" >40</option>
                <option value="41">41</option>
                <option value="42">42</option>
                <option value="43">43</option>
            </select></label>

            <label>Liczba par: <input type="number" name="liczba_par" class="kontrolki" ></label>

            <input type="submit" value="Zamów" class="kontrolki">
        </form>

        <?php

            $zapytanie2="SELECT model,nazwa,cena,nazwa_pliku FROM `buty` JOIN produkt USING(model);";
            $wynik2=mysqli_query($conn,$zapytanie2);

            if(mysqli_num_rows($wynik2)>0){
                while($wiersz2=mysqli_fetch_assoc($wynik2))
                {
                echo "<div class='buty'>";
                echo "<img src='./".$wiersz2['nazwa_pliku']."' alt='but męski'>";
                echo "<h2>".$wiersz2['nazwa']."</h2>";
                echo "<h5>Model: ".$wiersz2['model']."</h5>";
                echo "<h4>Cena: ".$wiersz2['cena']."</h4>";

                echo "</div>";
                }
            }

            mysqli_close($conn);
        ?>
    </section>

    <footer>
        <p>Autor strony: 00000000000000000000000</p>
    </footer>


</body>
</html>