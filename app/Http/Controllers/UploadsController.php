<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Upload;
use Illuminate\Http\Request;

class UploadsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $count = Upload::count();
        if ($count === 1) {
            $firstUpload = Upload::first();
            $imageData = 'http://enjoyer.vueadmin.com/' . $firstUpload->image_path;
            return response()->json([
                'id' => $firstUpload->id,
                'count' => $count - 1,
                'image_path' => $imageData,
            ]);
        } else {
            $firstUpload = Upload::first();
            $imageData = 'http://enjoyer.vueadmin.com/' . $firstUpload->image_path;
            $play_time = Carbon::parse($firstUpload->play_time);
            $play_time->addSeconds(45);
            if (Carbon::now() > $play_time) {
                $firstUpload->delete();
                $this->index();
            } else {
                return response()->json([
                    'id' => $firstUpload->id,
                    'count' => $count - 1,
                    'image_path' => $imageData,
                ]);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $latest_upload = Upload::latest()->first();

        if (!$latest_upload) {
            $upload = new Upload();
            $upload->device = $request->input('device');
            $upload->image_path = $request->input('image_path');
            $upload->play_time = Carbon::now();
            $upload->save();
        } else {
            $play_time = Carbon::parse($latest_upload->play_time);
            $play_time->addSeconds(55);
            $upload = new Upload();
            $upload->device = $request->input('device');
            $upload->image_path = $request->input('image_path');
            $upload->play_time = $play_time;
            $upload->save();
        }
        return [
            'code' => 200
        ];
    }
}
