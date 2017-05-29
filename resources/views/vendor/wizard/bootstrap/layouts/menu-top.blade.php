<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        {!! Html::linkRoute('frontend.user.dashboard', 'Home', array(), array('class' => 'navbar-brand')) !!}
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav navbar-right">
            <li>{!! Html::linkRoute('frontend.flows.step', 'Start flow', array(1)) !!}</li>
        </ul>
    </div>
</nav>
