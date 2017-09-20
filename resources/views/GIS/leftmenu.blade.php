<ul class="navigation slimmenu" id="navigation">
	<li {!! (Request::is('gis')? 'class="active"': "") !!}>
        <a href="{{url('gis')}}">
            <span class="mm-text ">Map </span>
        </a>
    </li>
	<li {!! (Request::is( 'gis/provinsi') || Request::is( 'gis/kota') || Request::is( 'gis/kecamatan')|| Request::is( 'gis/kelurahan') ? 'class="menu-dropdown active"': 'class="menu-dropdown"') !!}>
        <a href="javascript:void(0)">
            <span class="mm-text">Master Data</span>
            <span class="fa arrow"></span>
        </a>
		<ul class="sub-menu">
			<li {!! (Request::is( 'gis/provinsi')? 'class="active"': "") !!}>
                <a href="gis/provinsi">
                    <span class="mm-text"> Provinsi</span>
                </a>
            </li>
			<li {!! (Request::is( 'gis/kota')? 'class="active"': "") !!}>
                <a href="gis/provinsi">
                    <span class="mm-text"> Kota</span>
                </a>
            </li>
			<li {!! (Request::is( 'gis/kecamatan')? 'class="active"': "") !!}>
                <a href="gis/provinsi">
                    <span class="mm-text"> kecamatan</span>
                </a>
            </li>
			<li {!! (Request::is( 'gis/kelurahan')? 'class="active"': "") !!}>
                <a href="gis/provinsi">
                    <span class="mm-text"> kelurahan</span>
                </a>
            </li>
        </ul>
	</li>
</ul>
<!-- / .navigation -->
