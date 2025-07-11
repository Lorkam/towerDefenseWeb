<?php 
session_start();
$sauvegarde = $_SESSION['nomSauvegarde'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../assets/img/iconeJeu.png" />
    <title>MinimalTD - <?php echo $_POST['numNiveau']; ?></title>
    <div id="style-container"></div>
    <script>
        const dateCSS = new Date().getTime();
        const logiqueCSS = document.createElement('link');
        logiqueCSS.href = '../css/style.css?v=' + dateCSS; // cache buster avec timestamp
        logiqueCSS.rel = 'stylesheet';
        document.getElementById('style-container').appendChild(logiqueCSS);
    </script>
</head>
<body>
    <input type="hidden" id="nomSauvegarde" value="<?php echo $sauvegarde; ?>">
    <input type="hidden" id="niveauChoisi" value="<?php echo $_POST['numNiveau']; ?>">
    <div id="divBordureJeu">
    <div id="divContainerJeu">
        <canvas id="gameCanvas" width="1550" height="710"></canvas>
        <div id="divRetourMenuPrincipale" onclick="window.location.href='menuPrincipale.php'"><img src="../assets/img/maison.png"></div>


        <div class="" id="divInfoVague">
          <p>Vague actuelle : <span id="numVague">1</span></p>
          <p>Ennemis restants : <span id="nbEnnemisRestants">0</span></p>
          <p>Ennemis tués : <span id="nbEnnemisMorts">0</span></p>
        </div>
        <div id="divGolds">
          <span id="golds">0</span><img id="imgGolds" src="../assets/img/euro.png" alt="gold">
        </div>

        <div id="divEcranSombre" style="display: none;"></div>
        <div id="divImgVictoire" style="display: none;">
            <img src="../assets/img/victoire.png" alt="victoire">
            <div class="flex-row" style="gap: 10px;">
                <button id="btnRejouerVictoire">Rejouer</button>
                <button class="btnMainMenu" onclick="window.location.href='technologies.php'">Technologies</button>
                <button class="btnMainMenu" onclick="window.location.href='menuPrincipale.php'">Revenir au menu principale</button>
            </div>
        </div>
        <div id="divImgDefaite" style="display: none;">
            <img src="../assets/img/defaite.png" alt="defaite">
            <div class="flex-row" style="gap: 10px;">
                <button id="btnRejouerDefaite">Réessayer</button>
                <button class="btnMainMenu" onclick="window.location.href='technologies.php'">Technologies</button>
                <button class="btnMainMenu" onclick="window.location.href='menuPrincipale.php'">Revenir au menu principale</button>
            </div>
        </div>

        <div id="divOptionsEmplacement"></div>
        <div id="divOptionsTour">
            <span class="optionTour" id="ameliorer">Améliorer : <span id="prixAmelioration" class="no-pointer-envents" style="margin:0 5px;">-0-</span><img class="no-pointer-envents" src="../assets/img/euro.png" style="width:20px;"></span>
            <span class="optionTour" id="vendre">Vendre : <span id="prixVente" class="no-pointer-envents" style="margin:0 5px;">-0-</span><img class="no-pointer-envents" src="../assets/img/euro.png" style="width:20px;"></span>
        </div>



        <button id="lancerVagueBtn">Lancer la Prochaine Vague</button>
        <div id="divConsole"><div id="divHistorique"></div><input type="text" id="inputBarreEcriture"></div>
    </div>
    </div>






    <div id="script-container"></div>
    <script>
        const date = new Date().getTime();
        const logiqueJS = document.createElement('script');
        logiqueJS.src = '../src/partie/lancement.js?v=' + date; // cache buster avec timestamp
        logiqueJS.type = 'module';
        document.getElementById('script-container').appendChild(logiqueJS);
    </script>
</body>
</html>