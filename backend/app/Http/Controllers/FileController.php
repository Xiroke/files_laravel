<?php

namespace App\Http\Controllers;

use App\Http\Reponses\FileAlreadyExistResponse;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileController extends Controller
{
    /**
     * Список личный файлов
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $files = File::where('user_id', '=', $user->id)->get();
        return response()->json(['files' => $files]);
    }

    /**
     * Список файлов к которым есть доступ
     * @param Request $request
     * @return JsonResponse
     */
    public function index_files_granted(Request $request)
    {
        $user = auth()->user();

        $files = $user->grantedFile->toArray();

        return response()->json(['files' => $files]);
    }

    /**
     * Список пользователей имеющих доступ к файлу
     * @param File $file
     * @param Request $request
     * @return JsonResponse
     */
    public function index_users_granted(File $file, Request $request)
    {
        $users = $file->sharedUsers->toArray();
        return response()->json(['users' => $users]);
    }

    /**
     * Создание файла
     * @param StoreFileRequest $request
     * @return JsonResponse
     */
    public function store(StoreFileRequest $request)
    {
        $user = auth()->user();
        $files = $request->file('files');
        $uploadedFiles = [];
        $failedFiles = [];

        foreach ($files as $file) {
            $filename = $file->getClientOriginalName();
            $filenameHash = $file->hashName() . now()->toDateString();

            if (Storage::exists("users/{$user->id}/{$filenameHash}")) {
                $failedFiles[] = [$filenameHash => FileAlreadyExistResponse::make()->getData()];
                continue;
            }

            $path = $file->storeAs("users/{$user->id}", $filenameHash);
            $uploadedFile = File::create(['path' => $path, 'filename' => $filename, 'user_id' => $user->id]);
            $uploadedFiles[] = $uploadedFile;
        }

        return response()->json(['uploadedFiles' => $uploadedFiles, '$failedFiles' => $failedFiles]);
    }

    /**
     * Получение конкретного файла
     * @param File $file
     * @return StreamedResponse
     */
    public function show(File $file)
    {
        return Storage::download($file->path);
    }

    /**
     * Выдача прав
     * @param File $file
     * @param User $user
     * @return JsonResponse
     */
    public function give_permission(File $file, User $user)
    {
        if ($user->id == auth()->user()->id) {
            return response()->json(['message' => 'Нельзя выдать себе права'], 422);
        }

        $file->sharedUsers()->attach($user->id);

        return response()->json(['message' => 'Разрешение выдано']);
    }

    /**
     * Отзыв прав
     * @param File $file
     * @param User $user
     * @return JsonResponse
     */
    public function revoke_permission(File $file, User $user)
    {
        if ($user->id == auth()->user()->id) {
            return response()->json(['message' => 'Нельзя отзвать у себя права'], 422);
        }

        $file->sharedUsers()->detach($user->id);

        return response()->json(['message' => 'Разрешение выдано']);
    }

    /**
     * Изменение
     * @param UpdateFileRequest $request
     * @param File $file
     * @return JsonResponse
     */
    public function update(UpdateFileRequest $request, File $file)
    {
        $user = auth()->user();
        $validated = $request->validated();

        $oldPath = "users/{$user->id}/{$file->filename}";
        $newPath = "users/{$user->id}/{$validated['filename']}";

        if (!Storage::exists($oldPath)) {
            return response()->json(['message' => 'Исходный файл не найден'], 404);
        }

        if (Storage::exists($newPath)) {
            return response()->json(['message' => 'Файл с таким именем уже существует'], 422);
        }

        Storage::move($oldPath, $newPath);
        $file->filename = $validated['filename'];
        $file->save();
        return response()->json(['message' => 'Изменения применены']);
    }

    /**
     * Удаление
     * @param File $file
     * @return JsonResponse
     */
    public function destroy(File $file)
    {
        File::destroy($file->id);
        Storage::delete($file->path);
        return response()->json(['message' => 'Файл удален']);
    }
}
