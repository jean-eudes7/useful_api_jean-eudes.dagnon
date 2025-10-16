<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\UserModule;

class ModuleController extends Controller
{
    public function index()
    {
        return response()->json(Module::all(), 200);
    }

    public function activate($id)
    {
        $module = Module::find($id);
        if (!$module) {
            return response()->json(['message' => 'Module not found'], 404);
        }

        $user = auth()->user();

        UserModule::updateOrCreate(
            ['user_id' => $user->id, 'module_id' => $id],
            ['active' => true]
        );

        return response()->json(['message' => 'Module activated']);
    }

    public function deactivate($id)
    {
        $module = Module::find($id);
        if (!$module) {
            return response()->json(['message' => 'Module not found'], 404);
        }

        $user = auth()->user();
        $record = UserModule::where('user_id', $user->id)->where('module_id', $id)->first();

        if ($record) {
            $record->update(['active' => false]);
        }

        return response()->json(['message' => 'Module deactivated']);
    }
}