<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdministratorScopeRequest;
use App\Models\Administrator;
use App\Models\AdministratorScope;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Laravel\Passport\Passport;

class AdministratorScopeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function index(Administrator $administrator)
    {
        $scopes = $administrator->administratorScopes;
        return response()->json($scopes, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdministratorScopeRequest $request, Administrator $administrator)
    {

        $scope = $administrator->administratorScopes()->create($request->validated());

        foreach($administrator->tokens as $token)
                $token->revoke();

        return $scope;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Administrator  $administrator
     * @param  \App\Models\AdministratorScope  $administratorScope
     * @return \Illuminate\Http\Response
     */
    public function show(Administrator $administrator, AdministratorScope $administratorScope)
    {
        return response()->json($administratorScope, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Administrator  $administrator
     * @param  \App\Models\AdministratorScope  $administratorScope
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Administrator $administrator, AdministratorScope $administratorScope)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Administrator  $administrator
     * @param  \App\Models\AdministratorScope  $administratorScope
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdministratorScope $administratorScope)
    {
        $administrator = $administratorScope->administrator;
        $administratorScope->delete();
        foreach($administrator->tokens as $token)
                $token->revoke();
    }
}
