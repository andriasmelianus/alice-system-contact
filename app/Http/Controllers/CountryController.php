<?php

namespace App\Http\Controllers;

use App\Alice\ApiResponser;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CountryController extends Controller
{
    private $apiResponser;
    private $rules = [
        'name' => 'required|max:127'
    ];
    private $country;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ApiResponser $apiResponser, Country $country){
        $this->apiResponser = $apiResponser;
        $this->country = $country;
    }

    /**
     * Menambah data country
     *
     * @param Request $request
     * @return Json
     */
    public function create(Request $request){
        $this->validate($request, $this->rules);
        $country = Country::firstOrCreate($request->all());
        return $this->apiResponser->success($country, Response::HTTP_CREATED);
    }

    /**
     * Membaca data country
     *
     * @param Request $request
     * @return void
     */
    public function read(Request $request){
        $keyword = $request->input('keyword').'%';
        $country = Country::where('name', 'LIKE', $keyword)->limit(10)->get();

        return $this->apiResponser->success($country);
    }

    /**
     * Mengupdate data country
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request){
        $this->validate($request, $this->rules);

        $country = Country::findOrFail($request->input('id'));
        $country->fill($request->all());

        if($country->isClean()){
            return $this->errorResponse('Tidak ada perubahan data', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $country->save();
        return $this->apiResponser->success($country);
    }

    /**
     * Menghapus data country
     *
     * @param Request $request
     * @return void
     */
    public function destroy(Request $request){
        $country = Country::findOrFail($request->input('id'));
        $country->delete();

        return $this->apiResponser->success($country);
    }
}
