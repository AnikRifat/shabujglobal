<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use Yajra\DataTables\DataTables;

class DataTableController extends Controller
{
    public function users()
    {
        $users = User::select(['id', 'name', 'email', 'role']);

        return DataTables::of($users)

            ->addColumn('action', function ($user) {
                return '<a href="' . route('admin.users.edit', $user->id) . '" class="btn btn-primary">Edit</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function applications()
    {
        $applications = Application::select(['id', 'name', 'description', 'price', 'image']);

        return DataTables::of($applications)
            ->addColumn('image', function ($application) {
                $imageUrl = asset('storage/app/public/' . $application->image);

                return '<img src="' . $imageUrl . '" alt="Application Image" style="max-width: 100px; max-height: 100px;">';
            })
            ->addColumn('action', function ($application) {
                if (auth()->user()->can('permission', ['update application'])) {
                    $edit = '<a href="' . route('admin.applications.edit', $application->id) . '" class="btn btn-primary">Edit</a>';
                } else {
                    $edit = '<a disabled class=" btn btn-secondary">Unable to Edit</a>';
                }
                if (auth()->user()->can('permission', ['delete application'])) {
                    $delete = '<a href="' . route('admin.applications.destroy', $application->id) . '" class="btn btn-danger">Delete</a>';
                } else {
                    $delete = '<a disabled class=" btn btn-secondary">Ubanle to Delete</a>';
                }
                $action = $edit . $delete;

                return $action;
            })
            ->rawColumns(['image', 'action'])
            ->make(true);
    }
}
