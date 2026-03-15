<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $company = (object)[
            'name' => 'Demo Company',
        ];

        $users = [
            (object)['name' => 'Иван Иванов', 'email' => 'ivan@example.com'],
            (object)['name' => 'Мария Петрова', 'email' => 'maria@example.com'],
        ];

        return view('saas.dashboard', compact('company','users'));
    }

     public function addUser(Request $request)
    {
 
        $users = session()->get('users', []);
        $users[] = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        session()->put('users', $users);

        return redirect()->back()->with('success', 'Сотрудник добавлен');
    }
}
