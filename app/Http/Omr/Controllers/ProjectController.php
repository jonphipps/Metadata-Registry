<?php

namespace App\Http\omr\Controllers;

use App\Models\Project;
use Carbon\Carbon;
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
    //show has to be handled with a query scope in order to exclude private projects
    $this->authorizeResource(Project::class, 'project', [ 'except' => [ 'view', 'show' ] ]);
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
          $grid->model()
               ->public();

          $grid->filter(function ($filter) {
            $filter->like('org_name', 'name');
          });

          $grid->disableActions()
               ->disableCreation()
               ->disableExport()
               ->disableRowSelector();

          $grid->id('ID')
               ->display(function ($id) {
                 return '<a href="' . url('projects/' . $id) . '">' . $id . '</a>';
               })
               ->sortable();

          $grid->org_name('Project Name')
               ->sortable();

          $grid->vocabularies('Vocabularies')
               ->display(function ($vocabs) {
                 $count = count($vocabs);

                 return $count ? '<a href="' . url('projects/' . $this->id . '/vocabularies') . '"><span class="badge">' . $count . '</span>' : '';

               });

          $grid->vocabulary_count();

          $grid->elementsets('Element Sets')
               ->display(function ($elements) {
                 $count = count($elements);

                 return $count ? '<a href="' . url('projects/' . $this->id . '/elementsets') . '"><span class="badge">' . $count . '</span>' : '';

               });

          $grid->created_at('Created')
               ->display(function ($dt) {
                 return Carbon::parse($dt)
                              ->diffForHumans();
               })
               ->sortable();

          $grid->updated_at('Last Updated')
               ->display(function ($dt) {
                 return Carbon::parse($dt)
                              ->diffForHumans() . " ($dt)";
               })
               ->sortable();
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
      $content->body($this->form()
                          ->edit($project->id));
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
      $content->description('');
      $content->body($this->display($project));
    });
  }

  private function display(Project $project)
  {
    $url = url('projects');
    $str= <<<EOT
    <div class="box-header with-border">
        <h3 class="box-title">$project->org_name</h3>

        <div class="box-tools">

            <div class="btn-group pull-right" style="margin-right: 10px">
                <a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;Delete</a>
            </div>

            <div class="btn-group pull-right" style="margin-right: 10px">
                <a class="btn btn-sm btn-primary" href="$project->id/edit"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
            </div>

            <div class="btn-group pull-right" style="margin-right: 10px">
                <a href="$url" class="btn btn-sm btn-default form-history-back"><i class="fa fa-list"></i>&nbsp;List</a>
            </div>

        </div>
    </div>
    <!-- /.box-header -->
    
EOT;

    $str .= '<dl class="dl-horizontal">';
    foreach ($project->attributesToArray() as $key => $value) {
      $str .= "<dt>$key</dt><dd>$value</dd>";
    }
    $str .= '</dl>';

    return $str;
  }

  public function update(Project $project)
  {
    $id = $project->id;

    //$this->authorize('update', $project);
    return $this->form()
                ->update($id);
  }

  public function destroy(Project $project)
  {
    $id = $project->id;
    //$this->authorize('destroy', $project);
    if ($this->form()
             ->destroy($id)
    ) {
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
    return $this->form()
                ->store();
  }
}
