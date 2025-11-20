<?php

namespace App\Http\Controllers;

use App\Http\Reponses\FileAlreadyExistResponse;
use App\Http\Reponses\NoPermissionResponse;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $files = File::where('user_id', '=', $user->id)->get();
        return response()->json(['files' => $files]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFileRequest $request)
    {
        $user = auth()->user();
        $files = $request->file('files');
        $uploadedFiles = [];
        $failedFiles = [];

        foreach ($files as $file) {
            $filename = $file->getClientOriginalName();

            if (Storage::exists("users/{$user->id}/{$filename}")) {
                $failedFiles[] = [$filename => FileAlreadyExistResponse::make()->getData()];
                continue;
            }

            $path = $file->storeAs("users/{$user->id}", $filename);
            Log::info($filename);
            $uploadedFile = File::create(['path' => $path, 'filename' => $filename, 'user_id' => $user->id]);
            Log::info($uploadedFile);
            $uploadedFiles[] = $uploadedFile;
        }

        return response()->json(['uploadedFiles' => $uploadedFiles, '$failedFiles' => $failedFiles]);
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        $user = auth()->user();

        if ($file->user_id != $user->id) {
            return NoPermissionResponse::make();
        }

        return Storage::download($file->path);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFileRequest $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        $user = auth()->user();

        if ($file->user_id != $user->id) {
            return NoPermissionResponse::make();
        }

        File::destroy($file->id);

        return Storage::delete($file->path);
    }
}
