<?php
namespace App\Http\Modules;

class Users extends Modules{

    public function registerPermissions() {
    	$data = ['edit-users','add-users'];
    	$this->setPermissions($data);
    }
}