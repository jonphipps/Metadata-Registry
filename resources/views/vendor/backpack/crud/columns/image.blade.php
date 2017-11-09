<td>
  @if( !empty($entry->{$column['name']}) )
    <a
      href="{{ asset($entry->{$column['name']}) }}"
      target="_blank"
    >
      <img
        src="{{ asset( (isset($column['prefix']) ? $column['prefix'] : '') . $entry->{$column['name']}) }}"
        style="
          max-height: {{ isset($column['height']) ? $column['height'] : "25px" }};
          width: {{ isset($column['width']) ? $column['width'] : "auto" }};
          border-radius: 3px;"
      />
    </a>
  @else
    -
  @endif
</td>
