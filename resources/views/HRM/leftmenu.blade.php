
<ul class="navigation slimmenu" id="navigation">
    <li {!! (Request::is( 'role')|| Request::is( '/hrm/role')? 'class="active"': "") !!}>
        <a href="{{url('/hrm/role')}}">
            <span class="mm-text ">Role</span>
        </a>
    </li>
    <li {!! (Request::is( 'role_leve')? 'class="active"': "") !!}>
        <a href="{{url('/hrm/role_level')}}">
            <span class="mm-text ">Role Level</span>
        </a>
    </li>
    <li {!! (Request::is( 'modul')? 'class="active"': "") !!}>
        <a href="{{url('/hrm/modul')}}">
            <span class="mm-text ">Modul</span>
        </a>
    </li>
</ul>
<!-- / .navigation -->
