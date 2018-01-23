$(document).ready(function() {
    $('form').submit(function(e) {
        e.preventDefault();
        let json = $('textarea').val()
        try {
            $.parseJSON(json)
            $('.error').text('')

            $.ajax({
            type:"POST",
            data: {'json':json},
            url: "../api/index.php",
            success: function(data){
                    // $('#output').html(data)
                    $('.form-url').val(data)
                }
            });
        } catch(err) {
            $('.form-url').val('')
            $('.error').text('Invalid JSON format')
        }
        
        
    })
}) 