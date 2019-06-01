$(document).ready(function(){

    $("#first-select").on('change', function(event) {
         var selected = this.val();

         $(".hideIfNotSelected").hide(); //hide all selects
         $("#select-"+ selected).show(); //show only the selected select.
    });

});

