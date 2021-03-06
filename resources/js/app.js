/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

import $ from 'jquery';
window.$ = window.jQuery = $;

import 'jquery-ui/ui/widgets/datepicker.js';

$( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#start_date_show" )
        .datepicker({
          changeMonth: true,
          numberOfMonths: 1,
          altField: "#start_date"
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", new Date( getDate( this ).valueOf() + 24*60*60*1000 ) );
        }),
      to = $( "#end_date_show" ).datepicker({
        changeMonth: true,
        numberOfMonths: 1,
        altField: "#end_date"
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", new Date( getDate( this ).valueOf() - 24*60*60*1000 ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
        alert( error );
      }
 
      return date;
    }
    if ( typeof ( $('#start_date_show').attr('date') ) !== "undefined" ) {
      $('#start_date_show').datepicker('setDate', $('#start_date_show').attr('date') );
      $('#end_date_show').datepicker('setDate', $('#end_date_show').attr('date') );
    }
  } );

$("#search_clients").on('keyup', function() {
  var search = $(this).val().toLowerCase();
  //Go through each list item and hide if not match search

  $(".clients_sub_container").each(function() {
      if ($(this).find("a").html().toLowerCase().indexOf(search) != -1) {
          $(this).show();
      }
      else {
          $(this).hide();  
      }
  });    

  $(".clients_sub_container2 option").each(function() {
    if ($(this).html().toLowerCase().indexOf(search) != -1) {
        $(this).removeAttr('hidden');
    }
    else {
        $(this).attr('hidden','hidden');  
    }
  }); 
  
});