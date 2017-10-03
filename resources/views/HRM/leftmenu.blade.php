<ul class="navigation slimmenu" id="navigation">
	@if( ! empty($menu['7']))
	<li {!! (Request::is( 'role_leve')? 'class="active"': "") !!}>
        <a href="{{url('/hrm/role_level')}}">
            <span class="mm-text ">Role Level</span>
        </a>
    </li>
	@endif
	@if( ! empty($menu['9']))
    <li {!! (Request::is( 'role')|| Request::is( '/hrm/role')? 'class="active"': "") !!}>
        <a href="{{url('/hrm/role')}}">
            <span class="mm-text ">Role</span>
        </a>
    </li>
	@endif
	@if( ! empty($menu['10']))
		<li {!! (Request::is( 'hrm/role_akses')? 'class="active"': "") !!}>
	        <a href="/hrm/role_akses">
	            <span class="mm-text ">Role Akses</span>
	        </a>
	    </li>
	@endif
</ul>
<!-- / .navigation -->
