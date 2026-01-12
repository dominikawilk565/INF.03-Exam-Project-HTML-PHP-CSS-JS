<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firma przewozowa</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <?php
    $server='localhost';
    $name='root';
    $password='';
    $db_name='przewozy';

    $conn= mysqli_connect($server,$name,$password,$db_name);
    ?>

    <header>
        <h1>Firma przewozowa Półdarmo</h1>
    </header>

    <nav>
       <a href="./kwerenda1.png">kwerenda 1</a> 
       <a href="./kwerenda2.png">kwerenda 2</a> 
       <a href="./kwerenda3.png">kwerenda 3</a> 
       <a href="./kwerenda4.png">kwerenda 4</a> 
    </nav>

    <main>
        <article>
            <h2>Zadania do wykonania</h2>

            <table>
                <tr>
                    <th>Zadanie do wykonania</th>
                    <th>Data realizacji</th>
                    <th>Akcja</th>
                </tr>
            <?php
            $zapytanie1="SELECT id_zadania,zadanie,data FROM `zadania`;";
            $query1=mysqli_query($conn,$zapytanie1);

            $zapytanie2="DELETE FROM `zadania` where id_zadania=2;";
            
            if(isset($_GET['id_zadania']))
            {
                $id=$_GET['id_zadania'];
                $query2=mysqli_query($conn,"DELETE FROM `zadania` where id_zadania=$id;");
            }

            while($row1=mysqli_fetch_assoc($query1))
            {
                echo "<tr>";
                    echo "<td>".$row1['zadanie']."</td>";
                    echo "<td>".$row1['data']."</td>";
                    echo "<td>";
                    echo "<a href=?id_zadania='".$row1['id_zadania']."'>";
                    echo "Usuń";
                    echo "</a>";
                    echo "</td>";
                echo "</tr>";
            }
            ?>
            </table>

            <form action="./przewozy.php" method="post">
                <label>Zadanie do wykonania: <input type="text" name='zadanie'></label>
                <label>Data realizacji: <input type="date" name='data'></label>
                <input type="submit" value="Dodaj">
            </form>
                <?php
                    if(isset($_POST['zadanie'])&&isset($_POST['data']))
                    {
                        $zadanie=$_POST['zadanie'];
                        $data=$_POST['data'];
                        $zapytanie3="INSERT INTO `zadania` (`id_zadania`, `zadanie`, `data`, `osoba_id`) VALUES (NULL, '$zadanie', '$data', '1');";
                        $query3=mysqli_query($conn,$zapytanie3);
                    }
                    mysqli_close($conn);
                ?>
        </article>

        <aside>
            <img src="./auto.png" alt="auto firmowe">
            <h3>Nasza specjalność</h3>
                <ol>
                    <li>Przeprowadzki</li>
                    <li>Przewóz mebli</li>
                    <li>Przesyłi gabarytowe</li>
                    <li>Wynajem pojazdów</li>
                    <li>Zakupy towarów</li>
                </ol>
        </aside>
    </main>

    <footer>
        <p>Stronę wykonał: 0000000000000</p>
    </footer>
</body>
</html>