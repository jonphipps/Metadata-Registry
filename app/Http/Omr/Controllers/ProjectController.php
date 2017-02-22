<?php

namespace App\Http\omr\Controllers;

use App\Models\Project;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ProjectController extends Controller
{
    use ModelForm;

    public function __construct()
    {
        $this->authorizeResource(Project::class, 'project');
    }

    /**
     * Index interface.
     *
     * @return \Encore\Admin\Content|Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Projects');
            $content->description('This is the Projects table');

            $content->body($this->grid());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Project::class,
            function (Grid $grid) {

                $grid->id('ID')->sortable();

                $grid->created_at();
                $grid->updated_at();
            });
    }

    /**
     * Edit interface.
     *
     * @param Project $project
     *
     * @return \Encore\Admin\Content|Content
     */
    public function edit(Project $project)
    {
        //$id = $project->id;
        //$this->authorize('update', $project);

        return Admin::content(function (Content $content) use ($project) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($project->id));
        });
    }

    /**
     * Make a form builder.
     *
     * @return \Form
     */
    protected function form()
    {
        return Admin::form(Project::class,
            function (Form $form) {

                $form->display('id', 'ID');

                $form->display('created_at', 'Created At');
                $form->display('updated_at', 'Updated At');
            });
    }

    /**
     * Create interface.
     *
     * @return \Encore\Admin\Content|Content
     */
    public function create()
    {
        //$this->authorize('create', Project::class);

        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    public function show(Project $project)
    {
        return Admin::content(function (Content $content) use ($project) {

            $content->header('Show Project');
            $content->description($project->org_name);

            $content->body($this->display($project));
        });
    }

    private function display(Project $project)
    {
        $str = '<dl class="dl-horizontal">';
        foreach ($project->attributesToArray() as $key => $value) {
            $str .= "<dt>$key</dt><dd>$value</dd>";
        }
        $str.='</dl>';
        return $str;
    }

    public function update(Project $project)
    {
        $id = $project->id;
        //$this->authorize('update', $project);

        return $this->form()->update($id);
    }

    public function destroy(Project $project)
    {
        $id = $project->id;
        //$this->authorize('destroy', $project);

        if ($this->form()->destroy($id)) {
            return response()->json([
                'status'  => true,
                'message' => trans('admin::lang.delete_succeeded'),
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => trans('admin::lang.delete_failed'),
            ]);
        }
    }

    public function store()
    {
        //$this->authorize('create', Project::class);

        return $this->form()->store();
    }
}
