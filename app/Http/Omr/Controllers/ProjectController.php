<?php

namespace App\Http\omr\Controllers;

use App\Models\Project;
use Carbon\Carbon;
use Encore\Admin\Form;
use Encore\Admin\Form\Builder;
use Encore\Admin\Form\Tools;
use Encore\Admin\Grid;
use Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Auth\Access\AuthorizationException;
use PhpParser\Node\Stmt\TryCatch;

class ProjectController extends OmrController
{
  use ModelForm;

  public function __construct()
  {
    //show has to be handled with a query scope in order to exclude private projects
    $this->authorizeResource(Project::class, 'project', [ 'except' => [ 'view', 'index', 'show' ] ]);
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
          $grid->model()->public();

          $grid->filter(function ($filter) {
            $filter->like('org_name', 'name');
          });

          $grid->disableActions()
               ->disableCreation()
               ->disableExport()
               ->disableRowSelector();

          // $grid->id('ID')
          //      ->display(function ($id) {
          //        return '<a href="' . url('projects/' . $id) . '">' . $id . '</a>';
          //      })
          //      ->sortable();

          $grid->org_name('Project Name')
               ->display(function ($name) {
                 return '<a href="' . url('projects/' . $this->id) . '">' . $name . '</a>';
               })
               ->sortable();
          $grid->vocabularies('Vocabularies')
               ->display(function ($vocabs) {
                 $count = count($vocabs);

                 return $count ? '<a href="' . url('projects/' . $this->id . '/vocabularies') . '"><span class="badge">' . $count . '</span>' : '';

               });

          $grid->elementsets('Element Sets')
               ->display(function ($elements) {
                 $count = count($elements);

                 return $count ? '<a href="' . url('projects/' . $this->id . '/elementsets') . '"><span class="badge" >' . $count . '</span>' : '';

               });

          $grid->created_at('Created')
               ->datediff()->sortable();

          $grid->updated_at('Last Updated')
               ->sortable()->datediff();

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
   * @param string $mode
   *
   * @return \Form
   */
  protected function form($mode = Builder::MODE_EDIT)
  {
    return Admin::form(Project::class,
        function (Form $form) use ($mode) {
          $form->tab('Descriptive Metadata',
              function (Form $form) {
                $form->text('org_name', 'Name');
              })
               ->tab('Administrative Metadata',
                   function (Form $form) {
                     $form->display('id', 'ID');
                     $form->display('created_at', 'Created At');
                     $form->display('updated_at', 'Updated At');
                     $form->divider();
               });

          //make a few changes if the mode is a view-only
          if ($mode == Builder::MODE_VIEW) {
            $form->disableReset();
            if (auth()->check()) {
              $form->tools(function (Tools $tools) {
                $editButton = '<div class="btn-group pull-right" style="margin-right: 10px"><a href="' . request()->url() . '/edit" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i>&nbsp;' . trans('admin::lang.edit') . '</a></div>';
                if (auth()->user()->can('delete', request()->project)
                ) {
                  $tools->add(self::deleteButton());
                }
                if (auth()->user()->can('edit', request()->project)
                ) {
                  $tools->add($editButton);
                }
              });
            }
          }
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
    if ($project->is_private) {
      try {
        $this->authorize('view', $project);
      }
      catch (AuthorizationException $e) {
         return redirect()->route('frontend.auth.login');
      }
    }

    return Admin::content(function (Content $content) use ($project) {
      $content->header('Show Project');
      $content->description('');
      $content->row($this->form(Builder::MODE_VIEW)->view($project->id));
    });
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
    if ($this->form()->destroy($id)
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
    return $this->form()->store();
  }

  /**
   * Built delete action.
   *
   * @return string
   */
  private static function deleteButton()
  {
    $confirm = trans('admin::lang.delete_confirm');
    $text = trans('admin::lang.delete');
    $url = request()->url();
    $id = request()->project->id;
    $script = /** @lang JavaScript 1.5 */
        <<<SCRIPT
        
$('#form-delete-button').unbind('click').click(function() {
    if(confirm("{$confirm}")) {
        $.ajax({
            method: 'post',
            url: '{$url}',
            data: {
                _method:'delete',
                _token:LA.token,
            },
            success: function (data) {
                $.pjax.reload('#pjax-container');

                if (typeof data === 'object') {
                    if (data.status) {
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            }
        });
    }
});

SCRIPT;
    Admin::script($script);

    return /** @lang HTML */
        <<<EOT
        <div class="btn-group pull-right" style="margin-right: 10px">    
    <a href="javascript:void(0);" data-id="{$id}" id="form-delete-button" class="btn btn-sm btn-danger">
        <i class="fa fa-trash"></i>&nbsp;$text
    </a>
</div>
EOT;
  }
}
