<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIEKARNIA</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <?php
        $server="localhost";
        $name="root";
        $password="";
        $db_name="piekarnia";

        $conn=mysqli_connect($server,$name,$password,$db_name);

    ?>
    <img src="./wypieki.png" alt="Produkty naszej piekarni"> 
    <nav>
        <a href="./kw1.png">KWERENDA1</a>
        <a href="./kw2.png">KWERENDA2</a>
        <a href="./kw3.png">KWERENDA3</a>
        <a href="./kw4.png">KWERENDA4</a>
    </nav>

    <header>
        <h1>Witamy</h1>
        <h4>NA STRONIE PIEKARNI</h4>
        <p>Od 31 lat oferujemy najwyższej jakości pieczywo. Naturalnie świeże, naturalnie smaczne. Pieczemy wyłącznie wypieki na naturalnym zakwasie bez polepszaczy i zagęstników. Korzystamy wyłącznie z najlepszych ziaren pochodzących z ekologicznych upraw położonych w rejonach zgierskim i ozorkowskim.</p>
    </header>

    <main>
        <h4>Wybierz rodzaj wypieków:</h4>

        <form action="./piekarnia.php" method="post">
            <select name="opcja">
                <?php
                    $zapytanie1="SELECT DISTINCT(Rodzaj) FROM `wyroby` ORDER BY `wyroby`.`Rodzaj` DESC;";
                    $query1=mysqli_query($conn,$zapytanie1);

                    while($row1=mysqli_fetch_assoc($query1))
                    {
                        echo "<option value='".$row1['Rodzaj']."'>".$row1['Rodzaj']."</option>";
                    }
                ?>
            </select>
            <input type="submit" value="Wyślij">
        </form>

        <table>
            <tr><th>Rodzaj</th><th>Nazwa</th><th>Gramatura</th><th>Cena</th></tr>
           <?php
            if(isset($_POST['opcja']))
            {
                $wartosc=$_POST['opcja'];

                $zapytanie2="SELECT Rodzaj,Nazwa,Gramatura, Cena FROM `wyroby` WHERE Rodzaj='".$wartosc."';";
                $query2=mysqli_query($conn,$zapytanie2);

                while($row2=mysqli_fetch_assoc($query2))
                {
                    echo "<tr>"."<td>".$row2['Rodzaj']."</td>"."<td>".$row2['Nazwa']."</td>"."<td>".$row2['Gramatura']."</td>"."<td>".$row2['Cena']."</td>"."</tr>";
                }
            }
            else{
                echo "";
            }

            mysqli_close($conn);
           ?>
        </table>
    </main>

    <footer>
        <p>Autor: 000000000000000000000</p>
        <p>Data: 15.01.2026</p>
    </footer>

</body>
</html>