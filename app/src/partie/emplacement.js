import { TourClassique, TourRalentissante, TourExplosive } from "./tower.js";

export class Emplacement {
    constructor(position, partie) {
        this.partie = partie
        this.x = position['x']; // Position X de l'emplacement
        this.y = position['y']; // Position Y de l'emplacement
        this.taille = 30; // Taille de l'emplacement
        this.image = new Image();
        this.image.src = '../assets/img/emplacement2.png';
        this.tour = null; // Tour placée sur cet emplacement (null si aucune)
    }

    dessiner(){
        this.partie.ctx.drawImage(this.image, this.x-25, this.y-25, 50, 50);
    }

    ajouterTour(type){
        switch (type) {
            case 'TourClassique':
                const nouvelleTourClassique = new TourClassique({x:this.x, y:this.y}, this.partie); // Crée une nouvelle tour classique
                if (this.partie.golds >= this.partie.prixTourClassique) { // Vérifie si l'or est suffisant
                    this.tour = nouvelleTourClassique;
                    this.partie.towers.push(this.tour); // Ajoute la tour à la liste des tours
                    const cout = this.partie.prixTourClassique
                    this.partie.prixTourClassique *=2;
                    return -1*cout; // renvoie le coût de la tour
                }else{
                    this.partie.console.ecrire("Pas assez d'or pour acheter cette tour.");
                    return 0; // Retourne 0 si l'or est insuffisant
                }
            case 'TourRalentissante':
                const nouvelleTourRalentissante = new TourRalentissante({x:this.x, y:this.y}, this.partie); // Crée une nouvelle tour Ralentissante
                if (this.partie.golds >= this.partie.prixTourRalentissante) { // Vérifie si l'or est suffisant
                    this.tour = nouvelleTourRalentissante;
                    this.partie.towers.push(this.tour); // Ajoute la tour à la liste des tours
                    const cout = this.partie.prixTourRalentissante
                    this.partie.prixTourRalentissante *=2;
                    return -1*cout; // renvoie le coût de la tour
                }else{
                    this.partie.console.ecrire("Pas assez d'or pour acheter cette tour.");
                    return 0; // Retourne 0 si l'or est insuffisant
                }
            case 'TourExplosive':
                const nouvelleTourExplosive = new TourExplosive({x:this.x, y:this.y}, this.partie); // Crée une nouvelle tour Explosive
                console.log(this.partie.prixTourExplosive);
                if (this.partie.golds >= this.partie.prixTourExplosive) { // Vérifie si l'or est suffisant
                    this.tour = nouvelleTourExplosive;
                    this.partie.towers.push(this.tour); // Ajoute la tour à la liste des tours
                    const cout = this.partie.prixTourExplosive
                    this.partie.prixTourExplosive *=2;
                    return -1*cout; // renvoie le coût de la tour
                }else{
                    this.partie.console.ecrire("Pas assez d'or pour acheter cette tour.");
                    return 0; // Retourne 0 si l'or est insuffisant
                }
            // Ajouter d'autres types de tours ici si nécessaire
            default:
                console.warn("Type de tour inconnu :", type);
                return 0; // Retourne 0 si le type de tour est inconnu
        }
    }

    actionsDuTour() {
        // Vérifie si une tour est déjà placée sur cet emplacement
        if (this.tour) {
            this.tour.dessiner(this.partie.ctx);
            const ennemiProche = this.tour.chercherEnnemi(); // Cherche un ennemi à portée de la tour
            if (ennemiProche) {
                this.tour.tirer(ennemiProche);
            }
            this.tour.majBalles(this.partie.ctx);
        }else{
            // Si aucune tour n'est placée, dessine l'emplacement
            this.dessiner(this.partie.ctx);
        }
    }

    clicEmplacement(mouseEvent){
        if(mouseEvent.which == 1) { // Clic gauche
            this.afficherOptions(); // Affiche les options de la tour si nécessaire
        }
        return;
    }

    afficherOptions() {
        if(!this.tour){
            const divOptionsEmplacement = document.querySelector('#divOptionsEmplacement');
            for(const typeTour of Object.keys(this.partie.statTours)){
                if(this.partie.modificateurs[typeTour] == 0) continue; // Si la tour n'est pas débloquée, on passe à la suivante
                divOptionsEmplacement.querySelector('#prix'+typeTour).textContent = this.lvl >= this.nbLvl ? 'Max' : this.partie['prix'+typeTour]; // Met à jour le prix de la tour classique
            }
            divOptionsEmplacement.style.display = 'flex'; // Masque les options de l'emplacement
            divOptionsEmplacement.style.top = `${this.y - divOptionsEmplacement.offsetHeight*1.2}px`; // Positionne le div au-dessus de l'emplacement
            divOptionsEmplacement.style.left = `${this.x - divOptionsEmplacement.offsetWidth/2}px`; // Positionne le div à gauche de l'emplacement
            this.partie.emplacementSelectionne = this;
        }else{
            const divOptionsTour = document.querySelector('#divOptionsTour');
            divOptionsTour.style.display = 'flex'; // Masque les options de l'emplacement
            divOptionsTour.style.top = `${this.y - divOptionsTour.offsetHeight*1.2}px`; // Positionne le div au-dessus de l'emplacement
            divOptionsTour.style.left = `${this.x - divOptionsTour.offsetWidth/2}px`; // Positionne le div à gauche de l'emplacement
            divOptionsTour.querySelector('#prixAmelioration').textContent = this.tour.prixAmelioration; // Met à jour le prix d'amélioration de la tour classique
            divOptionsTour.querySelector('#prixVente').textContent = this.tour.valeur; // Met à jour la récompense de vente de la tour
            //console.log(this.partie.modificateurs.lvlUpTours, this.tour.lvl);
            if(this.partie.modificateurs.lvlUpTours <= this.tour.lvl){
                divOptionsTour.querySelector('#ameliorer').classList.add('pasDispo'); // Masque l'option de la tour classique si le niveau est insuffisant
                divOptionsTour.querySelector('#ameliorer').title = "Vous n'avez pas débloqué la technologie necessaire : Ingénierie niv "+(this.tour.lvl);
            }else{
                divOptionsTour.querySelector('#ameliorer').classList.remove('pasDispo'); // Affiche l'option de la tour classique si le niveau est suffisant
                divOptionsTour.querySelector('#ameliorer').title = "Améliorer la tour";
            }
            this.partie.emplacementSelectionne = this;
        }
    }
}