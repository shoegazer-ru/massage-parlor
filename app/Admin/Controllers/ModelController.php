<?php

namespace App\Admin\Controllers;

use App\Admin\Components\Files\Interfaces\FilesComponentInterface;
use App\Admin\Components\Models\Interfaces\ModelsComponentInterface;
use App\Exceptions\AdminModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ModelController extends Controller
{
    /**
     * @param  \Illuminate\Http\Request $request
     * @param  ModelsComponentInterface $models
     * @param string $modelName
     *
     * @return Response
     */
    public function create(Request $request, ModelsComponentInterface $models, string $modelName)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $model = $models->createModel($modelName, $input);
            return redirect()->route('model.edit', ['modelName' => $modelName, 'modelId' => $model->id]);
        }
        return view('admin.model.create', [
            'user' => Auth::user(),
            'modelName' => $modelName,
            'sectionId' => $request->get('section_id')
        ]);
    }

    /**
     * @param Request $request
     * @param ModelsComponentInterface $models
     * @param FilesComponentInterface $files
     * @param string $modelName
     * @param int $modelId
     * 
     * @return [type]
     */
    public function edit(
        Request $request,
        ModelsComponentInterface $models,
        FilesComponentInterface $files,
        string $modelName,
        int $modelId
    ) {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $models->editModel($modelName, $modelId, $input);
        }
        if ($action = $request->get('action')) {
            switch ($action) {
                case 'delete-file':
                    $files->deleteFile($request->get('fileId'));
                    break;
            }
        }
        return view('admin.model.edit', [
            'user' => Auth::user(),
            'modelName' => $modelName,
            'modelId' => $modelId,
            'sectionId' => $request->get('section_id')
        ]);
    }

    /**
     * @param Request $request
     * @param ModelsComponentInterface $models
     * @param string $modelName
     * @param int $modelId
     * 
     * @return [type]
     */
    public function delete(Request $request, ModelsComponentInterface $models, string $modelName, int $modelId)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $models->deleteModel($modelName, $modelId, $input);
            return redirect()->route('model.list', ['modelName' => $modelName]);
        }
        return view('admin.model.delete', [
            'user' => Auth::user(),
            'modelName' => $modelName,
            'modelId' => $modelId,
            'sectionId' => $request->get('section_id')
        ]);
    }

    /**
     * @param Request $request
     * @param ModelsComponentInterface $models
     * @param string $modelName
     * @param int $modelId
     * 
     * @return [type]
     */
    public function upload(Request $request, FilesComponentInterface $files, string $modelName, int $modelId)
    {
        $files->uploadFile($request->file('files'), $modelName, $modelId);
        return ['success' => true];
    }
}
