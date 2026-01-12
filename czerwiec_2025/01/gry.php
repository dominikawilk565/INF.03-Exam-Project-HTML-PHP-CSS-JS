<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gry komputerowe</title>
    <link rel="stylesheet" href="./styl.css"> 
</head>
<body>
    <?php
        $server='localhost';
        $name='root';
        $password='';
        $db_name='gry';

        $conn=mysqli_connect($server,$name,$password,$db_name);
    ?>
    <header>
        <h1>Ranking gier komputerowych</h1>
    </header>
    <div>
        <aside id="lewa">
            <h3>Top 5 gier w tym miesiącu</h3>
            <ul>
                <?php
                    $zapytanie1="SELECT nazwa,punkty FROM `gry` ORDER BY punkty DESC limit 5;";
                    $query1=mysqli_query($conn,$zapytanie1);

                    while($row1=mysqli_fetch_assoc($query1))
                    {
                        echo "<li>".$row1['nazwa']." "."<span class=punkciki>".$row1['punkty']."</span>"."</li>";
                    }
                ?>
            </ul>
            <h3>Nasz sklep</h3>
            <a href="http://sklep.gry.pl">Tu kupisz gry</a>
            <h3>Stronę wykonał:</h3>
            <p>000000000000000</p>
        </aside>

        <main>
            <section id="gry">
            <?php
                    $zapytanie2="SELECT id,nazwa,zdjecie FROM `gry`;";
                    $query2=mysqli_query($conn,$zapytanie2);

                    while($row2=mysqli_fetch_assoc($query2))
                    {
                        echo "<img src='./".$row2['zdjecie']."' alt='".$row2['nazwa']."' title='".$row2['id']."'>";
                        echo "<br><p>".$row2['nazwa']."</p>";
                    }

            ?>
            </section>
        </main>

        <aside id="prawa">
            <h3>Dodaj nową grę</h3>
            <form action="./gry.php" method="post">
                <legend>nazwa:</legend>
                <input type="text" name="nazwa" >

                <legend>opis:</legend>
                <input type="text" name="opis">

                <legend>cena:</legend>
                <input type="text" name="cena">

                <legend>zdjęcie:</legend>
                <input type="text" name="zdjecie">
                <br>

                <input type="submit" value="DODAJ">
            </form>
             <?php
                if(isset($_POST['nazwa'])&&isset($_POST['opis'])&&isset($_POST['cena'])&&isset($_POST['zdjecie']))
                {
                    $nazwa=$_POST['nazwa'];
                    $opis=$_POST['opis'];
                    $cena=$_POST['cena'];
                    $zdjecie=$_POST['zdjecie'];

                    $zapytanie4="INSERT INTO `gry`( `nazwa`, `opis`, `punkty`, `cena`, `zdjecie`) VALUES ('$nazwa','$opis','0','$cena','$zdjecie');";
                    $query4=mysqli_query($conn,$zapytanie4);
                }
             ?>
        </aside>
    </div>

    <footer>
        <form action="./gry.php" method="post">
            <input type="text" name="id">
            <input type="submit" value="Pokaż opis">
        </form>
         <?php
            if(isset($_POST['id']))
            {
                $pole=$_POST['id'];
                $zapytanie3="SELECT nazwa,left(opis,100),punkty,cena FROM `gry` WHERE id='".$pole."';";
                $query3=mysqli_query($conn,$zapytanie3);

                while($row3=mysqli_fetch_assoc($query3))
                {
                    echo "<h2>".$row3['nazwa'].", ".$row3['punkty']." punktów, ".$row3['cena']." zł </h2>";
                    echo "<p>".$row3['left(opis,100)']."</p>";
                }
                
            }
            mysqli_close($conn);
         ?>
    </footer>
</body>
</html>