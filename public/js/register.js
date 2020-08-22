$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#forma').on('submit', function(e){
        e.preventDefault();
        
        $.ajax({
            url: '/register',
            method: 'post',
            data: {
                username: $('#username').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                password_confirmation: $('#cfpassword').val()
            },
            success: function(data){
                $(':input','#forma')
                .not(':button, :submit, :reset, :hidden')
                .val('')
                .prop('checked', false)
                .prop('selected', false);

                $('#errors').removeClass('alert-danger');
                $('#errors').addClass('alert-success');
                $('#errors').html(data);
            },
            error: function(error){
                if(error.status === 422){
                    $('#errors').removeClass('alert-success');
                    $('#errors').addClass('alert-danger');
                    let html = '<ul>';
                    $.each(error.responseJSON.errors, function (key, item) 
                    {
                        html += `<li>${item}</li>`;
                    });
                    html += '</ul>';
                    $('#errors').html(html);
                }
            }
        })
    });
});