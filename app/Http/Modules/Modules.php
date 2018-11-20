<?php
namespace App\Http\Modules;

class Modules {
    
    public $permissions = [];

    public function getPermissions() {
    	return $this->permissions;
    }

    public function setPermissions($arr = []) {
    	global $arr;
        $this->permissions = $arr;
    }
}