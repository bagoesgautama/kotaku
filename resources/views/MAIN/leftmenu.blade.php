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
	@if( ! empty($menu['12']))
	<li {!! (Request::is( 'main/persiapan/kota/forum/bkm')||Request::is( 'main/persiapan/kota/forum/bkm/create')||Request::is( 'main/persiapan/kota/forum/kolaborasi')||Request::is( 'main/persiapan/kota/forum/kolaborasi/create')||Request::is( 'main/persiapan/kota/forum/f_forum')||Request::is( 'main/persiapan/kota/forum/f_forum/create')||Request::is( 'main/persiapan/kota/kegiatan/sosialisasi')||Request::is( 'main/persiapan/kota/kegiatan/sosialisasi/create')||Request::is( 'main/persiapan/kota/info')||Request::is( 'main/persiapan/kota/info/create')||Request::is( 'main/persiapan/kota/pokja/pembentukan')||Request::is( 'main/persiapan/kota/pokja/pembentukan/create')||Request::is( 'main/persiapan/kota/pokja/kegiatan')||Request::is( 'main/persiapan/kota/pokja/kegiatan/create')||Request::is( 'main/persiapan/propinsi/pokja/pembentukan')||Request::is( 'main/persiapan/propinsi/pokja/pembentukan/create')||Request::is( 'main/persiapan/propinsi/pokja/kegiatan')||Request::is( 'main/persiapan/propinsi/pokja/kegiatan/create')||Request::is( 'main/persiapan/nasional/pokja/pembentukan')||Request::is( 'main/persiapan/nasional/pokja/pembentukan/create')||Request::is( 'main/persiapan/nasional/pokja/kegiatan')||Request::is( 'main/persiapan/nasional/pokja/kegiatan/create') ? 'class="menu-dropdown active"': 'class="menu-dropdown"') !!}>
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
			<li {!! (Request::is( 'main/persiapan/kelurahan/lembaga/federasi_upk')||Request::is( 'main/persiapan/kelurahan/lembaga/federasi_upk/create')||Request::is( 'main/persiapan/kelurahan/lembaga/bdc')||Request::is( 'main/persiapan/kelurahan/lembaga/bdc/create')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/tabungan')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/tabungan/create')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/fasil_bdc')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/fasil_bdc/create')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/syariah')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/syariah/create')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/ppmk')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/ppmk/create')||Request::is( 'main/persiapan/kelurahan/lembaga/tapp')||Request::is( 'main/persiapan/kelurahan/lembaga/tapp/create')||Request::is( 'main/persiapan/kelurahan/lembaga/tipp')||Request::is( 'main/persiapan/kelurahan/lembaga/tipp/create')||Request::is( 'main/persiapan/kelurahan/lembaga/organisasai_pengelola')||Request::is( 'main/persiapan/kelurahan/lembaga/organisasai_pengelola/create')||
			Request::is( 'main/persiapan/kelurahan/pemilu_bkm')||Request::is( 'main/persiapan/kelurahan/pemilu_bkm/create')||Request::is( 'main/persiapan/kelurahan/forum/keberfungsian')||Request::is( 'main/persiapan/kelurahan/forum/keberfungsian/create')||Request::is( 'main/persiapan/kelurahan/forum/keanggotaan')||Request::is( 'main/persiapan/kelurahan/forum/keanggotaan/create')||Request::is( 'main/persiapan/kelurahan/pelatihan')||Request::is( 'main/persiapan/kelurahan/pelatihan/create')||Request::is( 'main/persiapan/kelurahan/agen_sosialilasi')||Request::is( 'main/persiapan/kelurahan/agen_sosialilasi/create')||Request::is( 'main/persiapan/kelurahan/relawan')||Request::is( 'main/persiapan/kelurahan/relawan/create')||Request::is( 'main/persiapan/kelurahan/sosialisasi')||Request::is( 'main/persiapan/kelurahan/sosialisasi/create')||Request::is( 'main/persiapan/kelurahan/info')||Request::is( 'main/persiapan/kelurahan/info/create') ? 'class="active"': 'class=""') !!}>
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
					<li {!! (Request::is( 'main/persiapan/kelurahan/pelatihan')||Request::is( 'main/persiapan/kelurahan/pelatihan/create')||Request::is( 'main/persiapan/kelurahan/agen_sosialilasi')||Request::is( 'main/persiapan/kelurahan/agen_sosialilasi/create')||Request::is( 'main/persiapan/kelurahan/relawan')||Request::is( 'main/persiapan/kelurahan/relawan/create')||Request::is( 'main/persiapan/kelurahan/sosialisasi')||Request::is( 'main/persiapan/kelurahan/sosialisasi/create') ? 'class="active"': "") !!}>
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
							<li {!! (Request::is( 'main/persiapan/kelurahan/agen_sosialilasi')||Request::is( 'main/persiapan/kelurahan/agen_sosialilasi/create') ? 'class="active"': "") !!}>
								<a href="/main/persiapan/kelurahan/agen_sosialilasi">
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
					<li {!! (Request::is( 'main/persiapan/kelurahan/lembaga/federasi_upk')||Request::is( 'main/persiapan/kelurahan/lembaga/federasi_upk/create')||Request::is( 'main/persiapan/kelurahan/lembaga/bdc')||Request::is( 'main/persiapan/kelurahan/lembaga/bdc/create')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/tabungan')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/tabungan/create')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/fasil_bdc')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/fasil_bdc/create')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/syariah')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/syariah/create')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/ppmk')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/ppmk/create')||Request::is( 'main/persiapan/kelurahan/lembaga/tapp')||Request::is( 'main/persiapan/kelurahan/lembaga/tapp/create')||Request::is( 'main/persiapan/kelurahan/lembaga/tipp')||Request::is( 'main/persiapan/kelurahan/lembaga/tipp/create')||Request::is( 'main/persiapan/kelurahan/lembaga/organisasai_pengelola')||Request::is( 'main/persiapan/kelurahan/lembaga/organisasai_pengelola/create') ? 'class="active"': "") !!}>
						<a href="javascript:void(0)">
							<span class="mm-text">Kegiatan Kelembagaan</span>
							<span class="fa arrow"></span>
						</a>
						<ul class="form-sub-submenu">
							@if( ! empty($menu['72']))
							<li {!! (Request::is( 'main/persiapan/kelurahan/lembaga/tapp')||Request::is( 'main/persiapan/kelurahan/lembaga/tapp/create') ? 'class="active"': "") !!}>
								<a href="/main/persiapan/kelurahan/lembaga/tapp">
									<span class="mm-text">TAPP</span>
								</a>
							</li>
							@endif
							@if( ! empty($menu['73']))
							<li {!! (Request::is( 'main/persiapan/kelurahan/lembaga/tipp')||Request::is( 'main/persiapan/kelurahan/lembaga/tipp/create') ? 'class="active"': "") !!}>
								<a href="/main/persiapan/kelurahan/lembaga/tipp">
									<span class="mm-text">Pembentukan/Penguatan TIPP</span>
								</a>
							</li>
							@endif
							@if( ! empty($menu['74']))
							<li {!! (Request::is( 'main/persiapan/kelurahan/lembaga/organisasai_pengelola')||Request::is( 'main/persiapan/kelurahan/lembaga/organisasai_pengelola/create') ? 'class="active"': "") !!}>
								<a href="/main/persiapan/kelurahan/lembaga/organisasai_pengelola">
									<span class="mm-text">Organisasi Pengelola O & P</span>
								</a>
							</li>
							@endif
							@if( ! empty($menu['75']))
							<li {!! (Request::is( 'main/persiapan/kelurahan/lembaga/ksm/tabungan')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/tabungan/create')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/fasil_bdc')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/fasil_bdc/create')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/syariah')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/syariah/create')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/ppmk')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/ppmk/create') ? 'class="active"': "") !!}>
								<a href="javascript:void(0)">
									<span class="mm-text">KSM Ekonomi</span>
									<span class="fa arrow"></span>
								</a>
								<ul class="form-sub-submenu">
									@if( ! empty($menu['78']))
									<li {!! (Request::is( 'main/persiapan/kelurahan/lembaga/ksm/ppmk')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/ppmk/create') ? 'class="active"': "") !!}>
										<a href="/main/persiapan/kelurahan/lembaga/ksm/ppmk">
											<span class="mm-text">Kelurahan PPMK</span>
										</a>
									</li>
									@endif
									@if( ! empty($menu['79']))
									<li {!! (Request::is( 'main/persiapan/kelurahan/lembaga/ksm/syariah')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/syariah/create') ? 'class="active"': "") !!}>
										<a href="/main/persiapan/kelurahan/lembaga/ksm/syariah">
											<span class="mm-text">KSM Syariah</span>
										</a>
									</li>
									@endif
									@if( ! empty($menu['80']))
									<li {!! (Request::is( 'main/persiapan/kelurahan/lembaga/ksm/fasil_bdc')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/fasil_bdc/create') ? 'class="active"': "") !!}>
										<a href="/main/persiapan/kelurahan/lembaga/ksm/fasil_bdc">
											<span class="mm-text">KSM Difasilitasi Melalui BDC</span>
										</a>
									</li>
									@endif
									@if( ! empty($menu['81']))
									<li {!! (Request::is( 'main/persiapan/kelurahan/lembaga/ksm/tabungan')||Request::is( 'main/persiapan/kelurahan/lembaga/ksm/tabungan/create') ? 'class="active"': "") !!}>
										<a href="/main/persiapan/kelurahan/lembaga/ksm/tabungan">
											<span class="mm-text">KSM Memiliki Tabungan di Lembaga Keuangan Resmi</span>
										</a>
									</li>
									@endif
								</ul>
							</li>
							@endif
							@if( ! empty($menu['76']))
							<li {!! (Request::is( 'main/persiapan/kelurahan/lembaga/bdc')||Request::is( 'main/persiapan/kelurahan/lembaga/bdc/create') ? 'class="active"': "") !!}>
								<a href="/main/persiapan/kelurahan/lembaga/bdc">
									<span class="mm-text">BDC</span>
								</a>
							</li>
							@endif
							@if( ! empty($menu['77']))
							<li {!! (Request::is( 'main/persiapan/kelurahan/lembaga/federasi_upk')||Request::is( 'main/persiapan/kelurahan/lembaga/federasi_upk/create') ? 'class="active"': "") !!}>
								<a href="/main/persiapan/kelurahan/lembaga/federasi_upk">
									<span class="mm-text">Federasi UPK</span>
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
	</li>
	@endif
</ul>
<!-- / .navigation -->
