<?php

namespace App\Http\Omr\Controllers;

use App\Models\Project;
use App\Models\Vocabulary;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\ModelForm;

class VocabularyController extends OmrController

{
  use ModelForm;

  /**
   * Index interface.
   *
   * @param Project $project
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
    return Admin::grid(Vocabulary::class,
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
          //        return '<a href="' . url('vocabularies/' . $id) . '">' . $id . '</a>';
          //      })->sortable();
          $grid->column('name', 'Name')
               ->display(function ($name) {
                 return '<a href="' . url('vocabularies/' . $this->id) . '">' . $name . '</a>';
               })
               ->sortable();
          $grid->column('project.org_name', 'Project')
               ->display(function ($project) {
                 return '<a href="' . url('projects/' . $this->project['id']) . '">' . $project . '</a>';
               })
               ->sortable();
          $grid->concepts('Concepts')
               ->display(function ($concepts) {
                 $count = count($concepts);

                 return $count ? '<a href="' . url('vocabularies/' . $this->id . '/concepts') . '"><span class="badge">' . $count . '</span>' : '';

               });
          $grid->language();
          $grid->column('status.display_name', 'Status');
          $grid->created_at('Created')
               ->datediff()
               ->sortable();
          $grid->last_updated('Last Updated')
               ->sortable()
               ->datediff();
        });
  }

  /**
   * Make a form builder.
   *
   * @return \Form
   */
  protected function form()
  {
    return Admin::form(Vocabulary::class,
        function (Form $form) {
          $form->display('id', 'ID');
          $form->display('created_at', 'Created At');
          $form->display('updated_at', 'Updated At');
          $form->display('vocabulary.name', 'Name');
          $form->divide();
          $form->text('label', 'Label');

        });
  }
}
