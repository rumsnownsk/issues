<?php
/**
 * Created by PhpStorm.
 * User: rum
 * Date: 10.01.20
 * Time: 12:37
 */

namespace app\models;

use core\Auth;
use Illuminate\Database\Eloquent\Model;
use PDO;
use Valitron\Validator;

class Task extends Model
{
    protected $table = 'tasks';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'email',
        'textissue',
        'complete'
    ];

    public $rules = [
        'required' =>
            ['username', 'email', 'textissue']
    ];

    public $errors = array();

    public function validate($fields)
    {
        $v = new Validator($fields);
        $v->rules($this->rules);

        if ($v->validate()) {
            return true;
        } else {
//            dd($v->errors());
            $this->errors = $v->errors();
            return false;
        }
    }

    public function add($fields)
    {

        if (isset($fields['completeIssue']) && Auth::isAdmin()) {
            $fields['complete'] = 1;
        } else {
            $fields['complete'] = 0;
        }

        if (!$this->validate($fields)) {
            return false;
        }

        $task = new static();
        $task->fill($fields);
        $res = $task->save();
        return $res;

    }

    public function edit($fields)
    {
        if (!Auth::isAdmin()){
            return false;
        }
        if (isset($fields['completeIssue'])) {
            $fields['complete'] = 1;
        } else {
            $fields['complete'] = 0;
        }
        if (!$this->validate($fields)) {
            return false;
        }
        $this->fill($fields);
        return $this->save();
    }

    public function getErrors()
    {
        $errors = [];
        foreach ($this->errors as $error) {
            foreach ($error as $item) {
                $errors[] .= $item;
            }
        }
        return $errors;
    }

    public function getComplete(){
        if ($this->complete == 0){
            return 'nole';
        } else {
            return 'nenole';
        }
    }
}