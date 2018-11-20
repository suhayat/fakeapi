<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function responseOk($data, $message = 'successfully')
  	{
  		return response(["success" => true, "message" => $message, "data" => $data], 200);
  	}

  	protected function responseFail($errorMessage, $errorCode = 500)
  	{
  		return response(["success" => false, "message" => $errorMessage], $errorCode);
  	}
}
