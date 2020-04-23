<?php

namespace App\Http\Controllers;

use App\Alice\ApiResponser;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegionController extends Controller
{
    private $apiResponser;
    private $rules = [
        'name' => 'required|max:127'
    ];
    private $region;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ApiResponser $apiResponser, Region $region){
        $this->apiResponser = $apiResponser;
        $this->region = $region;
    }

    /**
     * Menambah data region
     *
     * @param Request $request
     * @return Json
     */
    public function create(Request $request){
        $this->validate($request, $this->rules);
        $region = Region::firstOrCreate($request->all());
        return $this->apiResponser->success($region, Response::HTTP_CREATED);
    }

    /**
     * Membaca data region
     *
     * @param Request $request
     * @return void
     */
    public function read(Request $request){
        $keyword = $request->input('keyword').'%';
        $region = Region::where('name', 'LIKE', $keyword)->limit(10)->get();

        return $this->apiResponser->success($region);
    }

    /**
     * Mengupdate data region
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request){
        $this->validate($request, $this->rules);

        $region = Region::findOrFail($request->input('id'));
        $region->fill($request->all());

        if($region->isClean()){
            return $this->errorResponse('Tidak ada perubahan data', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $region->save();
        return $this->apiResponser->success($region);
    }

    /**
     * Menghapus data region
     *
     * @param Request $request
     * @return void
     */
    public function destroy(Request $request){
        $region = Region::findOrFail($request->input('id'));
        $region->delete();

        return $this->apiResponser->success($region);
    }
}
