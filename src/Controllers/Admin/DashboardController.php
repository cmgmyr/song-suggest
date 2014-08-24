<?php
namespace Ss\Controllers\Admin;

use Illuminate\Support\Facades\View;

class DashboardController extends AdminController
{

    public function index()
    {
        $this->layout->activeLink = 'dashboard';
        $this->layout->content = View::make('admin.dashboard.index');
    }
} 