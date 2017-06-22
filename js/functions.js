$(document).ready( function() {
    $(".click-row").click(function(){
        var a = this.id;
        var n = a.slice(7);
        window.location.href = "?p=view_entry&row=" + n;
    });

    $('#view-all').DataTable({
        stateSave: true
    });

    $("#go-back-button").click(function(){
        window.location = "?p=view_all";
    });

    $("#edit-button").click(function(){
        $("#save-button, #cancel-button, .form-control").show();
        $("#edit-button, #go-back-button, #initial-text").hide();
        $("#project").focus();
    });

    $("#cancel-button").click(function(){
        $("#save-button, #cancel-button, .form-control").hide();
        $("#edit-button, #go-back-button, #initial-text").show();
    });

    $( "form" ).keypress(function( event ) {
        if ( event.which == 13 ) {
            event.preventDefault();
            $("#save-button").click();
        }
    });

    $("#confirmation-save-button").click(function(){
        if (Modernizr.formattribute) {
            // supported
        } else {
            // not-supported
            $("#edit-values").submit();
        }
    });
});
