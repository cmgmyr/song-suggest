<?php
namespace Ss\Controllers;

use Ss\Services\Notifications\Flash;
use Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

abstract class BaseController extends Controller
{

    protected $layout = 'layouts.frontend';
    protected $activeLink = 'home';

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
            $this->layout->activeLink = $this->activeLink;
        }
    }

    public function redirectRouteWithSuccess($route, $message)
    {
        Flash::success($message);
        return Redirect::route($route);
    }

    public function redirectRouteWithError($route, $message)
    {
        Flash::error($message);
        return Redirect::route($route);
    }

}
