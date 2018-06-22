<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function index(\Parsedown $parsedown)
    {
        $md = file_get_contents(resource_path('markdown/test.md'));
        $html = $parsedown->text($md);

        return view('demo', ['html' => $html]);
    }
}
