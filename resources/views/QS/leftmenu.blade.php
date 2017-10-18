<ul class="navigation slimmenu" id="navigation">
	@if( ! empty($menu['7']))
	<li {!! (Request::is( 'role_leve')? 'class="active"': "") !!}>
        <a href="javascript:void(0)">
            <span class="mm-text ">Master</span>
			<span class="fa arrow"></span>
        </a>
		<ul class="sub-menu">
			@if( ! empty($menu['18']))
			<li {!! (Request::is( 'qs/master/agenda*')? 'class="active"': "") !!}>
				<a href="/qs/master/agenda">
					<span class="mm-text">Agenda</span>
				</a>
			</li>
		</ul>
    </li>
	@endif
	@if( ! empty($menu['9']))
    <li {!! (Request::is( 'role')|| Request::is( '/hrm/role')? 'class="active"': "") !!}>
        <a href="javascript:void(0)">
            <span class="mm-text ">Monitoring</span>
			<span class="fa arrow"></span>
        </a>
		<ul class="sub-menu">
			@if( ! empty($menu['18']))
			<li {!! (Request::is( 'qs/master/agenda*')? 'class="active"': "") !!}>
				<a href="/qs/master/agenda">
					<span class="mm-text">Agenda</span>
				</a>
			</li>
		</ul>
    </li>
	@endif
</ul>
<!-- / .navigation -->
