<?php

namespace App\Http\Omr\Controllers;

use App\Models\ElementSet;
use App\Models\Project;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\ModelForm;

class ElementSetController extends OmrController

{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return \Encore\Admin\Content|Content
     */
  public function index(Project $project)
    {
    return Admin::content(function (Content $content) use ($project) {
      $content->header( 'Project:');
      $content->description($project->org_name ?? '');
      $content->body($this->grid($project));
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     *
     * @return \Encore\Admin\Content|Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return \Encore\Admin\Content|Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
   * @param Project $project
   *
     * @return Grid
     */
  protected function grid($project)
    {
        return Admin::grid(ElementSet::class,
            function (Grid $grid) use ($project) {
              if ($project) {
                $grid->model()
                     ->where('agent_id', $project->id);
              }
              $grid->disableActions()
                   ->disableCreation()
                   ->disableExport()
                   ->disableRowSelector();
              // $grid->id('ID')
              //      ->display(function ($id) {
              //        return '<a href="' . url('elementsets/' . $id) . '">' . $id . '</a>';
              //      })
              //      ->sortable();
              $grid->column('name', 'Name')
                   ->display(function ($name) {
                     return '<a href="' . url('elementsets/' . $this->id) . '">' . $name . '</a>';
                   })
                   ->sortable();
              $grid->column('project.org_name', 'Project')
                   ->display(function ($project) {
                     return '<a href="' . url('projects/' . $this->project['id']) . '">' . $project . '</a>';
                   })
                   ->sortable();
              $grid->elements('Elements')
                   ->display(function ($elements) {
                     $count = count($elements);

                     return $count ? '<a href="' . url('elementsets/' . $this->id . '/elements') . '"><span class="badge">' . $count . '</span>' : '';

                   });
              $grid->column('status.display_name', 'Status');
              $grid->created_at('Created')
                   ->datediff()
                   ->sortable();
              $grid->updated_at('Last Updated')
                   ->sortable()
                   ->datediff();
            });
    }

    /**
     * Make a form builder.
     *
     * @return Form|\Form
     */
    protected function form()
    {
        return Admin::form(ElementSet::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
