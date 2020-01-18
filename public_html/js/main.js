$(function () {
    $('#modal1').removeClass('hidden');

    // load_data();

    function load_data() {
        $.ajax({
            url: '/tasks',
            dataType: 'html',
            method: 'get',
            async: false,
            success: function (response) {
                console.log(response);
                $('#tasks_data').html(response);





            }
        })
    }

    registrationLinkPopup();

    reqistrationDelete();

    $("a.page-link").on('click', function () {
        console.log(this);
        $.ajax({
            url: '/tasks',
            dataType: 'html',
            method: 'get',
            success: function (response) {
                console.log(response);
                $('#tasks_data').html(response);

                registrationLinkPopup();

                reqistrationDelete();

                return false;
            }
        })


    })


    // Добавление новой задачи
    $("#add").on('click', function () {
        $("#issue_action").attr('title', "Add Issue");
        $("#action").val("insert");
        $("#form_action").val("insert")
    });

    // Редактирование одной задачи
    $(document).on('click', '.edit', function () {
        var id = $(this).attr('id');

        $.ajax({
            url: '/onetask',
            method: 'get',
            dataType: 'json',
            data: {id: id, action: 'update'},
            success: function (response) {
                console.log(response);
                if (response.code == 200) {
                    var task = response.task;
                    $("#title_popup").text('Редактировать задачу №'+ task.id);
                    $("#username").val(task.username);
                    $("#email").val(task.email);
                    $("#textIssue").text(task.textissue);

                    if (task.complete == 1){
                        $("#completeIssue").prop('checked', true);
                    } else {
                        $("#completeIssue").prop('checked', false);
                    }
                    $("#action").val('update');
                    $("#model_id").val(task.id);

                    $("#form_action").text("Изменить");
                }
            }
        })
    });

    $("#form_issue").submit(function (event) {
        event.preventDefault();
        event.stopImmediatePropagation;


        var error_username = '';
        var error_email = '';
        var error_textIssue = '';

        if ($("#username").val() == '') {
            error_username = 'Обязательное поле';
            $("#error_username").text(error_username);
            $("#username").css('border-color', '#cc0000')
        } else {
            error_username = '';
            $("#error_username").text(error_username);
            $("#username").css("border-color", '')
        }

        if ($('#email').val() == '') {
            error_email = 'Обязательное поле';
            $("#error_email").text(error_email);
            $("#email").css('border-color', '#cc0000')
        } else {
            error_email = '';
            $("#error_email").text(error_email);
            $("#email").css('border-color', '')
        }

        if ($("#textIssue").val() == '') {
            error_textIssue = 'Обязательное поле';
            $("#error_textIssue").text(error_textIssue);
            $("#textIssue").css('border-color', '#cc0000')
        } else {
            error_textIssue = '';
            $("#error_textIssue").text(error_textIssue);
            $("#textIssue").css('border-color', '')
        }

        if (error_username !== '' ||
            error_email !== '' ||
            error_textIssue !== '') {
            return false
        }

        // $("#form_action").attr('disabled', 'disabled');

        var th = $(this);

        $.ajax({
            url: "/formIssue",
            type: "post",
            dataType: 'json',
            data: th.serialize(),
            success: function (response) {

                if (response.code == 200) {

                    th.trigger("reset");

                    $('#modal1').removeClass("open");
                    setTimeout( function(){
                        $('#modal1').parents(".overlay_modal").removeClass("open");
                    }, 350);
                    location.reload();

                } else if (response.code == 400) {

                }
            }
        });
        return false;
    });



    $(".modal_window").each( function(){
        $(this).wrap('<div class="overlay_modal"></div>')
    });


    function registrationLinkPopup(){
        $(".btn_action_issue").on('click', function(e){
            e.preventDefault();
            e.stopImmediatePropagation;

            var $this = $(this),
                modal = $($this).data("modal");

            $(modal).parents(".overlay_modal").addClass("open");
            setTimeout( function(){
                $(modal).addClass("open");
            }, 350);

            $(document).on('click', function(e){
                var target = $(e.target);

                if ($(target).hasClass("overlay_modal")){
                    $(target).find(".modal_window").each( function(){
                        $(this).removeClass("open");
                    });
                    setTimeout( function(){
                        $(target).removeClass("open");
                    }, 350);
                }
            });
        });


    }

    function reqistrationDelete(){
        $('.delete').click(function() {
            $('.popup-fade').fadeIn();
            var id = $(this).attr('id');

            $("#deleteConfirm").attr('value', id)
            return false;
        });
    }




    $('.popup-close').click(function() {
        $(this).parents('.popup-fade').fadeOut();
        return false;
    });

    $(document).keydown(function(e) {
        if (e.keyCode === 27) {
            e.stopPropagation();
            $('.popup-fade').fadeOut();
        }
    });

    $('.popup-fade').click(function(e) {
        if ($(e.target).closest('.popup').length == 0) {
            $(this).fadeOut();
        }
    });

    // Удаление одной записи (уже после подтверждения)
    $("#deleteConfirm").on('click', function () {
        var id = $(this).attr('value');
        $.ajax({
            url: '/deleteIssue',
            method: 'post',
            data: {id:id},
            dataType: 'json',
            success: function (response) {
                $('.popup-fade').fadeOut();
                location.reload();
            }

        })
    })
    $("#deleteNo").on('click', function () {
        $('.popup-fade').fadeOut();
    })

   function getPaginate(){
        $.ajax({
            url: '/htmlPagination',
            method: 'get',
            data: {},
            dataType: 'html',
            success: function (response) {
                $("#paginate").html(response)
            }
        })
   };

})