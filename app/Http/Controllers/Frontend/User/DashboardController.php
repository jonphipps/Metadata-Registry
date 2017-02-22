<?php

namespace App\Http\Controllers\Frontend\User;

use Admin;
use App\Http\Controllers\Controller;
use App\Models\ProjectHasUser;
use Auth;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Displayers\Actions;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\InfoBox;

class DashboardController extends Controller
{
  public function index()
  {
    return Admin::content(function (Content $content) {

      $user = Auth::user();
      $content->row(new Box('My Projects', $this->projectGrid()));

      // if ($user->projects()->count()) {
      //   $content->header('Dashboard');
      //   $content->description('This project has...');
      //
      //   $content->row(function ($row) {
      //     /** @var \Encore\Admin\Layout\Row $row */
      //     $row->column(3, new InfoBox('Value Vocabularies', 'users', 'aqua', '/admin/users', '1024'));
      //     $row->column(3, new InfoBox('Concepts', 'shopping-cart', 'green', '/admin/orders', '150%'));
      //     $row->column(3, new InfoBox('Element Sets', 'book', 'yellow', '/admin/articles', '2786'));
      //     $row->column(3, new InfoBox('Elements', 'file', 'red', '/admin/files', '698726'));
      //   });
      // } else {
      //   $content->header('Start by Adding a Project!');
      //   $content->row(function (Row $row) {
      //
      //     $row->column(6,
      //         '<a class="btn btn-primary btn-lg" href="projects/create">Add New Project...</a>');
      //   });
      // }

    });
  }


  /**
   * Make a grid builder.
   *
   * @return Grid
   */
  protected function projectGrid()
  {
    return Admin::grid(ProjectHasUser::class,
        function (Grid $grid) {
          $grid->model()->where('user_id', '=', Auth::id());
          $grid->resource('projects');

          $grid->disableExport();
            if (! Auth::user()->is_administrator) {
                $grid->actions(function ($actions) {
                    /** @var Actions $actions */
                    $actions->disableDelete();
                    $actions->disableEdit();
                    $actions->setResource('ProjectHasUser');
                    // append an action.
                    $actions->append('<a href="'.$actions->getResource().'/'.$actions->getKey().'" class="btn btn-xs btn-info" style="margin-right:4px">
                        <i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"></i></a>');
                });
            } else {
                $grid->actions(function ($actions) {
                    /** @var Actions $actions */
                    $actions->disableDelete();
                    $actions->disableEdit();
                    $actions->setResource('ProjectHasUser');

                        // append an action.
                    $actions->append(
                        '<a href="'.$actions->getResource().'/'.$actions->getKey().'" class="btn btn-xs btn-info" style="margin-right:4px">
                        <i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"></i></a>'
                    );
                        // prepend an action.
                    $actions->prepend(
                            '<a href="'.$actions->getResource().'/'.$actions->getKey().'/edit" class="btn btn-xs btn-primary" style="margin-right:4px">
                        <i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i></a>'
                    );
                });
            }

          // $grid->id('ID')->sortable()->display(function ($id) {
          //   return  '<a href="' . route('frontend.project.user.edit', [ 'id' => $id ]) . '">' . $id . '</a>';
          // });
          $grid->column('project.org_name', 'Name')->sortable()->display(function ($project) {
            $foo = '<a href="' . route('projects.show', [ 'id' => $this->agent_id ]) . '">' . $project . '</a>';

            return $foo;
          });

          $grid->is_registrar_for('Registrar')->bool();
          $grid->is_admin_for('Administrator')->bool();
          $grid->created_at()->sortable();
          $grid->updated_at()->sortable();
        });
  }

}
