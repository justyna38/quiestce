class Partie {
    constructor() {
        this.nombreEssai = 0;
        this.decompteJeu = 8;
    }

    decompte() {
        this.nombreEssai = this.nombreEssai + 1;
        if (this.decompteJeu > 0) {
            this.decompteJeu = this.decompteJeu - 1
        } else {
            this._gameOver();
        }
    }

    _gameOver() {
        alert("Vous avez perdu. Fin de la partie");
    }

    gagne() {
        if (this.nombreEssai < 2) {
            alert("Vous avez gagné en " + this.nombreEssai + " manche");
        } else {
            alert("Vous avez gagné en " + this.nombreEssai + " manches");
        }
    }

}


//Algo
/*

On initialise un objet de type partie
2. a chaque fois que le joueur pose une question, le compteur decremente
3. si le compteur arrive a zero, lance fonction gameover()
4. si le joueur trouve avant, lance fonction gagne()
*/

//Lance la consultation BDD pour avoir la liste des personnes et la personne a trouver
//construit l html pour afficher tous les personnages
//interroge BDD pour avoir la liste des questions
//construit l html pour afficher toutes les questions

const cheminControleurPhp = '../../projet/back/controleur/question.php';
const cheminAjoutPerso='../../projet/front/vue/connexion.php';
const cheminImage = "../upload/";
const divGenerale = document.getElementById('board');
let solution = "";
let partie = new Partie();
let devine = false;

//tant que decompteJeu est superieur a zero on reste dans la boucle

//1.On recupere la liste des personnages en BDD
var requete = new XMLHttpRequest();
requete.onload = function recupereListePersonnages() {
    //La variable à passer est alors contenue dans l'objet response et l'attribut responseText.
    const variableARecuperee = this.responseText;
   
    const listeJeu = JSON.parse(variableARecuperee);
    //On construit des objets personnages
    const persoATrouver = listeJeu.bonneReponse;
    const listePersonnages = listeJeu.personnagesParties;
    const listeQuestions = listeJeu.listeQuestions;
    solution = persoATrouver.prenom;
    joueUnePartie(persoATrouver, listePersonnages, listeQuestions);
}
requete.open("POST", cheminControleurPhp, true);
requete.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
requete.send("initialisation=1");


function ajouteQuestionPlateauJeu(element, valeur) {
    const question = document.getElementById('question');
    const idFille = "question_" + valeur;
    creerUneDiv(question, idFille);
    const maQuestion = document.getElementById(idFille);
     maQuestion.classList.add("questions");
    const spanId = "spanQuestion_" + valeur;
    creerUneSpan(maQuestion, spanId);
    const recupereSpan= document.getElementById(spanId);
    recupereSpan.innerHTML=element.question;
    recupereSpan.value= element.id;
    const selectId = "select_"+valeur;
    creerUnSelect(maQuestion, selectId);
    const monSelect=document.getElementById(selectId);

    var requete = new XMLHttpRequest();
    requete.onload = function recupererReponse() {
        const variableARecuperee = this.responseText;
        const reponses = JSON.parse(variableARecuperee);
        
        for(let i =0; i<reponses.length; i++){
            let recherche= ""
            if(element.question.includes("couleur")){
                let tableauTemp= element.question.split(" ");
                recherche=tableauTemp[tableauTemp.length-1];
            }else{
                recherche=element.question;
               
            }
            
            const idOption=recherche+"_"+valeur+i;
            creerUneOption(monSelect, idOption);
            const monOption = document.getElementById(idOption);
            monOption.innerHTML=reponses[i].reponse;
            monOption.value=reponses[i].reponse;
            monOption.addEventListener('click', envoieReponseBDD, false);
        }
        
    }
    requete.open("POST", cheminControleurPhp, true);
    requete.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    requete.send("reponse="+element.id);
    
    
}

