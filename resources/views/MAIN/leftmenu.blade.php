<ul class="navigation slimmenu" id="navigation">
	@if( ! empty($menu['11']))
	<li {!! (Request::is( 'main/data_wilayah/provinsi')||Request::is( 'main/data_wilayah/provinsi/create')||Request::is( 'main/data_wilayah/kota')||Request::is( 'main/data_wilayah/kota/create')||Request::is( 'main/data_wilayah/kecamatan')||Request::is( 'main/data_wilayah/kecamatan/create')||Request::is( 'main/data_wilayah/kelurahan')||Request::is( 'main/data_wilayah/kelurahan/create')||
	Request::is( 'main/kel_faskel')||Request::is( 'main/kel_faskel/create')||Request::is( 'main/faskel')||Request::is( 'main/faskel/create')||Request::is( 'main/kota_korkot')||Request::is( 'main/kota_korkot/create')||Request::is( 'main/korkot')||Request::is( 'main/korkot/create')||Request::is( 'main/kmw')||Request::is( 'main/kmw/create')||Request::is( 'main/kmp_slum_program')||Request::is( 'main/kmp_slum_program/create')||Request::is( 'main/slum_program')||Request::is( 'main/slum_program/create')||Request::is( 'main/kmp')||Request::is( 'main/kmp/create')? 'class="menu-dropdown active"': 'class="menu-dropdown"') !!}>
        <a href="javascript:void(0)">
            <span class="mm-text">Master Data</span>
            <span class="fa arrow"></span>
        </a>
		<ul class="sub-menu">
			@if( ! empty($menu['18']))
			<li {!! (Request::is( 'main/data_wilayah/provinsi')||Request::is( 'main/data_wilayah/provinsi/create')||Request::is( 'main/data_wilayah/kota')||Request::is( 'main/data_wilayah/kota/create')||Request::is( 'main/data_wilayah/kecamatan')||Request::is( 'main/data_wilayah/kecamatan/create')||Request::is( 'main/data_wilayah/kelurahan')||Request::is( 'main/data_wilayah/kelurahan/create')? 'class="active"': "") !!}>
				<a href="javascript:void(0)">
					<span class="mm-text">Data Wilayah</span>
					<span class="fa arrow"></span>
				</a>
				<ul class="sub-menu form-submenu">
					@if( ! empty($menu['20']))
					<li {!! (Request::is( 'main/data_wilayah/provinsi')||Request::is( 'main/data_wilayah/provinsi/create')? 'class="active"': "") !!}>
						<a href="/main/data_wilayah/provinsi">
							<span class="mm-text">Propinsi</span>
						</a>
					</li>
					@endif
					@if( ! empty($menu['21']))
					<li {!! (Request::is( 'main/data_wilayah/kota')||Request::is( 'main/data_wilayah/kota/create')? 'class="active"': "") !!}>
						<a href="/main/data_wilayah/kota">
							<span class="mm-text">Kota / Kabupaten</span>
						</a>
					</li>
					@endif
					@if( ! empty($menu['22']))
					<li {!! (Request::is( 'main/data_wilayah/kecamatan')||Request::is( 'main/data_wilayah/kecamatan/create')? 'class="active"': "") !!}>
						<a href="/main/data_wilayah/kecamatan">
							<span class="mm-text">Kecamatan</span>
						</a>
					</li>
					@endif
					@if( ! empty($menu['23']))
					<li {!! (Request::is( 'main/data_wilayah/kelurahan')||Request::is( 'main/data_wilayah/kelurahan/create')? 'class="active"': "") !!}>
						<a href="/main/data_wilayah/kelurahan">
							<span class="mm-text">Kelurahan</span>
						</a>
					</li>
					@endif
				</ul>
			</li>
			@endif
			@if( ! empty($menu['19']))
			<li {!! (Request::is( 'main/kel_faskel')||Request::is( 'main/kel_faskel/create')||Request::is( 'main/faskel')||Request::is( 'main/faskel/create')||Request::is( 'main/kota_korkot')||Request::is( 'main/kota_korkot/create')||Request::is( 'main/korkot')||Request::is( 'main/korkot/create')||Request::is( 'main/kmw')||Request::is( 'main/kmw/create')||Request::is( 'main/kmp_slum_program')||Request::is( 'main/kmp_slum_program/create')||Request::is( 'main/slum_program')||Request::is( 'main/slum_program/create')||Request::is( 'main/kmp')||Request::is( 'main/kmp/create')? 'class="active"': "") !!}>
				<a href="javascript:void(0)">
					<span class="mm-text">Data Cakupan Program</span>
					<span class="fa arrow"></span>
				</a>
				<ul class="sub-menu form-submenu">
					@if( ! empty($menu['24']))
					<li {!! (Request::is( 'main/slum_program')||Request::is( 'main/slum_program/create')? 'class="active"': "") !!}>
				        <a href="/main/slum_program">
				            <span class="mm-text ">Slum Program</span>
				        </a>
				    </li>
					@endif
					@if( ! empty($menu['25']))
				    <li {!! (Request::is( 'main/kmp')||Request::is( 'main/kmp/create')? 'class="active"': "") !!}>
				        <a href="/main/kmp">
				            <span class="mm-text ">Konsultan Managemen Pusat (KMP)</span>
				        </a>
				    </li>
					@endif
					@if( ! empty($menu['26']))
					<li {!! (Request::is( 'main/kmp_slum_program')||Request::is( 'main/kmp_slum_program/create')? 'class="active"': "") !!}>
				        <a href="/main/kmp_slum_program">
				            <span class="mm-text ">Mapping KMP Ke Slum Program</span>
				        </a>
				    </li>
					@endif
					@if( ! empty($menu['27']))
					<li {!! (Request::is( 'main/kmw')||Request::is( 'main/kmw/create')? 'class="active"': "") !!}>
				        <a href="/main/kmw">
				            <span class="mm-text ">Konsultan Managemen Wilayah (KMW)</span>
				        </a>
				    </li>
					@endif
					@if( ! empty($menu['28']))
					<li {!! (Request::is( 'main/korkot')||Request::is( 'main/korkot/create')? 'class="active"': "") !!}>
				        <a href="/main/korkot">
				            <span class="mm-text ">Koordinator Kota (KorKot)</span>
				        </a>
				    </li>
					@endif
					@if( ! empty($menu['29']))
					<li {!! (Request::is( 'main/kota_korkot')||Request::is( 'main/kota_korkot/create')? 'class="active"': "") !!}>
				        <a href="/main/kota_korkot">
				            <span class="mm-text ">Mapping Kota Ke Korkot</span>
				        </a>
				    </li>
					@endif
					@if( ! empty($menu['30']))
					<li {!! (Request::is( 'main/faskel')||Request::is( 'main/faskel/create')? 'class="active"': "") !!}>
				        <a href="/main/faskel">
				            <span class="mm-text ">Tim Fasilitator Kelurahan (FasKel)</span>
				        </a>
				    </li>
					@endif
					@if( ! empty($menu['31']))
					<li {!! (Request::is( 'main/kel_faskel')||Request::is( 'main/kel_faskel/create')? 'class="active"': "") !!}>
				        <a href="/main/kel_faskel">
				            <span class="mm-text ">Mapping Faskel Ke Kelurahan</span>
				        </a>
				    </li>
					@endif
				</ul>
			</li>
			@endif
		</ul>
	</li>
	@endif
	@if( ! empty($menu['11']))
	<li {!! (Request::is( 'main/persiapan/kota/forum/bkm')||Request::is( 'main/persiapan/kota/forum/bkm/create')||Request::is( 'main/persiapan/kota/forum/kolaborasi')||Request::is( 'main/persiapan/kota/forum/kolaborasi/create')||Request::is( 'main/persiapan/kota/forum/f_forum')||Request::is( 'main/persiapan/kota/forum/f_forum/create')||Request::is( 'main/persiapan/kota/kegiatan/sosialisasi')||Request::is( 'main/persiapan/kota/kegiatan/sosialisasi/create')||Request::is( 'main/persiapan/kota/info')||Request::is( 'main/persiapan/kota/info/create')||Request::is( 'main/persiapan/kota/pokja/pembentukan')||Request::is( 'main/persiapan/kota/pokja/pembentukan/create')||Request::is( 'main/persiapan/kota/pokja/kegiatan')||Request::is( 'main/persiapan/kota/pokja/kegiatan/create')||Request::is( 'main/persiapan/propinsi/pokja/pembentukan')||Request::is( 'main/persiapan/propinsi/pokja/pembentukan/create')||Request::is( 'main/persiapan/propinsi/pokja/kegiatan')||Request::is( 'main/persiapan/propinsi/pokja/kegiatan/create')||Request::is( 'main/persiapan/nasional/pokja/pembentukan')||Request::is( 'main/persiapan/nasional/pokja/pembentukan/create')||Request::is( 'main/persiapan/nasional/pokja/kegiatan')||Request::is( 'main/persiapan/nasional/pokja/kegiatan/create') ? 'class="menu-dropdown active"': 'class="menu-dropdown"') !!}>
        <a href="javascript:void(0)">
            <span class="mm-text">Persiapan</span>
            <span class="fa arrow"></span>
        </a>
		<ul class="sub-menu">
			<li {!! (Request::is( 'main/persiapan/nasional/pokja/pembentukan')||Request::is( 'main/persiapan/nasional/pokja/pembentukan/create')||Request::is( 'main/persiapan/nasional/pokja/kegiatan')||Request::is( 'main/persiapan/nasional/pokja/kegiatan/create')? 'class="active"': 'class=""') !!}>
                <a href="javascript:void(0)">
                    <span class="mm-text">Nasional</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="sub-menu form-submenu">
					<li {!! (Request::is( 'main/persiapan/nasional/pokja/pembentukan')||Request::is( 'main/persiapan/nasional/pokja/pembentukan/create')||Request::is( 'main/persiapan/nasional/pokja/kegiatan')||Request::is( 'main/persiapan/nasional/pokja/kegiatan/create')? 'class="active"': "") !!}>
						<a href="javascript:void(0)">
		                    <span class="mm-text">Kelompok Kerja (Pokja)</span>
		                    <span class="fa arrow"></span>
		                </a>
						<ul class="sub-menu form-submenu">
							<li {!! (Request::is( 'main/persiapan/nasional/pokja/pembentukan')||Request::is( 'main/persiapan/nasional/pokja/pembentukan/create') ? 'class="active"': "") !!}>
								<a href="/main/persiapan/nasional/pokja/pembentukan">
				                    <span class="mm-text">Pembentukan</span>
				                </a>
						    </li>
							<li {!! (Request::is( 'main/persiapan/nasional/pokja/kegiatan')||Request::is( 'main/persiapan/nasional/pokja/kegiatan/create')? 'class="active"': "") !!}>
								<a href="/main/persiapan/nasional/pokja/kegiatan">
				                    <span class="mm-text">Kegiatan / Monitoring</span>
				                </a>
						    </li>
						</ul>
				    </li>
				</ul>
			</li>
			<li {!! (Request::is( 'main/persiapan/propinsi/pokja/pembentukan')||Request::is( 'main/persiapan/propinsi/pokja/pembentukan/create')||Request::is( 'main/persiapan/propinsi/pokja/kegiatan')||Request::is( 'main/persiapan/propinsi/pokja/kegiatan/create')? 'class="active"': 'class=""') !!}>
                <a href="javascript:void(0)">
                    <span class="mm-text">Propinsi</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="sub-menu form-submenu">
					<li {!! (Request::is( 'main/persiapan/propinsi/pokja/pembentukan')||Request::is( 'main/persiapan/propinsi/pokja/pembentukan/create')||Request::is( 'main/persiapan/propinsi/pokja/kegiatan')||Request::is( 'main/persiapan/propinsi/pokja/kegiatan/create')? 'class="active"': "") !!}>
						<a href="javascript:void(0)">
		                    <span class="mm-text">Kelompok Kerja (Pokja)</span>
		                    <span class="fa arrow"></span>
		                </a>
						<ul class="sub-menu form-submenu">
							<li {!! (Request::is( 'main/persiapan/propinsi/pokja/pembentukan')||Request::is( 'main/persiapan/propinsi/pokja/pembentukan/create')? 'class="active"': "") !!}>
								<a href="/main/persiapan/propinsi/pokja/pembentukan">
				                    <span class="mm-text">Pembentukan</span>
				                </a>
						    </li>
							<li {!! (Request::is( 'main/persiapan/propinsi/pokja/kegiatan')||Request::is( 'main/persiapan/propinsi/pokja/kegiatan/create')? 'class="active"': "") !!}>
								<a href="/main/persiapan/propinsi/pokja/kegiatan">
				                    <span class="mm-text">Kegiatan / Monitoring</span>
				                </a>
						    </li>
						</ul>
				    </li>
				</ul>
			</li>
			<li {!! (Request::is( 'main/persiapan/kota/forum/bkm')||Request::is( 'main/persiapan/kota/forum/bkm/create')||Request::is( 'main/persiapan/kota/forum/kolaborasi')||Request::is( 'main/persiapan/kota/forum/kolaborasi/create')||Request::is( 'main/persiapan/kota/forum/f_forum')||Request::is( 'main/persiapan/kota/forum/f_forum/create')||Request::is( 'main/persiapan/kota/kegiatan/sosialisasi')||Request::is( 'main/persiapan/kota/kegiatan/sosialisasi/create')||Request::is( 'main/persiapan/kota/info')||Request::is( 'main/persiapan/kota/info/create')||Request::is( 'main/persiapan/kota/pokja/pembentukan')||Request::is( 'main/persiapan/kota/pokja/pembentukan/create')||Request::is( 'main/persiapan/kota/pokja/kegiatan')||Request::is( 'main/persiapan/kota/pokja/kegiatan/create') ? 'class="active"': 'class=""') !!}>
                <a href="javascript:void(0)">
                    <span class="mm-text">Kota/Kabupaten</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="sub-menu form-submenu">
					<li {!! (Request::is( 'main/persiapan/kota/info')||Request::is( 'main/persiapan/kota/info/create') ? 'class="active"': "") !!}>
						<a href="/main/persiapan/kota/info">
							<span class="mm-text">Informasi Umum</span>
						</a>
					</li>
					<li {!! (Request::is( 'main/persiapan/kota/pokja/pembentukan')||Request::is( 'main/persiapan/kota/pokja/pembentukan/create')||Request::is( 'main/persiapan/kota/pokja/kegiatan')||Request::is( 'main/persiapan/kota/pokja/kegiatan/create')? 'class="active"': "") !!}>
						<a href="javascript:void(0)">
		                    <span class="mm-text">Kelompok Kerja (Pokja)</span>
		                    <span class="fa arrow"></span>
		                </a>
						<ul class="sub-menu form-submenu">
							<li {!! (Request::is( 'main/persiapan/kota/pokja/pembentukan')||Request::is( 'main/persiapan/kota/pokja/pembentukan/create')? 'class="active"': "") !!}>
								<a href="/main/persiapan/kota/pokja/pembentukan">
				                    <span class="mm-text">Pembentukan</span>
				                </a>
						    </li>
							<li {!! (Request::is( 'main/persiapan/kota/pokja/kegiatan')||Request::is( 'main/persiapan/kota/pokja/kegiatan/create')? 'class="active"': "") !!}>
								<a href="/main/persiapan/kota/pokja/kegiatan">
				                    <span class="mm-text">Kegiatan / Monitoring</span>
				                </a>
						    </li>
						</ul>
				    </li>
					<li {!! (Request::is( 'main/persiapan/kota/kegiatan/sosialisasi')||Request::is( 'main/persiapan/kota/kegiatan/sosialisasi/create') ? 'class="active"': "") !!}>
						<a href="javascript:void(0)">
		                    <span class="mm-text">Kegiatan</span>
		                    <span class="fa arrow"></span>
		                </a>
						<ul class="sub-menu form-submenu">
							<li {!! (Request::is( 'main/persiapan/kota/kegiatan/sosialisasi')||Request::is( 'main/persiapan/kota/kegiatan/sosialisasi/create') ? 'class="active"': "") !!}>
								<a href="/main/persiapan/kota/kegiatan/sosialisasi">
				                    <span class="mm-text">Sosialisasi & Relawan</span>
				                </a>
						    </li>
						</ul>
				    </li>
				    <li {!! (Request::is( 'main/persiapan/kota/forum/bkm')||Request::is( 'main/persiapan/kota/forum/bkm/create')||Request::is( 'main/persiapan/kota/forum/kolaborasi')||Request::is( 'main/persiapan/kota/forum/kolaborasi/create')||Request::is( 'main/persiapan/kota/forum/f_forum')||Request::is( 'main/persiapan/kota/forum/f_forum/create') ? 'class="active"': "") !!}>
						<a href="javascript:void(0)">
		                    <span class="mm-text">Forum Kota</span>
		                    <span class="fa arrow"></span>
		                </a>
						<ul class="sub-menu form-submenu">
							<li {!! (Request::is( 'main/persiapan/kota/forum/bkm')||Request::is( 'main/persiapan/kota/forum/bkm/create') ? 'class="active"': "") !!}>
								<a href="/main/persiapan/kota/forum/bkm">
				                    <span class="mm-text">BKM/LKM</span>
				                </a>
						    </li>
						</ul>
						<ul class="sub-menu form-submenu">
							<li {!! (Request::is( 'main/persiapan/kota/forum/kolaborasi')||Request::is( 'main/persiapan/kota/forum/kolaborasi/create') ? 'class="active"': "") !!}>
								<a href="/main/persiapan/kota/forum/kolaborasi">
				                    <span class="mm-text">Kolaborasi</span>
				                </a>
						    </li>
						</ul>
						<ul class="sub-menu form-submenu">
							<li {!! (Request::is( 'main/persiapan/kota/forum/f_forum')||Request::is( 'main/persiapan/kota/forum/f_forum/create') ? 'class="active"': "") !!}>
								<a href="/main/persiapan/kota/forum/f_forum">
				                    <span class="mm-text">Keberfungsian Forum</span>
				                </a>
						    </li>
						</ul>
				    </li>
				</ul>
			</li>
		</ul>
	</li>
	@endif
</ul>
<!-- / .navigation -->
