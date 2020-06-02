<?php

namespace Controllers;

use App;
use Models\Job;

class Home extends \App\Controller
{
    
    public function index ($request, $params)
    {
        
        if ($request->method === 'post') {
            if (App::$validator->validate([
                'name' => 'requare',
                'email' => 'requare|email',
                'description' => 'requare',
            ], $request->params)) {
                
                $job = new Job();

                $job->name = $request->params['name'];
                $job->email = $request->params['email'];
                $job->description = $request->params['description'];

                $job->insert();

                $request->params = [];

                $message = App::message('Вы добавили новую задачу!');
            }
        }

        $jobs = Job::paginate(3);
        $links = Job::links();
        $order = Job::order([
            ['order_by' => 'name', 'order' => 'ASC', 'desc' => 'по имени и возрастанию'],
            ['order_by' => 'name', 'order' => 'DESC', 'desc' => 'по имени и убыванию'],
            ['order_by' => 'email', 'order' => 'ASC', 'desc' => 'по emeil и возрастанию'],
            ['order_by' => 'email', 'order' => 'DESC', 'desc' => 'по emsil и убыванию'],
            ['order_by' => 'done', 'order' => 'ASC', 'desc' => 'сначала невыполненные'],
            ['order_by' => 'done', 'order' => 'DESC', 'desc' => 'сначала выполненные'],
        ]);

        return $this->render('Home', [
            'errors' => App::$validator->errors,
            'params' => $params,
            'request' => $request,
            'jobs' => $jobs,
            'links' => $links,
            'order' => $order,
            'message' => $message,
        ]);
        
    }
    
}