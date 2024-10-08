<?php
if(isset($_FILES) && count($_FILES) > 0){
    echo json_encode(['status' => 'success']);
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>

        <input multiple type="file" accept=".pdf"/>

        <button onclick="sendToServer()">Post files to server</button>

        <script>

           async function sendToServer() {
               const files = document.querySelector('input[type="file"]').files;
               const promises = [];
               for (let i = 0; i < files.length; i++) {
                   promises.push(postPromise(files[i]));
               }
               await Promise.all(promises);
               alert('All files uploaded');
           }

            function postPromise(file){
                return new Promise( function(resolve, reject){
                    const fd = new FormData();
                    fd.append('file', file);
                    fd.append('info', `${file.name}`);
                    fetch('savefile', {
                        method: 'POST',
                        body: fd
                    }).then(response => {
						resolve(response);
                    }).catch(error => {
                       reject({
                           status: error.status,
                           statusText: error.statusText
                       });
                   });
               });
           }
       </script>
   </body>
</html>
