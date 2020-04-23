<?php

namespace App\Http\Controllers;

use App\Alice\ApiResponser;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AddressController extends Controller
{
    private $apiResponser;
    private $rules = [
        'name' => 'required|max:127'
    ];
    private $address;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ApiResponser $apiResponser, Address $address){
        $this->apiResponser = $apiResponser;
        $this->address = $address;
    }

    /**
     * Menambah data address
     *
     * @param Request $request
     * @return Json
     */
    public function create(Request $request){
        $this->validate($request, $this->rules);
        $address = Address::firstOrCreate($request->all());
        return $this->apiResponser->success($address, Response::HTTP_CREATED);
    }

    /**
     * Membaca data address
     *
     * @param Request $request
     * @return void
     */
    public function read(Request $request){
        $keyword = $request->input('keyword').'%';
        $addresses = Address::where('name', 'LIKE', $keyword)->limit(10)->get();

        return $this->apiResponser->success($addresses);
    }

    /**
     * Mengupdate data address
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request){
        $this->validate($request, $this->rules);

        $address = Address::findOrFail($request->input('id'));
        $address->fill($request->all());

        if($address->isClean()){
            return $this->errorResponse('Tidak ada perubahan data', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $address->save();
        return $this->apiResponser->success($address);
    }

    /**
     * Menghapus data address
     *
     * @param Request $request
     * @return void
     */
    public function destroy(Request $request){
        $address = Address::findOrFail($request->input('id'));
        $address->delete();

        return $this->apiResponser->success($address);
    }
}
