<?php

namespace App\Http\Controllers;

use App\Models\Source;
use Illuminate\Http\Request;

class SourcesController extends Controller
{
    /**
     * 获取sources表中最新的10条数据
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $sources = Source::latest()->take(10)->get();
        return response()->json($sources);
    }

    /**
     * 获取最新的一条数据
     *
     * @return \Illuminate\Http\Response
     */
    public function latest()
    {
        $source = Source::latest()->first();
        return response()->json($source);
    }

    /**
     * 获取倒数第n条数据
     *
     * @param  int  $index
     * @return \Illuminate\Http\Response
     */
    public function byIndex($index)
    {
        $source = Source::latest()->skip($index - 1)->first();
        return response()->json($source);
    }

    public function newestIndex() {
        $source = Source::latest()->first();
        $id = $source->id;
        $imageData = 'http://enjoyer.vueadmin.com/' . $source->image_code;
        return response()->json([
            'id' => $id,
            'image' => $imageData
        ]);
    }

    /**
     * 获取最新的图片地址
     *
     * @return \Illuminate\Http\Response
     */
    public function newest()
    {
        $source = Source::latest()->first();
        $imageData = 'http://enjoyer.vueadmin.com/' . $source->image_code;
        return $imageData;
    }

    /**
     * 新增一条source数据
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $source = new Source;
        $source->generation_date = $request->input('generation_date');
        $source->generation_terminal = $request->input('generation_terminal');
        $source->image_code = $request->input('image_code');
        $source->par_value = $request->input('par_value');
        $source->is_verified = $request->input('is_verified', false);
        $source->resource_code = $request->input('resource_code');
        $source->save();

        return response()->json($source, 200);
    }
}
