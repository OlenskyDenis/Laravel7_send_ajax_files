<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index(){
        return view('pages.home');
    }

    public function send(Request $request){
        dd($request->all());
        // ->rundom_folder
        //$this->deletePreviewDirectory();

        return view('pages.home');
    }

    public function getUploadedFiles(Request $request){
        $random_folder = Str::random(10);
        $path_application_preview_files = "application_files_preview/". $random_folder ."/";


        foreach ($request->file('images') as $file) {
            $files[] = collect([
                $file->store($path_application_preview_files, 'public'),
                $file->getClientOriginalName(),
            ]);
        }
        //dd($files);

        return view('includes.upload-files',[
            'files' => $files,
            'random_folder' => $random_folder
        ])->render();
    }

    // public function deletePreviewDirectory($path_preview){

    //     return Storage::disk('public')->deleteDirectory($path_preview);
    // }
}
