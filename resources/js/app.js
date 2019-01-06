
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 */

require('./bootstrap');


$(document).ready( function () {

    $('.sidenav').sidenav();
    $(".dropdown-trigger").dropdown();
    $('select').formSelect();       
    $('.scrollspy').scrollSpy();  
});