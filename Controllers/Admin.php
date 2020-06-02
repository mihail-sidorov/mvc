<?php

namespace Controllers;

use App;
use Models\User;
use Models\Job;

class Admin extends \App\Controller
{

    public function index($request)
    {

        if (User::is_login()) {
            if ($request->method === 'post') {
                if (App::$validator->validate([
                    'description' => 'requare',
                ], $request->params)) {
                    $job = new Job();

                    $job->description = $request->params['description'];
                    if (isset($request->params['done'])) {
                        $job->done = 1;
                    }
                    else {
                        $job->done = 0;
                    }

                    if ($request->params['description'] !== Job::get_field_value('description', $request->params['id']) || Job::get_field_value('edit_admin', $request->params['id']) == 1) {
                        $job->edit_admin = 1;
                    }
                    
                    $job->update($request->params['id']);

                    $message = App::message("Вы изменили задачу с id: {$request->params['id']}");
                }
            }



            $jobs = Job::paginate(3);
            $links = Job::links();
            $order = Job::order([
                ['order_by' => 'name', 'order' => 'ASC', 'desc' => 'по имени и возрастанию'],
                ['order_by' => 'name', 'order' => 'DESC', 'desc' => 'по имени и убыванию'],
                ['order_by' => 'email', 'order' => 'ASC', 'desc' => 'по email и возрастанию'],
                ['order_by' => 'email', 'order' => 'DESC', 'desc' => 'по email и убыванию'],
                ['order_by' => 'done', 'order' => 'ASC', 'desc' => 'сначала не выполненные'],
                ['order_by' => 'done', 'order' => 'DESC', 'desc' => 'сначала выполненные'],
            ]);

            return $this->render('Admin', [
                'jobs' => $jobs,
                'links' => $links,
                'order' => $order,
                'message' => $message,
            ]);
        }
        else {
            header('Location: /login');
        }

    }
    
}