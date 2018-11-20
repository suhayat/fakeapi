<?php
namespace App\Http\Modules;

class Roles extends Modules {
    
    public function registerPermissions() {
    	$data = ['edit-roles','add-roles'];
    	$this->setPermissions($data);
    }
}