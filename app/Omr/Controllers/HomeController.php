<?php

namespace App\Omr\Controllers;

use Admin;
use App\Http\Controllers\Controller;
use Auth;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\InfoBox;

class HomeController extends Controller
{
  public function index()
  {
    return Admin::content(function (Content $content) {

      $user = Auth::user();
      if ($user) {
        if ($user->projects()->count()) {
          $content->header('Dashboard');
          $content->description('This project has...');

          $content->row(function ($row) {
            /** @var \Encore\Admin\Layout\Row $row */
            $row->column(3, new InfoBox('Value Vocabularies', 'users', 'aqua', '/admin/users', '1024'));
            $row->column(3, new InfoBox('Concepts', 'shopping-cart', 'green', '/admin/orders', '150%'));
            $row->column(3, new InfoBox('Element Sets', 'book', 'yellow', '/admin/articles', '2786'));
            $row->column(3, new InfoBox('Elements', 'file', 'red', '/admin/files', '698726'));
          });
        } else {
          $content->header('Start by Adding a Project!');
          $content->row(function (Row $row) {

            $row->column(6, '<a class="btn btn-block btn-primary btn-lg" href="projects/create">Add New Project...</a>');
          });
        }
      }
    });

  }
}
