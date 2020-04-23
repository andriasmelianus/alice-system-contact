<?php

namespace App\Http\Controllers;

use App\Alice\ApiResponser;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PhoneController extends Controller
{
    private $apiResponser;
    private $rules = [
        'number' => 'required|max:127'
    ];
    private $phone;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ApiResponser $apiResponser, Phone $phone){
        $this->apiResponser = $apiResponser;
        $this->phone = $phone;
    }

    /**
     * Menambah data phone
     *
     * @param Request $request
     * @return Json
     */
    public function create(Request $request){
        $this->validate($request, $this->rules);
        $phone = Phone::firstOrCreate($request->all());
        return $this->apiResponser->success($phone, Response::HTTP_CREATED);
    }

    /**
     * Membaca data phone
     *
     * @param Request $request
     * @return void
     */
    public function read(Request $request){
        $keyword = $request->input('keyword').'%';
        $phone = Phone::where('number', 'LIKE', $keyword)->limit(10)->get();

        return $this->apiResponser->success($phone);
    }

    /**
     * Mengupdate data phone
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request){
        $this->validate($request, $this->rules);

        $phone = Phone::findOrFail($request->input('id'));
        $phone->fill($request->all());

        if($phone->isClean()){
            return $this->errorResponse('Tidak ada perubahan data', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $phone->save();
        return $this->apiResponser->success($phone);
    }

    /**
     * Menghapus data phone
     *
     * @param Request $request
     * @return void
     */
    public function destroy(Request $request){
        $phone = Phone::findOrFail($request->input('id'));
        $phone->delete();

        return $this->apiResponser->success($phone);
    }
}
