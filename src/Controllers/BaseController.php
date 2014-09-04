<?php
namespace Ss\Controllers;

use Laracasts\Commander\CommanderTrait;
use Ss\Services\Notifications\Flash;
use Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

abstract class BaseController extends Controller
{

    use CommanderTrait;

    /**
     * @var string
     */
    protected $layout = 'layouts.frontend';

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    /**
     * Redirects to specified route with a successful message
     *
     * @param $route
     * @param $message
     * @param array $params
     * @return mixed
     */
    public function redirectRouteWithSuccess($route, $message, $params = [])
    {
        Flash::success($message);
        return Redirect::route($route, $params);
    }

    /**
     * * Redirects to specified route with an error message
     *
     * @param $route
     * @param $message
     * @param array $params
     * @return mixed
     */
    public function redirectRouteWithError($route, $message, $params = [])
    {
        Flash::error($message);
        return Redirect::route($route, $params);
    }

    /**
     * Redirects back with a successful message
     *
     * @param $message
     * @return mixed
     */
    public function redirectBackWithSuccess($message)
    {
        Flash::success($message);
        return Redirect::back();
    }

    /**
     * Redirects back with an error message
     *
     * @param $message
     * @return mixed
     */
    public function redirectBackWithError($message)
    {
        Flash::error($message);
        return Redirect::back();
    }

}
