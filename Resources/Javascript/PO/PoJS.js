/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function()
{
    /*$( "#SnChange" ).autocomplete({
        source: "../Resources/WebResponses/Autocomplete.php",
        minLength: 0
    });*/
    $('#PO input').on( 'input', function() {
        var alertas = document.getElementById("alertas");
        setTimeout(() => {
            alertas.style.opacity = 0;
        }, 0); 
    }); 
});


function RevisarInfo(){
    var number =      document.getElementById('Number').value;
    var ammount =     document.getElementById('Ammount').value;
    var info = new Array(number, ammount);
    $.ajax({ //PERFORM AN AJAX CALL
        type:                   'post', 
        url:                    '../Resources/WebResponses/PoAJAX.php', //PHP CONTAINING ALL THE FUNCTIONS
        data:                   {newPO: '1', informacion: info}, //SEND THE VALUE TO EXECUTE A QUERY WITH THE PALLET ID
        success: function(data) { //IF THE REQUEST ITS SUCCESSFUL
            DisplayError(data);
            window.parent.$("body").animate({scrollTop:0}, 'fast');
            if(data === "PO Added"){
                document.getElementById('PO').reset();
            }
        }
    });
    return false;
}

function DisplayError(e){
    var alertas = document.getElementById("alertas");
    alertas.innerHTML = "";
    alertas.innerHTML = e;
    setTimeout(() => {
        alertas.style.opacity = 1;
    }, 0);   
}

function EnableStates(e){
    if(e == "US"){
        document.getElementById('State').disabled = false;
    }else{
        document.getElementById('State').disabled = true;
    }
}

