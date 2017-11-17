<ul class="navigation slimmenu" id="navigation">
	@if( ! empty($menu['193']))
	<li {!! (Request::is( 'hrm/dashboard')? 'class="active"': "") !!}>
        <a href="javascript:void(0)">
            <span class="mm-text ">Dashboard</span>
        </a>
	</li>
	@endif
	@if( ! empty($menu['194']))
	<li {!! (Request::is( 'hrm/admin/*')? 'class="active"': "") !!}>
        <a href="javascript:void(0)">
            <span class="mm-text ">Administrator</span>
			<span class="fa arrow"></span>
        </a>
		<ul class="sub-menu form-submenu">
			@if( ! empty($menu['196']))
		    <li {!! (Request::is( 'hrm/admin/role*')? 'class="active"': "") !!}>
		        <a href="/hrm/admin/role">
		            <span class="mm-text ">Role</span>
		        </a>
		    </li>
			@endif
			@if( ! empty($menu['197']))
				<li {!! (Request::is( 'hrm/admin/manajemen_role*')? 'class="active"': "") !!}>
			        <a href="/hrm/admin/manajemen_role">
			            <span class="mm-text ">Manajemen Role</span>
			        </a>
			    </li>
			@endif
			@if( ! empty($menu['159']))
			<li {!! (Request::is( 'hrm/admin/activity_log')? 'class="active"': "") !!}>
		        <a href="/hrm/activity_log">
		            <span class="mm-text ">Web Activity Log</span>
		        </a>
			</li>
			@endif
		</ul>
    </li>
	@endif
	@if( ! empty($menu['198']))
	<li {!! (Request::is( 'hrm/profil/*')? 'class="active"': "") !!}>
        <a href="javascript:void(0)">
            <span class="mm-text ">Profil Saya</span>
			<span class="fa arrow"></span>
        </a>
		<ul class="sub-menu form-submenu">
			@if( ! empty($menu['199']))
			<li {!! (Request::is( 'hrm/profil/user*')? 'class="active"': "") !!}>
				<a href="/hrm/profil/user">
					<span class="mm-text ">Data diri</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['200']))
			<li {!! (Request::is( 'hrm/profil/pendidikan*')? 'class="active"': "") !!}>
				<a href="/hrm/profil/pendidikan">
					<span class="mm-text ">Data Pendidikan</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['201']))
			<li {!! (Request::is( 'hrm/profil/pelatihan*')? 'class="active"': "") !!}>
				<a href="/hrm/profil/pelatihan">
					<span class="mm-text ">Data Pelatihan</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['202']))
			<li {!! (Request::is( 'hrm/profil/penghargaan*')? 'class="active"': "") !!}>
				<a href="/hrm/profil/penghargaan">
					<span class="mm-text ">Data Piagam Penghargaan</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['203']))
			<li {!! (Request::is( 'hrm/profil/penghargaan*')? 'class="active"': "") !!}>
				<a href="/hrm/profil/penghargaan">
					<span class="mm-text ">Pengalaman Kerja KOTAKU</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['204']))
			<li {!! (Request::is( 'hrm/profil/password*')? 'class="active"': "") !!}>
				<a href="/hrm/profil/password">
					<span class="mm-text ">Melihat Track Record</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['205']))
			<li {!! (Request::is( 'hrm/profil/password*')? 'class="active"': "") !!}>
				<a href="/hrm/profil/password">
					<span class="mm-text ">Melihat Hasil Evaluasi Kinerja</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['206']))
			<li {!! (Request::is( 'hrm/profil/password*')? 'class="active"': "") !!}>
				<a href="/hrm/profil/password">
					<span class="mm-text ">Update Password</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['230']))
			<li {!! (Request::is( 'hrm/profil/pesan*')? 'class="active"': "") !!}>
				<a href="/hrm/profil/pesan">
					<span class="mm-text ">Pesan</span>
				</a>
			</li>
			@endif
		</ul>
	</li>
	@endif
	@if( ! empty($menu['207']))
	<li {!! (Request::is( 'hrm/management_diri/*')? 'class="active"': "") !!}>
		<a href="javascript:void(0)">
			<span class="mm-text ">Management Diri Saya</span>
			<span class="fa arrow"></span>
		</a>
		<ul class="sub-menu form-submenu">
			@if( ! empty($menu['208']))
			<li {!! (Request::is( 'hrm/management_diri/aktivasi*')? 'class="active"': "") !!}>
				<a href="/hrm/management_diri/aktivasi">
					<span class="mm-text ">Aktivasi Diri</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['209']))
			<li {!! (Request::is( 'hrm/profil/user/profil*')? 'class="active"': "") !!}>
				<a href="/hrm/profil/user/profil">
					<span class="mm-text ">Mutasi Diri</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['210']))
			<li {!! (Request::is( 'hrm/profil/user/profil*')? 'class="active"': "") !!}>
				<a href="/hrm/profil/user/profil">
					<span class="mm-text ">Demosi Diri</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['229']))
			<li {!! (Request::is( 'hrm/profil/user/profil*')? 'class="active"': "") !!}>
				<a href="/hrm/profil/user/profil">
					<span class="mm-text ">Promosi Diri</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['211']))
			<li {!! (Request::is( 'hrm/management_diri/evaluasi*')? 'class="active"': "") !!}>
				<a href="/hrm/management_diri/evaluasi">
					<span class="mm-text ">Evaluasi Kinerja</span>
				</a>
			</li>
			@endif
		</ul>
	</li>
	@endif
	@if( ! empty($menu['212']))
	<li {!! (Request::is( 'hrm/management_personil/*')? 'class="active"': "") !!}>
		<a href="javascript:void(0)">
			<span class="mm-text ">Management Personil</span>
			<span class="fa arrow"></span>
		</a>
		<ul class="sub-menu form-submenu">
			@if( ! empty($menu['213']))
			<li {!! (Request::is( 'hrm/management_personil/persetujuan/*')? 'class="active"': "") !!}>
				<a href="javascript:void(0)">
					<span class="mm-text ">Persetujuan</span>
					<span class="fa arrow"></span>
				</a>
				<ul class="form-submenu">
					@if( ! empty($menu['214']))
					<li {!! (Request::is( 'hrm/management_personil/persetujuan/pendaftaran*')? 'class="active"': "") !!}>
						<a href="/hrm/management_personil/persetujuan/pendaftaran">
							<span class="mm-text ">Persetujuan Pendaftaran</span>
						</a>
					</li>
					@endif
					@if( ! empty($menu['215']))
					<li {!! (Request::is( 'hrm/profil/user/profil*')? 'class="active"': "") !!}>
						<a href="/hrm/profil/user/profil">
							<span class="mm-text ">Persetujuan Mutasi</span>
						</a>
					</li>
					@endif
					@if( ! empty($menu['216']))
					<li {!! (Request::is( 'hrm/profil/user/profil*')? 'class="active"': "") !!}>
						<a href="/hrm/profil/user/profil">
							<span class="mm-text ">Persetujuan Demosi</span>
						</a>
					</li>
					@endif
					@if( ! empty($menu['217']))
					<li {!! (Request::is( 'hrm/profil/user/profil*')? 'class="active"': "") !!}>
						<a href="/hrm/profil/user/profil">
							<span class="mm-text ">Persetujuan Promosi</span>
						</a>
					</li>
					@endif
					@if( ! empty($menu['218']))
					<li {!! (Request::is( 'hrm/profil/user/profil*')? 'class="active"': "") !!}>
						<a href="/hrm/profil/user/profil">
							<span class="mm-text ">Persetujuan Penggajian</span>
						</a>
					</li>
					@endif
					@if( ! empty($menu['219']))
					<li {!! (Request::is( 'hrm/profil/user/profil*')? 'class="active"': "") !!}>
						<a href="/hrm/profil/user/profil">
							<span class="mm-text ">Persetujuan Evaluasi Kinerja</span>
						</a>
					</li>
					@endif
					@if( ! empty($menu['220']))
					<li {!! (Request::is( 'hrm/profil/user/profil*')? 'class="active"': "") !!}>
						<a href="/hrm/profil/user/profil">
							<span class="mm-text ">Persetujuan Kuota</span>
						</a>
					</li>
					@endif
				</ul>
			</li>
			@endif
			@if( ! empty($menu['221']))
			<li {!! (Request::is( 'hrm/profil/user/profil*')? 'class="active"': "") !!}>
				<a href="/hrm/profil/user/profil">
					<span class="mm-text ">Mengatur Mutasi Personil</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['222']))
			<li {!! (Request::is( 'hrm/profil/user/profil*')? 'class="active"': "") !!}>
				<a href="/hrm/profil/user/profil">
					<span class="mm-text ">Mengatur Demosi Personil</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['223']))
			<li {!! (Request::is( 'hrm/profil/user/profil*')? 'class="active"': "") !!}>
				<a href="/hrm/profil/user/profil">
					<span class="mm-text ">Mengatur Promosi Personil</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['224']))
			<li {!! (Request::is( 'hrm/profil/user/profil*')? 'class="active"': "") !!}>
				<a href="/hrm/profil/user/profil">
					<span class="mm-text ">Mengatur Pemberhentian Personil</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['225']))
			<li {!! (Request::is( 'hrm/management_personil/peringatan*')? 'class="active"': "") !!}>
				<a href="/hrm/management_personil/peringatan">
					<span class="mm-text ">Mengatur Peringatan Personil</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['226']))
			<li {!! (Request::is( 'hrm/management_personil/blacklist*')? 'class="active"': "") !!}>
				<a href="/hrm/management_personil/blacklist">
					<span class="mm-text ">Mengatur Blacklist Personil</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['227']))
			<li {!! (Request::is( 'hrm/management_personil/sidang*')? 'class="active"': "") !!}>
				<a href="/hrm/management_personil/sidang">
					<span class="mm-text ">Mengatur Berita Acara Sidang Majelis Kode Etik</span>
				</a>
			</li>
			@endif
			@if( ! empty($menu['228']))
			<li {!! (Request::is( 'hrm/profil/user/profil*')? 'class="active"': "") !!}>
				<a href="/hrm/profil/user/profil">
					<span class="mm-text ">Mengatur Evaluasi Kinerja</span>
				</a>
			</li>
			@endif
		</ul>
	</li>
	@endif
</ul>
<!-- / .navigation -->
