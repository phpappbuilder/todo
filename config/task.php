<?php

return [
    'status' => ['1'=>'new', '2'=>'in progress', '3'=>'done'],
    'validators' => [
        'title' => 'required|max:100',
        'description' => 'required|max:400',
        'status' => 'required|in:1,2,3',
        'date_start' => 'required|date'
    ]
];