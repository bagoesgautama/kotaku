<ul class="navigation slimmenu" id="navigation">
	@if( ! empty($menu['11']))
	<li {!! (Request::is( 'main/data_wilayah/provinsi')||Request::is( 'main/data_wilayah/provinsi/create')||Request::is( 'main/data_wilayah/kota')||Request::is( 'main/data_wilayah/kota/create')||Request::is( 'main/data_wilayah/kecamatan')||Request::is( 'main/data_wilayah/kecamatan/create')||Request::is( 'main/data_wilayah/kelurahan')||Request::is( 'main/data_wilayah/kelurahan/create')||Request::is( 'main/kel_faskel')||Request::is( 'main/kel_faskel/create')||Request::is( 'main/faskel')||Request::is( 'main/faskel/create')||Request::is( 'main/kota_korkot')||Request::is( 'main/kota_korkot/create')||Request::is( 'main/korkot')||Request::is( 'main/korkot/create')||Request::is( 'main/kmw')||Request::is( 'main/kmw/create')||Request::is( 'main/kmp_slum_program')||Request::is( 'main/kmp_slum_program/create')||Request::is( 'main/slum_program')||Request::is( 'main/slum_program/create')||Request::is( 'main/kmp')||Request::is( 'main/kmp/create')? 'class="menu-dropdown active"': 'class="menu-dropdown"') !!}>
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
	@if( ! empty($menu['12']))
	<li {!! (Request::is( 'main/persiapan/kelurahan/pelatihan')||Request::is( 'main/persiapan/kelurahan/pelatihan/create')||Request::is( 'main/persiapan/kelurahan/agen_sosialisasi')||Request::is( 'main/persiapan/kelurahan/agen_sosialisasi/create')||Request::is( 'main/persiapan/kelurahan/relawan')||Request::is( 'main/persiapan/kelurahan/relawan/create')||Request::is( 'main/persiapan/kelurahan/sosialisasi')||Request::is( 'main/persiapan/kelurahan/sosialisasi/create')||Request::is( 'main/persiapan/kelurahan/info')||Request::is( 'main/persiapan/kelurahan/info/create')||Request::is( 'main/persiapan/kecamatan/keberfungsian')||Request::is( 'main/persiapan/kecamatan/keberfungsian/create')||Request::is( 'main/persiapan/kecamatan/kolaborasi')||Request::is( 'main/persiapan/kecamatan/kolaborasi/create')||Request::is( 'main/persiapan/kecamatan/bkm')||Request::is( 'main/persiapan/kecamatan/bkm/create')||Request::is( 'main/persiapan/kota/forum/bkm')||Request::is( 'main/persiapan/kota/forum/bkm/create')||Request::is( 'main/persiapan/kota/forum/kolaborasi')||Request::is( 'main/persiapan/kota/forum/kolaborasi/create')||Request::is( 'main/persiapan/kota/forum/f_forum')||Request::is( 'main/persiapan/kota/forum/f_forum/create')||Request::is( 'main/persiapan/kota/kegiatan/sosialisasi')||Request::is( 'main/persiapan/kota/kegiatan/sosialisasi/create')||Request::is( 'main/persiapan/kota/info')||Request::is( 'main/persiapan/kota/info/create')||Request::is( 'main/persiapan/kota/pokja/pembentukan')||Request::is( 'main/persiapan/kota/pokja/pembentukan/create')||Request::is( 'main/persiapan/kota/pokja/kegiatan')||Request::is( 'main/persiapan/kota/pokja/kegiatan/create')||Request::is( 'main/persiapan/propinsi/pokja/pembentukan')||Request::is( 'main/persiapan/propinsi/pokja/pembentukan/create')||Request::is( 'main/persiapan/propinsi/pokja/kegiatan')||Request::is( 'main/persiapan/propinsi/pokja/kegiatan/create')||Request::is( 'main/persiapan/nasional/pokja/pembentukan')||Request::is( 'main/persiapan/nasional/pokja/pembentukan/create')||Request::is( 'main/persiapan/nasional/pokja/kegiatan')||Request::is( 'main/persiapan/nasional/pokja/kegiatan/create') ? 'class="menu-dropdown active"': 'class="menu-dropdown"') !!}>
        <a href="javascript:void(0)">
            <span class="mm-text">Persiapan</span>
            <span class="fa arrow"></span>
        </a>
		<ul class="sub-menu">
			@if( ! empty($menu['32']))
			<li {!! (Request::is( 'main/persiapan/nasional/pokja/pembentukan')||Request::is( 'main/persiapan/nasional/pokja/pembentukan/create')||Request::is( 'main/persiapan/nasional/pokja/kegiatan')||Request::is( 'main/persiapan/nasional/pokja/kegiatan/create')? 'class="active"': 'class=""') !!}>
                <a href="javascript:void(0)">
                    <span class="mm-text">Nasional</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="sub-menu form-submenu">
					@if( ! empty($menu['37']))
					<li {!! (Request::is( 'main/persiapan/nasional/pokja/pembentukan')||Request::is( 'main/persiapan/nasional/pokja/pembentukan/create')||Request::is( 'main/persiapan/nasional/pokja/kegiatan')||Request::is( 'main/persiapan/nasional/pokja/kegiatan/create')? 'class="active"': "") !!}>
						<a href="javascript:void(0)">
		                    <span class="mm-text">Kelompok Kerja (Pokja)</span>
		                    <span class="fa arrow"></span>
		                </a>
						<ul class="form-sub-submenu">
							@if( ! empty($menu['47']))
							<li {!! (Request::is( 'main/persiapan/nasional/pokja/pembentukan')||Request::is( 'main/persiapan/nasional/pokja/pembentukan/create') ? 'class="active"': "") !!}>
								<a href="/main/persiapan/nasional/pokja/pembentukan">
				                    <span class="mm-text">Pembentukan</span>
				                </a>
						    </li>
							@endif
							@if( ! empty($menu['48']))
							<li {!! (Request::is( 'main/persiapan/nasional/pokja/kegiatan')||Request::is( 'main/persiapan/nasional/pokja/kegiatan/create')? 'class="active"': "") !!}>
								<a href="/main/persiapan/nasional/pokja/kegiatan">
				                    <span class="mm-text">Kegiatan / Monitoring</span>
				                </a>
						    </li>
							@endif
						</ul>
				    </li>
					@endif
				</ul>
			</li>
			@endif
			@if( ! empty($menu['33']))
			<li {!! (Request::is( 'main/persiapan/propinsi/pokja/pembentukan')||Request::is( 'main/persiapan/propinsi/pokja/pembentukan/create')||Request::is( 'main/persiapan/propinsi/pokja/kegiatan')||Request::is( 'main/persiapan/propinsi/pokja/kegiatan/create')? 'class="active"': 'class=""') !!}>
                <a href="javascript:void(0)">
                    <span class="mm-text">Propinsi</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="sub-menu form-submenu">
					@if( ! empty($menu['38']))
					<li {!! (Request::is( 'main/persiapan/propinsi/pokja/pembentukan')||Request::is( 'main/persiapan/propinsi/pokja/pembentukan/create')||Request::is( 'main/persiapan/propinsi/pokja/kegiatan')||Request::is( 'main/persiapan/propinsi/pokja/kegiatan/create')? 'class="active"': "") !!}>
						<a href="javascript:void(0)">
		                    <span class="mm-text">Kelompok Kerja (Pokja)</span>
		                    <span class="fa arrow"></span>
		                </a>
						<ul class="form-sub-submenu">
							@if( ! empty($menu['49']))
							<li {!! (Request::is( 'main/persiapan/propinsi/pokja/pembentukan')||Request::is( 'main/persiapan/propinsi/pokja/pembentukan/create')? 'class="active"': "") !!}>
								<a href="/main/persiapan/propinsi/pokja/pembentukan">
				                    <span class="mm-text">Pembentukan</span>
				                </a>
						    </li>
							@endif
							@if( ! empty($menu['50']))
							<li {!! (Request::is( 'main/persiapan/propinsi/pokja/kegiatan')||Request::is( 'main/persiapan/propinsi/pokja/kegiatan/create')? 'class="active"': "") !!}>
								<a href="/main/persiapan/propinsi/pokja/kegiatan">
				                    <span class="mm-text">Kegiatan / Monitoring</span>
				                </a>
						    </li>
							@endif
						</ul>
				    </li>
					@endif
				</ul>
			</li>
			@endif
			@if( ! empty($menu['34']))
			<li {!! (Request::is( 'main/persiapan/kota/forum/bkm')||Request::is( 'main/persiapan/kota/forum/bkm/create')||Request::is( 'main/persiapan/kota/forum/kolaborasi')||Request::is( 'main/persiapan/kota/forum/kolaborasi/create')||Request::is( 'main/persiapan/kota/forum/f_forum')||Request::is( 'main/persiapan/kota/forum/f_forum/create')||Request::is( 'main/persiapan/kota/kegiatan/sosialisasi')||Request::is( 'main/persiapan/kota/kegiatan/sosialisasi/create')||Request::is( 'main/persiapan/kota/info')||Request::is( 'main/persiapan/kota/info/create')||Request::is( 'main/persiapan/kota/pokja/pembentukan')||Request::is( 'main/persiapan/kota/pokja/pembentukan/create')||Request::is( 'main/persiapan/kota/pokja/kegiatan')||Request::is( 'main/persiapan/kota/pokja/kegiatan/create') ? 'class="active"': 'class=""') !!}>
                <a href="javascript:void(0)">
                    <span class="mm-text">Kota/Kabupaten</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="sub-menu form-submenu">
					@if( ! empty($menu['40']))
					<li {!! (Request::is( 'main/persiapan/kota/info')||Request::is( 'main/persiapan/kota/info/create') ? 'class="active"': "") !!}>
						<a href="/main/persiapan/kota/info">
							<span class="mm-text">Informasi Umum</span>
						</a>
					</li>
					@endif
					@if( ! empty($menu['39']))
					<li {!! (Request::is( 'main/persiapan/kota/pokja/pembentukan')||Request::is( 'main/persiapan/kota/pokja/pembentukan/create')||Request::is( 'main/persiapan/kota/pokja/kegiatan')||Request::is( 'main/persiapan/kota/pokja/kegiatan/create')? 'class="active"': "") !!}>
						<a href="javascript:void(0)">
		                    <span class="mm-text">Kelompok Kerja (Pokja)</span>
		                    <span class="fa arrow"></span>
		                </a>
						<ul class="form-sub-submenu">
							@if( ! empty($menu['51']))
							<li {!! (Request::is( 'main/persiapan/kota/pokja/pembentukan')||Request::is( 'main/persiapan/kota/pokja/pembentukan/create')? 'class="active"': "") !!}>
								<a href="/main/persiapan/kota/pokja/pembentukan">
				                    <span class="mm-text">Pembentukan</span>
				                </a>
						    </li>
							@endif
							@if( ! empty($menu['52']))
							<li {!! (Request::is( 'main/persiapan/kota/pokja/kegiatan')||Request::is( 'main/persiapan/kota/pokja/kegiatan/create')? 'class="active"': "") !!}>
								<a href="/main/persiapan/kota/pokja/kegiatan">
				                    <span class="mm-text">Kegiatan / Monitoring</span>
				                </a>
						    </li>
							@endif
						</ul>
				    </li>
					@endif
					@if( ! empty($menu['41']))
					<li {!! (Request::is( 'main/persiapan/kota/kegiatan/sosialisasi')||Request::is( 'main/persiapan/kota/kegiatan/sosialisasi/create') ? 'class="active"': "") !!}>
						<a href="javascript:void(0)">
		                    <span class="mm-text">Kegiatan</span>
		                    <span class="fa arrow"></span>
		                </a>
						<ul class="form-sub-submenu">
							@if( ! empty($menu['53']))
							<li {!! (Request::is( 'main/persiapan/kota/kegiatan/sosialisasi')||Request::is( 'main/persiapan/kota/kegiatan/sosialisasi/create') ? 'class="active"': "") !!}>
								<a href="/main/persiapan/kota/kegiatan/sosialisasi">
				                    <span class="mm-text">Sosialisasi & Relawan</span>
				                </a>
						    </li>
							@endif
						</ul>
				    </li>
					@endif
					@if( ! empty($menu['42']))
				    <li {!! (Request::is( 'main/persiapan/kota/forum/bkm')||Request::is( 'main/persiapan/kota/forum/bkm/create')||Request::is( 'main/persiapan/kota/forum/kolaborasi')||Request::is( 'main/persiapan/kota/forum/kolaborasi/create')||Request::is( 'main/persiapan/kota/forum/f_forum')||Request::is( 'main/persiapan/kota/forum/f_forum/create') ? 'class="active"': "") !!}>
						<a href="javascript:void(0)">
		                    <span class="mm-text">Forum Kota</span>
		                    <span class="fa arrow"></span>
		                </a>
						<ul class="form-sub-submenu">
							@if( ! empty($menu['54']))
							<li {!! (Request::is( 'main/persiapan/kota/forum/bkm')||Request::is( 'main/persiapan/kota/forum/bkm/create') ? 'class="active"': "") !!}>
								<a href="/main/persiapan/kota/forum/bkm">
				                    <span class="mm-text">BKM/LKM</span>
				                </a>
						    </li>
							@endif
							@if( ! empty($menu['55']))
							<li {!! (Request::is( 'main/persiapan/kota/forum/kolaborasi')||Request::is( 'main/persiapan/kota/forum/kolaborasi/create') ? 'class="active"': "") !!}>
								<a href="/main/persiapan/kota/forum/kolaborasi">
				                    <span class="mm-text">Kolaborasi</span>
				                </a>
						    </li>
							@endif
							@if( ! empty($menu['56']))
							<li {!! (Request::is( 'main/persiapan/kota/forum/f_forum')||Request::is( 'main/persiapan/kota/forum/f_forum/create') ? 'class="active"': "") !!}>
								<a href="/main/persiapan/kota/forum/f_forum">
				                    <span class="mm-text">Keberfungsian Forum</span>
				                </a>
						    </li>
							@endif
						</ul>
				    </li>
					@endif
				</ul>
			</li>
			@endif
			@if( ! empty($menu['35']))
			<li {!! (Request::is( 'main/persiapan/kecamatan/keberfungsian')||Request::is( 'main/persiapan/kecamatan/keberfungsian/create')||Request::is( 'main/persiapan/kecamatan/kolaborasi')||Request::is( 'main/persiapan/kecamatan/kolaborasi/create')||Request::is( 'main/persiapan/kecamatan/bkm')||Request::is( 'main/persiapan/kecamatan/bkm/create') ? 'class="active"': 'class=""') !!}>
                <a href="javascript:void(0)">
                    <span class="mm-text">Kecamatan</span>
                    <span class="fa arrow"></span>
                </a>
				<ul class="sub-menu form-submenu">
					@if( ! empty($menu['57']))
					<li {!! (Request::is( 'main/persiapan/kecamatan/bkm')||Request::is( 'main/persiapan/kecamatan/bkm/create') ? 'class="active"': "") !!}>
						<a href="/main/persiapan/kecamatan/bkm">
							<span class="mm-text">Forum BKM/LKM</span>
						</a>
					</li>
					@endif
					@if( ! empty($menu['58']))
					<li {!! (Request::is( 'main/persiapan/kecamatan/kolaborasi')||Request::is( 'main/persiapan/kecamatan/kolaborasi/create') ? 'class="active"': "") !!}>
						<a href="/main/persiapan/kecamatan/kolaborasi">
							<span class="mm-text">Forum Kolaborasi</span>
						</a>
					</li>
					@endif
					@if( ! empty($menu['59']))
					<li {!! (Request::is( 'main/persiapan/kecamatan/keberfungsian')||Request::is( 'main/persiapan/kecamatan/keberfungsian/create') ? 'class="active"': "") !!}>
						<a href="/main/persiapan/kecamatan/keberfungsian">
							<span class="mm-text">Keberfungsian Forum</span>
						</a>
					</li>
					@endif
				</ul>
			</li>
			@endif
			@if( ! empty($menu['36']))
			<li {!! (Request::is( 'main/persiapan/kelurahan/lembaga/federasi_upk')||Request::is( 'main/persiapan/kelurahan/lembaga/federasi_upk/create')||Request::is( 'main/persiapan/kelurahan/lembaga/bdc')||Request::is( 'main/persiapan/kelurahan/lembaga/bdc/create')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/tabungan')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/tabungan/create')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/fasil_bdc')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/fasil_bdc/create')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/syariah')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/syariah/create')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/ppmk')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/ppmk/create')||Request::is( 'main/persiapan/kelurahan/lembaga/tapp')||Request::is( 'main/persiapan/kelurahan/lembaga/tapp/create')||Request::is( 'main/persiapan/kelurahan/lembaga/tipp')||Request::is( 'main/persiapan/kelurahan/lembaga/tipp/create')||Request::is( 'main/persiapan/kelurahan/lembaga/organisasai_pengelola')||Request::is( 'main/persiapan/kelurahan/lembaga/organisasai_pengelola/create')||Request::is( 'main/persiapan/kelurahan/pemilu_bkm')||Request::is( 'main/persiapan/kelurahan/pemilu_bkm/create')||Request::is( 'main/persiapan/kelurahan/forum/keberfungsian')||Request::is( 'main/persiapan/kelurahan/forum/keberfungsian/create')||Request::is( 'main/persiapan/kelurahan/forum/keanggotaan')||Request::is( 'main/persiapan/kelurahan/forum/keanggotaan/create')||Request::is( 'main/persiapan/kelurahan/pelatihan')||Request::is( 'main/persiapan/kelurahan/pelatihan/create')||Request::is( 'main/persiapan/kelurahan/agen_sosialisasi')||Request::is( 'main/persiapan/kelurahan/agen_sosialisasi/create')||Request::is( 'main/persiapan/kelurahan/relawan')||Request::is( 'main/persiapan/kelurahan/relawan/create')||Request::is( 'main/persiapan/kelurahan/sosialisasi')||Request::is( 'main/persiapan/kelurahan/sosialisasi/create')||Request::is( 'main/persiapan/kelurahan/info')||Request::is( 'main/persiapan/kelurahan/info/create') ? 'class="active"': 'class=""') !!}>
                <a href="javascript:void(0)">
                    <span class="mm-text">Kelurahan</span>
                    <span class="fa arrow"></span>
                </a>
				<ul class="sub-menu form-submenu">
					@if( ! empty($menu['66']))
					<li {!! (Request::is( 'main/persiapan/kelurahan/info')||Request::is( 'main/persiapan/kelurahan/info/create') ? 'class="active"': "") !!}>
						<a href="/main/persiapan/kelurahan/info">
							<span class="mm-text">Informasi Umum</span>
						</a>
					</li>
					@endif
					@if( ! empty($menu['60']))
					<li {!! (Request::is( 'main/persiapan/kelurahan/pelatihan')||Request::is( 'main/persiapan/kelurahan/pelatihan/create')||Request::is( 'main/persiapan/kelurahan/agen_sosialisasi')||Request::is( 'main/persiapan/kelurahan/agen_sosialisasi/create')||Request::is( 'main/persiapan/kelurahan/relawan')||Request::is( 'main/persiapan/kelurahan/relawan/create')||Request::is( 'main/persiapan/kelurahan/sosialisasi')||Request::is( 'main/persiapan/kelurahan/sosialisasi/create') ? 'class="active"': "") !!}>
						<a href="javascript:void(0)">
							<span class="mm-text">Kegiatan Kelurahan</span>
							<span class="fa arrow"></span>
						</a>
						<ul class="form-sub-submenu">
							@if( ! empty($menu['62']))
							<li {!! (Request::is( 'main/persiapan/kelurahan/sosialisasi')||Request::is( 'main/persiapan/kelurahan/sosialisasi/create') ? 'class="active"': "") !!}>
								<a href="/main/persiapan/kelurahan/sosialisasi">
									<span class="mm-text">Kegiatan Sosialisasi</span>
								</a>
							</li>
							@endif
							@if( ! empty($menu['63']))
							<li {!! (Request::is( 'main/persiapan/kelurahan/relawan')||Request::is( 'main/persiapan/kelurahan/relawan/create') ? 'class="active"': "") !!}>
								<a href="/main/persiapan/kelurahan/relawan">
									<span class="mm-text">Relawan</span>
								</a>
							</li>
							@endif
							@if( ! empty($menu['64']))
							<li {!! (Request::is( 'main/persiapan/kelurahan/agen_sosialisasi')||Request::is( 'main/persiapan/kelurahan/agen_sosialisasi/create') ? 'class="active"': "") !!}>
								<a href="/main/persiapan/kelurahan/agen_sosialisasi">
									<span class="mm-text">Agen Sosialisasi</span>
								</a>
							</li>
							@endif
							@if( ! empty($menu['65']))
							<li {!! (Request::is( 'main/persiapan/kelurahan/pelatihan')||Request::is( 'main/persiapan/kelurahan/pelatihan/create') ? 'class="active"': "") !!}>
								<a href="/main/persiapan/kelurahan/pelatihan">
									<span class="mm-text">Pelatihan Masyarakat</span>
								</a>
							</li>
							@endif
						</ul>
					</li>
					@endif
					@if( ! empty($menu['67']))
					<li {!! (Request::is( 'main/persiapan/kelurahan/forum/keberfungsian')||Request::is( 'main/persiapan/kelurahan/forum/keberfungsian/create')||Request::is( 'main/persiapan/kelurahan/forum/keanggotaan')||Request::is( 'main/persiapan/kelurahan/forum/keanggotaan/create') ? 'class="active"': "") !!}>
						<a href="javascript:void(0)">
							<span class="mm-text">Forum Kolaborasi</span>
							<span class="fa arrow"></span>
						</a>
						<ul class="form-sub-submenu">
							@if( ! empty($menu['70']))
							<li {!! (Request::is( 'main/persiapan/kelurahan/forum/keanggotaan')||Request::is( 'main/persiapan/kelurahan/forum/keanggotaan/create') ? 'class="active"': "") !!}>
								<a href="/main/persiapan/kelurahan/forum/keanggotaan">
									<span class="mm-text">Keanggotaan</span>
								</a>
							</li>
							@endif
							@if( ! empty($menu['71']))
							<li {!! (Request::is( 'main/persiapan/kelurahan/forum/keberfungsian')||Request::is( 'main/persiapan/kelurahan/forum/keberfungsian/create') ? 'class="active"': "") !!}>
								<a href="/main/persiapan/kelurahan/forum/keberfungsian">
									<span class="mm-text">Keberfungsian Forum</span>
								</a>
							</li>
							@endif
						</ul>
					</li>
					@endif
					@if( ! empty($menu['68']))
					<li {!! (Request::is( 'main/persiapan/kelurahan/pemilu_bkm')||Request::is( 'main/persiapan/kelurahan/pemilu_bkm/create') ? 'class="active"': "") !!}>
						<a href="/main/persiapan/kelurahan/pemilu_bkm">
							<span class="mm-text">Pemilihan Ulang BKM/LKM</span>
						</a>
					</li>
					@endif
					@if( ! empty($menu['69']))
					<li {!! (Request::is( 'main/persiapan/kelurahan/lembaga')||Request::is( 'main/persiapan/kelurahan/lembaga/create') ? 'class="active"': "") !!}>
						<a href="/main/persiapan/kelurahan/lembaga">
							<span class="mm-text">Kegiatan Kelembagaan</span>
						</a>
					</li>
					@endif
				</ul>
			</li>
			@endif
		</ul>
	</li>
	@endif

	@if( ! empty($menu['12']))
	<li {!! (Request::is( 'main/perencanaan/kelurahan/kegiatan')||Request::is( 'main/perencanaan/kelurahan/kegiatan/create')||Request::is( 'main/perencanaan/kelurahan/investasi_5thn')||Request::is( 'main/perencanaan/kelurahan/investasi_5thn/create')||Request::is( 'main/perencanaan/kelurahan/penyusunan_rplp')||Request::is( 'main/perencanaan/kelurahan/penyusunan_rplp/create')||Request::is( 'main/perencanaan/kelurahan/penanganan_kumuh')||Request::is( 'main/perencanaan/kelurahan/penanganan_kumuh/create')||Request::is( 'main/perencanaan/kontrak_paket')||Request::is( 'main/perencanaan/kontrak_paket/create')||Request::is( 'main/perencanaan/pengadaan_lelang')||Request::is( 'main/perencanaan/pengadaan_lelang/create')||Request::is( 'main/perencanaan/infra/amdal')||Request::is( 'main/perencanaan/infra/amdal/create')||Request::is( 'main/perencanaan/infra/penyiapan_paket')||Request::is( 'main/perencanaan/infra/penyiapan_paket/create')||Request::is( 'main/perencanaan/rencana_kegiatan')||Request::is( 'main/perencanaan/rencana_kegiatan/create')||Request::is( 'main/perencanaan/kawasan/investasi')||Request::is( 'main/perencanaan/kawasan/investasi/create')||Request::is( 'main/perencanaan/kawasan/perencanaan')||Request::is( 'main/perencanaan/kawasan/perencanaan/create')||Request::is( 'main/perencanaan/penanganan/pengamanan_dampak')||Request::is( 'main/perencanaan/penanganan/pengamanan_dampak/create')||Request::is( 'main/perencanaan/penanganan/rencana_investasi')||Request::is( 'main/perencanaan/penanganan/rencana_investasi/create')||Request::is( 'main/perencanaan/penanganan/profile_rencana_5thn')||Request::is( 'main/perencanaan/penanganan/profile_rencana_5thn/create')||Request::is( 'main/perencanaan/penanganan/lokasi_profile')||Request::is( 'main/perencanaan/penanganan/lokasi_profile/create')||Request::is( 'main/perencanaan/penanganan/konsultasi_perencanaan')||Request::is( 'main/perencanaan/penanganan/konsultasi_perencanaan/create')||Request::is( 'main/perencanaan/penanganan/lokakarya_perencanaan')||Request::is( 'main/perencanaan/penanganan/lokakarya_perencanaan/create')||Request::is( 'main/perencanaan/penanganan/pelaksanaan_rpk')||Request::is( 'main/perencanaan/penanganan/pelaksanaan_rpk/create')||Request::is( 'main/perencanaan/penanganan/pembangunan_visi')||Request::is( 'main/perencanaan/penanganan/pembangunan_visi/create')? 'class="menu-dropdown active"': 'class="menu-dropdown"') !!}>
        <a href="javascript:void(0)">
            <span class="mm-text">Perencanaan</span>
            <span class="fa arrow"></span>
        </a>
		<ul class="sub-menu">
			@if( ! empty($menu['18']))
			<li {!! (Request::is( 'main/perencanaan/penanganan/pengamanan_dampak')||Request::is( 'main/perencanaan/penanganan/pengamanan_dampak/create')||Request::is( 'main/perencanaan/penanganan/rencana_investasi')||Request::is( 'main/perencanaan/penanganan/rencana_investasi/create')||Request::is( 'main/perencanaan/penanganan/profile_rencana_5thn')||Request::is( 'main/perencanaan/penanganan/profile_rencana_5thn/create')||Request::is( 'main/perencanaan/penanganan/lokasi_profile')||Request::is( 'main/perencanaan/penanganan/lokasi_profile/create')||Request::is( 'main/perencanaan/penanganan/konsultasi_perencanaan')||Request::is( 'main/perencanaan/penanganan/konsultasi_perencanaan/create')||Request::is( 'main/perencanaan/penanganan/lokakarya_perencanaan')||Request::is( 'main/perencanaan/penanganan/lokakarya_perencanaan/create')||Request::is( 'main/perencanaan/penanganan/pelaksanaan_rpk')||Request::is( 'main/perencanaan/penanganan/pelaksanaan_rpk/create')||Request::is( 'main/perencanaan/penanganan/pembangunan_visi')||Request::is( 'main/perencanaan/penanganan/pembangunan_visi/create')? 'class="active"': "") !!}>
				<a href="javascript:void(0)">
					<span class="mm-text">Penanganan Pemukiman Kota</span>
					<span class="fa arrow"></span>
				</a>
				<ul class="sub-menu form-submenu">
					@if( ! empty($menu['47']))
					<li {!! (Request::is( 'main/perencanaan/penanganan/pelaksanaan_rpk')||Request::is( 'main/perencanaan/penanganan/pelaksanaan_rpk/create')||Request::is( 'main/perencanaan/penanganan/pembangunan_visi')||Request::is( 'main/perencanaan/penanganan/pembangunan_visi/create')? 'class="active"': "") !!}>
						<a href="javascript:void(0)">
							<span class="mm-text">Perencanaan Penanganan Permukiman</span>
							<span class="fa arrow"></span>
						</a>
						<ul class="form-sub-submenu">
							@if( ! empty($menu['47']))
							<li {!! (Request::is( 'main/perencanaan/penanganan/pembangunan_visi')||Request::is( 'main/perencanaan/penanganan/pembangunan_visi/create') ? 'class="active"': "") !!}>
								<a href="/main/perencanaan/penanganan/pembangunan_visi">
				                    <span class="mm-text">Pembangunan Visi</span>
				                </a>
						    </li>
							@endif
							@if( ! empty($menu['47']))
							<li {!! (Request::is( 'main/perencanaan/penanganan/pelaksanaan_rpk')||Request::is( 'main/perencanaan/penanganan/pelaksanaan_rpk/create') ? 'class="active"': "") !!}>
								<a href="/main/perencanaan/penanganan/pelaksanaan_rpk">
				                    <span class="mm-text">Pelaksanaan RPK</span>
				                </a>
						    </li>
							@endif
						</ul>
					</li>
					@endif
					@if( ! empty($menu['47']))
					<li {!! (Request::is( 'main/perencanaan/penanganan/lokakarya_perencanaan')||Request::is( 'main/perencanaan/penanganan/lokakarya_perencanaan/create')? 'class="active"': "") !!}>
						<a href="/main/perencanaan/penanganan/lokakarya_perencanaan">
							<span class="mm-text">Lokakarya Perencanaan</span>
						</a>
					</li>
					@endif
					@if( ! empty($menu['47']))
					<li {!! (Request::is( 'main/perencanaan/penanganan/konsultasi_perencanaan')||Request::is( 'main/perencanaan/penanganan/konsultasi_perencanaan/create')? 'class="active"': "") !!}>
						<a href="/main/perencanaan/penanganan/konsultasi_perencanaan">
							<span class="mm-text">Konsultasi Perencanaan</span>
						</a>
					</li>
					@endif
					@if( ! empty($menu['47']))
					<li {!! (Request::is( 'main/perencanaan/penanganan/lokasi_profile')||Request::is( 'main/perencanaan/penanganan/lokasi_profile/create')? 'class="active"': "") !!}>
						<a href="/main/perencanaan/penanganan/lokasi_profile">
							<span class="mm-text">Lokasi & Profile Permukiman, Produk Perencanaan, Profile Kumuh</span>
						</a>
					</li>
					@endif
					@if( ! empty($menu['47']))
					<li {!! (Request::is( 'main/perencanaan/penanganan/rencana_investasi')||Request::is( 'main/perencanaan/penanganan/rencana_investasi/create')||Request::is( 'main/perencanaan/penanganan/profile_rencana_5thn')||Request::is( 'main/perencanaan/penanganan/profile_rencana_5thn/create')? 'class="active"': "") !!}>
						<a href="javascript:void(0)">
							<span class="mm-text">RP2KP-KP/SIAP</span>
							<span class="fa arrow"></span>
						</a>
						<ul class="form-sub-submenu">
							@if( ! empty($menu['47']))
							<li {!! (Request::is( 'main/perencanaan/penanganan/profile_rencana_5thn')||Request::is( 'main/perencanaan/penanganan/profile_rencana_5thn/create') ? 'class="active"': "") !!}>
								<a href="/main/perencanaan/penanganan/profile_rencana_5thn">
				                    <span class="mm-text">Profile Kumuh & Rencana Penangan 5 Tahun</span>
				                </a>
						    </li>
							@endif
							@if( ! empty($menu['47']))
							<li {!! (Request::is( 'main/perencanaan/penanganan/rencana_investasi')||Request::is( 'main/perencanaan/penanganan/rencana_investasi/create') ? 'class="active"': "") !!}>
								<a href="/main/perencanaan/penanganan/rencana_investasi">
				                    <span class="mm-text">Rencana Investasi Tahunan</span>
				                </a>
						    </li>
							@endif
						</ul>
					</li>
					@endif
					@if( ! empty($menu['47']))
					<li {!! (Request::is( 'main/perencanaan/penanganan/pengamanan_dampak')||Request::is( 'main/perencanaan/penanganan/pengamanan_dampak/create')? 'class="active"': "") !!}>
						<a href="/main/perencanaan/penanganan/pengamanan_dampak">
							<span class="mm-text">Pengamanan Dampak Sosial & Lingkungan</span>
						</a>
					</li>
					@endif
				</ul>
			</li>
			@endif
			@if( ! empty($menu['93']))
			<li {!! (Request::is( 'main/perencanaan/kawasan/investasi')||Request::is( 'main/perencanaan/kawasan/investasi/create')||Request::is( 'main/perencanaan/kawasan/perencanaan')||Request::is( 'main/perencanaan/kawasan/perencanaan/create')? 'class="active"': "") !!}>
				<a href="javascript:void(0)">
					<span class="mm-text">Kawasan Prioritas</span>
					<span class="fa arrow"></span>
				</a>
				<ul class="sub-menu form-submenu">
					@if( ! empty($menu['97']))
					<li {!! (Request::is( 'main/perencanaan/kawasan/perencanaan')||Request::is( 'main/perencanaan/kawasan/perencanaan/create')? 'class="active"': "") !!}>
						<a href="/main/perencanaan/kawasan/perencanaan">
							<span class="mm-text">Perencanaan Kawasan Prioritas</span>
						</a>
					</li>
					@endif
					@if( ! empty($menu['98']))
					<li {!! (Request::is( 'main/perencanaan/kawasan/investasi')||Request::is( 'main/perencanaan/kawasan/investasi/create')? 'class="active"': "") !!}>
						<a href="/main/perencanaan/kawasan/investasi">
							<span class="mm-text">Rencana Investasi 5 Tahun</span>
						</a>
					</li>
					@endif
				</ul>
			</li>
			@endif
			@if( ! empty($menu['94']))
			<li {!! (Request::is( 'main/perencanaan/rencana_kegiatan')||Request::is( 'main/perencanaan/rencana_kegiatan/create')? 'class="active"': "") !!}>
				<a href="/main/perencanaan/rencana_kegiatan">
					<span class="mm-text">Rencana Kegiatan Skala Kota</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['95']))
			<li {!! (Request::is( 'main/perencanaan/kontrak_paket')||Request::is( 'main/perencanaan/kontrak_paket/create')||Request::is( 'main/perencanaan/pengadaan_lelang')||Request::is( 'main/perencanaan/pengadaan_lelang/create')||Request::is( 'main/perencanaan/infra/amdal')||Request::is( 'main/perencanaan/infra/amdal/create')||Request::is( 'main/perencanaan/infra/penyiapan_paket')||Request::is( 'main/perencanaan/infra/penyiapan_paket/create')? 'class="active"': "") !!}>
				<a href="javascript:void(0)">
					<span class="mm-text">Penyiapan DED, Pengadaan Skala Kota</span>
					<span class="fa arrow"></span>
				</a>
				<ul class="sub-menu form-submenu">
					@if( ! empty($menu['99']))
					<li {!! (Request::is( 'main/perencanaan/infra/amdal')||Request::is( 'main/perencanaan/infra/amdal/create')||Request::is( 'main/perencanaan/infra/penyiapan_paket')||Request::is( 'main/perencanaan/infra/penyiapan_paket/create')? 'class="active"': "") !!}>
						<a href="javascript:void(0)">
							<span class="mm-text">Kegiatan Infrastruktur - Lingkungan</span>
							<span class="fa arrow"></span>
						</a>
						<ul class="form-sub-submenu">
							@if( ! empty($menu['106']))
							<li {!! (Request::is( 'main/perencanaan/infra/penyiapan_paket')||Request::is( 'main/perencanaan/infra/penyiapan_paket/create')? 'class="active"': "") !!}>
								<a href="/main/perencanaan/infra/penyiapan_paket">
									<span class="mm-text">Penyaiapan Paket(DED,RAB,RKS)</span>
								</a>
							</li>
							@endif
							@if( ! empty($menu['107']))
							<li {!! (Request::is( 'main/perencanaan/infra/amdal')||Request::is( 'main/perencanaan/infra/amdal/create')? 'class="active"': "") !!}>
								<a href="/main/perencanaan/infra/amdal">
									<span class="mm-text">Pengamanan Dampak Sosial & Lingkungan</span>
								</a>
							</li>
							@endif
						</ul>
					</li>
					@endif
					@if( ! empty($menu['100']))
					<li {!! (Request::is( 'main/perencanaan/pengadaan_lelang')||Request::is( 'main/perencanaan/pengadaan_lelang/create')? 'class="active"': "") !!}>
						<a href="/main/perencanaan/pengadaan_lelang">
							<span class="mm-text">Pengadaan/Proses Lelang</span>
						</a>
					</li>
					@endif
					@if( ! empty($menu['102']))
					<li {!! (Request::is( 'main/perencanaan/kontrak_paket')||Request::is( 'main/perencanaan/kontrak_paket/create')? 'class="active"': "") !!}>
						<a href="/main/perencanaan/kontrak_paket">
							<span class="mm-text">Kontrak Paket Pekerjaan Kontraktor</span>
						</a>
					</li>
					@endif
				</ul>
			</li>
			@endif
			@if( ! empty($menu['96']))
			<li {!! (Request::is( 'main/perencanaan/kelurahan/kegiatan')||Request::is( 'main/perencanaan/kelurahan/kegiatan/create')||Request::is( 'main/perencanaan/kelurahan/investasi_5thn')||Request::is( 'main/perencanaan/kelurahan/investasi_5thn/create')||Request::is( 'main/perencanaan/kelurahan/penyusunan_rplp')||Request::is( 'main/perencanaan/kelurahan/penyusunan_rplp/create')||Request::is( 'main/perencanaan/kelurahan/penanganan_kumuh')||Request::is( 'main/perencanaan/kelurahan/penanganan_kumuh/create')? 'class="active"': "") !!}>
				<a href="javascript:void(0)">
					<span class="mm-text">Rencana Kelurahan</span>
					<span class="fa arrow"></span>
				</a>
				<ul class="sub-menu form-submenu">
					@if( ! empty($menu['108']))
					<li {!! (Request::is( 'main/perencanaan/kelurahan/penanganan_kumuh')||Request::is( 'main/perencanaan/kelurahan/penanganan_kumuh/create')? 'class="active"': "") !!}>
						<a href="/main/perencanaan/kelurahan/penanganan_kumuh">
							<span class="mm-text">Rencana Penanganan Kumuh Kelurahan</span>
						</a>
					</li>
					@endif
					@if( ! empty($menu['104']))
					<li {!! (Request::is( 'main/perencanaan/kelurahan/penyusunan_rplp')||Request::is( 'main/perencanaan/kelurahan/penyusunan_rplp/create')? 'class="active"': "") !!}>
						<a href="/main/perencanaan/kelurahan/penyusunan_rplp">
							<span class="mm-text">Penyusunan RPLP</span>
						</a>
					</li>
					@endif
					@if( ! empty($menu['105']))
					<li {!! (Request::is( 'main/perencanaan/kelurahan/investasi_5thn')||Request::is( 'main/perencanaan/kelurahan/investasi_5thn/create')? 'class="active"': "") !!}>
						<a href="/main/perencanaan/kelurahan/investasi_5thn">
							<span class="mm-text">Rencana Investasi 5 Tahun</span>
						</a>
					</li>
					@endif
					@if( ! empty($menu['103']))
					<li {!! (Request::is( 'main/perencanaan/kelurahan/kegiatan')||Request::is( 'main/perencanaan/kelurahan/kegiatan/create')? 'class="active"': "") !!}>
						<a href="/main/perencanaan/kelurahan/kegiatan">
							<span class="mm-text">Rencana Kegiatan Skala Kelurahan</span>
						</a>
					</li>
					@endif
				</ul>
			</li>
			@endif
		</ul>
	</li>
	@endif
</ul>
