/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var row = "";
$(document).ready(function()
{
    $('#timeForms input').on( 'input', function() {
        var alertas = document.getElementById("alertas");
        setTimeout(() => {
            alertas.style.opacity = 0;
        }, 0);
    });
    ////////
    window.onclick = function(event) {
        var modal =     document.getElementById("modal");
        if (event.target === modal) {
            hideProjects();
        }
    }

    ////////
    $( ".project" ).autocomplete({
        source: "../Resources/WebResponses/AutocompleteProjectUser.php",
        minLength: 0
    });

    $('#Assignment input').on( 'input', function() {
        var alertas = document.getElementById("alertas");
        setTimeout(() => {
            alertas.style.opacity = 0;
        }, 0);
    });

    $( ".hourDay" ).change(function() {
        //alert( "jejillo" );
        var total =         0;
        var i =             0;
        $(this).closest('tr').find("input").each(function() {
            //alert(this.value);
            if(i > 0 && i < 9){
                total = +total + +this.value;
            }
            i++;
        });
        //alert(total);
        $(this).closest('tr').find('.sum')[0].innerHTML = total;
    });
});

function nuevoExpense(){
    var w =         "AddExpense.php";
    var frame = $('#load', window.parent.document);
    frame.fadeOut(500, function () {
        frame.attr('src', w);
        frame.fadeIn(500);
    });
}

function DisplayError(e){
    var alertas = document.getElementById("alertas");
    alertas.innerHTML = "";
    alertas.innerHTML = e;
    setTimeout(() => {
        alertas.style.opacity = 1;
    }, 0);

    setTimeout(() => {
        alertas.style.opacity = 0;
    }, 3000);
}

function AssignExpense(){
    var formData =      new FormData();
    var Form =          document.getElementById('formExpenses');
    var childs =        Form.elements;
    for(I = 0; I < childs.length - 2; I++) {
        var Value =       childs[I].value;
        var Idi =         childs[I].id;
        formData.append(Idi, Value);
    }
    for (var i = 0, len = document.getElementById('Attachments').files.length; i < len; i++) {
            formData.append("file" + i, document.getElementById('Attachments').files[i]);
    }
    $.ajax({
        type:                 'post',
        cache:                false,
        contentType:          false,
        processData:          false,
        url:                  '../Resources/WebResponses/ExpensesAJAX.php',
        data:                 formData,
        success:              function(data){
            DisplayError(data);
            if(data === "Expense Added Successfully"){
                document.getElementById("formExpenses").reset();
            }
        }
    });
    return false;
}

function viewExpense(e){
    alert(e);
}
