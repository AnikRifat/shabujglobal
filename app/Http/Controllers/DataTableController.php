<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class DataTableController extends Controller
{
    public function users()
    {
        $users = User::select(['id', 'name', 'email', 'role']);

        return DataTables::of($users)

            ->addColumn('action', function ($user) {
                return '<a href="'.route('admin.users.edit', $user->id).'" class="btn btn-primary">Edit</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function applications()
    {
        if (Auth::user()->role == 'student') {
            $applications = Application::where('user_id', Auth::user()->id)->select(['id', 'subject', 'description', 'status', 'user_id', 'created_at']);
        } else {
            $applications = Application::select(['id', 'subject', 'description', 'status', 'user_id', 'created_at']);
        }

        return DataTables::of($applications)
            ->addColumn('status', function ($application) {
                switch ($application->status) {
                    case 1:
                        $statusLabel = 'Accepted';
                        $badgeClass = 'bg-success';
                        break;
                    case 2:
                        $statusLabel = 'Pending';
                        $badgeClass = 'bg-warning';
                        break;
                    case 0:
                        $statusLabel = 'Canceled';
                        $badgeClass = 'bg-danger';
                        break;
                    default:
                        $statusLabel = 'Unknown';
                        $badgeClass = 'bg-secondary';
                        break;
                }

                return '<span class="badge '.$badgeClass.'">'.$statusLabel.'</span>';
            })
            ->addColumn('action', function ($application) {
                $viewButton = view('admin.pages.applications.action-buttons', compact('application'))->render();

                return $viewButton;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
}
