<ul class="navigation slimmenu" id="navigation">
	<li {!! (Request::is('gis')? 'class="active"': "") !!}>
        <a href="{{url('gis')}}">
            <span class="mm-text ">Map Propinsi</span>
        </a>
    </li>
	<li {!! (Request::is('gis/map-kota')? 'class="active"': "") !!}>
        <a href="{{url('gis/map-kota')}}">
            <span class="mm-text ">Map Kota</span>
        </a>
    </li>
</ul>
<!-- / .navigation -->
