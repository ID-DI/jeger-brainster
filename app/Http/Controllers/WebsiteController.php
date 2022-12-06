<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cover = asset('images/01-home.jpg');
        return view('welcome', compact('cover'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,gif,pdf,tiff,png|max:2048',
            'email' => 'required|email',
        ]);
        $newFile = new File();
        if($request->file()) {
            $fileName = time().'.'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('file',$fileName,'public');
            $fileEmail = $request->email;
            $newFile->name = time().'.'.$request->file->getClientOriginalName();
            $newFile->file_path = '/storage/' . $filePath;
            $newFile->email = $fileEmail;
            $newFile->save();
            
            $APIurl = 'https://jager.brainster.xyz/api?img=';
            $server_path = 'http://127.0.0.1:8000/';
            $lastId = DB::getPdo()->lastInsertId();
            $file = DB::table('files')->where('id', $lastId)->first();
            $filePath = $file->file_path;
            // $response = Http::get('https://jager.brainster.xyz/api?img=http://localhost/images/receipt.jpg&iwantstatus=1');
            $response = Http::get($APIurl . $server_path . $filePath);
            $imgStatus = $response->object()->img_status;
            $code = $response->object()->code;

            if($imgStatus > 0 && $imgStatus < 3 &&  $code == 200) 
            {
                $text = $response->object()->text;
                $receipt = new Receipt();
                $receipt->file_id = $lastId;
                $receipt->status = $imgStatus;
                $receipt->text = $text;
                $receipt->save();
                $data['success'] = 1;
            }
            elseif($imgStatus == 0 &&  $code == 200)
            {
                DB::table('files')->delete($lastId);
                $data['success'] = 0;
            }
            elseif($code == 400)
            {
                DB::table('files')->delete($lastId);
                $data['success'] = 2;
            }
            return response()->json($data);
        }
        else
        {
            return response()->json(3);
        }
    }

}
