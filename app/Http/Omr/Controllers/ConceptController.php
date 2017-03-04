<?php

namespace App\Http\Omr\Controllers;

use App\Models\Concept;
use App\Models\Vocabulary;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\ModelForm;

class ConceptController extends OmrController

{
  use ModelForm;

  /**
   * Index interface.
   *
   * @param Vocabulary $vocabulary
   *
   * @return \Encore\Admin\Content|Content
   */
  public function index(Vocabulary $vocabulary)
  {
    return Admin::content(function (Content $content) use ($vocabulary) {
      $content->header('Vocabulary:');
      $content->description($vocabulary->name);
      $content->body($this->grid($vocabulary));
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
      $content->body($this->form()
                          ->edit($id));
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
   * @return Grid
   */
  protected function grid($vocabulary)
  {
    return Admin::grid(Concept::class,
        function (Grid $grid) use ($vocabulary) {
          $grid->model()
               ->where('vocabulary_id', $vocabulary->id);
          $grid->disableActions()
               ->disableCreation()
               ->disableExport()
               ->disableRowSelector();
          $grid->column('pref_label', 'Name')
               ->display(function ($name) {
                 return '<a href="' . url('concepts/' . $this->id) . '">' . $name . '</a>';
               })
               ->sortable();
          $grid->language();
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
    return Admin::form(Concept::class,
        function (Form $form) {
          $form->display('id', 'ID');
          $form->display('created_at', 'Created At');
          $form->display('updated_at', 'Updated At');
        });
  }
}
