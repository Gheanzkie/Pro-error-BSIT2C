<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TeacherModel;
use CodeIgniter\Controller;
use App\Models\LogModel;

class Teacher extends Controller
{
    public function index(){
        $model = new TeacherModel();
        $data['teacher'] = $model->findAll();
        return view('teacher/index', $data);
    }

    public function save(){
        $name = $this->request->getPost('name');
        $salary = $this->request->getPost('salary');

        $userModel = new \App\Models\TeacherModel();
        $logModel = new LogModel();

        $data = [
            'name'       => $name,
            'salary'       => $salary
        ];

        if ($userModel->insert($data)) {
            $logModel->addLog('New Teacher has been added: ' . $name, 'ADD');
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to save Teacher']);
        }
    }

    public function update(){
        $model = new TeacherModel();
        $logModel = new LogModel();
        $userId = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $salary = $this->request->getPost('salary');

        $userData = [
            'name'       => $name,
            'salary'       => $salary
        ];

        $updated = $model->update($userId, $userData);

        if ($updated) {
            $logModel->addLog('New Teacher has been apdated: ' . $name, 'UPDATED');
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Teacher updated successfully.'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error updating Teacher.'
            ]);
        }
    }

    public function edit($id){
        $model = new TeacherModel();
    $user = $model->find($id); // Fetch user by ID

    if ($user) {
        return $this->response->setJSON(['data' => $user]); // Return user data as JSON
    } else {
        return $this->response->setStatusCode(404)->setJSON(['error' => 'User not found']);
    }
}

public function delete($id){
    $model = new TeacherModel();
    $logModel = new LogModel();
    $user = $model->find($id);
    if (!$user) {
        return $this->response->setJSON(['success' => false, 'message' => 'Teacher not found.']);
    }

    $deleted = $model->delete($id);

    if ($deleted) {
        $logModel->addLog('Delete Teacher', 'DELETED');
        return $this->response->setJSON(['success' => true, 'message' => 'Teacher deleted successfully.']);
    } else {
        return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete Teacher.']);
    }
}

public function fetchRecords()
{
    $request = service('request');
    $model = new \App\Models\TeacherModel();

    $start = $request->getPost('start') ?? 0;
    $length = $request->getPost('length') ?? 10;
    $searchValue = $request->getPost('search')['value'] ?? '';

    $totalRecords = $model->countAll();
    $result = $model->getRecords($start, $length, $searchValue);

    $data = [];
    $counter = $start + 1;
    foreach ($result['data'] as $row) {
        $row['row_number'] = $counter++;
        $data[] = $row;
    }

    return $this->response->setJSON([
        'draw' => intval($request->getPost('draw')),
        'recordsTotal' => $totalRecords,
        'recordsFiltered' => $result['filtered'],
        'data' => $data,
    ]);
}

}