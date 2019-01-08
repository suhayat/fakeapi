<?php
namespace App\Models\Site;

use DB;

class SiteRepository
{

    protected $model;
      
    public function __construct(Site $model) {
        $this->model = $model;
    }

    public function list($request)
    {
        $limit = (!empty($request['limit'])) ? $request['limit'] : 10;
     
        $model = $this->model->select('sites.id','sites.website_name')
                ->searchOrder($request, ['sites.id','sites.website_name'])
                ->paginate($limit);

        return (new SiteTransformer)->transformPaginate($model);
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
        $model->website_name = $request->input('website_name');
        $model->domain = $request->input('domain');
        $model->logo = $request->input('logo');
        $model->layout = $request->input('layout');
        $model->meta_description = $request->input('meta_description');
        $model->meta_tag = $request->input('meta_tag');
        $model->css_style = $request->input('css_style');
        $model->facebook_key = $request->input('facebook_key');
        $model->google_key = $request->input('google_key');
        $model->save();
        DB::commit();
        return true;
    }

    public function update($id, $request)
    {
        DB::beginTransaction();
        $model = $this->model->find($id);
        $model->website_name = $request->input('website_name');
        $model->domain = $request->input('domain');
        $model->logo = $request->input('logo');
        $model->layout = $request->input('layout');
        $model->meta_description = $request->input('meta_description');
        $model->meta_tag = $request->input('meta_tag');
        $model->css_style = $request->input('css_style');
        $model->facebook_key = $request->input('facebook_key');
        $model->google_key = $request->input('google_key');
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