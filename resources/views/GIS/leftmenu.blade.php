<ul class="navigation slimmenu" id="navigation">
	<li {!! (Request::is('gis')? 'class="active"': "") !!}>
        <a href="{{url('gis')}}">
            <span class="mm-text ">Map </span>
        </a>
    </li>
	<li {!! (Request::is( 'gis/provinsi') || Request::is('gis/provinsi/create') || Request::is( 'gis/kota') || Request::is('gis/kota/create') || Request::is( 'gis/kecamatan') || Request::is('gis/kecamatan/create') || Request::is( 'gis/kelurahan') || Request::is('gis/kelurahan/create') ? 'class="menu-dropdown active"': 'class="menu-dropdown"') !!}>
        <a href="javascript:void(0)">
            <span class="mm-text">Master Data</span>
            <span class="fa arrow"></span>
        </a>
		<ul class="sub-menu">
			<li {!! (Request::is( 'gis/provinsi') || Request::is('gis/provinsi/create') ? 'class="active"': "") !!}>
                <a href="/gis/provinsi">
                    <span class="mm-text"> Provinsi</span>
                </a>
            </li>
			<li {!! (Request::is( 'gis/kota') || Request::is('gis/kota/create') ? 'class="active"': "") !!}>
                <a href="/gis/kota">
                    <span class="mm-text"> Kota</span>
                </a>
            </li>
			<li {!! (Request::is( 'gis/kecamatan') || Request::is('gis/kecamatan/create') ? 'class="active"': "") !!}>
                <a href="/gis/kecamatan">
                    <span class="mm-text"> Kecamatan</span>
                </a>
            </li>
			<li {!! (Request::is( 'gis/kelurahan') || Request::is('gis/kelurahan/create')? 'class="active"': "") !!}>
                <a href="/gis/kelurahan">
                    <span class="mm-text"> Kelurahan</span>
                </a>
            </li>
        </ul>
	</li>
</ul>
<!-- / .navigation -->
