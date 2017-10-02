<ul class="navigation slimmenu" id="navigation">
	<li {!! (Request::is( '/main/kel_faskel') || Request::is( '/main/faskel')||Request::is( '/main/kota_korkot') || Request::is( '/main/korkot')||Request::is( '/main/slum_program') || Request::is( '/main/kmp')||Request::is( '/main/kmp_slum_program')||Request::is( '/main/kmw')? 'class="menu-dropdown active"': 'class="menu-dropdown"') !!}>
        <a href="javascript:void(0)">
            <span class="mm-text">Master Data</span>
            <span class="fa arrow"></span>
        </a>
		<ul class="sub-menu">
			<li {!! (Request::is( '/main/slum_program')? 'class="active"': "") !!}>
		        <a href="/main/slum_program">
		            <span class="mm-text ">Slum Program</span>
		        </a>
		    </li>
		    <li {!! (Request::is( '/main/kmp')? 'class="active"': "") !!}>
		        <a href="/main/kmp">
		            <span class="mm-text ">Konsultan Managemen Pusat (KMP)</span>
		        </a>
		    </li>
			<li {!! (Request::is( '/main/kmp_slum_program')? 'class="active"': "") !!}>
		        <a href="/main/kmp_slum_program">
		            <span class="mm-text ">Mapping KMP Ke Slum Program</span>
		        </a>
		    </li>
			<li {!! (Request::is( '/main/kmw')? 'class="active"': "") !!}>
		        <a href="/main/kmw">
		            <span class="mm-text ">Konsultan Managemen Wilayah (KMW)</span>
		        </a>
		    </li>
			<li {!! (Request::is( '/main/korkot')? 'class="active"': "") !!}>
		        <a href="/main/korkot">
		            <span class="mm-text ">Koordinator Kota (KorKot)</span>
		        </a>
		    </li>
			<li {!! (Request::is( '/main/kota_korkot')? 'class="active"': "") !!}>
		        <a href="/main/kota_korkot">
		            <span class="mm-text ">Mapping Kota Ke Korkot</span>
		        </a>
		    </li>
			<li {!! (Request::is( '/main/faskel')? 'class="active"': "") !!}>
		        <a href="/main/faskel">
		            <span class="mm-text ">Tim Fasilitator Kelurahan (FasKel)</span>
		        </a>
		    </li>
			<li {!! (Request::is( '/main/kel_faskel')? 'class="active"': "") !!}>
		        <a href="/main/kel_faskel">
		            <span class="mm-text ">Mapping Faskel Ke Kelurahan</span>
		        </a>
		    </li>
		</ul>
	</li>
	<li {!! (Request::is( 'main/persiapan/kota/kegiatan/sosialisasi')||Request::is( 'main/persiapan/kota/kegiatan/sosialisasi/create')||Request::is( 'main/persiapan/kota/info')||Request::is( 'main/persiapan/kota/info/create')||Request::is( 'main/persiapan/kota/pokja/pembentukan')||Request::is( 'main/persiapan/kota/pokja/pembentukan/create')||Request::is( 'main/persiapan/kota/pokja/kegiatan')||Request::is( 'main/persiapan/kota/pokja/kegiatan/create')||Request::is( 'main/persiapan/propinsi/pokja/pembentukan')||Request::is( 'main/persiapan/propinsi/pokja/pembentukan/create')||Request::is( 'main/persiapan/propinsi/pokja/kegiatan')||Request::is( 'main/persiapan/propinsi/pokja/kegiatan/create')||Request::is( 'main/persiapan/nasional/pokja/pembentukan')||Request::is( 'main/persiapan/nasional/pokja/pembentukan/create')||Request::is( 'main/persiapan/nasional/pokja/kegiatan')||Request::is( 'main/persiapan/nasional/pokja/kegiatan/create') ? 'class="menu-dropdown active"': 'class="menu-dropdown"') !!}>
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
			<li {!! (Request::is( 'main/persiapan/kota/kegiatan/sosialisasi')||Request::is( 'main/persiapan/kota/kegiatan/sosialisasi/create')||Request::is( 'main/persiapan/kota/info')||Request::is( 'main/persiapan/kota/info/create')||Request::is( 'main/persiapan/kota/pokja/pembentukan')||Request::is( 'main/persiapan/kota/pokja/pembentukan/create')||Request::is( 'main/persiapan/kota/pokja/kegiatan')||Request::is( 'main/persiapan/kota/pokja/kegiatan/create') ? 'class="active"': 'class=""') !!}>
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
				</ul>
			</li>
		</ul>
	</li>
</ul>
<!-- / .navigation -->
