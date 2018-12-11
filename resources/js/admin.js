
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


//require('./map');

//require('./collection');

//require('./audio');

$(document).ready( function () {
    $('.modal').modal();
    console.log('running admin scripts');
    $('#create_collection_form').hide();

    $('.sidenav').sidenav();

    $(".dropdown-trigger").dropdown();

    // $('#dataTable').DataTable({
    // //paging: false
    // });
             
});