function envoieReponseBDD(){

    const valeurPassee= this;
    
    const reponse=valeurPassee.value;
    const tabTemp=valeurPassee.id.split("_");
    const question=tabTemp[0];
    requete.onload = function reponseUtilisateur() {
        //La variable à passer est alors contenue dans l'objet response et l'attribut responseText.
        const variableARecuperee = this.responseText;
        console.log(variableARecuperee)
        
        
        if (variableARecuperee == 'false[]') {
            //construire la div avec symbole faux
            partie.decompte();
            modifieScore();
            if (document.getElementById("retourQuestion")) {
                //on la detruit
                const divQuestion = document.getElementById("question");
                const aDetruire = document.getElementById("retourQuestion");
                divQuestion.removeChild(aDetruire);
                creerUneDiv(divQuestion, "retourQuestion");
                const i = document.createElement('i');
                i.className = "fa-solid fa-xmark";
                const divRetourQuestion = document.getElementById("retourQuestion");
                divRetourQuestion.appendChild(i);
            } else {
                const divQuestion = document.getElementById("question");
                creerUneDiv(divQuestion, "retourQuestion");
                const i = document.createElement('i');
                i.className = "fa-solid fa-xmark";
                const divRetourQuestion = document.getElementById("retourQuestion");
                divRetourQuestion.appendChild(i);
            }
        } else {
            //construire la div avec symbole true
            partie.decompte();
            modifieScore();
            if (document.getElementById("retourQuestion")) {
                //on la detruit
                const divQuestion = document.getElementById("question");
                const aDetruire = document.getElementById("retourQuestion");
                divQuestion.removeChild(aDetruire);
                creerUneDiv(divQuestion, "retourQuestion");
                const i = document.createElement('i');
                i.className = "fa-solid fa-check";
                const divRetourQuestion = document.getElementById("retourQuestion");
                divRetourQuestion.appendChild(i);
            } else {
                const divQuestion = document.getElementById("question");
                creerUneDiv(divQuestion, "retourQuestion");
                const i = document.createElement('i');
                i.className = "fa-solid fa-check";
                const divRetourQuestion = document.getElementById("retourQuestion");
                divRetourQuestion.appendChild(i);
            }
        }
    }
    requete.open("POST", cheminControleurPhp, true);
    requete.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    requete.send("question=" + question + "&reponse="+ reponse + "&solution=" + solution);
   
}

function ajoutPersonnagePlateauJeu(tableau, valeur) {
    const divTableauDeJeu = document.getElementById("tableauDeJeu");
    const idPersonnage = "personnage_" + valeur;
    creerUneDiv(divTableauDeJeu, idPersonnage)
    const divPersonnage = document.getElementById(idPersonnage);
    divPersonnage.addEventListener('click', cliquePersonnage, false);
    divPersonnage.classList.add("personnage");
    const idPhoto = "photo_" + valeur;
    creerUneDiv(divPersonnage, idPhoto);
    const idPrenom = "prenom_" + valeur;
    creerUneDiv(divPersonnage, idPrenom);
    const divPhoto = document.getElementById(idPhoto);
    const idImage = "image_" + valeur;
    creerPhoto(divPhoto, idImage, tableau.photo);
    const divPrenom = document.getElementById(idPrenom);
    const paragraphe = "paragraphe_" + valeur;
    creerUnP(divPrenom, paragraphe, tableau.prenom);
}

function modifieScore() {
    const spanScore = document.getElementById("afficheScore");
    if (partie.score == 1) {
        spanScore.innerHTML = "Essai restant : " + partie.decompteJeu;
    } else {
        spanScore.innerHTML = "Essais restant : " + partie.decompteJeu;
    }

}

function creerUneDiv(divMere, idFille) {
    var divFille = document.createElement('div');
    divFille.id = idFille;
    divMere.appendChild(divFille);
}

function creerUnSelect(divMere, idFille) {
    var select = document.createElement('select');
    select.id = idFille;
    divMere.appendChild(select);
}

function creerUneOption(selectMere, idFille) {
    var option = document.createElement('option');
    option.id = idFille;
    selectMere.appendChild(option);
}

function creerUneSpan(divMere, idFille) {
    var span = document.createElement('span');
    span.id = idFille;
    divMere.appendChild(span);
}

function creerUnP(divMere, idFille, prenom) {
    var p = document.createElement('p');
    p.id = idFille;
    p.innerHTML = prenom;
    divMere.appendChild(p);
}

