
<ul class="navigation slimmenu" id="navigation">
    <li {!! (Request::is( 'index')|| Request::is( '/')? 'class="active"': "") !!}>
        <a href="{{url('/')}}">
            <span class="mm-text ">Dashboard 1</span>
        </a>
    </li>
    <li {!! (Request::is( 'index2')? 'class="active"': "") !!}>
        <a href="{{url('index2')}}">
            <span class="mm-text ">Dashboard 2</span>
        </a>
    </li>
</ul>
<!-- / .navigation -->
