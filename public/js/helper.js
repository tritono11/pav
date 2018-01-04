/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/*
 * Template per le chiamate ajax generiche
 */
function execAjax(url, method, data){
    return $.ajax({
        method: method,
        url: url,
        data: data
    })
    .done(function(data) {
        
    })
    .fail(function(error) {
        alert( error);
    })
    .always(function() {
        
    });
}

/*
 * Template valorizza dropdown list
 * idSource - tag id reference
 * data     - JSON list key, value
 * flagAddOrRemove = 0 | 1
 */
function fillDdlFromPlunk(idSource, data, flagAddOrRemove){
    var $ddl = $('#' + idSource);
    if (flagAddOrRemove == 0){
        emptyDdl(idSource);
    }
    $.each(data, function(key, value) {
        $ddl.append($("<option />").val(key).text(value));
    });
}


function emptyDdl(idSource){
    var $ddl = $('#' + idSource);
    $ddl.find('option').remove();
}