/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function($) {
    console.log( "ready - profilo!" );
    $('#t_regione_nascita').change(function(e){
        var url = $(this).data('url');
        var val = e.target.value;
        var ajaxProvince = execAjax(url + val, 'GET',{});
        ajaxProvince.done(function(data) {
            fillDdlFromPlunk('t_provincia_nascita', data, 0);
        })
    });
        
});