<?php

namespace App\Http\Controllers;

use App\Exports\JsonExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UploadController extends Controller
{
    public function UploadAction(Request $request)
    {
        $json = \File::json($request->file('json_file'));
        
        return Excel::download(new JsonExport($json), 'json_upload.xlsx');
    }
}
