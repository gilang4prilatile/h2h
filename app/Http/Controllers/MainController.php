<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public string $view;
    public string $mainUrl;
    public $user;

    public function __construct()
    {
        $this->view = '';

        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            view()->share('__user', $this->user);
            view()->share('__menus', session("userMenus"));
            // $canEdit = $this->user->can(getUrlAction('edit')) ? true : false;
            // $canDelete = $this->user->can(getUrlAction('delete')) ? true : false;
            // $canView = $this->user->can(getUrlAction('view')) ? true : false;

            view()->share('canEdit', true);
            view()->share('canDelete', true);
            view()->share('canView', true);
            view()->share('canExcel', true);
            view()->share('canPDF', true);
            view()->share('canEnable', true);
            view()->share('canDisable', true);
            return $next($request);
        });
    }

    public function makeView(string $view, array $data = [])
    {
        $resultView = !empty($this->view) ?
            $this->view . "." . $view :
            $view;

        return view($resultView, $data);
    }
}
