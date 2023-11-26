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
        $applications = Application::select(['id', 'subject', 'description', 'status', 'user_id', 'created_at']);

        return DataTables::of($applications)
            ->addColumn('action', function ($application) {
                $edit = auth()->user()->can('permission', ['update application'])
                    ? '<a href="' . route('admin.applications.edit', $application->id) . '" class="btn btn-primary">Edit</a>'
                    : '<a disabled class="btn btn-secondary">Unable to Edit</a>';

                $delete = auth()->user()->can('permission', ['delete application'])
                    ? '<a href="' . route('admin.applications.destroy', $application->id) . '" class="btn btn-danger">Delete</a>'
                    : '<a disabled class="btn btn-secondary">Unable to Delete</a>';

                $action = $edit . $delete;

                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
