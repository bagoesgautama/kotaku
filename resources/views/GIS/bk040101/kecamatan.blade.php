@extends('GIS/default') {{-- Page title --}} @section('title') maps @stop {{-- local styles --}} @section('header_styles')
<link rel="stylesheet" type="text/css" href="{{url('css/gmaps_cust.css')}}"> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>GIS</h1>
    <ol class="breadcrumb">
        <li >
			<a href="/gis">
            Map</a>
        </li>
		<li >
			<a href="/gis/map-kota?id={{$kode_propinsi}}">
            {{$kota}}</a>
        </li>
		<li class="active">
            {{$kota}}
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-md-12 " >
		<div class="panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-map"></i> bk040101-kecamatan
                            </h4>
            </div>
            <div class="panel-body">
				<table id='info'></table>
                <div id="gmap-top" class="gmap"></div>
            </div>
        </div>
    </div>
</div>

<!-- row -->
@stop {{-- local scripts --}} @section('footer_scripts')
<script>
$(document).ready(function() {

	var mapProp = {
		center: new google.maps.LatLng(-2.600029, 118.015776),
		zoom: 5,
		//scrollwheel: false,
		//disableDoubleClickZoom: true,
		zoomControl: true,
		//draggable: false,
		zoomControlOpt: {
			style: 'SMALL',
			position: 'TOP_LEFT'
		},
		panControl: false,
		streetViewControl: false,
		mapTypeControl: false,
		overviewMapControl: false
	};

	var map = new google.maps.Map(document.getElementById("gmap-top"), mapProp);
	var prop = {!! json_encode($prop) !!};
	var attr={}
	console.log(prop)
	for(var i=0;i<prop.length;i++){
		map.data.loadGeoJson('/uploads/kecamatan/'+prop[i].url_border_area);
		attr[prop[i].nama]=prop[i]
		attr[prop[i].nama].contentString = '<div id="content">'+
	      '<div id="siteNotice">'+
	      '</div>'+
	      '<h1 id="firstHeading" class="firstHeading">'+prop[i].nama+'</h1>'+
	      '<div id="bodyContent">'+
	      '<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large ' +
	      'sandstone rock formation in the southern part of the '+
	      'Heritage Site.</p>'+
	      '<p>Attribution: Uluru, <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">'+
	      'https://en.wikipedia.org/w/index.php?title=Uluru</a> '+
	      '(last visited June 22, 2009).</p>'+
	      '</div>'+
	      '</div>';
	}

	map.data.setStyle(function(feature) {
		console.log(feature)
		if(attr[feature.f.KECAMATAN].kode%2==0){
			return ({
			    fillColor: 'red',
			    strokeWeight: 1
			  });
		}else{
			return ({
			    fillColor: 'green',
			    strokeWeight: 2
			  });
		}
	})
	map.data.addListener('mouseover', function(event) {
	  	var data_detil=attr[event.feature.f.KECAMATAN]
    	var row = '';
		for(var key in data_detil){
			row += '<tr>';
			row+='<td>' + key + '</td>';
			row+='<td>' + data_detil[key]+' </td>';
			row +='<tr>'
		}
	    $('#info').html(row);
	});
	//alert(JSON.stringify(prop));
});
</script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCZ3sUKS6BLuxnrGVQl2xRR2FFaljwPb2o&libraries=places"></script>
<script type="text/javascript" src="{{asset('vendors/gmaps/js/gmaps.min.js')}}"></script>
<!--<script type="text/javascript" src="{{asset('js/custom_js/custommaps.js')}}"></script>-->
@stop
