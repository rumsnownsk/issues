<?php

namespace app\controllers;


use core\Auth;
use app\models\Task;

class AjaxController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->isAjax()) {
            redirect('/');
        }
    }

    public function oneTaskAction()
    {
        $task = Task::find($_GET['id'])->toArray();

        if ($task) {
            $data = [
                'code' => 200,
                'task' => $task
            ];
        } else {
            $data = [
                'code' => 404,
                'errors' => "not found",
            ];
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit();
    }

    public function formIssueAction()
    {
        $task = new Task();

        if ($_POST['action'] == 'insert') {
            $res = $task->add($_POST);

            if ($res) {
                $data = [
                    'code' => 200,
                    'object' => $res,
                    'message' => 'добавлена новая запись'
                ];
            } else {
                $data = [
                    'code' => 422,
                    'errors' => $task->getErrors(),
                ];
            }

        } elseif ($_POST['action'] == 'update') {

            $id = (int)$_POST['model_id'];

            $task = Task::find($id);

            $res = $task->edit($_POST);

            if ($res) {
                $data = [
                    'code' => 200,
                    'object' => $res,
                    'message' => 'Запись обновлена'
                ];
            } else {
                $data = [
                    'code' => 422,
                    'errors' => $task->getErrors(),
                ];
            }
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit();
    }

    public function deleteIssueAction(){
        $id = (int)$_POST['id'];
        $task = Task::query()->find($id);
        if ($task) {
            $task->delete();
            $data = [
                'code' => 200,
                'message' => 'Запись удалена'
            ];
        } else {
            $data = [
                'code' => 404,
                'errors' => 'запись не найдена',
            ];
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit();
    }

}