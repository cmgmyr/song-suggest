<?php
namespace Ss\Controllers\Admin;

use Ss\Controllers\BaseController;

abstract class AdminController extends BaseController
{

    protected $layout = 'admin.layouts.backend';
    protected $activeLink = 'dashboard';

}
