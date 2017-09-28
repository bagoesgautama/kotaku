
<ul class="navigation slimmenu" id="navigation">
    <li {!! (Request::is( 'hrm/role')|| Request::is( '/hrm/role')? 'class="active"': "") !!}>
        <a href="/hrm/role">
            <span class="mm-text ">Role</span>
        </a>
    </li>
    <li {!! (Request::is( 'hrm/role_leve')? 'class="active"': "") !!}>
        <a href="/hrm/role_level">
            <span class="mm-text ">Role Level</span>
        </a>
    </li>
    <li {!! (Request::is( 'hrm/modul')? 'class="active"': "") !!}>
        <a href="/hrm/modul">
            <span class="mm-text ">Modul</span>
        </a>
    </li>
	<li {!! (Request::is( 'hrm/role_akses')? 'class="active"': "") !!}>
        <a href="/hrm/role_akses">
            <span class="mm-text ">Role Akses</span>
        </a>
    </li>
</ul>
<!-- / .navigation -->
