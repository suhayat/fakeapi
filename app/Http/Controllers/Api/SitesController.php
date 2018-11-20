<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Site\Site;

class SitesController extends ApiController {
    
    
    public function getSiteConfig($domain, Request $request) 
    {
        $model = Site::where('domain', $domain)->first();
        if ($model) {
            return $this->responseOk($model);
        }

        return $this->responseFail('Config not found');
    }
}

