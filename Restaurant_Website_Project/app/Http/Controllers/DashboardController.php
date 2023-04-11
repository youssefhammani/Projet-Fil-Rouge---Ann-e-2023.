<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function getUsers()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
}
