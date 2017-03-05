<?php

namespace App\Http\Omr\Controllers;

use App\Models\Access\User\User;

use Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\ModelForm;

class UserController extends OmrController

{

  use ModelForm;

  private $mode;


  /**
   * Index interface.
   *
   * @return Content
   */
  public function index()
  {
    return Admin::content(function (Content $content) {

      $content->header('Users');
      $content->description('This is the Users table');

      $content->body($this->grid());
    });
  }


  /**
   * Edit interface.
   *
   * @param $id
   *
   * @return Content
   */
  public function edit($id)
  {
    return Admin::content(function (Content $content) use ($id) {
      $this->mode = 'edit';

      $content->header('header');
      $content->description('description');

      $content->body($this->form()->edit($id));
    });
  }


  /**
   * Create interface.
   *
   * @return Content
   */
  public function create()
  {
    return Admin::content(function (Content $content) {

      $this->mode = 'create';
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
  protected function grid()
  {
    /**
     * @param Grid $grid
     */

    return Admin::grid(
        User::class,
        function (Grid $grid) {

          /** @var \Encore\Admin\Grid $grid */
          $grid->id('ID')->sortable();
          $grid->name()->sortable();
          $grid->email()->sortable();

          $grid->created_at();
          $grid->updated_at();

          $grid->filter(function ($filter) {

            // Sets the range query for the created_at field
            $filter->between('created_at', 'Created Time')->datetime();
          });
        });
  }


  /**
   * Make a form builder.
   *
   * @return Form
   */
  protected function form()
  {
    return Admin::form(User::class,
        function (Form $form) {

          if ($this->mode !== 'create' && Admin::user()->isRole('Administrator')) {
            $form->display('id', 'ID');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
            $form->divide();
          }

          $form->text('name', 'User Name')->rules('required')->attribute('autofocus')->help('This is some help text');
          $form->email('email', 'Email')->rules('required');
          if ($this->mode !== 'create') {
            $form->password('password', 'Password');
          } else {
            $form->password('password', 'Password')->rules('required');
          }

          $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password !== $form->password) {
              $form->password = bcrypt($form->password);
            }
          });
        });
  }
}
