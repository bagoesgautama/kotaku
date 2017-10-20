<ul class="navigation slimmenu" id="navigation">
	@if( ! empty($menu['148']))
	<li {!! (Request::is( 'qs/master/*')? 'class="active"': "") !!}>
        <a href="javascript:void(0)">
            <span class="mm-text ">Master</span>
			<span class="fa arrow"></span>
        </a>
		<ul class="sub-menu form-submenu">
			@if( ! empty($menu['150']))
			<li {!! (Request::is( 'qs/master/agenda*')? 'class="active"': "") !!}>
				<a href="/qs/master/agenda">
					<span class="mm-text">Agenda</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['151']))
			<li {!! (Request::is( 'qs/master/kegiatan_kelurahan*')? 'class="active"': "") !!}>
				<a href="/qs/master/kegiatan_kelurahan">
					<span class="mm-text">Kegiatan Skala Kelurahan</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['152']))
			<li {!! (Request::is( 'qs/master/kegiatan_kota*')? 'class="active"': "") !!}>
				<a href="/qs/master/kegiatan_kota">
					<span class="mm-text">Kegiatan Skala Kota</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['153']))
			<li {!! (Request::is( 'qs/master/schedule*')? 'class="active"': "") !!}>
				<a href="/qs/master/schedule">
					<span class="mm-text">Master Schedule</span>
				</a>
			</li>
			@endif
		</ul>
    </li>
	@endif
	@if( ! empty($menu['149']))
    <li {!! (Request::is( 'qs/monitoring/*')? 'class="active"': "") !!}>
        <a href="javascript:void(0)">
            <span class="mm-text ">Monitoring</span>
			<span class="fa arrow"></span>
        </a>
		<ul class="sub-menu form-submenu">
			@if( ! empty($menu['154']))
			<li {!! (Request::is( 'qs/monitoring/kelurahan*')? 'class="active"': "") !!}>
				<a href="/qs/monitoring/kelurahan">
					<span class="mm-text">Kegiatan Skala Kelurahan</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['155']))
			<li {!! (Request::is( 'qs/monitoring/kota*')? 'class="active"': "") !!}>
				<a href="/qs/monitoring/kota">
					<span class="mm-text">Kegiatan Skala Kota</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['156']))
			<li {!! (Request::is( 'qs/monitoring/status*')? 'class="active"': "") !!}>
				<a href="/qs/monitoring/status">
					<span class="mm-text">Report Progress Update Status</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['157']))
			<li {!! (Request::is( 'qs/monitoring/status_kelurahan*')? 'class="active"': "") !!}>
				<a href="/qs/monitoring/status_kelurahan">
					<span class="mm-text">Update Status Kegiatan Skala Kelurahan</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['158']))
			<li {!! (Request::is( 'qs/monitoring/status_kota*')? 'class="active"': "") !!}>
				<a href="/qs/monitoring/status_kota">
					<span class="mm-text">Update Status Kegiatan Skala Kota</span>
				</a>
			</li>
			@endif
		</ul>
    </li>
	@endif
</ul>
<!-- / .navigation -->
