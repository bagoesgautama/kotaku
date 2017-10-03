@extends('HRM/default') {{-- Page title --}} @section('title') @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/hover/css/hover-min.css')}}" rel="stylesheet">
<link href="{{asset('css/buttons_sass.css')}}" rel="stylesheet">

@stop {{-- Page Header--}} @section('page-header')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>HRM Module</h1>
    <ol class="breadcrumb">
        <li class="active">
			<a href="/hrm">
	            <i class="fa fa-fw fa-home"></i> HRM
			</a>
        </li>
		<li class="active">
            Role akses
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')

<div class="row">
    <div class="col-md-12 " >
		<div class="form-group">
			<table>
				<tr>
				    <td>Role :</td>
					<td><select name="role" id="role">
							<option value=undefined>Please select</option>
						</select>
				    </td>
				</tr>
				<tr>
				    <td>Aplikasi :</td>
					<td><select name="apps" id="apps">
							<option value=undefined>Please select</option>
						</select>
				    </td>
				</tr>
				<tr>
				    <td>Modul :</td>
					<td><select name="modul" id="modul">
							<option value=undefined>Please select</option>
						</select>
				    </td>
				</tr>
			</table>
		</div>
		<div class="tools pull-left">
			<a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" id="show" href="#">Show</a>
		</div>
	</div>
</div>
<div class="row">
	<img id="imgSpinner1" src="{{asset('img/loader.gif')}}" alt="loading..." height="64" width="64">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped" id="akses">
			</table>
		</div>
	</div>
	<div class="tools pull-left">
		<a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" id="save" href="#">Save</a>
	</div>
</div>
<!-- /.modal ends here -->@stop {{-- local scripts --}} @section('footer_scripts')

<script>
	$(document).ready(function () {
		$("#imgSpinner1").hide();
		$("#save").hide();
		var prop = {!! json_encode($totalData) !!};
		var prop_role = {!! json_encode($role) !!};
		var attr={}
		var role = $('#role');
		var apps = $('#apps');
		var apps_id,modul_id;
		var modul = $('#modul');
		for(var i=0;i<prop.length;i++){
			if(attr[prop[i].apps]==undefined){
				attr[prop[i].apps]={id:prop[i].apps_id,modul:{}};
				attr[prop[i].apps].modul[prop[i].modul]={id:prop[i].modul_id}
			}else{
				attr[prop[i].apps].modul[prop[i].modul]={id:prop[i].modul_id}
			}
		}
		for (var i=0;i<prop_role.length;i++){
			role.append("<option value='"+ prop_role[i].kode +"'>" + prop_role[i].nama + "</option>");
		}
		for (var key in attr){
			apps.append("<option value='"+ attr[key].id +"'>" + key + "</option>");
		}
		apps.change(function(){
			apps_id=apps.val();
			if(apps_id!=undefined){
				var role_name=this.options[this.selectedIndex].innerHTML;
				modul.empty();
				modul.append("<option value=undefined>Please select</option>");
				var mod=attr[role_name].modul
				for (var key in mod){
					modul.append("<option value='"+ mod[key].id +"'>" + key + "</option>");
				}
			}
		});
		$("#show").click(function(e) {
			e.preventDefault();
			apps_id=apps.val();
			modul_id=modul.val();
		    $.ajax({
		        type: "GET",
		        url: "/hrm/role_akses/show",
		        data: {
		            modul: modul.val(),
		            role: role.val()
		        },
				beforeSend: function(){
					$("#imgSpinner1").show();
               	},
		        success: function(result) {
					$("#imgSpinner1").hide();
		            var row = `<thead>
						<tr>
						<th>menu ID</th>
						<th>menu</th>
						<th>menu detail</th>
						<th>menu detail ID</th>
						<th>akses</th>
						</tr>
					</thead>`;
					result=JSON.parse(result);
					for(var i=0;i< result.length;i++){
						row += '<tr>';
						row+='<td id="menu_id">' + result[i].menu_id + '</td>';
						row+='<td>' + result[i].menu + '</td>';
						row+='<td>' + result[i].detil+' </td>';
						row+='<td id="detil_id">' + result[i].detil_id+' </td>';
						if(result[i].akses==0)
							row+='<td ><input type="checkbox" id="check" name="check" value='+result[i].akses+' data-size="small"> </td>';
						else
							row+='<td ><input type="checkbox" id="check" name="check" value='+result[i].akses+' data-size="small" checked> </td>';
						row +='</tr>'
					}
				    $('#akses').html(row);
					$("#save").show();
		        },
		        error: function(result) {
					$("#imgSpinner1").hide();
		            alert('Harap isi Role dan modul!');
		        }
		    });
		});

		$('#save').on('click', function(e) {
			e.preventDefault();
			var data=[];
			$('#akses tbody tr').each(function(row, tr){
				if($(this).find('input').val()==0 && $(this).find('input').is(':checked')){
					var json={apps:apps_id,modul:modul_id,role:role.val(),menu_id:$(this).find('td:eq(1)').text(),detil_id:$(this).find('td:eq(3)').text()}
					json.flag=1;
					data.push(json);
				}else if ($(this).find('input').val()==1 && !$(this).find('input').is(':checked')){
					var json={apps:apps_id,modul:modul_id,role:role.val(),menu_id:$(this).find('td:eq(1)').text(),detil_id:$(this).find('td:eq(3)').text()}
					json.flag=0;
					data.push(json);
				}
			});
			if(data.length>0){
				$.ajax({
			        type: "post",
			        url: "/hrm/role_akses",
					data: JSON.stringify(data),
					beforeSend: function(){
						$("#imgSpinner1").show();
	               	},
			        success: function(result) {
						alert('Form Submitted.');
						//window.location.href = "/hrm/role_akses";
					},
			        error: function(result) {
						$("#imgSpinner1").hide();
						alert('Save data gagal!');
			        }
			    });
			}else{
				alert('data tidak berubah!');
			}
		});
	});
</script>
<script src="{{asset('js/custom_js/alert.js')}}" type="text/javascript"></script>
@stop
