
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

$(document).ready( function () {

    $('.modal').modal();
    
    $('.sidenav').sidenav();
    $('select').formSelect();

    $(".dropdown-trigger").dropdown();

    $('#dashboardNavigation').hide();
    $('#toggleNavigation').click( function() {
        $('#dashboardNavigation').toggle();
    });




    // var create_form_btn = $('#create_collection_form').hide();
    // $( "#create-collection" ).click(function() {
    //     create_form_btn.show();
    // });

    // $('#dataTable').DataTable({
    // //paging: false
    // });
             
});