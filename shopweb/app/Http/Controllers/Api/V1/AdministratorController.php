<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Http\Requests\StoreAdministratorRequest;
use App\Http\Requests\UpdateAdministratorRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdministratorController extends Controller
{
    public function __construct() {
        $this->middleware(['auth:api']);
        $this->middleware(['scope:read-administrators,*'])->only(['index','show']);
        $this->middleware(['scope:create-administrators,*'])->only('store');
        $this->middleware(['scope:update-administrators,*'])->only('update');
        $this->middleware(['scope:block-administrators,*'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        request()->validate([
            's' => ['nullable','string'],
            'all' => ['nullable', 'boolean']
        ]);


        if(request()->get('all', false)) {
            return response()->json(Administrator::all(), Response::HTTP_OK);
        }

        $numOfPage = 8;
        $search = request('s');
        if ($search)
            $administrator = Administrator::where('name','like',"%{$search}%")
            ->orWhere('email','like',"%{$search}%")
            ->paginate($numOfPage);
        else
            $administrator = Administrator::paginate($numOfPage);

        $administrator->withQueryString();
        return response()->json($administrator, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdministratorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdministratorRequest $request)
    {


        $request->merge([
            'password' => Hash::make($request->password)
        ]);

        $administrator = Administrator::create($request->all());


        return response()->json([
            'data' => $administrator,
            'password' => $request->safe()->password
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function show(Administrator $administrator)
    {
        return response()->json($administrator, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdministratorRequest  $request
     * @param  \App\Models\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdministratorRequest $request, Administrator $administrator)
    {
        $administrator->update($request->safe()->except('password'));

        $password = null;

        if ($request->password) {
            $password = Str::random(12); //fewfwefe21123

            $administrator->password = Hash::make($password); //12eu821djoiwfwovnwoirodqwiodjqw

            $administrator->save();
        }

         return response()->json([
            'data' => $administrator,
            'password' => $password,
         ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Administrator $administrator)
    {
        $administrator->delete();
        return response()->json($administrator, Response::HTTP_OK);
    }
}
