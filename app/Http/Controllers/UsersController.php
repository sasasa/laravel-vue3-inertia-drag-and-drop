<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Data\UsersRequest;

use App\UseCases\UsersMultiUpadateUseCase;

class UsersController extends Controller
{
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::ordered()->get(),
        ]);
    }

    public function multiupdate(UsersRequest $request, UsersMultiUpadateUseCase $useCase)
    {
        $useCase($request);
        return to_route('users.index')->with([
            'message' => '登録しました。',
            'status' => 'success'
        ]);
    }
}
