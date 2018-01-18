$(document).ready(function() {
    $('form').submit(function(e) {
        
        let json = $('textarea').val()
        try {
            $.parseJSON(json)
            $('.form-url').val('valid json url')
            $('.error').text('')

            $.ajax({
            type: "GET",
            data: json,
            url: "../api",
            success: function(data){
                    // $('#output').html(data)
                    $('.form-url').val(data)
                }
            });
        } catch(err) {
            $('.form-url').val('')
            $('.error').text('Invalid JSON format')
        }
        
        e.preventDefault()
    })
}) 