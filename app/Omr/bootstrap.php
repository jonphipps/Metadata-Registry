<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

Encore\Admin\Form::forget(['map', 'editor']);

Encore\Admin\Grid\Column::extend('bool',
    function ($value) {
      return $value ? "<i class='fa fa-check' style='color:green'></i>" : "";
});
Encore\Admin\Grid\Column::extend('link',
    function ($route, $id, $label) {
      return '<a href="' . route($route, ['id' => $id])  . '">' . $label . '</a>';
    });
