/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function($) {
    console.log( "ready - user!" );
    $('.roles-checkbox').change(function(e){
        var elId = $(this).attr('id'); // split "_"
        elId = elId.split("_")[0];
        if ($(this).is(':checked')) {
            $(this).attr('value', 'Y');
            $('#' + elId).val('Y');
        } else {
            $(this).attr('value', 'N');
            $('#' + elId).val('N');
        }
    });
    // Init
    init();
});

function init(){};