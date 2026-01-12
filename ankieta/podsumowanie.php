<link rel="stylesheet" href="./style.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<main class="summary">
<?php
$server = 'localhost';
$user = 'root';
$password = '';
$db_name = 'ankieta';

$conn = mysqli_connect($server, $user, $password, $db_name);
if (!$conn) {
    die("Błąd połączenia z bazą: " . mysqli_connect_error());
}


$rok = $_POST['lata'] ?? null;
$plec = $_POST['plec'] ?? 'inne';
$zaawansowanie = $_POST['zaawansowanie'] ?? 'Początkujący';
if (empty($zaawansowanie)) {
    die("Nie wybrano poziomu zaawansowania!");
}


$query1 = mysqli_prepare($conn, "INSERT INTO uzytkownicy (plec, zaawansowanie, rok) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($query1, "ssi", $plec, $zaawansowanie, $rok);
mysqli_stmt_execute($query1);
$id_uzytkownika = mysqli_insert_id($conn);
mysqli_stmt_close($query1);


$jezyki = isset($_POST['jezyki']) ? json_encode($_POST['jezyki'], JSON_UNESCAPED_UNICODE) : null;
$front_or_back = $_POST['front_or_back'] ?? null;
$nauczyciel = ($_POST['nauczyciel'] ?? null) === 'inny' ? ($_POST['wpisany'] ?? null) : ($_POST['nauczyciel'] ?? null);
$ocena = $_POST['ocena'] ?? null;
$ciekawostka = $_POST['ciekawostka'] ?? null;
$jezyk = $_POST['jezyk'] ?? null;
$trudnosc = $_POST['trudnosc'] ?? null;
$stopien = $_POST['stopien'] ?? null;
$materialy1 = $_POST['materialy1'] ?? null;
$czas = $_POST['czas'] ?? null;
$pytania = $_POST['pytania'] ?? null;
$pytania1 = ($pytania === 'Tak') ? ($_POST['pytania1'] ?? null) : null; // constraint obsługiwany
$zadania = $_POST['zadania'] ?? null;
$urzycie = $_POST['urzycie'] ?? null;
$useful = ($urzycie === 'Tak') ? ($_POST['useful'] ?? null) : null;
$zmiana = $_POST['zmiana'] ?? null;


$query2 = mysqli_prepare($conn, "INSERT INTO odpowiedzi 
(id_wypelniajacego, jezyki, front_or_back, nauczyciel, ocena, ciekawostka, jezyk_prow, trudnosc, tempo, materialy, czestosc, pytania, pytania_wyczerp, zadania, urzycie, czestosc_urzycia, zmiana)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");


mysqli_stmt_bind_param($query2, "issssssssssssssss", 
    $id_uzytkownika, $jezyki, $front_or_back, $nauczyciel, $ocena, $ciekawostka, $jezyk, $trudnosc, $stopien, $materialy1, $czas, $pytania, $pytania1, $zadania, $urzycie, $useful, $zmiana);

mysqli_stmt_execute($query2);
mysqli_stmt_close($query2);


echo "<h2>Dziękuję za wypełnienie ankiety!</h2>";

$wypelnienie = "SELECT COUNT(id_wypelniajacego) AS liczba FROM `odpowiedzi`;";
$wynik_wypelnienia = mysqli_query($conn, $wypelnienie);
if ($wynik_wypelnienia) {
    $row = mysqli_fetch_assoc($wynik_wypelnienia);
    echo "Liczba osób, które wypełniły ankietę: " . $row['liczba'];
} else {
    echo "Błąd przy liczeniu wypełnień: " . mysqli_error($conn);
}

echo "<br>Statystyki z poprzednich ankiet: <br>";

$plec_odp="SELECT plec, COUNT(*) AS ilosc FROM uzytkownicy GROUP BY plec;";
$policz_plec=mysqli_query($conn,$plec_odp);
$plcie = [
    "k" => "Kobiety",
    "m" => "Mężczyźni",
    "inne" => "Inne / Nie podano"
];
$podpis=[];
$wysokosc_slupka= [];

while ($row1 = mysqli_fetch_assoc($policz_plec)) {
    $podpis[]= $plcie[$row1['plec']];
    $wysokosc_slupka[]= $row1['ilosc'];
}
echo "<h3>Płeć: </h3><br>";
echo "<div class='wykres-plec'>
    <canvas id='plec'></canvas>
</div>";

$zaawansowanie_odp="SELECT zaawansowanie, COUNT(*) AS ilosc1 FROM uzytkownicy GROUP BY zaawansowanie;";
$policz_zaawansowanie=mysqli_query($conn,$zaawansowanie_odp);
$podpis1=[];
$wysokosc_slupka1= [];
while ($row2 = mysqli_fetch_assoc($policz_zaawansowanie)) {
    $podpis1[]= $row2['zaawansowanie'];
    $wysokosc_slupka1[]= $row2['ilosc1'];
}
echo "<h3>Zaawansowanie osób wypełniających ankietę: </h3><br>";
echo "<div class='wykres-zaw'>
    <canvas id='zaw'></canvas>
</div>";

$result = mysqli_query($conn, "SELECT jezyki FROM odpowiedzi");

$policz_jezyki = [
    'HTML' => 0,
    'CSS' => 0,
    'JavaScript' => 0,
    'Python' => 0,
    'Java' => 0,
    'PHP' => 0,
    'Rodzina C' => 0,
    'Żadne' => 0
];

while ($row3 = mysqli_fetch_assoc($result)) {
    if ($row3['jezyki']) {
        $jezyki1 = json_decode($row3['jezyki'], true);
        foreach ($jezyki1 as $j) {
            switch($j) {
                case 'HTML': $policz_jezyki['HTML']++; break;
                case 'CSS': $policz_jezyki['CSS']++; break;
                case 'JavaScript': $policz_jezyki['JavaScript']++; break;
                case 'Python': $policz_jezyki['Python']++; break;
                case 'Java': $policz_jezyki['Java']++; break;
                case 'PHP': $policz_jezyki['PHP']++; break;
                case 'rodzina_c': $policz_jezyki['Rodzina C']++; break;
                case 'nic': $policz_jezyki['Żadne']++; break;
            }
        }
    }
}
echo "<h3>Ile osób programuje w danym języku: </h3><br>";
echo "<div class='jez-prog'>
    <canvas id='prog'></canvas>
</div>";

$pytanie="SELECT front_or_back,count(*) as odpowiedz FROM `odpowiedzi` GROUP BY front_or_back;";
$policz_front_back = [
    'front-end' => 0,
    'back-end' => 0,
    'brak' => 0
];
$pytanie2=mysqli_query($conn,$pytanie);
while ($row4 = mysqli_fetch_assoc($pytanie2)) {
    switch($row4['front_or_back']) {
        case 'front-end':
            $policz_front_back['front-end'] = (int)$row4['odpowiedz'];
            break;
        case 'back-end':
            $policz_front_back['back-end'] = (int)$row4['odpowiedz'];
            break;
        default:
            $policz_front_back['brak'] = (int)$row4['odpowiedz'];
            break;
    }
}

echo "<h3>Preferencje front-end / back-end: </h3><br>";
echo "<div class='front-back'>
        <canvas id='frontBack'></canvas>
      </div>";

$nauczyciele_query = "SELECT nauczyciel, COUNT(*) AS ilosc
                      FROM odpowiedzi
                      GROUP BY nauczyciel
                      ORDER BY ilosc DESC";

$result_nauczyciele = mysqli_query($conn, $nauczyciele_query);

$nauczyciele_labels = [];
$nauczyciele_data = [];
$lista_wpisanych = [];

while ($row = mysqli_fetch_assoc($result_nauczyciele)) {

    $label = $row['nauczyciel'] === 'inny' ? 'Wpisany przez Ciebie' : $row['nauczyciel'];
    $nauczyciele_labels[] = $label;
    $nauczyciele_data[] = (int)$row['ilosc'];


    if ($row['nauczyciel'] === 'inny') {

        $lista_wpisanych[$label][] = $_POST['wpisany'] ?? '';
    }
}


echo "<h3>Kto Cię uczy: </h3><br>";
echo "<div class='wykres-nauczyciel' style='width:50%; float:left;'><canvas id='nauczycielChart'></canvas></div>";

echo "<div class='lista-nauczycieli' ><ul>";
foreach ($lista_wpisanych as $nauczyciel => $wpisani) {
    echo "<li><strong>$nauczyciel:</strong> " . implode(', ', array_filter($wpisani)) . "</li>";
}
echo "</ul></div>";
echo "<div style='clear:both;'></div>";

$tempo_query = "SELECT tempo, COUNT(*) AS ilosc FROM odpowiedzi GROUP BY tempo";
$result_tempo = mysqli_query($conn, $tempo_query);

$podpis2 = [];
$dane = [];

while ($row5 = mysqli_fetch_assoc($result_tempo)) {
    $podpis2[] = $row5['tempo'];
    $dane[] = (int)$row5['ilosc'];
}
echo "<br><h3>Tempo nauczyciela: </h3>";
echo "<div class='tempo'>
        <canvas id='tempo'></canvas>
      </div>";


$stopien_query = "SELECT trudnosc,count(*) as ilosc FROM `odpowiedzi` GROUP BY trudnosc;";
$result_stopien = mysqli_query($conn, $stopien_query);

$podpis3 = [];
$dane1 = [];

while ($row6 = mysqli_fetch_assoc($result_stopien)) {
    $label = $row6['trudnosc'] ?: 'Nie podano';
    $podpis3[] = $label;
    $dane1[] = (int)$row6['ilosc'];
};
echo "<br><h3>Czy stopień trudności zadań jest dobierany do ucznia? </h3>";
echo "<div class='stopien'>
        <canvas id='stopien'></canvas>
      </div>";


$ocena_query = "SELECT ocena, COUNT(*) AS ilosc FROM odpowiedzi GROUP BY ocena ORDER BY ocena ASC";
$result_ocena = mysqli_query($conn, $ocena_query);

$podpis4 = [];
$dane2 = [];

for ($i = 0; $i <= 5; $i++) {
    $podpis4[] = (string)$i;
    $dane2[$i] = 0; 
}

while ($row7 = mysqli_fetch_assoc($result_ocena)) {
    $ocena = (int)$row7['ocena'];
    $dane2[$ocena] = (int)$row7['ilosc'];
}

echo "<br><h3> Jak oceniasz przygotowanie prowadzącego do lekcji?</h3>";
echo "<div class='ocena-nauczyciel'>
        <canvas id='nauczyciel'></canvas>
      </div>";
 
      
$materialy_query = "SELECT materialy, COUNT(*) AS ilosc FROM odpowiedzi GROUP BY materialy ORDER BY materialy ASC";
$result_materialy = mysqli_query($conn, $materialy_query);

$podpis5 = [];
$dane3 = [];


for ($i = 0; $i <= 5; $i++) {
    $podpis5[] = (string)$i;
    $dane3[$i] = 0;
}

while ($row8 = mysqli_fetch_assoc($result_materialy)) {
    $ocena_materialy = (int)$row8['materialy'];
    $dane3[$ocena_materialy] = (int)$row8['ilosc'];
}

echo "<br><h3> Jak oceniasz materiały dydaktyczne?</h3>";
echo "<div class='ocena-materialy'>
        <canvas id='materialy'></canvas>
      </div>";

$query_ciekawostki = "SELECT ciekawostka FROM odpowiedzi WHERE ciekawostka IS NOT NULL AND ciekawostka != '' ORDER BY RAND() LIMIT 4";
$result_ciekawostki = mysqli_query($conn, $query_ciekawostki);


$kolory = ['#FF6B6B', '#4ECDC4', '#FFD93D', '#6A4C93'];

echo "<h3>Najciekawsze rzeczy, jakie dowiedzieli się uczestnicy:</h3>";
echo "<div style='display:flex; gap:15px; flex-wrap:wrap;'>";

$i = 0;
while ($row = mysqli_fetch_assoc($result_ciekawostki)) {
    $kolor = $kolory[$i % count($kolory)];
    echo "<div style='flex:1 1 200px; background-color: $kolor; color:#fff; padding:15px; border-radius:10px; box-shadow: 2px 2px 8px rgba(0,0,0,0.2);'>
            " . htmlspecialchars($row['ciekawostka']) . "
          </div>";
    $i++;
}

echo "</div>";

$query_zmiany = "SELECT zmiana FROM odpowiedzi WHERE zmiana IS NOT NULL AND zmiana != '' ORDER BY RAND() LIMIT 4";
$result_zmiany = mysqli_query($conn, $query_zmiany);


$kolory = ['#FF6B6B', '#4ECDC4', '#FFD93D', '#6A4C93'];

echo "<h3>Co prowadzący może zmienić:</h3>";
echo "<div style='display:flex; gap:15px; flex-wrap:wrap;'>";

$i = 0;
while ($row = mysqli_fetch_assoc($result_zmiany)) {
    $kolor = $kolory[$i % count($kolory)];
    echo "<div style='flex:1 1 200px; background-color: $kolor; color:#fff; padding:15px; border-radius:10px; box-shadow: 2px 2px 8px rgba(0,0,0,0.2);'>
            " . htmlspecialchars($row['zmiana']) . "
          </div>";
    $i++;
}

echo "</div>";

mysqli_close($conn);
?>
</main>



<script>
        let podpis=<?php echo json_encode($podpis);?>;
    let wysokosc=<?php echo json_encode($wysokosc_slupka);?>;

new Chart(document.getElementById('plec'), {
    type: 'bar',
    data: {
        labels: podpis,
        datasets: [{
            data: wysokosc,
            backgroundColor: [
                'rgba(153, 102, 255, 0.7)', 
                'rgba(255, 159, 64, 0.7)', 
                'rgba(75, 192, 192, 0.7)'  
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        },
        scales: {
            x: {
                ticks: { color: '#ffffff' },
                grid: { color: 'rgba(255,255,255,0.3)' } 
            },
            y: {
                beginAtZero: true,                
                ticks: { color: '#ffffff' },     
                grid: { color: 'rgba(255,255,255,0.3)' } 
            }
        }
    }
});

    let podpis1=<?php echo json_encode($podpis1);?>;
    let wysokosc1=<?php echo json_encode($wysokosc_slupka1);?>;

new Chart(document.getElementById('zaw'), {
    type: 'bar',
    data: {
        labels: podpis1,
        datasets: [{
            data: wysokosc1,
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235,1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        },
        scales: {
            x: {
                ticks: { color: '#ffffff' },    
                grid: { color: 'rgba(255,255,255,0.3)' } 
            },
            y: {
                beginAtZero: true,                
                ticks: { color: '#ffffff' },     
                grid: { color: 'rgba(255,255,255,0.3)' } 
            }
        }
    }
});

let podpis2 = <?php echo json_encode(array_keys($policz_jezyki)); ?>;
let wysokosc2 = <?php echo json_encode(array_values($policz_jezyki)); ?>;
let jezykiKolory = [
    'rgba(255, 99, 132, 0.7)',   
    'rgba(54, 162, 235, 0.7)',   
    'rgba(255, 206, 86, 0.7)',   
    'rgba(75, 192, 192, 0.7)',   
    'rgba(153, 102, 255, 0.7)',  
    'rgba(255, 159, 64, 0.7)',   
    'rgba(201, 203, 207, 0.7)',  
    'rgba(128, 128, 128, 0.7)'   
];
new Chart(document.getElementById('prog'), {
    type: 'bar',
    data: {
        labels: podpis2,
        datasets: [{
            data: wysokosc2,
            backgroundColor: jezykiKolory,
            borderWidth: 1
        }]
    },
    options: {
         responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        },
        scales: {
            x: { ticks: { color: '#ffffff' }, grid: { color: 'rgba(255,255,255,0.2)' } },
            y: { beginAtZero: true, ticks: { color: '#ffffff' }, grid: { color: 'rgba(255,255,255,0.2)' } }
        }
    }
});
let podpis3 = <?php echo json_encode(array_keys($policz_front_back)); ?>;
let wysokosc3 = <?php echo json_encode(array_values($policz_front_back)); ?>;

new Chart(document.getElementById('frontBack'), {
    type: 'doughnut',
    data: {
        labels: podpis3,
        datasets: [{
            data: wysokosc3,
            backgroundColor: [
                'rgb(54, 162, 235)',
                'rgb(75, 192, 192)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1
        }]
    },
options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,       // włącz legendę
                position: 'right',   // po prawej stronie
                labels: {
                    color: '#ffffff', // kolor czcionki legendy
                    font: {
                        size: 14
                    }
                }
            }
        }
    }
});
let podpis4 = <?php echo json_encode($nauczyciele_labels); ?>;
let wysokosc4 = <?php echo json_encode($nauczyciele_data); ?>;

new Chart(document.getElementById('nauczycielChart'), {
    type: 'bar',
    data: {
        labels: podpis4,
        datasets: [{
            data: wysokosc4,
            backgroundColor: podpis4.map(label => 
                label === 'Wpisany przez Ciebie' ? 'rgba(255, 159, 64, 0.8)' : 'rgba(153, 102, 255, 0.7)'
            ),
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: { ticks: { color: '#ffffff' }, grid: { color: 'rgba(255,255,255,0.2)' } },
            y: { beginAtZero: true, ticks: { color: '#ffffff' }, grid: { color: 'rgba(255,255,255,0.2)' } }
        }
    }
});

let podpis5 = <?php echo json_encode($podpis2); ?>;
let wysokosc5 = <?php echo json_encode($dane); ?>;

new Chart(document.getElementById('tempo'), {
    type: 'bar',
    data: {
        labels: podpis5,
        datasets: [{
            data: wysokosc5,
            backgroundColor: 'rgba(255, 159, 64, 0.7)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: { ticks: { color: '#ffffff' }, grid: { color: 'rgba(255,255,255,0.2)' } },
            y: { beginAtZero: true, ticks: { color: '#ffffff' }, grid: { color: 'rgba(255,255,255,0.2)' } }
        }
    }
});
let podpis6 = <?php echo json_encode($podpis3, JSON_HEX_TAG); ?>;
let wysokosc6 = <?php echo json_encode($dane1); ?>;

new Chart(document.getElementById('stopien'), {
    type: 'doughnut',
    data: {
        labels: podpis6,
        datasets: [{
            data: wysokosc6,
            backgroundColor: [
                'rgb(54, 162, 235)',
                'rgb(75, 192, 192)',
                'rgb(201, 203, 207)' // dodaj tyle kolorów, ile masz etykiet
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'right',
                labels: { color: '#ffffff', font: { size: 14 } }
            }
        }
    }
});

let podpis7 = <?php echo json_encode($podpis4); ?>;
let wysokosc7 = <?php echo json_encode(array_values($dane2)); ?>;

new Chart(document.getElementById('nauczyciel'), {
    type: 'bar',
    data: {
        labels: podpis7,
        datasets: [{
            data: wysokosc7,
            backgroundColor: 'rgba(75, 192, 192, 0.7)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: { ticks: { color: '#fff' }, grid: { color: 'rgba(255, 255, 255, 0.1)' } },
            y: { beginAtZero: true, ticks: { color: '#ffffffff' }, grid: { color: 'rgba(255,255,255,0.1)' } }
        }
    }
});

let podpis8 = <?php echo json_encode($podpis5); ?>;
let wysokosc8 = <?php echo json_encode(array_values($dane3)); ?>;

new Chart(document.getElementById('materialy'), {
    type: 'bar',
    data: {
        labels: podpis8,
        datasets: [{
            data: wysokosc8,
            backgroundColor: 'rgba(75, 192, 192, 0.7)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: { ticks: { color: '#fff' }, grid: { color: 'rgba(255, 255, 255, 0.1)' } },
            y: { beginAtZero: true, ticks: { color: '#ffffffff' }, grid: { color: 'rgba(255, 255, 255, 0.1)' } }
        }
    }
});
</script>