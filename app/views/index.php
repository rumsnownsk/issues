<!doctype html>
<html lang="ru">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <!--    <link rel="stylesheet" href="/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">
    <link href="/css/popup.css" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Issues</title>
</head>
<body>
<section id="content" class="content">
    <div class="container">
        <div class="row">

            <div class="admin_panel">
                <?php if ($auth->isLogin()) : ?>
                    <p>Привет!, <?php echo $auth->username ?></p>
                    <a href="/logout" class="btn btn-info btn-xs" id="logoutBtn">Logout</a>
                <?php else: ?>
                    <a href="/login" class="btn btn-link btn-xs" id="adminBtn">For admin</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="head_table">
                <h3>Список задач</h3>
                <div class="somebth">
                    <a href="#" class="btn btn-info btn-xs btn_action_issue" data-modal="#modal1" id="add" name="add">Добавить</a>
                </div>
            </div>

            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">
                        ID
                        <a href="/tasks?orderBy=id<?= $directSort ?>"><i class="fa fa-long-arrow-down"
                                                                         aria-hidden="true"
                                                                         title="1 -> 9"></i></a>
                        <a href="/tasks?orderBy=id<?= $reverseSort ?>"><i class="fa fa-long-arrow-up" aria-hidden="true"
                                                                          title="9 -> 1"></i></a>
                    </th>
                    <th scope="col">
                        User
                        <a href="/tasks?orderBy=username<?= $directSort ?>"><i class="fa fa-long-arrow-down"
                                                                               aria-hidden="true"
                                                                               title="А -> Я"></i></a>
                        <a href="/tasks?orderBy=username<?= $reverseSort ?>"><i class="fa fa-long-arrow-up"
                                                                                aria-hidden="true"
                                                                                title="Я -> А"></i></a>
                    </th>
                    <th scope="col">
                        Email
                        <a href="/tasks?orderBy=email<?= $directSort ?>"><i class="fa fa-long-arrow-down"
                                                                            aria-hidden="true"
                                                                            title="А -> Я"></i></a>
                        <a href="/tasks?orderBy=email<?= $reverseSort ?>"><i class="fa fa-long-arrow-up"
                                                                             aria-hidden="true"
                                                                             title="Я -> А"></i></a>
                    </th>
                    <th scope="col">Задача</th>
                    <th scope="col">
                        Выполнено
                        <a href="/tasks?orderBy=complete<?= $directSort ?>"><i class="fa fa-long-arrow-down"
                                                                               aria-hidden="true"
                                                                               title="0 -> 9"></i></a>
                        <a href="/tasks?orderBy=complete<?= $reverseSort ?>"><i class="fa fa-long-arrow-up"
                                                                                aria-hidden="true"
                                                                                title="9 -> 0"></i></a>
                    </th>
                    <?php if($auth->isAdmin()) : ?>
                    <th scope="col">edit</th>
                    <th scope="col">delete</th>
                    <?php endif ?>
                </tr>
                </thead>
                <tbody id="tasks_data">
                <?php foreach ($tasks as $task) : ?>
                    <tr>
                        <td scope="row"><?= $task->id ?></td>
                        <td><?= $task->username ?></td>
                        <td><?= $task->email ?></td>
                        <td><?= $task->textissue ?></td>
                        <td class="checkTd">
                            <?php if ($task->complete == 1) : ?>
                                <img src="/images/png/complete.png" width="20px" alt="">
                            <?php endif; ?>
                        </td>

                        <?php if($auth->isAdmin()) : ?>
                        <td>
                            <a href="#" class="btn btn-warning btn-xs btn_action_issue edit" data-modal="#modal1"
                               id="<?= $task->id ?>">Edit</a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-danger btn-xs delete" id="<?= $task->id ?>">Delete</a>
                        </td>
                        <?php endif ?>

                    </tr>

                <?php endforeach; ?>
                <!--            <tr>-->
                <!--                <td align="center" colspan="7">No content</td>-->
                <!--            </tr>-->
                </tbody>
            </table>


            <?php getPagination($paginator) ?>
        </div>


        <div class='modal_window hidden' id='modal1'>
            <div class='content'>
                <h1 class='title' id="title_popup">Добавить новую задачу</h1>

                <form id="form_issue">

                    <div class="form-group">
                        <input type="text" name="username" id="username" class="form-control"
                               placeholder="Your name">
                        <span id="error_username" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" id="email" class="form-control"
                               placeholder="Your email">
                        <span id="error_email" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                    <textarea class="form-control" name="textissue" rows="5" id="textIssue"
                              placeholder="Enter Issue"></textarea>
                        <span id="error_textIssue" class="text-danger"></span>
                    </div>

                    <?php if ($auth->isLogin()) : ?>

                    <div class="form-group">
                        <input type="checkbox" name="completeIssue" id="completeIssue" value="on"
                               class="form-control" title="">
                        <label for="completeIssue" class="label_publish">выполнено</label>
                    </div>

                    <?php endif; ?>

                    <div class="form-group">
                        <input type="hidden" name="action" id="action" value="insert"/>
                        <input type="hidden" name="model_id" id="model_id"/>
                    </div>
                    <div class="button-center">
                        <button type="submit" name="form_action" id="form_action" value="insert"
                                class="btn btn-info btn-xs">Добавить
                        </button>
                    </div>
                </form>


            </div>
        </div>


        <?php if ($auth->isLogin()) : ?>

        <div class="popup-fade">
            <div class="popup" id="delConf">
                <a class="popup-close" href="#">Закрыть</a>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <button type="submit" data-dismiss="modal" id="deleteConfirm" class="btn">Delete</button>
                    <button type="submit" data-dismiss="modal" id="deleteNo" class="btn btn-primary">Cancel</button>
                </div>
            </div>
        </div>

        <?php endif; ?>

    </div>


</section>


<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>-->
<script src="/js/jquery-3.4.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script>

<!--<script src="/js/jquery.magnific-popup.min.js" type="text/javascript"></script>-->
<script src="/js/main.js" type="text/javascript"></script>


</body>


</html>


