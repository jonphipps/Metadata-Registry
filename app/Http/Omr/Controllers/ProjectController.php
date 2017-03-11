<?php

namespace App\Http\Omr\Controllers;

use Admin;
use App\Models\ElementSet;
use App\Models\Project;
use App\Models\Vocabulary;
use Encore\Admin\Form;
use Encore\Admin\Form\Builder;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\BoxTools;
use Encore\Admin\Widgets\Form as WidgetForm;
use Illuminate\Auth\Access\AuthorizationException;

class ProjectController extends OmrController
{

  public function __construct()
  {
    //show has to be handled with a query scope in order to exclude private projects
    $this->authorizeResource(Project::class,
                             'project',
                             [ 'except' => [ 'view', 'index', 'show' ] ]);
  }

  /**
   * Index interface.
   *
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
          $grid->disableActions()->disableCreation()->disableExport()->disableRowSelector();
          $grid->org_name('Project Name')->display(function ($name) {
            return '<a href="' . url('projects/' . $this->id) . '">' . $name . '</a>';
          })->sortable();
          $grid->vocabularies('Vocabularies')->display(function ($vocabs) {
            $count = count($vocabs);

            return $count ?
                '<a href="' .
                url('projects/' . $this->id . '/vocabularies') .
                '">'. OmrController::badge($count) : '';
          });
          $grid->elementsets('Element Sets')->display(function ($elements) {
            $count = count($elements);

            return $count ?
                '<a href="' .
                url('projects/' . $this->id . '/elementsets') .
                '">'. OmrController::badge($count) : '';
          });
          $grid->created_at('Created')->datediff()->sortable();
          $grid->updated_at('Last Updated')->sortable()->datediff();
        });
  }

  /**
   * Edit interface.
   *
   * @param Project $project
   *
   * @return Content
   */
  public function edit(Project $project)
  {
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
   * @return Form
   */
  protected function form($mode = Builder::MODE_EDIT)
  {
    return Admin::form(Project::class,
        function (Form $form) use ($mode) {
          $form->tab('Descriptive Metadata',
              function (Form $form) {
                $form->text('org_name', 'Name');
              })->tab('Administrative Metadata',
                  function (Form $form) {
                    $form->display('id', 'ID');
                    $form->display('created_at', 'Created At');
                    $form->display('updated_at', 'Updated At');
                    $form->divider();
                  });
          //make a few changes if the mode is a view-only
          if ($mode == Builder::MODE_VIEW) {
            $this->addEditButtons($form, request()->project);
          }
        });
  }

  /**
   * Create interface.
   *
   * @return \Encore\Admin\Layout\Content
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
   * @param Project $project
   *
   * @return Content|\Illuminate\Http\RedirectResponse
   */
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
      $content->row($this->members($project->id));
      $content->row($this->vocabulariesForm($project->id));
      $content->row($this->elementSetsForm($project->id));
    });
  }

  /**
   * @param $id
   *
   * @return Box
   */
  private function members($id)
  {
    $project = request()->project;
    $count   = $project->members()->count();
    $form    = new WidgetForm();
    $options = $project->members()->get()->mapWithKeys(function ($item) {
      return [ $item['id'] => $item['name'] ];
    });
    $form->select('Select a Project Member')
        ->options($options)
        ->placeholder('Select a Project Member');

    $tools = new BoxTools();
    $tools->prepend(OmrController::createButton( 'Add a Member','project.user.create', ['project' => $project]));
    $box =  new Box('Members  ' . OmrController::badge($count), $form, $tools);
    return $box->collapsable();

  }

  /**
   * @param $id
   *
   * @return Box
   */
  private function vocabulariesForm($id)
  {
    $project = request()->project;
    $count   = $project->vocabularies()->count();
    $form    = new WidgetForm();
    $form->select('conceptSearch', 'Search Concept labels')
        ->options($project->conceptsForSelect())
        ->placeholder('Search for a Concept');
    $options = $project->vocabulariesForSelect();
    $form->select('vocabs', 'Select a Vocabulary')->options($options)->load('concepts', '/concepts/select','id', 'pref_label')->placeholder('Select a Vocabulary');
    $form->select('concepts', 'Select a Concept')->placeholder('Select a Vocabulary first');

    return new Box('Vocabularies  ' . OmrController::badge($count), $form);

  }

  /**
   * @param $id
   *
   * @return Box
   */
  private function elementSetsForm($id)
  {
    $project = request()->project;
    $count   = $project->elementSets()->count();
    $form    = new WidgetForm();
    $form->select('elementSearch', 'Search Element labels')->options($project->elementsForSelect())->placeholder('Search for an Element');
    $options = $project->elementSetsForSelect();
    $form->select('elementsets', 'Select Element Set')
        ->options($options)
        ->load('elements', '/elements/select', 'id', 'label')
        ->placeholder('Select an Element Set');
    $form->select('elements', 'Select Element')->placeholder('Select an Element Set first');

    return new Box('Element Sets  ' . OmrController::badge($count), $form);

  }

  /**
   * @param $id
   *
   * @return Box
   */
  private function vocabularies($id)
  {
    return new Box('Vocabularies',
      Admin::grid(Vocabulary::class,
          function (Grid $grid) use ($id) {
            $grid->filter(function ($filter) {
              $filter->like('name', 'name');
            });
            $grid->model()->setSortName('v')->setPerPageName('vp');
            $grid->disableActions()
                 ->disableCreation()
                 ->disableExport()
                 ->disableRowSelector();
            $grid->tools->disableRefreshButton();
            $grid->model()->where('agent_id', $id);
            $grid->id();
            $grid->name()->sortable();
          }));

  }

  /**
   * @param $id
   *
   * @return Box
   */
  private function elementsets($id)
  {
    return new Box('Element Sets', Admin::grid(ElementSet::class,
        function (Grid $grid) use ($id) {
          $grid->filter(function ($filter) {
            $filter->like('name', 'name');
          });
          $grid->model()->setSortName('e')->setPerPageName('ep');
          $grid->disableActions()
               ->disableCreation()
               ->disableExport()
               ->disableRowSelector();
          $grid->tools->disableRefreshButton();
          $grid->model()->where('agent_id', $id);
          $grid->id();
          $grid->name()->sortable();
        }));

  }


  /**
   * @param Project $project
   *
   * @return mixed
   */
  public function update(Project $project)
  {
    return $this->form()->update($project->id);
  }

  /**
   * @param Project $project
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function destroy(Project $project)
  {
    if ($this->form()->destroy($project->id)
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

  /**
   * @return mixed
   */
  public function store()
  {
    return $this->form()->store();
  }

}
