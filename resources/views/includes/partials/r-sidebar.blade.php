<div class="col-md-4 col-md-push-8">
    @if (Auth::check())
        <ul class="media-list">
        <li class="media">
            <div class="media-left">
                <img class="media-object" src="{{ $logged_in_user->picture }}" alt="Profile picture">
            </div>
            <! --media-left-->
            <div class="media-body">
                <h4 class="media-heading">{{ $logged_in_user->name }}<br/>
                    <small>
                        {{ $logged_in_user->email }}<br/>
                        Joined {{ $logged_in_user->created_at->format('F jS, Y') }}
                    </small>
                </h4>{{ \Collective\Html\link_to_route('frontend.user.account', trans('navs.frontend.user.account'), [], ['class' => 'btn btn-info btn-xs']) }}@permission('view-backend'){{ \Collective\Html\link_to_route('admin.dashboard', trans('navs.frontend.user.administration'), [], ['class' => 'btn btn-danger btn-xs']) }}@endauth
            </div><!--media-body--></li><!--media--></ul>
    <!--media-list-->
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Browse</h4>
        </div><!--panel-heading-->
        <div class="panel-body">
            <div class="list-group">
                <a href="projects" class="list-group-item">Projects</a>
                <a href="vocabularies" class="list-group-item">Vocabularies</a>
                <a href="elementsets" class="list-group-item">Element Sets</a>
            </div>
        </div><!--panel-body-->
    </div><!--panel-->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Search</h4>
        </div><!--panel-heading-->
        <div class="panel-body">
            <form class="form-inline" method="get" action="/conceptprop/search">
                <div class="form-group">
                    <label class="sr-only" for="concept_term">Vocabularies</label>
                    <input type="text" class="form-control" name="concept_term" id="concept_term" placeholder="Vocabularies">
                    <button type="submit" class="btn btn-sm btn-primary ">Search</button>
                </div>
            </form>
            <form class="form-inline" method="get" action="/schemaprop/search">
                <div class="form-group">
                    <label class="sr-only" for="exampleInputEmail3">Element Sets</label>
                    <input type="text" class="form-control" name="sq" id="sq" placeholder="Element Sets">
                    <button type="submit" class="btn btn-sm btn-primary ">Search</button>
                </div>
            </form>
        </div><!--panel-body-->
    </div><!--panel--></div>
