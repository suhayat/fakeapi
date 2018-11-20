<?php

namespace App\Http\Controllers;

use JsValidator;
use Validator;
use Navigation;
use App\Enum\Access;
use Illuminate\Http\Request;
use App\Models\Article\ArticleRepository;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller {
    
    protected $model;

    public function __construct(
        ArticleRepository $article
    ) {
        $this->model = $article;
    }
    
    protected function validationRules($id = 0) {
        $rule['title'] = 'required|unique:articles'. ($id ? ",id,$id" : '');
        $rule['content'] = 'required';
        return $rule;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = $this->model->list($request->all());
            return $model;
        }

        return view('articles.index');
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {

            $validation = Validator::make($request->all(), $this->validationRules());
            if ($validation->fails()) {
                return redirect()->back()->withInput()->withErrors($validation->errors());
            }

            try {
                $this->model->create($request);
                session()->flash('success', 'Data berhasil disimpan');
                return redirect(Navigation::adminUrl('/articles'));
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->withErrors($e->getMessage());
            }
        }

        $validator = JsValidator::make($this->validationRules());

        return view('articles.form', compact('validator'));
    }

    public function edit($id, Request $request)
    {
        if ($request->isMethod('post')) {

            $validation = Validator::make($request->all(), $this->validationRules($id));
            if ($validation->fails()) {
                return redirect()->back()->withInput()->withErrors($validation->errors());
            }

            try {
                $this->model->update($id, $request);
                session()->flash('success', 'Data berhasil disimpan');
                return redirect(Navigation::adminUrl('/articles'));
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->withErrors($e->getMessage());
            }
        }

        $validator = JsValidator::make($this->validationRules($id));
        $model = $this->model->find($id);

        return view('articles.form', compact('model','validator'));
    }

    public function view($id)
    {
        $model = $this->model->find($id);
        return view('articles.view', compact('model'));
    }

    public function delete($id) 
    {
        try {
            session()->flash('success', 'Data berhasil dihapus');
            $result['success'] = $this->model->destroy($id);
        } catch (\Exception $e) {
            session()->flash('danger', $e->getMessage());
            $result['success'] = false;
        }

        return response()->json($result);
    }
}

