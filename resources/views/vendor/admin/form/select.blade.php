<div class="form-group {!! !$errors->has($errorKey) ?: 'has-error' !!}">

<label for="{{$id}}" class="col-sm-{{$width['label']}} control-label">{{$label}}</label>

    <div class="col-sm-{{$width['field']}}">

        @include('admin::form.error')

        <input type="hidden" name="{{$name}}"/>

        <select class="form-control {{$class}}" style="width: 100%;" name="{{$name}}" data-placeholder="{{ $placeholder }}" {!! $attributes !!} >
            <option></option>
            @foreach($options as $select => $option)
                @if(is_array($option))
                    <optgroup label="{{$select}}"></optgroup>
                    @foreach($option as $selectG => $optionG)
                        <option value="{{$selectG}}" {{ $selectG == old($column, $value) ?'selected':'' }}>{{$optionG}}</option>
                    @endforeach
                @else
                <option value="{{$select}}" {{ $select == old($column, $value) ?'selected':'' }}>{{$option}}</option>
                @endif
            @endforeach
        </select>

        @include('admin::form.help-block')

    </div>
</div>
