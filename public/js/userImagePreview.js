 var flag; //Variable auxiliar que nos ayuda a saber si hay una imagen cargada en la vista previa o no
 function readFile(input) {
     var previewZone = document.getElementById('file-preview-zone');

     //Sí no se selecciona imagen y ya hay una cargada en la vista previa la quitamos
     if (input.files.length == 0 && flag == true) {
         previewZone.removeChild(previewZone.firstChild);
         flag = false; //Indicamos que ya no hay imagen en la vista previa
     }

     if (input.files && input.files[0]) {
         var reader = new FileReader();
         reader.onload = function (e) {
             var filePreview = document.createElement('img');

             filePreview.id = 'file-preview';
             filePreview.src = e.target.result;
             filePreview.classList.add('imagePreview');

             //Sí se selecciona otra imagen y ya hay una en la vista previa la quitamos para poder poner la nueva
             if (flag == true) {
                 previewZone.removeChild(previewZone.firstChild);
             }

             previewZone.appendChild(filePreview);
             flag = true; //Indicamos que hay una imagen cargada en la vista previa
         }

         reader.readAsDataURL(input.files[0]);
     }
 } //Fin de readFile
