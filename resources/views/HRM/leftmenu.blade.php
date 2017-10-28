<ul class="navigation slimmenu" id="navigation">
	@if( ! empty($menu['159']))
	<li {!! (Request::is( 'hrm/activity_log')? 'class="active"': "") !!}>
        <a href="/hrm/activity_log">
            <span class="mm-text ">Web Activity Log</span>
        </a>
	</li>
	@endif
	@if( ! empty($menu['1']))
	<li {!! (Request::is( 'hrm/admin/*')? 'class="active"': "") !!}>
        <a href="javascript:void(0)">
            <span class="mm-text ">Administrator</span>
			<span class="fa arrow"></span>
        </a>
		<ul class="sub-menu form-submenu">
			<!--@if( ! empty($menu['7']))
			<li {!! (Request::is( 'hrm/admin/role_level*')? 'class="active"': "") !!}>
		        <a href="/hrm/admin/role_level">
		            <span class="mm-text ">Role Level</span>
		        </a>
			</li>
			@endif-->
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
	@if( ! empty($menu['160']))
	<li {!! (Request::is( 'hrm/registrasi_mandiri*')? 'class="active"': "") !!}>
		<a href="/hrm/registrasi_mandiri">
            <span class="mm-text ">Registrasi Mandiri</span>
        </a>
	</li>
	@endif
	@if( ! empty($menu['161']))
	<li {!! (Request::is( 'hrm/profil/*')||Request::is( 'hrm/management*')? 'class="active"': "") !!}>
        <a href="javascript:void(0)">
            <span class="mm-text ">Managemen Personil</span>
			<span class="fa arrow"></span>
        </a>
		<ul class="sub-menu form-submenu">
			@if( ! empty($menu['162']))
			<li {!! (Request::is( 'hrm/profil/pesan*')? 'class="active"': "") !!}>
				<a href="/hrm/profil/pesan">
		            <span class="mm-text ">Kotak Pesan</span>
		        </a>
			</li>
			@endif
			@if( ! empty($menu['178']))
			<li {!! (Request::is( 'hrm/management/*')? 'class="active"': "") !!}>
		        <a href="javascript:void(0)">
		            <span class="mm-text ">Managemen User</span>
					<span class="fa arrow"></span>
		        </a>
				<ul class="sub-menu form-submenu">
					@if( ! empty($menu['174']))
					<li {!! (Request::is( 'hrm/management/blacklist*')? 'class="active"': "") !!}>
						<a href="/hrm/management/blacklist">
							<span class="mm-text ">Black List Personil</span>
						</a>
					</li>
					@endif
				</ul>
			</li>
			@endif
			@if( ! empty($menu['163']))
			<li {!! (Request::is( 'hrm/profil/user/*')? 'class="active"': "") !!}>
		        <a href="javascript:void(0)">
		            <span class="mm-text ">Profil Personil</span>
					<span class="fa arrow"></span>
		        </a>
				<ul class="form-sub-submenu">
					@if( ! empty($menu['179']))
					<li {!! (Request::is( 'hrm/profil/user/profil*')? 'class="active"': "") !!}>
						<a href="/hrm/profil/user/profil">
				            <span class="mm-text ">Profil</span>
				        </a>
					</li>
					@endif
					@if( ! empty($menu['168']))
					<li {!! (Request::is( 'hrm/profil/user/aktivasi*')? 'class="active"': "") !!}>
						<a href="/hrm/profil/user/aktivasi">
				            <span class="mm-text ">Aktivasi User</span>
				        </a>
					</li>
					@endif
					@if( ! empty($menu['169']))
					<li {!! (Request::is( 'hrm/profil/user/pelatihan*')? 'class="active"': "") !!}>
						<a href="/hrm/profil/user/pelatihan">
				            <span class="mm-text ">Sertifikasi Pelatihan</span>
				        </a>
					</li>
					@endif
					@if( ! empty($menu['170']))
					<li {!! (Request::is( 'hrm/profil/user/pendidikan*')? 'class="active"': "") !!}>
						<a href="/hrm/profil/user/pendidikan">
				            <span class="mm-text ">Backgroud Pendidikan</span>
				        </a>
					</li>
					@endif
					@if( ! empty($menu['171']))
					<li {!! (Request::is( 'hrm/profil/user/penghargaan*')? 'class="active"': "") !!}>
						<a href="/hrm/profil/user/penghargaan">
				            <span class="mm-text ">Piagam Penghargaan</span>
				        </a>
					</li>
					@endif
					@if( ! empty($menu['172']))
					<li {!! (Request::is( 'hrm/profil/user/perubahan*')? 'class="active"': "") !!}>
						<a href="/hrm/profil/user/perubahan">
				            <span class="mm-text ">update status (mutasi/promosi/demosi/pemecatan)</span>
				        </a>
					</li>
					@endif
					@if( ! empty($menu['173']))
					<li {!! (Request::is( 'hrm/profil/user/password*')? 'class="active"': "") !!}>
						<a href="/hrm/profil/user/password">
				            <span class="mm-text ">Ganti Password</span>
				        </a>
					</li>
					@endif

				</ul>
			</li>
			@endif
			@if( ! empty($menu['164']))
			<li {!! (Request::is( 'hrm/management/kuota/*')? 'class="active"': "") !!}>
				<a href="javascript:void(0)">
		            <span class="mm-text ">Kuota Personil</span>
					<span class="fa arrow"></span>
		        </a>
				<ul class="form-sub-submenu">
					@if( ! empty($menu['175']))
					<li {!! (Request::is( 'hrm/management/kuota/kmp*')? 'class="active"': "") !!}>
						<a href="/hrm/management/kuota/kmp">
				            <span class="mm-text ">KMP</span>
				        </a>
					</li>
					@endif
					@if( ! empty($menu['176']))
					<li {!! (Request::is( 'hrm/management/kuota/kmw*')? 'class="active"': "") !!}>
						<a href="/hrm/management/kuota/kmw">
				            <span class="mm-text ">KMW</span>
				        </a>
					</li>
					@endif
					@if( ! empty($menu['177']))
					<li {!! (Request::is( 'hrm/management/kuota/korkot*')? 'class="active"': "") !!}>
						<a href="/hrm/management/kuota/korkot">
				            <span class="mm-text ">Korkot</span>
				        </a>
					</li>
					@endif
				</ul>
			</li>
			@endif
			@if( ! empty($menu['165']))
			<li {!! (Request::is( 'hrm/management/peringatan*')? 'class="active"': "") !!}>
				<a href="/hrm/management/peringatan">
		            <span class="mm-text ">managemen peringatan</span>
		        </a>
			</li>
			@endif
			@if( ! empty($menu['166']))
			<li {!! (Request::is( 'hrm/management/evaluasi*')? 'class="active"': "") !!}>
				<a href="/hrm/management/evaluasi">
		            <span class="mm-text ">Evaluasi Kinerja</span>
		        </a>
			</li>
			@endif
			@if( ! empty($menu['167']))
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
