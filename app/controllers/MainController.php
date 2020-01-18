<?php

namespace app\controllers;

use app\models\Task;
use Illuminate\Database\Capsule\Manager as DB;
use JasonGrimes\Paginator;

class MainController extends CommonController
{
    public function indexAction()
    {
        $encoded_string = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        parse_str($encoded_string, $res);
        extract($res);

        $tasks = DB::table('tasks');

        $directSort = '&sd=asc';
        $reverseSort = '&sd=desc';


        if (isset($orderBy)  ){

            if (isset($sd) && $sd=='asc'){

                $tasks->orderBy($orderBy, 'asc');

            } elseif(isset($sd) && $sd=='desc') {

                $tasks->orderBy($orderBy, 'desc');

            } else {

                $tasks->orderBy($orderBy, 'asc');

            }
        }

        if (isset($page)){
            $directSort .= '&page='.$page;
            $reverseSort .= '&page='.$page;
        }

        $countTasks = $tasks->count();
        $itemsPerPage = 10;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $urlPattern = "/tasks?page=(:num)";

        if (isset($sd)){
            $urlPattern .= "&sd={$sd}";
        }

        if (isset($orderBy)){
            $urlPattern .= "&orderBy={$orderBy}";
        }

        $paginator = new Paginator($countTasks, $itemsPerPage, $currentPage, $urlPattern);

        $start = ($currentPage - 1) * $itemsPerPage;
        $tasks = $tasks->skip($start)->take($itemsPerPage)->get();

        $this->render('index', compact('paginator', 'tasks', 'directSort', 'reverseSort'));
    }

}