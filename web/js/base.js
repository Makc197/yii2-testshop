$('.logout_link').on('click', function(event){
    event.preventDefault();
    console.log("test");
    $('#logout_form').submit();
});