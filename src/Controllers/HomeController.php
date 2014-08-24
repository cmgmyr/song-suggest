<?php
namespace Ss\Controllers;

use View;

class HomeController extends BaseController
{

    /**
     * Shows the default home page
     *
     * @return View
     */
    public function showWelcome()
    {
        $this->layout->content = View::make('home.welcome');
    }

}
