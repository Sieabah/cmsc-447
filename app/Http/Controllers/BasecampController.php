<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Classes\Basecamp\BasecampAPI;
use App\Classes\Basecamp\BasecampClient;


class BasecampController extends Controller
{
    /**
     * @var BasecampAPI
     */
    protected $api;

    public function __construct(BasecampAPI $api)
    {
        $this->api = $api;
    }

    public function endpoint(Request $request, BasecampClient $bc){
        $token = $bc->web()->getAccessToken('authorization_code', ['code' => $request->input('code', '')]);

        Cache::forever('BCaccessToken', $token->getToken());
        Cache::forever('BCrefreshToken', $token->getRefreshToken());
        Cache::forever('BCexpiration', $token->getExpires());

        return redirect()->intended();
    }

    public function invalid(Request $request, $msg){
        return response()->json([
            'message' => 'Invalid API request: '.$msg
        ])->setStatusCode(400);
    }

    public function projects(Request $request){
        return $this->api->projects();
    }

    public function project(Request $request, $project){

        return response()->json($this->api->project($project));
    }

    public function peopleInProject(Request $request, $project){
        return $this->api->peopleInProject($project);
    }

    public function personProject(Request $request, $person){
        return null;
    }

    public function person(Request $request, $person){
        return $this->api->person($person);
    }

    public function personInfo(Request $request, $person){
        return response()->json($this->person($request, $person));
    }

    public function groups(Request $request){
        return $this->api->teams();
    }

    public function group(Request $request, $group){
        return $this->project($request, $group);
    }

    public function people(){
        return $this->api->people();
    }

    public function todos(Request $request, $status=null){
        if(!in_array($status, ['active', 'completed', null]))
            return $this->invalid($request, 'No valid todo status');

        return ['todos'];
        //return $this->api->get('')
    }
}
