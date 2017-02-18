<?php

namespace App\Http\Omr\Controllers;

use App\Models\Vocabulary;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class VocabularyController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return \Encore\Admin\Layout\Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
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
     * @return Content
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
    protected function grid()
    {
        return Admin::grid(Vocabulary::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->column('name','Name');
            $grid->column('project.org_name','Project');
            $grid->column('status.display_name', 'Status');

            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return \Form
     */
    protected function form()
    {
        return Admin::form(Vocabulary::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
            $form->display('project.org_name','Project');
            $form->divide();
            $form->text('label','Label');

        });
    }
}
