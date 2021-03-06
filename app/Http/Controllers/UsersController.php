<?php

namespace App\Http\Controllers;

use JsValidator;
use Validator;
use Navigation;
use App\Enum\Access;
use Illuminate\Http\Request;
use App\Models\User\UserRepository;
use App\Models\Role\RoleRepository;
use App\Http\Controllers\Controller;
use App\Models\User\User;

class UsersController extends Controller {
    
    protected $model;
    protected $role;

    public function __construct(
        UserRepository $user, 
        RoleRepository $role
    ) {
        $this->model = $user;
        $this->role = $role;
    }
    
    protected function validationRules($scope = 'create', $id = 0) {
        $rule['name'] = 'required';
        $rule['username'] = 'required|unique:users'. ($id ? ",id,$id" : '');
        $rule['role_id'] = 'required';
        $rule['email'] = 'required|email|unique:users'. ($id ? ",id,$id" : '');
        if ($scope == 'create') {
            $rule['password'] = 'required';
        }
        return $rule;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = $this->model->list($request->all());
            return $users;
        }

        return view('users.index');
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {

            $validation = Validator::make($request->all(), $this->validationRules());
            if ($validation->fails()) {
                return redirect()->back()->withInput()->withErrors($validation->errors());
            }

            try {
                $this->model->create($request->all());
                session()->flash('success', 'Data berhasil disimpan');
                return redirect(Navigation::adminUrl('/users'));
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->withErrors($e->getMessage());
            }
        }

        $roles = $this->role->getOptions();
        $validator = JsValidator::make($this->validationRules());

        return view('users.form', compact('roles','validator'));
    }

    public function edit($id, Request $request)
    {
        if ($id == Access::DEVELOPER) {
            return abort(404);
        }

        if ($request->isMethod('post')) {

            $validation = Validator::make($request->all(), $this->validationRules('edit', $id));
            if ($validation->fails()) {
                return redirect()->back()->withInput()->withErrors($validation->errors());
            }

            try {
                $this->model->update($id, $request->all());
                session()->flash('success', 'Data berhasil disimpan');
                return redirect(Navigation::adminUrl('/users'));
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->withErrors($e->getMessage());
            }
        }

        $roles = $this->role->getOptions();
        $validator = JsValidator::make($this->validationRules('edit', $id));
        $model = $this->model->find($id);

        return view('users.form', compact('model','roles','validator'));
    }

    public function view($id)
    {
        $model = $this->model->find($id);
        return view('users.view', compact('model'));
    }

    public function delete($id) 
    {
        if ($id == Access::DEVELOPER) {
            return abort(404);
        }
        
        try {
            session()->flash('success', 'Data berhasil dihapus');
            $result['success'] = $this->model->destroy($id);
        } catch (\Exception $e) {
            session()->flash('danger', $e->getMessage());
            $result['success'] = false;
        }

        return response()->json($result);
    }

    public function getBasic()
    {
        return view('users.basic');
    }

    public function getBasicData()
    {
        $users = User::select(['id','name','email','created_at','updated_at']);

        return \Datatables::of($users)->make();
    }
}

