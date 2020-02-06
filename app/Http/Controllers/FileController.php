<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class FileController extends Controller
{
    public function index(){
        $files = Storage::files('upload');
        return view('welcome', compact('files'));
    }

    public function uploadFile( Request $request){
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            $file->storeAs('upload', $file_name);
            /* Storage::disk('local')->put($file_name, $file); */
        } else {
            return back()->with(["error"=>"File not available!"]);
        }
        return back()->with(["success"=>"Uploaded Successfully."]);
    }

    //Upload multiple files
/*     public function uploadFile( Request $request){
        if ($request->hasFile('files')) {
            $files = $request->file('files');

            foreach($files as $file){
                $file_name = $file->getClientOriginalName();
                $file->storeAs('upload', $file_name);
            }

        } else {
            return back()->with(["error"=>"File not available!"]);
        }
        return back()->with(["success"=>"Uploaded Successfully."]);
    } */

    public function downloadFile($file){
        $path = '../storage/app/upload/'.$file;
        return response()->download($path, $file);
    }

    public function deleteFile($file){
        $file_exist = '../storage/app/upload/'.$file;
        if($file_exist){
            @unlink($file_exist);
        }else{
            return back()->with(["error"=>"File not found!"]);
        }
        return back()->with(["success"=>"Deleted Successfully."]);
    }
}
