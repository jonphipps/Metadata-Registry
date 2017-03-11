<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-03-04,  Time: 2:05 PM */

namespace App\Http\Omr\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Admin;
use Encore\Admin\Form;
use Encore\Admin\Form\Tools;
use Illuminate\Database\Eloquent\Model;

class OmrController extends Controller
{
  /**
   * @param Form $form
   * @param Model $resource
   *
   */
  function addEditButtons(Form &$form, $resource): void
  {
      $form->disableReset();
      if (auth()->check()) {
        $form->tools(function (Tools $tools) use ($resource) {
          if (auth()->user()->can('delete', $resource)) {
            $tools->add(OmrController::deleteButton($resource->id));
          }
          if (auth()->user()->can('edit', $resource)) {
            $tools->add(OmrController::editButton());
          }
        });
      }
    }

  /**
   * @return string
   */
  private static function editButton()
  {
    return '<div class="btn-group pull-right" style="margin-right: 10px"><a href="' .
        request()->url() .
        '/edit" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i>&nbsp;' .
        trans('admin::lang.edit') .
        '</a></div>';
  }

  /**
   * @param string $caption
   * @param string $route
   * @param array|null $routeParams
   *
   * @return string
   */
  public static function createButton($caption = '', $route = '', $routeParams = null)
  {
    $route   = route($route, $routeParams) ?? request()->url() . '/create';
    $caption = $caption ?? trans('admin::lang.create');
    return <<<EOT
<div class="btn-group pull-right" style="margin-right: 10px">
  <a href="{$route}" class="btn btn-sm btn-success">
    <i class="fa fa-plus-square-o"></i>
    &nbsp;$caption
  </a>
</div>
EOT;

  }

  /**
   * Built delete action.
   *
   * @param int $id
   *
   * @return string
   */
  private static function deleteButton($id)
  {
    $confirm = trans('admin::lang.delete_confirm');
    $text    = trans('admin::lang.delete');
    $url     = request()->url();
    $script  = /** @lang JavaScript 1.5 */
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

  public static function badge($count)
  {
    return '<span class="badge">' . $count . '</span>';
  }
}