function creerBouton(divMere, idFille) {
    var button = document.createElement('button');
    button.id = idFille;
    divMere.appendChild(button);
}

function creerPhoto(divMere, idFille, source) {
    var image = document.createElement('img');
    image.id = idFille;
    image.src = cheminImage + source;
    divMere.appendChild(image)
}

function creerPhotoRetournee(divMere, source) {
    var image = document.createElement('img');
    image.className = "retournee";
    image.src = cheminImage + source;
    divMere.appendChild(image)
}


function joueUnePartie(persoATrouver, listePersonnages, listeQuestions) {
    //1. On construit le plateau de jeu
    const divPerso = "tableauDeJeu";
    const divQuestion = "question";
    const idScore = "score";
    const idAjouter = "ajouter";
    creerUneDiv(divGenerale, divPerso);
    creerUneDiv(divGenerale, divQuestion);
    creerUneDiv(divGenerale, idScore);
    creerUneDiv(divGenerale, idAjouter);
    
    //2.On construit les personnages et on leur met un eventListener
    for (let i = 0; i < listePersonnages.length; i++) {
        ajoutPersonnagePlateauJeu(listePersonnages[i], i + 1)
    }

    //3.On construit les questions et on leur met un eventListener

    for (let i = 0; i < listeQuestions.length; i++) {
        ajouteQuestionPlateauJeu(listeQuestions[i], i + 1);
    }
    const divMereQuestion = document.getElementById("question");
    creerBouton(divMereQuestion, "devine");
    const boutonDevine = document.getElementById("devine");
    boutonDevine.innerHTML = "devine";
    boutonDevine.addEventListener('click', changeDevine, false);
    const divScore = document.getElementById("score");
    creerUneSpan(divScore, "afficheScore")
    modifieScore();
    const divMereAjouter= document.getElementById("ajouter")
    creerBouton(divMereAjouter,"ajouterPerso");
    const boutonAjouter = document.getElementById("ajouterPerso");
    boutonAjouter.innerHTML = "ajouter un personnage";
    boutonAjouter.addEventListener('click', redirigeVersPerso, false);
}

function redirigeVersPerso(){
    window.location.href = cheminAjoutPerso;
    location.href();
}

function changeDevine() {
    const boutonDevine2 = document.getElementById("devine");
    if (!devine) {
        devine = true;
        boutonDevine2.innerHTML = "annuler";

    } else if (devine) {
        devine = false;
        boutonDevine2.innerHTML = "devine";
    }
}

function cliquePersonnage() {
    if (devine) {
        const monId = this.id;
        console.log(monId)
        const monTab = monId.split("_");
        const monNum = monTab[1];
        const idARechercher = "paragraphe_" + monNum;
        console.log(idARechercher)
        const maBalise= document.getElementById(idARechercher);
        if(maBalise.innerHTML===solution){
            
            partie.gagne();
        }else{
            alert("Ce n'est pas la bonne réponse");
        } 
    } else {

        //0. recuperer, la div de photo a modifier
        const tabDeDiv = this.id.split("_");
        const chiffreId = tabDeDiv[1];
        const idImg = "image_" + chiffreId;
        const balisePhoto = document.getElementById(idImg);
        //1. condition
        
        if (balisePhoto.src.includes("croix.png")) {
            const monId = this.id;
            const monTab = monId.split("_");
            const monNum = monTab[1];
            const idARechercher = "paragraphe_" + monNum;
            const monParagraphe = document.getElementById(idARechercher);
            const monPrenom = monParagraphe.innerHTML;

            var requete = new XMLHttpRequest();
            
            requete.onload = function () {
                //La variable à passer est alors contenue dans l'objet response et l'attribut responseText.
                const variableARecuperee = this.responseText;
                console.log(variableARecuperee)
                const photo = JSON.parse(variableARecuperee);
                balisePhoto.src = cheminImage + photo[0].photo;
            }
            requete.open("POST", cheminControleurPhp, true);
            requete.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            requete.send("photo=1&prenom=" + monPrenom);
            

        } else {
            balisePhoto.src = cheminImage + "croix.png";
        }
    }
}