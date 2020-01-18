$(document).ready(function () {


    $("#login_form").submit(function (e) {
        e.preventDefault();
        e.stopImmediatePropagation;


        var err_username = '';
        var err_pass = '';

        if ($("#username").val() == '') {
            err_username = 'Обязательное поле';
            $("#err_username").text(err_username);
            $("#username").css('border-color', '#cc0000')
        } else {
            err_username = '';
            $("#err_username").text(err_username);
            $("#username").css("border-color", '')
        }

        if ($('#password').val() == '') {
            err_pass = 'Обязательное поле';
            $("#err_pass").text(err_pass);
            $("#password").css('border-color', '#cc0000')
        } else {
            err_pass = '';
            $("#err_pass").text(err_pass);
            $("#password").css('border-color', '')
        }

        if (err_username !== '' || err_pass !== '' ) {
            $("#err_message").remove();
            return false
        }
        console.log(this)
        var th = $(this);
        $.ajax({
            url: "/auth",
            method: 'post',
            dataType: 'json',
            data: th.serialize(),
            success: function (response) {
                if (response.code == 200){
                    location.replace("/");

                } else if (response.code == 422) {

                    $("#err_message").remove();

                    $.each(response.errors, function (k, v) {

                        $("<span id='err_message' class='text-danger'>" + v + "</span>").prependTo($("#login_form"));

                    })
                }
            }
        })
        return false
    })
})