<div id="saveActions" class="form-group">

    <input type="hidden" name="save_action" value="{{ $saveAction['active']['value'] }}">
    <nav class="navbar btn-toolbar sw-toolbar sw-toolbar-bottom">
        <div class="btn-group navbar-btn sw-btn-group-extra pull-right" role="group">
            @if($wizard['last'])
            <button class="btn btn-info">Finish</button>
            @endif
            <a href="{{ url($crud->route) }}" class="btn btn-default"><span class="fa fa-ban"></span>
                &nbsp;{{ trans('backpack::crud.cancel') }}</a>
        </div>
        <div class="btn-group navbar-btn sw-btn-group pull-right" role="group">
            <button class="btn btn-default sw-btn-prev @if($wizard['step'] === 1) disabled @endif" type="button">Previous</button>
            @unless($wizard['last'])
            <button class="btn btn-default sw-btn-next" type="button">Next</button>
                @endif
        </div>
    </nav>
</div>
