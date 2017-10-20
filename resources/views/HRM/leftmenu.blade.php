<ul class="navigation slimmenu" id="navigation">
	@if( ! empty($menu['7']))
	<li {!! (Request::is( 'hrm/activity_log')? 'class="active"': "") !!}>
        <a href="/hrm/activity_log">
            <span class="mm-text ">Web Activity Log</span>
        </a>
	</li>
	@endif
	@if( ! empty($menu['7']))
	<li {!! (Request::is( 'hrm/admin/*')? 'class="active"': "") !!}>
        <a href="javascript:void(0)">
            <span class="mm-text ">Administrator</span>
			<span class="fa arrow"></span>
        </a>
		<ul class="sub-menu form-submenu">
			@if( ! empty($menu['7']))
			<li {!! (Request::is( 'hrm/admin/role_level*')? 'class="active"': "") !!}>
		        <a href="/hrm/admin/role_level">
		            <span class="mm-text ">Role Level</span>
		        </a>
			</li>
			@endif
			@if( ! empty($menu['9']))
		    <li {!! (Request::is( 'hrm/admin/role*')? 'class="active"': "") !!}>
		        <a href="/hrm/admin/role">
		            <span class="mm-text ">Role</span>
		        </a>
		    </li>
			@endif
			@if( ! empty($menu['10']))
				<li {!! (Request::is( 'hrm/admin/role_akses*')? 'class="active"': "") !!}>
			        <a href="/hrm/admin/role_akses">
			            <span class="mm-text ">Role Akses</span>
			        </a>
			    </li>
			@endif
		</ul>
    </li>
	@endif
	@if( ! empty($menu['7']))
	<li {!! (Request::is( 'hrm/registrasi_mandiri*')? 'class="active"': "") !!}>
		<a href="/hrm/registrasi_mandiri">
            <span class="mm-text ">Registrasi Mandiri</span>
        </a>
	</li>
	@endif
	@if( ! empty($menu['7']))
	<li {!! (Request::is( 'hrm/management/*')? 'class="active"': "") !!}>
        <a href="javascript:void(0)">
            <span class="mm-text ">Managemen Personil</span>
			<span class="fa arrow"></span>
        </a>
		<ul class="sub-menu form-submenu">
			@if( ! empty($menu['7']))
			<li {!! (Request::is( 'hrm/management/pesan*')? 'class="active"': "") !!}>
				<a href="/hrm/management/pesan">
		            <span class="mm-text ">Kotak Pesan</span>
		        </a>
			</li>
			@endif
			@if( ! empty($menu['7']))
			<li {!! (Request::is( 'hrm/management/user/*')? 'class="active"': "") !!}>
		        <a href="javascript:void(0)">
		            <span class="mm-text ">Managemen User</span>
					<span class="fa arrow"></span>
		        </a>
				<ul class="form-sub-submenu">
					@if( ! empty($menu['7']))
					<li {!! (Request::is( 'hrm/management/user/aktivasi*')? 'class="active"': "") !!}>
						<a href="/hrm/management/user/aktivasi">
				            <span class="mm-text ">Aktivasi User</span>
				        </a>
					</li>
					@endif
					@if( ! empty($menu['7']))
					<li {!! (Request::is( 'hrm/management/user/pelatihan*')? 'class="active"': "") !!}>
						<a href="/hrm/management/user/pelatihan">
				            <span class="mm-text ">Sertifikasi Pelatihan</span>
				        </a>
					</li>
					@endif
					@if( ! empty($menu['7']))
					<li {!! (Request::is( 'hrm/management/user/pendidikan*')? 'class="active"': "") !!}>
						<a href="/hrm/management/user/pendidikan">
				            <span class="mm-text ">Backgroud Pendidikan</span>
				        </a>
					</li>
					@endif
					@if( ! empty($menu['7']))
					<li {!! (Request::is( 'hrm/management/user/penghargaan*')? 'class="active"': "") !!}>
						<a href="/hrm/management/user/penghargaan">
				            <span class="mm-text ">Piagam Penghargaan</span>
				        </a>
					</li>
					@endif
					@if( ! empty($menu['7']))
					<li {!! (Request::is( 'hrm/management/user/status*')? 'class="active"': "") !!}>
						<a href="/hrm/management/user/status">
				            <span class="mm-text ">update status (mutasi/promosi/demosi/pemecatan)</span>
				        </a>
					</li>
					@endif
					@if( ! empty($menu['7']))
					<li {!! (Request::is( 'hrm/management/user/password*')? 'class="active"': "") !!}>
						<a href="/hrm/management/user/password">
				            <span class="mm-text ">Ganti Password</span>
				        </a>
					</li>
					@endif
					@if( ! empty($menu['7']))
					<li {!! (Request::is( 'hrm/management/user/black_list*')? 'class="active"': "") !!}>
						<a href="/hrm/management/user/black_list">
				            <span class="mm-text ">Black List Personil</span>
				        </a>
					</li>
					@endif
				</ul>
			</li>
			@endif
			@if( ! empty($menu['7']))
			<li {!! (Request::is( 'hrm/management/kuota/*')? 'class="active"': "") !!}>
				<a href="javascript:void(0)">
		            <span class="mm-text ">Kuota Personil</span>
					<span class="fa arrow"></span>
		        </a>
				<ul class="form-sub-submenu">
					@if( ! empty($menu['7']))
					<li {!! (Request::is( 'hrm/management/kuota/kmp*')? 'class="active"': "") !!}>
						<a href="/hrm/management/kuota/kmp">
				            <span class="mm-text ">KMP</span>
				        </a>
					</li>
					@endif
					@if( ! empty($menu['7']))
					<li {!! (Request::is( 'hrm/management/kuota/kmw*')? 'class="active"': "") !!}>
						<a href="/hrm/management/kuota/kmw">
				            <span class="mm-text ">KMW</span>
				        </a>
					</li>
					@endif
					@if( ! empty($menu['7']))
					<li {!! (Request::is( 'hrm/management/kuota/korkot*')? 'class="active"': "") !!}>
						<a href="/hrm/management/kuota/korkot">
				            <span class="mm-text ">Korkot</span>
				        </a>
					</li>
					@endif
				</ul>
			</li>
			@endif
			@if( ! empty($menu['7']))
			<li {!! (Request::is( 'hrm/management/peringatan*')? 'class="active"': "") !!}>
				<a href="/hrm/management/peringatan">
		            <span class="mm-text ">managemen peringatan</span>
		        </a>
			</li>
			@endif
			@if( ! empty($menu['7']))
			<li {!! (Request::is( 'hrm/management/evaluasi*')? 'class="active"': "") !!}>
				<a href="/hrm/management/evaluasi">
		            <span class="mm-text ">Evaluasi Kinerja</span>
		        </a>
			</li>
			@endif
			@if( ! empty($menu['7']))
			<li {!! (Request::is( 'hrm/management/sidang*')? 'class="active"': "") !!}>
				<a href="/hrm/management/sidang">
		            <span class="mm-text ">Hasil Sidang Kode Etik</span>
		        </a>
			</li>
			@endif
		</ul>
	</li>
	@endif
</ul>
<!-- / .navigation -->
