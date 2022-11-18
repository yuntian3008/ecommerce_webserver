<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\AdministratorScope;
use Illuminate\Http\Request;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Administrator $administrator)
    {
        $request->validate([
            'scopes' => [
                'required',
                'array'
            ],
            'scopes.*' => [
                Rule::in(Passport::scopeIds())
            ]
        ]);
        $scopes = $request->scopes;

        foreach ($scopes as $value) {
            $inserts[] = ['scope' => $value ];
        }
        $r =  $administrator->administratorScopes()->createMany($inserts);

        foreach($administrator->tokens as $token)
                $token->revoke();

        return $r;
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
        //
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
    public function destroy(Administrator $administrator, AdministratorScope $administratorScope)
    {
        $administrator->administratorScopes()->delete();
    }
}
