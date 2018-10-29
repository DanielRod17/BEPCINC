/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function()
{
    
    $( "#Employee" ).autocomplete({
        source: "../Resources/WebResponses/AutocompleteConsultor.php",
        minLength: 0
    });
    
    $( "#Project" ).autocomplete({
        source: "../Resources/WebResponses/AutocompleteProject.php",
        minLength: 0
    });
    
    $( "#PO" ).autocomplete({
        source: "../Resources/WebResponses/AutocompletePO.php",
        minLength: 0
    });

    $('#Assignment input').on( 'input', function() {
        var alertas = document.getElementById("alertas");
        setTimeout(() => {
            alertas.style.opacity = 0;
        }, 0);
    });

});


function RevisarInfo(){
    var name =          document.getElementById('Name').value;
    var project =       document.getElementById('Project').value;
    var po =            document.getElementById('PO').value;
    var br =            document.getElementById('BR').value;
    var pr =            document.getElementById('PR').value;
    var em =            document.getElementById('Employee').value;
    var info = new Array(name, project, po, br, pr, em);
    $.ajax({ //PERFORM AN AJAX CALL
        type:                   'post', 
        url:                    '../Resources/WebResponses/AssignmentAJAX.php', //PHP CONTAINING ALL THE FUNCTIONS
        data:                   {newAssignment: '1', informacion: info}, //SEND THE VALUE TO EXECUTE A QUERY WITH THE PALLET ID
        success: function(data) { //IF THE REQUEST ITS SUCCESSFUL
            DisplayError(data);
            window.parent.$("body").animate({scrollTop:0}, 'fast');
            if(data === "Assignment Added"){
                document.getElementById('Assignment').reset();
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