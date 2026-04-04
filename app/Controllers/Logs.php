<?php

namespace App\Controllers;

use App\Models\LogModel;
use App\Controllers\BaseController;

class Logs extends BaseController
{

    public function log()
{
    $logModel = new LogModel();
    

    $date = $this->request->getGet('date') ?? date('Y-m-d');

    $data['logs'] = $logModel->getLogsByDate($date);
    $data['selectedDate'] = $date;

    return view('log/index', $data);
}

}