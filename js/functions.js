$(document).ready( function() {
    var original_value = "";

    $(".click-row").click(function(){
        var row_id = this.id;
        window.location.href = "?p=view_entry&row=" + row_id;
    });

    $('#view-all').DataTable({
        "stateSave": true,
        "fixedHeader": true
    });

    $("#go-back-button").click(function(){
        window.location = "?p=view_all";
    });

    $("#landing-view-all-button").click(function(){
        window.location = "?p=view_all";
    });

    $("#landing-new-entry-button").click(function(){
        window.location = "?p=new_entry";
    });

    $("#edit-button").click(function(){
        $("#save-button, #cancel-button, .view-input").show();
        $("#edit-button, #go-back-button, #print-button, .initial-text").hide();
        $("#project").focus();
        original_value = $("form").serializeArray();
    });

    $("#confirmation-cancel-button ").click(function(){
        $("#changes-made").empty();
    });

    $("#save-button").click(function() {
        var new_value = $("form").serializeArray();
        for(var i=0; i<original_value.length; i++){
            $("#changes-made").append(original_value[i].value + " > " + "<strong>" + new_value[i].value  + "</strong>" + " " + "<br>");
        }
    });

    // Cancel button for editing fields. Also hides/shows the correct buttons for editing the fields
    $("#cancel-button").click(function(){
        $("#save-button, #cancel-button, .view-input").hide();
        $("#edit-button, #go-back-button, #print-button, .initial-text").show();
    });

    // Print button
    $("#print-button").click(function(){
        window.print();
    });

    // Turns the enter key push into a click event to avoid erroneously submitting the form without confirmation modal popping up first
    $( "form" ).keypress(function( event ) {
        if ( event.which == 13 ) {
            event.preventDefault();
            $("#save-button").click();
        }
    });

    // Fix for IE11 and Edge to relate buttons outside of form element
    $("#confirmation-save-button").click(function(){
        if (Modernizr.formattribute) {
            // supported
        } else {
            // not-supported
            $("#edit-values").submit();
        }
    });

    $('#confirmation-modal').on('hidden.bs.modal', function () {
        $("#changes-made").empty();
    });
});

