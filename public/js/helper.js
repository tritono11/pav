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
 * flagAddOrRemove = 0 | 1
 */
function fillDdlFromPlunk(idSource, data, flagAddOrRemove){
    var $ddl = $('#t_provincia_nascita');
    if (flagAddOrRemove == 0){
        $ddl.find('option').remove();
    }
    $.each(data, function(key, value) {
        $ddl.append($("<option />").val(key).text(value));
    });
}