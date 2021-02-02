$(document).ready(function() {

    $(document).on('change', '.custom-file-input', function () {
        let fileName = $(this).val().replace(/\\/g, '/').replace(/.*\//, '');
        $(this).parent('.custom-file').find('.custom-file-label').text(fileName);
    });

    $('body').on('click', '.file-select-button', function(){
        $(this).closest('.upload-image-strip').find('input').click();
    });
    
    $('body').on('change', '.upload-image-strip input', function (e) {
        let filename = e.target.value.split('\\').pop();
        let nf = $(this).closest('.upload-image-strip').find('.name-file');
    
        if (filename.length > 12) {
            let extension = filename.split('.').pop();
            let truncate = filename.substr(0, 12) + '... .' + extension;
    
            nf.text(truncate);
        } else if(filename.length > 0) {
            nf.text(filename);
        }
    });

    // On va écouter le clic
    $("[data-delete]").on('click', function(e){
         // On empêche la navigation
         e.preventDefault();

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
                    $(this).closest('div').remove();
                else
                    alert(data.error)
            }).catch(e => alert(e))
         }
    });
});