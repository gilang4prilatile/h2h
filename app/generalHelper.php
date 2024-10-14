<?php

use App\Models\Profile;
use Illuminate\Support\Facades\Route;

function filterDataTableToArray(string $form): array
{
    parse_str($form, $formArray);
    unset($formArray["_token"]);

    return $formArray;
}


function getUrlAction($action = '')
{
    $current = Route::getCurrentRoute();
    $uri = $current->uri;
    $as = $current->action["as"];
    $method = explode(".", $as);
    $method = end($method);
    $result = "";

    if ($method != 'getIndex') {
        $uriArr = collect(explode("/", $uri))->filter(function ($row) {
            return !str_contains($row, '{');
        });
        $result =  implode("/", $uriArr->all());
    } else {
        $result =  $uri . '/index';
    }

    if (!empty($action)) {
        $arrResult = explode("/", $result);
        $temp = [];
        foreach ($arrResult as $row) {
            if (end($arrResult) == $row) {
                $row = $action;
            }
            $temp[] = $row;
        }

        return implode("/", $temp);
    } else {
        return $result;
    }
}

function getUrlMenu()
{
    $action = getUrlAction();

    $exp = explode("/", $action);
    $count = count($exp);

    if ($count >= 3) {
        array_pop($exp);
    }

    return implode("/", $exp);
}

function selectBoxBc()
{
    return $bc = [
        '' => '---',
        23 => 23,
        40 => 40,
        27 => 27,
        25 => 25,
        41 => 41,
        27 => 27,
        30 => 30,
    ];
}

function selectStatusBC40()
{
    return $status_id = [
      '' => '---',
      1 => 'DRAFT',
        5 => 'DONE'
    ];
}

function selectStatusBC41()
{
    return $status_id = [
        '' => '---',
        2 => 'DRAFT',
        6 => 'DONE'
    ];
}

function selectStatusBC25()
{
    return $status_id = [
        '' => '---',
        2 => 'DRAFT',
        6 => 'DONE'
    ];
}


function selectStatusBC23()
{
    return $status_id = [
        '' => '---',
        3 => 'DRAFT',
        7 => 'DONE'
    ];
}

function selectStatusBC20()
{
    return $status_id = [
        '' => '---',
        11 => 'DRAFT LOCAL',
        12 => 'SEND TO BC',
        15 => 'RUNNING CEISA'
    ];
}


function selectStatusPartial()
{
    return $partial = [
        '' => '---',
        1 => 'IN PROGRESS',
        0 => 'DONE'
    ];
}


function selectStatusFakturPajak()
{
    return $faktur_pajak = [
        '' => '---',
        0 => 'IN PROGRESS',
        1 => 'DONE'
    ];
}

function getprofile ($type) {

    $user = auth()->user();
    if($user->profile_id){
        $profiletype = Profile::where('id','=',$user->profile_id)->first();
        if(in_array($type, $profiletype->types)){
            $profile = Profile::whereJsonContains('types', $type)
                        ->where('id',$user->profile_id)
                        ->orWhereJsonContains('types', $type)
                        ->where('created_by',$user->id)
                        ->orWhere('name','UNIAIR INDOTAMA CARGO')
                        ->orWhere('warehouse_id', $user->warehouse_id)
                        ->get()
                        ->pluck("name", "id");
        }else{
            $profile = Profile::whereJsonContains('types', $type)->get()->pluck("name", "id");
        }

        return $profile;
    }else if($user->warehouse_id){

        $profile = Profile::whereJsonContains('types', $type)
                        ->where('warehouse_id',$user->warehouse_id)
                        ->get()
                        ->pluck("name", "id");

        return $profile;

    }else{
        $profile = Profile::whereJsonContains('types', $type)->get()->pluck("name", "id");
        return $profile;
    }

}

function getkota(){
    
    $user = auth()->user();

    if($user->warehouse == null){
        $userkota = 0;
    }
    else{
        $userkota = $user->warehouse->city;
    }

    return $userkota;
}