<?php

namespace App\Http\Controllers;

use App\Mail\ApplicationAccept;
use App\Mail\ApplicationCancel;
use App\Mail\ApplicationSubmit;
use App\Models\Application;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::all();

        return view('admin.pages.applications.index', compact('applications'));
    }

    public function create()
    {
        $application = null;

        return view('admin.pages.applications.view', compact('application'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'subject' => [
                'required',
                'max:255',
                Rule::unique('applications', 'subject')->whereNull('deleted_at'),
            ],
            'description' => 'nullable',
            'files.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',

        ]);

        $data['user_id'] = Auth::user()->id;

        // Create the application and retrieve its id
        $application = Application::create($data);


        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $fileData['file'] = $this->storeApplicationFile($file, 'applications');
                $fileData['application_id'] = $application->id;

                File::create($fileData);

            }
        }

        Mail::to(Auth::user()->email)->send(new ApplicationSubmit());

        return redirect()->route('admin.application.index')->with('success', 'Application created successfully');
    }



    public function destroy(Application $application)
    {
        // dd($application);

        $application->delete();

        return redirect()->route('admin.application.index')->with('success', 'Application deleted successfully');
    }
    public function Active(Application $application)
    {
        $application->status = 1;
        $application->update();
        Mail::to(Auth::user()->email)->send(new ApplicationAccept());
        return redirect()->route('admin.application.index')->with('success', 'Application Accepted successfully');
    }
    public function cancel(Application $application)
    {
        $application->status = 0;

        $application->update();
        Mail::to(Auth::user()->email)->send(new ApplicationCancel());
        return redirect()->route('admin.application.index')->with('success', 'Application Canceled successfully');
    }
    public function storeApplicationFile(UploadedFile $file, $folder = 'applications')
    {
        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $filePath = $folder . '/' . $fileName;

        Storage::disk('public')->put($filePath, file_get_contents($file));

        return $filePath;
    }
}
