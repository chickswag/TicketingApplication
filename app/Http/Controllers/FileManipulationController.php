<?php

namespace App\Http\Controllers;

use App\Exports\ExportData;
use App\Imports\FileImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\File;
use Maatwebsite\Excel\Facades\Excel;

class FileManipulationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('files.upload')->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function readUploadedFile(Request $request){

        if(Auth::check())
        {
            $form_data = $request->all();
            $file_rule = ['file' => 'Required',];
            $file_validator = Validator::make($form_data, $file_rule);
            if ($file_validator->passes()) {

                $data = file_get_contents($form_data['file']->getRealPath());
                $lines = array_unique(explode(PHP_EOL, $data));
                $created_date = date("Y-m-d H:i:s");
                switch($form_data['type']){
                    case 'alphabetically':
                        $lines = array_unique(explode(PHP_EOL, $data));
                        usort($lines,'strcasecmp');
                        break;
                    case 'string_length':
                        $lines = array_unique(explode(PHP_EOL, $data));
                        usort($lines,array('App\Http\Controllers\FileManipulationController','my_sort'));
                        break;
                }
                $export = new ExportData([
                    $lines
                ]);

                return Excel::download($export, 'File'.$created_date.'updated.xlsx');
            }
            $messages = $file_validator->messages();
            return redirect()->back()->withErrors($messages);
        }
        else{
            return response('/');
        }


    }

    private static function my_sort($a,$b)
    {
        return strlen($b)-strlen($a);
    }


}
