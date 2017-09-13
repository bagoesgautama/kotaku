@extends('layouts/default') {{-- Page title --}} @section('title') Blank @stop {{-- local styles --}} @section('header_styles') @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Blank</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li><a href="{{url('simple')}}"> Simple</a></li>
        <li class="active">
            Create
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="panel-body border">
	<form method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
		<div class="row">
			<div class="form-group striped-col">
				<label class="col-sm-3 control-label">Static</label>
				<div class="col-sm-9">
					<p class="form-control-static">
						Static text
					</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="example-text-input1">Text</label>
				<div class="col-sm-6">
					<input type="text" id="example-text-input1" name="example-text-input" class="form-control" placeholder="Text">
					<span class="help-block">
						This is a help text
					</span>
				</div>
			</div>
			<div class="form-group striped-col">
				<label class="col-sm-3 control-label" for="example-email1">Email</label>
				<div class="col-sm-6">
					<input type="email" id="example-email1" name="example-email" class="form-control" placeholder="Email">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="example-password1">Password</label>
				<div class="col-sm-6">
					<input type="password" id="example-password1" name="example-password" class="form-control" placeholder="Password">
				</div>
			</div>
			<div class="form-group striped-col">
				<label class="col-sm-3 control-label" for="example-disabled1">Disabled</label>
				<div class="col-sm-6">
					<input type="text" id="example-disabled1" name="example-disabled" class="form-control" placeholder="Disabled" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="example-textarea-input2">Textarea</label>
				<div class="col-sm-6">
					<textarea id="example-textarea-input2" name="example-textarea-input" rows="7" class="form-control resize_vertical" placeholder="Description...."></textarea>
				</div>
			</div>
			<div class="form-group striped-col">
				<label class="col-sm-3 control-label" for="example-select1">Select</label>
				<div class="col-sm-6">
					<select id="example-select1" name="example-select" class="form-control" size="1">
						<option value="0">
							Please select
						</option>
						<option value="1">Bootstrap</option>
						<option value="2">CSS</option>
						<option value="3">JavaScript</option>
						<option value="4">HTML</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="example-multiple-select2">Multiple</label>
				<div class="col-sm-6">
					<select id="example-multiple-select2" name="example-multiple-select" class="form-control" size="5" multiple>
						<option value="1">Option #1</option>
						<option value="2">Option #2</option>
						<option value="3">Option #3</option>
						<option value="4">Option #4</option>
						<option value="5">Option #5</option>
						<option value="6">Option #6</option>
						<option value="7">Option #7</option>
						<option value="8">Option #8</option>
						<option value="9">Option #9</option>
						<option value="10">Option #10</option>
					</select>
				</div>
			</div>
			<div class="form-group striped-col">
				<label class="col-sm-3 control-label">Radio Buttons
				</label>
				<div class="col-sm-9">
					<div>
						<label for="example-radio4">
							<input type="radio" id="example-radio4" name="example-radios" value="option1">&nbsp; HTML</label>
					</div>
					<div>
						<label for="example-radio5">
							<input type="radio" id="example-radio5" name="example-radios" value="option2">&nbsp; CSS</label>
					</div>
					<div>
						<label for="example-radio6">
							<input type="radio" id="example-radio6" name="example-radios" value="option3">&nbsp; JavaScript
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">
					Inline Radio Buttons
				</label>
				<div class="col-sm-9">
					<div class="row">
						<div class="col-sm-4">
							<label class="radio-inline" for="example-inline-radio7">
								<input type="radio" id="example-inline-radio7" name="example-inline-radios" value="option1">&nbsp; HTML
							</label>
						</div>
						<div class="col-sm-4">
							<label class="radio-inline" for="example-inline-radio8">
								<input type="radio" id="example-inline-radio8" name="example-inline-radios" value="option2">&nbsp; CSS
							</label>
						</div>
						<div class="col-sm-4">
							<label class="radio-inline" for="example-inline-radio9">
								<input type="radio" id="example-inline-radio9" name="example-inline-radios" value="option3">&nbsp; JavaScript
							</label>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group striped-col">
				<label class="col-sm-3 control-label">Checkboxes</label>
				<div class="col-sm-9">
					<div>
						<label for="example-checkbox4">
							<input type="checkbox" id="example-checkbox4" name="example-checkbox1" value="option1">&nbsp; HTML
						</label>
					</div>
					<div>
						<label for="example-checkbox5">
							<input type="checkbox" id="example-checkbox5" name="example-checkbox2" value="option2">&nbsp; CSS
						</label>
					</div>
					<div>
						<label for="example-checkbox6">
							<input type="checkbox" id="example-checkbox6" name="example-checkbox3" value="option3">&nbsp; JavaScript
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">
					Inline Checkboxes
				</label>
				<div class="col-sm-9">
					<div class="row">
						<div class="col-sm-4">
							<label class="checkbox-inline" for="example-inline-checkbox7">
								<input type="checkbox" id="example-inline-checkbox7" name="example-inline-checkbox1" value="option1">&nbsp; HTML
							</label>
						</div>
						<div class="col-sm-4">
							<label class="checkbox-inline" for="example-inline-checkbox8">
								<input type="checkbox" id="example-inline-checkbox8" name="example-inline-checkbox2" value="option2">&nbsp; CSS
							</label>
						</div>
						<div class="col-sm-4">
							<label class="checkbox-inline" for="example-inline-checkbox9">
								<input type="checkbox" id="example-inline-checkbox9" name="example-inline-checkbox3" value="option3">&nbsp; JavaScript
							</label>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group striped-col ">
				<label class="col-sm-3 control-label" for="example-file-input1">File</label>
				<div class="col-sm-9">
					<input type="file" id="example-file-input1" name="example-file-input">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="example-file-multiple-input1">
					Multiple File
				</label>
				<div class="col-sm-9">
					<input type="file" id="example-file-multiple-input1" name="example-file-multiple-input" multiple>
				</div>
			</div>
			<div class="form-group form-actions">
				<div class="col-sm-9 col-sm-offset-3">
					<a href="{{url('simple')}}" type="button" class="btn btn-effect-ripple btn-danger">
						Cancel
					</a>
					<button type="button" class="btn btn-effect-ripple btn-primary">
						Submit
					</button>
					<button type="reset" class="btn btn-effect-ripple btn-default reset_btn2">
						Reset
					</button>
				</div>
			</div>
		</div>
	</form>
</div>
@stop {{-- local scripts --}} @section('footer_scripts') @stop
