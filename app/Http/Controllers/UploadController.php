<?php

namespace App\Http\Controllers;

use App\Exports\JsonExport;
use App\Jobs\ExportToExcelJob;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UploadController extends Controller
{
    public function UploadAction(Request $request)
    {
        //store all the data from json file to a variable
        $json = \File::json($request->file('json_file'));

        //Export the data to excel file using matwebsite/excel package
        $export = new JsonExport($json);
        return Excel::download($export, 'json_upload.xlsx');


        /*Tried to use default package queue function of excel package
        but excel is not generating although job is completed*/

        //$export->queue('json_upload.xlsx');
        // return back()->withSuccess('Export started!');

        /*Tried to use custom queue function but same problem as above
        excel is not generating although job is completed*/
    
        // dispatch(new ExportToExcelJob($json));
        // return back()->withSuccess('Export started!');
    }
}
