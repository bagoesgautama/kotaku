
<ul class="navigation slimmenu" id="navigation">
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
<!-- / .navigation -->
