<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\SalesModel;


class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/login');
        }


        $userModel = new UserModel();
        $productModel = new ProductModel();
        $salesModel = new SalesModel();

        $data = [
        'totalStaff' => $userModel->getTotalStaff(),
        'totalProduct' => $productModel->getTotalProduct(),
        'totalSales' => $salesModel->getTotalSales(),
        'salesList' => $salesModel->orderBy('date','DESC')->findAll(),
        'pageName' => 'Dashboard'
];

        return view('dashboard', $data);
    }
}