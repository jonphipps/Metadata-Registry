@if ( Session::has('messageType') )
    <div id="messages">
        @if( Session::get('messageType') == 'error' )
            <div class="alert alert-danger">
        @elseif( Session::get('messageType') == 'success' )
            <div class="alert alert-success">
        @elseif( Session::get('messageType') == 'information' )
            <div class="alert alert-info">
        @endif
            <ul class="list-unstyled">
            @foreach( Session::get('messages') as $value )
                <li>{{ $value }}</li>
            @endforeach
            </ul>
        </div>
    </div>
@endif