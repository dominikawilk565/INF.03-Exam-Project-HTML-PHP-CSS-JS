<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ankieta</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>

<main> 
    <h2>Proszę o wypełnienie ankiety dotyczącej zajęć z przedmiotu Aplikacje Internetowe.</h2>
    <h3>Wasza opinia ma znaczenie!</h3>

    <form id="odpowiedzi" action="./podsumowanie.php" method="post">

        <label>Którego języka programowania najczęściej używasz do pisania aplikacji internetowych?</label>
        <div id="pytanie1">
            <label><input type="checkbox" name="jezyki[]" value="HTML" class="opcja">HTML</label>
            <label><input type="checkbox" name="jezyki[]" value="CSS" class="opcja">CSS</label>
            <label><input type="checkbox" name="jezyki[]" value="JavaScript" class="opcja">JavaScript</label>
            <label><input type="checkbox" name="jezyki[]" value="Python" class="opcja">Python</label>
            <label><input type="checkbox" name="jezyki[]" value="Java" class="opcja">Java</label>
            <label><input type="checkbox" name="jezyki[]" value="PHP" class="opcja">PHP</label>
            <label><input type="checkbox" name="jezyki[]" value="rodzina_c" class="opcja">Rodzina C (C, C#, C++)</label>
            <label><input type="checkbox" id="nic" name="jezyki[]" value="nic">Żadne z wymienionych</label>
        </div>
    <br>

        <label>Wolisz front-end czy back-end?</label>
        <select name="front_or_back">
            <option value="" selected disabled>--Wybierz--</option>
            <option value="front-end">front-end</option>
            <option value="back-end">back-end</option>
        </select><br>


        <label>Kto cię uczy Aplikacji Internetowych?</label>
        <select name="nauczyciel" id="nauczyciel" onchange="inny(this)">
            <option value="" selected disabled>--Wybierz--</option>
            <option value="Nowak">Nowak</option>
            <option value="Michael">Michael</option>
            <option value="inny">Inny (Wpisz)</option>
        </select>
        <input type="text" name="wpisany" id="wpisany" placeholder="Wpisz nazwisko nauczyciela" style="display:none; margin-top:5px;"><br>

    
        <label>Jak oceniasz przygotowanie prowadzącego do lekcji?</label>
        <div id="ocena_prowadzacego" style="display:flex; gap:10px; margin-top:10px; margin-left:10px;">
            <img src="./bardzo_dobrze.png" alt="bardzo dobrze" data-value="5">
            <img src="./dobrze.png" alt="dobrze" data-value="4">
            <img src="./tak_lo.png" alt="średnio" data-value="3">
            <img src="./słabo.png" alt="słabo" data-value="2">
            <img src="./bardzo_źle.png" alt="bardzo źle" data-value="1">
        </div>
        <input type="hidden" name="ocena" id="ocena"><br>


        <label for="ciekawostka">Najciekawsza rzecz, jakiej się dowiedziałeś/aś?</label>
        <textarea name="ciekawostka" id="ciekawostka" cols="50" rows="4"></textarea><br>

        <label for="jezyk">Jakiego języka używa prowadzący?</label>
        <select name="jezyk" id="jezyk">
            <option selected disabled>--Wybierz styl języka--</option>
            <option value="zrozumiałego">zrozumiałego</option>
            <option value="trochę-niezrozumiały">trochę niezrozumiały</option>
            <option value="nie">nie zrozumiałego</option>
        </select><br>

        <label>Czy stopień trudności zadań jest dobierany do ucznia?</label>
        <label><input type="radio" name="trudnosc" value="Tak">Tak</label>
        <label><input type="radio" name="trudnosc" value="Nie">Nie</label><br>

        <label>Czy tempo pracy jest dostosowane do ucznia?</label>
        <select name="stopien">
            <option selected disabled>--Wybierz dostosowanie tempa--</option>
            <option value="dostosowywany">Tak</option>
            <option value="nie-zawsze">Nie zawsze</option>
            <option value="niedostosowywany">Nie</option>
        </select><br>

        <label>Jak oceniasz materiały dydaktyczne?</label>
        <div id="materialy" style="display:flex; gap:10px; margin-top:10px; margin-left:10px;">
            <img src="./bardzo_dobrze.png" data-value="5">
            <img src="./dobrze.png" data-value="4">
            <img src="./tak_lo.png" data-value="3">
            <img src="./słabo.png" data-value="2">
            <img src="./bardzo_źle.png" data-value="1">
        </div>
        <input type="hidden" name="materialy1" id="materialy1"><br>

        <label>Jak często korzystasz z materiałów omawianych na zajęciach przy własnych projektach?</label>
        <select name="czas">
            <option selected disabled>--Wybierz częstotliwość--</option>
            <option value="Czesto">Często</option>
            <option value="Rzadko">Rzadko</option>
            <option value="prawie-nigdy">Prawie-nigdy</option>
            <option value="Nigdy">Nigdy</option>
            <option value="sprawdzian">Tylko na sprawdzian</option>
        </select><br>

        <label>Czy masz możliwość zadawania pytań?</label>
        <label><input type="radio" name="pytania" value="Tak">Tak</label>
        <label><input type="radio" name="pytania" value="Nie">Nie</label><br>

        <div id="unikalne" style="display:none;">
            <label>Czy na zadane pytanie otrzymujesz wyczerpującą odpowiedź?</label>
            <label><input type="radio" name="pytania1" value="Tak">Tak</label>
            <label><input type="radio" name="pytania1" value="Nie">Nie</label>
        </div><br>


        <label>Czy masz możliwość otrzymywania dodatkowych zadań?</label>
        <label><input type="radio" name="zadania" value="Tak">Tak</label>
        <label><input type="radio" name="zadania" value="Nie">Nie</label><br>


        <label>Czy planujesz wykorzystać zdobytą wiedzę w przyszłości?</label>
        <label><input type="radio" name="urzycie" value="Tak">Tak</label>
        <label><input type="radio" name="urzycie" value="Nie">Nie</label>
        <label><input type="radio" name="urzycie" value="Nie-wiem">Nie wiem</label><br>

        <div id="wiedza" style="display:none;">
            <label>Jak często planujesz wykorzystywać tę wiedzę?</label>
            <select name="useful">
                <option selected disabled>--Wybierz częstotliwość--</option>
                <option value="Often">Często</option>
                <option value="Rarely">Rzadko</option>
                <option value="occasionally">Prawie-nigdy</option>
                <option value="Never">Nigdy</option>
                <option value="use">Kiedy będę potrzebował/ła</option>
            </select>
        </div><br>

        <label>Co prowadzący może zmienić?</label>
        <textarea name="zmiana" cols="50" rows="4"></textarea><br>

        <label>Który rok się uczysz Aplikacji Internetowych?</label>
        <input type="number" name="lata" min="1" max="5" required><br>

        <label>Płeć:</label>
        <label><input type="radio" name="plec" value="k" required>Kobieta</label>
        <label><input type="radio" name="plec" value="m" required>Mężczyzna</label>
        <label><input type="radio" name="plec" value="inne" required>Wolę nie podawać</label><br>

        <label>Wybierz poziom zaawansowania:</label>
        <select name="zaawansowanie" required>
            <option disabled selected>--Poziom zaawansowania--</option>
            <option>Początkujący</option>
            <option>średniozaawansowany</option>
            <option>zaawansowany</option>
        </select><br>

        <br><br>
        <button type="submit" id="przycisk">Przejdź do podsumowania ankiety</button>
    </form>
</main>

<script src="skrypt.js" defer></script>
</body>
</html>