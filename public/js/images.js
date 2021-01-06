window.onload = () => {
    // Gestion du bouton "supprimer"
    let links = document.querySelector("[data-delete]")
   
   
    // On va écouter le clic
    links.addEventListener("click", function(e){
         // On empêche la navigation
         e.preventDefault()

         // On demande confirmation
         if(confirm("voulez-vous supprimer cette image ?")){
            // On envoie une requête Ajax vers le href du lien avec la méthode DELETE
            fetch(this.getAttribute("href"), {
               method: "DELETE", 
               header: {
                    "X-Requested-With": "XMLHttpRequest",
                    "Content-Type": "application/json"
               },
               body: JSON.stringify({"_token": this.dataset.token})
            }).then(
                // On récupère la réponse en JSON
                response => response.json()
            ).then(data => {
                if(data.success)
                    this.parentElement.remove()
                else
                    alert(data.error)
            }).catch(e => alert(e))
         }
    })
}