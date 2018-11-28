/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 *
 *
 */

function changeBackground(){
    preload();
    var src =       document.getElementById("contenedor");
    src.appendChild(images[1]);
    //setInterval(displayNextImage, 4000);
    $( "#contenedor" ).remove( ".delete" );
}
function mostrarRecuperar(){
    $("#forgot").slideToggle();
}
function EnviarPassword(){
    var mail =          document.getElementById('emailRec').value;
    alert (mail);
    return false;
}
function Login(){
    var usuario =          document.getElementById('usuario').value;
    var password =         document.getElementById('password').value;
    $.ajax({ //PERFORM AN AJAX CALL
        type:                   'post',
        url:                    'Resources/WebResponses/Login.php', //PHP CONTAINING ALL THE FUNCTIONS
        data:                   {usuario: usuario, contra: password}, //SEND THE VALUE TO EXECUTE A QUERY WITH THE PALLET ID
        success: function(data) { //IF THE REQUEST ITS SUCCESSFUL
            //alert (data);
            if(data != "Wrong Credentials"){
                //alert (data);
                window.location.href = "Pages/Principal.php";
            }else{
                alert (data);
            }
        }
    });
    return false;
}
