<?php

namespace App\Http\Controllers;

use App\Alice\ApiResponser;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CityController extends Controller
{
    private $apiResponser;
    private $rules = [
        'name' => 'required|max:127'
    ];
    private $city;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ApiResponser $apiResponser, City $city){
        $this->apiResponser = $apiResponser;
        $this->city = $city;
    }

    /**
     * Menambah data city
     *
     * @param Request $request
     * @return Json
     */
    public function create(Request $request){
        $this->validate($request, $this->rules);
        $city = City::firstOrCreate($request->all());
        return $this->apiResponser->success($city, Response::HTTP_CREATED);
    }

    /**
     * Membaca data city
     *
     * @param Request $request
     * @return void
     */
    public function read(Request $request){
        $keyword = $request->input('keyword').'%';
        $city = City::where('name', 'LIKE', $keyword)->limit(10)->get();

        return $this->apiResponser->success($city);
    }

    /**
     * Mengupdate data city
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request){
        $this->validate($request, $this->rules);

        $city = City::findOrFail($request->input('id'));
        $city->fill($request->all());

        if($city->isClean()){
            return $this->errorResponse('Tidak ada perubahan data', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $city->save();
        return $this->apiResponser->success($city);
    }

    /**
     * Menghapus data city
     *
     * @param Request $request
     * @return void
     */
    public function destroy(Request $request){
        $city = City::findOrFail($request->input('id'));
        $city->delete();

        return $this->apiResponser->success($city);
    }
}
