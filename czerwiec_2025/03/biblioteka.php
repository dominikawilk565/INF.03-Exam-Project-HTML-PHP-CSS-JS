<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIBLIOTEKA SZKOLNA</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <?php
    $server='localhost';
    $name='root';
    $password='';
    $db_name='biblioteka';

    $conn=mysqli_connect($server,$name,$password,$db_name);
    ?>
    <header>
        <h2>STRONA BIBLIOTEKI SZKOLNEJ WIEDZAMIN</h2>
    </header>

    <section>
        <h3>Nasze dzisiejsze propozycje:</h3>

        <table>
            
                <tr>
                    <th>Autor</th>
                    <th>Tytuł</th>
                    <th>Katalog</th>
                </tr>

            <?php
            $zapytanie="SELECT autor,tytul,kod FROM `ksiazki` ORDER BY rand() LIMIT 5;";
            $query=mysqli_query($conn,$zapytanie);

            while($row=mysqli_fetch_assoc($query))
            {
                echo "<tr>";
                echo "<td>".$row['autor']."</td>";
                echo "<td>".$row['tytul']."</td>";
                echo "<td>".$row['kod']."</td>";
                echo "</tr>";
            }
            

            mysqli_close($conn);
            ?>
        </table>
    </section>

    <main>
        <article id="ropucha">
            <img src="./ksiazka1.jpg" alt="okładka książki">
            <p>Według rónych podań najpaskudniejsza ropucha nosi w głowie piękny, cenny klejnot.</p>
        </article>

        <article id="lalka">
            <img src="./ksiazka2.jpg" alt="okładka książki">
            <p>Panna Stefcia i Maryla nie są to zbyt grzeczne damy, nawet nie słuchają mamy...</p>
        </article>

        <article id="przyjaciel">
            <img src="./ksiazka3.jpg" alt="okładka książki">
            <p>Ratuj mnie, przyjacielu, w ostatniej potrzebie: Kocham piękną Irenę. Rodzice i ona...</p>
        </article>
    </main>

    <footer>
        Stronę wykonał: 0000000000000000
    </footer>
</body>
</html>