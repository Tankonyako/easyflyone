<?php

namespace App\Http\Controllers;

use App\Models\User;
use Propaganistas\LaravelPhone\PhoneNumber;

class NewsController extends Controller
{
    public function newsPage()
    {
        return view('pages.news', []);
    }
    public function newsSpecifyPage($id)
    {
        return view('pages.news', ['newsid' => $id]);
    }
}
