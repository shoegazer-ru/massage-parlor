<?php

namespace App\Admin\Controllers;

use App\Admin\Components\Fields\Interfaces\FieldsComponentInterface;
use App\Admin\Components\Files\Interfaces\FilesComponentInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FieldsController extends Controller
{
    /**
     * @param Request $request
     * @param FieldsComponentInterface $fields
     * @param FilesComponentInterface $files
     * @param string $fieldName
     * @param int|null $modelId
     * 
     * @return [type]
     */
    public function edit(
        Request $request,
        FieldsComponentInterface $fields,
        FilesComponentInterface $files,
        string $fieldName,
        ?int $modelId = null
    ) {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $field = $fields->saveFIeld($fieldName, $modelId, $input);
            if (!$modelId) {
                return redirect()->route('field.edit', ['fieldName' => $fieldName, 'modelId' => $field->id]);
            }
        }
        if ($action = $request->get('action')) {
            switch ($action) {
                case 'delete-file':
                    $files->deleteFile($request->get('fileId'));
                    break;
            }
        }
        return view('admin.fields.edit', [
            'user' => Auth::user(),
            'fieldName' => $fieldName,
            'modelId' => $modelId
        ]);
    }

    /**
     * @param Request $request
     * @param FieldsComponentInterface $fields
     * @param string $fieldName
     * @param int $modelId
     * 
     * @return [type]
     */
    public function delete(Request $request, FieldsComponentInterface $fields, string $fieldName, int $modelId)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $fields->deleteField($modelId, $input);
            return redirect()->route('fields.list', ['fieldName' => $fieldName]);
        }
        return view('admin.fields.delete', [
            'user' => Auth::user(),
            'fieldName' => $fieldName,
            'modelId' => $modelId
        ]);
    }
}
