<?php

namespace App\Http\Omr\Controllers;

use App\Models\Element;
use App\Models\ElementSet;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ElementController extends OmrController

{
    use ModelForm;

  /**
   * Index interface.
   *
   * @param ElementSet $elementSet
   *
   * @return \Encore\Admin\Content|Content
   */
    public function index(ElementSet $elementSet)
    {
        return Admin::content(function (Content $content) use ($elementSet) {

            $content->header('Element Set:');
            $content->description($elementSet->name);

            $content->body($this->grid($elementSet));
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
   * @param ElementSet $elementSet
   *
   * @return Grid
   */
  protected function grid($elementSet)
  {
    return Admin::grid(Element::class,
        function (Grid $grid) use ($elementSet) {
          $grid->model()
               ->where('schema_id', $elementSet->id);
          $grid->disableActions()
               ->disableCreation()
               ->disableExport()
               ->disableRowSelector();
          $grid->column('name', 'Name')
               ->display(function ($name) {
                 return '<a href="' . url('elements/' . $this->id) . '">' . $name . '</a>';
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
        return Admin::form(Element::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
