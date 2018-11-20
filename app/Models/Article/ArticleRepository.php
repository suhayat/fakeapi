<?php
namespace App\Models\Article;

use DB;
use Illuminate\Support\Str;

class ArticleRepository
{

    protected $model;
      
    public function __construct(Article $model) {
        $this->model = $model;
    }

    public function list($request)
    {
        $limit = (!empty($request['limit'])) ? $request['limit'] : 10;
     
        $model = $this->model->select('articles.id','articles.title')
                ->searchOrder($request, ['articles.id','articles.title'])
                ->paginate($limit);

        return (new ArticleTransformer)->transformPaginate($model);
    }

    public function find($id)
    {
        $model = $this->model->findOrFail($id);
        return $model;
    }
     
    public function create($request)
    {
        DB::beginTransaction();
        $model = $this->model;
        $model->title = $request->input('title');
        $model->slug = str_slug($request->input('title'), '-');
        $model->short_content = Str::words(strip_tags($request->input('content')), 80);
        $model->content = $request->input('content');
        $model->save();
        DB::commit();
        return true;
    }

    public function update($id, $request)
    {
        DB::beginTransaction();
        $model = $this->model->find($id);
        $model->title = $request->input('title');
        $model->slug = str_slug($request->input('title'), '-');
        $model->short_content = Str::words(strip_tags($request->input('content')), 80);
        $model->content = $request->input('content');
        $model->save();
        DB::commit();
        return true;
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        $model = $this->model->find($id);
        $model->delete();
        DB::commit();
        return true;
    }
}