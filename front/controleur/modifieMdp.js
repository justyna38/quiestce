const motDePasse1= document.getElementById("mdpSaisi");
const motDePasse2= document.getElementById("mdpValide");
const bouton= document.getElementById("boutonMdp");

bouton.addEventListener("click", verifieMotDePasse);

function verifieMotDePasse(){
    if (motDePasse1.value===motDePasse2.value){
        if(motDePasse1.value ==''){
            alert('vous devez saisir un mot de passe');
        }else{
            const URL= "../../back/controleur/modifieMdpAdmin.php";
            const login= document.getElementById("login").value;
            var requete = new XMLHttpRequest();
            requete.onload = function () {
                const variableARecuperee = this.responseText;
                console.log(variableARecuperee);
                if(variableARecuperee==true || variableARecuperee=='1'){
                    const url = "../vue/connexion.php" + "?erreur=Mot de passe modifié";
                    document.location.href = (url);
                }else{
                    alert('probleme de connexion. Merci de contacter votre administrateur système');
                }
            }
            requete.open("POST", URL, true);
            requete.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            requete.send("login=" + login + "&password=" + motDePasse1.value);
        }
        
    }
    else{
        alert("les mots de passe saisis ne correspondent pas");
    }
}