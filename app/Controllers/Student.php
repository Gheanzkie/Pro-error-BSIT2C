<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\StudentModel;
use CodeIgniter\Controller;
use App\Models\LogModel;

class Student extends Controller
{
    public function index(){
        $model = new StudentModel();
        $data['student'] = $model->findAll();
        return view('student/index', $data);
    }

    public function save(){
        $name = $this->request->getPost('name');
        $bday = $this->request->getPost('bday');
        $course = $this->request->getPost('course');
        $address = $this->request->getPost('address');

        $userModel = new \App\Models\StudentModel();
        $logModel = new LogModel();

        $data = [
            'name'       => $name,
            'bday'       => $bday,
            'course'       => $course,
            'address'    => $address
        ];

        if ($userModel->insert($data)) {
            $logModel->addLog('New student has been added: ' . $name, 'ADD');
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to save Profiling']);
        }
    }

    public function update(){
        $model = new StudentModel();
        $logModel = new LogModel();
        $userId = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $bday = $this->request->getPost('bday');
        $course = $this->request->getPost('course');
        $address = $this->request->getPost('address');

        $userData = [
            'name'       => $name,
            'bday'       => $bday,
            'course'       => $course,
            'address'    => $address
        ];

        $updated = $model->update($userId, $userData);

        if ($updated) {
            $logModel->addLog('New student has been apdated: ' . $name, 'UPDATED');
            return $this->response->setJSON([
                'success' => true,
                'message' => 'student updated successfully.'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error updating student.'
            ]);
        }
    }

    public function edit($id){
        $model = new StudentModel();
    $user = $model->find($id); // Fetch user by ID

    if ($user) {
        return $this->response->setJSON(['data' => $user]); // Return user data as JSON
    } else {
        return $this->response->setStatusCode(404)->setJSON(['error' => 'User not found']);
    }
}

public function delete($id){
    $model = new StudentModel();
    $logModel = new LogModel();
    $user = $model->find($id);
    if (!$user) {
        return $this->response->setJSON(['success' => false, 'message' => 'student not found.']);
    }

    $deleted = $model->delete($id);

    if ($deleted) {
        $logModel->addLog('Delete student', 'DELETED');
        return $this->response->setJSON(['success' => true, 'message' => 'student deleted successfully.']);
    } else {
        return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete Profiling.']);
    }
}

public function fetchRecords()
{
    $request = service('request');
    $model = new \App\Models\StudentModel();

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