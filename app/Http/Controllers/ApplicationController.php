<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
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
        $application = false;

        return view('admin.pages.applications.view', compact('application'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique('applications', 'name')->whereNull('deleted_at'),
            ],
            'description' => 'nullable',
            'price' => 'required|numeric',
            'image' => 'nullable',
        ]);

        $data['slug'] = Str::slug($data['name']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $data['image'] = $this->storeApplicationImage($image, 'applications');
        }
        $data['user_id'] = Auth::user()->id;
        Application::create($data);

        return redirect()->route('admin.applications.index')->with('success', 'Application created successfully');
    }

    public function edit(Application $application)
    {
        return view('admin.pages.applications.view', compact('application'));
    }

    public function update(Request $request, Application $application)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique('applications', 'name')->ignore($application->id)->whereNull('deleted_at'),
            ],
            'description' => 'nullable',
            'price' => 'required|numeric',
            'image' => 'nullable',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $data['image'] = $this->storeApplicationImage($image, 'applications');
            Storage::delete($application->image);
        }
        $data['slug'] = Str::slug($data['name']);
        $application->update($data);

        return redirect()->route('admin.applications.index')->with('success', 'Application updated successfully');
    }

    public function destroy(Application $application)
    {
        $application->delete();

        return redirect()->route('admin.applications.index')->with('success', 'Application deleted successfully');
    }

    public function storeApplicationImage(UploadedFile $image, $folder = 'applications')
    {
        $fileName = Str::uuid() . '.' . $image->getClientOriginalExtension();
        $filePath = $folder . '/' . $fileName;

        Storage::disk('public')->put($filePath, file_get_contents($image));

        return $filePath;
    }
}
