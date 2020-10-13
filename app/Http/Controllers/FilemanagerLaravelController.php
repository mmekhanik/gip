<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use UniSharp\LaravelFilemanager\Controllers\LfmController;

class FilemanagerLaravelController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator|user');

    }
    public function getShow()
    {
        // dd('getShow');
        return view('laravel-filemanager::show');
    }
    public function getConnectors()
    {
        // $f = LfmController::Filemanager();
        // $f->connector_url = url('/') . '/filemanager/connectors';
        // $f->run();
    }
    public function postConnectors()
    {
        // $f = LfmController::Filemanager();
        // $f->connector_url = url('/') . '/filemanager/connectors';
        // $f->run();
    }

}
