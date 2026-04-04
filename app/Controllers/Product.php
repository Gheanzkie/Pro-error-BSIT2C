<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LogModel;
use App\Models\ProductModel;

class Product extends Controller
{
    public function index(){
        $model = new ProductModel();
        $data = [
            'product' => $model->findAll(),
            'pageName' => 'Product'  
        ];
        return view('product/index', $data);
    }
 
    public function save(){
        $category_id = $this->request->getPost('category_id');
        $name = $this->request->getPost('name');
        $price = $this->request->getPost('price');
        $stock = $this->request->getPost('stock');

        $userModel = new ProductModel();
        $logModel = new LogModel();

        $data = [
            'category_id' => $category_id,
            'name'        => $name,
            'price'       => $price,
            'stock'       => $stock
        ];

        if ($userModel->insert($data)) {
            $logModel->addLog('New Product has been added: ' . $name, 'ADD');
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to save Product']);
        }
    }

    public function update(){
        $model = new ProductModel();
        $logModel = new LogModel();
        $userId = $this->request->getPost('id');
        $category_id = $this->request->getPost('category_id');
        $name = $this->request->getPost('name');
        $price = $this->request->getPost('price');
        $stock = $this->request->getPost('stock');

        $userData = [
            'category_id' => $category_id,
            'name'        => $name,
            'price'       => $price,
            'stock'       => $stock
        ];

        $updated = $model->update($userId, $userData);

        if ($updated) {
            $logModel->addLog('Product has been updated: ' . $name, 'UPDATED');
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Product updated successfully.'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error updating product.'
            ]);
        }
    }

    public function edit($id){
        $model = new ProductModel();
        $user = $model->find($id);

        if ($user) {
            return $this->response->setJSON(['data' => $user]);
        } else {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Product not found']);
        }
    }

    public function delete($id){
        $model = new ProductModel();
        $logModel = new LogModel();
        $user = $model->find($id);
        if (!$user) {
            return $this->response->setJSON(['success' => false, 'message' => 'Product not found.']);
        }

        $deleted = $model->delete($id);

        if ($deleted) {
            $logModel->addLog('Deleted product: ' . $user['name'], 'DELETED');
            return $this->response->setJSON(['success' => true, 'message' => 'Product deleted successfully.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete Product.']);
        }
    }

    public function fetchRecords()
    {
        $request = service('request');
        $model = new ProductModel();

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