<?php 
session_start();
$sauvegarde = $_SESSION['nomSauvegarde'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/iconeJeu.png" />
    <title>MinimalTD - Technologies</title>
    <div id="style-container"></div>
    <script>
        const dateCSS = new Date().getTime();
        const logiqueCSS = document.createElement('link');
        logiqueCSS.href = '../css/styleTechnologies.css?v=' + dateCSS; // cache buster avec timestamp
        logiqueCSS.rel = 'stylesheet';
        document.getElementById('style-container').appendChild(logiqueCSS);
    </script>
</head>
<body>
    <div id="divBordureJeu"><div id="divContainerJeu">
        <input type="hidden" id="nomSauvegarde" value="<?php echo $sauvegarde; ?>">
        <canvas id="canvasTechno" width="1550px" height="710px"></canvas>
        <h1 id="titrePage">Technologies</h1>
        <div id="divContainerNoeuds">
            <!-- Les noeuds s'ajoutent automatiquement ici -->
        </div>
    
        <div id="divRetourMenuPrincipale" onclick="window.location.href='menuPrincipale.php'"><img src="../assets/img/maison.png"></div>
        <div id="divMonaies" class="flex-column">
            <div id="divTriangles" class="flex-row"><span>0</span><img src="../assets/img/triangle.png"></div>
            <div id="divRonds" class="flex-row"><span>0</span><img src="../assets/img/rond.png"></div>
            <div id="divHexagones" class="flex-row"><span>0</span><img src="../assets/img/hexagone.png"></div>
        </div>
        <div id="divInfoNoeud" class="flex-column cachee">
            <h3 id="titre">-Titre par défaut-</h3>
            <div class="flex-row space-between" style="width: 100%;">
                <span id="lvl">-1/6-</span>
                <span id="prix">-99-</span>
            </div><br>
            <span id="description">-Description par défaut-</span>
        </div>

        <div id="legende">
            <p>Les technologies sont des améliorations permanentes qui vous permettent de vous renforcer.</p>
            <p>Chaque technologie a un coût en ressources et peut être débloquée / améliorée avec un clique gauche, ou vendue avec un clic droit.</p>
            <p>Les ressources sont gagnées en tuant des ennemis dans les niveaux.</p>
            <p class="alignLeft"><img src="../assets/img/pasDebloque.png"> Pas Débloqué</p>
            <p class="alignLeft"><img src="../assets/img/debloque.png"> Débloqué</p>
            <p class="alignLeft"><img src="../assets/img/niveauMax.png"> Niveau maximum</p>
        </div>

    </div></div>

    <div id="script-container"></div>
    <script>
        const date = new Date().getTime();
        const logiqueJS = document.createElement('script');
        logiqueJS.src = '../src/fonctionnementPages/technologies.js?v=' + date; // cache buster avec timestamp
        logiqueJS.type = 'module';
        document.getElementById('script-container').appendChild(logiqueJS);
    </script>
</body>
</html>