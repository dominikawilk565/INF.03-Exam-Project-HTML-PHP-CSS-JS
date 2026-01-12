<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteka miejska</title>
    <link rel="stylesheet" href="./styl.css">
</head>
<body>
    <?php
        $name="root";
        $db_name="biblioteka";
        $password="";
        $server="localhost";

        $conn=mysqli_connect($server,$name,$password,$db_name);
    ?>
    <header>
        <!-- --skrypt 1-- -->
         <?php
            for($i=0;$i<20;$i++)
            {
                echo "<img src=./obraz.png>";
            }
         ?>
    </header>

    <main>
        <section id="blok_1">
            <h2>Liryka</h2>
            <form action="./biblioteka.php" method="post">
                <select name="id_ksiazki">
                    <!-- skrypt 2 -->
                    <option disabled>Wybierz książke</option>
                     <?php
                        $zapytanie1="SELECT id,tytul FROM `ksiazka` where gatunek='liryka';";
                        $query1=mysqli_query($conn,$zapytanie1);
                        while($row=mysqli_fetch_assoc($query1))
                        {
                            echo "<option value='".$row["id"]."'>".$row["tytul"]."</option>";
                        }
                     ?>
                </select>
                <input type="submit" value="Rezerwuj">
            </form>
            <!-- skrypt 3 -->
             <?php
              if(isset($_POST['id_ksiazki'])&& !empty($_POST['id_ksiazki'] ))
              {
                $id=$_POST['id_ksiazki'];
                $zapytanie5="SELECT tytul FROM `ksiazka` where id=$id;";
                $query2=mysqli_query($conn,$zapytanie5);
                while($row1=mysqli_fetch_assoc($query2))
                {
                    echo "<p>Książka ".$row1["tytul"]." została zarezerwowana</p>";
                }
                 $zapytanie4="UPDATE `ksiazka` SET `rezerwacja`='1' WHERE ksiazka.id=$id;";
                    $query3=mysqli_query($conn,$zapytanie4);
              } 
             ?>
        </section>

        <section id="blok_2">
            <h2>Epika</h2>
            <form action="./biblioteka.php" method="post">
                <select name="epika">
                    <option disabled>Wybierz książke</option>
                    <!-- skrypt 2 -->
                     <?php
                        $zapytanie1="SELECT id,tytul FROM `ksiazka` where gatunek='epika';";
                        $query1=mysqli_query($conn,$zapytanie1);
                        while($row=mysqli_fetch_assoc($query1))
                        {
                            echo "<option value='".$row["id"]."'>".$row["tytul"]."</option>";
                        }
                     ?>
                </select>
                <input type="submit" value="Rezerwuj">
            </form>
            <!-- skrypt 3 -->
             <?php
              if(isset($_POST['epika'])&& !empty($_POST['epika'] ))
              {
                $id=$_POST['epika'];
                $zapytanie5="SELECT tytul FROM `ksiazka` where id=$id;";
                $query2=mysqli_query($conn,$zapytanie5);
                while($row1=mysqli_fetch_assoc($query2))
                {
                    echo "<p>Książka ".$row1["tytul"]." została zarezerwowana</p>";
                    
                }
                $zapytanie4="UPDATE `ksiazka` SET `rezerwacja`='1' WHERE ksiazka.id=$id;";
                    $query3=mysqli_query($conn,$zapytanie4);
              } 
             ?>
        </section>

        <section id="blok_3">
            <h2>Dramat</h2>
            <form action="./biblioteka.php" method="post">
                <select name="dramat">
                    <option disabled>Wybierz książke</option>
                    <!-- skrypt 2 -->
                     <?php
                        $zapytanie1="SELECT id,tytul FROM `ksiazka` where gatunek='dramat';";
                        $query1=mysqli_query($conn,$zapytanie1);
                        while($row=mysqli_fetch_assoc($query1))
                        {
                            echo "<option value='".$row["id"]."'>".$row["tytul"]."</option>";
                        }
                     ?>
                </select>
                <input type="submit" value="Rezerwuj">
            </form>
              <!-- skrypt 3 -->
             <?php
              if(isset($_POST['dramat'])&& !empty($_POST['dramat'] ))
              {
                $id=$_POST['dramat'];
                $zapytanie5="SELECT tytul FROM `ksiazka` where id=$id;";
                $query2=mysqli_query($conn,$zapytanie5);
                while($row1=mysqli_fetch_assoc($query2))
                {
                    echo "<p>Książka ".$row1["tytul"]." została zarezerwowana</p>";
                   
                }
                 $zapytanie4="UPDATE `ksiazka` SET `rezerwacja`='1' WHERE ksiazka.id=$id;";
                    $query3=mysqli_query($conn,$zapytanie4);
              } 
             ?>
        </section>

        <section id="blok_4">
            <h2>Zaległe książki</h2>
            <ul>
                <!-- skrypt 4 -->
                 <?php
                    $zapytanie2="SELECT tytul,id_cz,data_odd FROM `ksiazka` inner JOIN wypozyczenia on ksiazka.id=wypozyczenia.id_ks order by data_odd ASC limit 15;";
                    $query4=mysqli_query($conn,$zapytanie2);
                    while($row2=mysqli_fetch_assoc($query4))
                    {
                        echo "<li>".$row2["tytul"]." ".$row2["id_cz"]." ".$row2["data_odd"]."</li>";
                    }
                    mysqli_close($conn);
                 ?>
            </ul>
        </section>
    </main>

    <footer>
        <p><strong>Autor: 00000000000000</strong></p>
    </footer>
</body>
</html>