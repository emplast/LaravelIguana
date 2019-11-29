@extends('layouts.app')
@section('content')
<div class="container-fluid">
	@if (session('status'))
	<div class="alert alert-success">
		{{ session('status') }}
	</div>
	@endif
	<br/><br/><br/>
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-3">
			<div class="thumbnail">
				
				<a href="#" class="thumbnail" style="text-decoration: none;">
				<img src="{{asset('upload/image.png')}}" alt="..." id="album_image"></a>
				<div class="caption">
					<h3 id="h_name"></h3>
					<p id="p_opis"></p>
					<p id="p_autor"></p>
				</div>
				
			</div><br/>
			
			
		</div>
		
		<div class="col-md-4">
			{!! Form::open(['url'=>'addAlbum','class'=>'form-horizontal','enctype'=>'multipart/form-data'])!!}
			<h4>Dodawanie nowego albumu</h4>
			<br/>
			<br/>
			<div class="form-group">
				@if(count($errors)>0)
				<div class="alert alert-danger">
					<ul>
						@foreach($errors->all() as $error)
						<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
				@endif
				<div class="col-sm-4">
					{!! Form::label('name','Nazwa:')!!}
				</div>
				<div class="col-sm-6">
					{!! Form::text('name',null,['class'=>'form-control','id'=>'name'])!!}
				</div>
			</div><br/><br/>
			<div class="form-group">
				<div class="col-sm-4">
					{!! Form::label('opis','Opis:')!!}
				</div>
				<div class="col-sm-6">
					{!! Form::text('opis',null,['class'=>'form-control','id'=>'opis'])!!}
				</div>
			</div><br/><br/>
			
			<div class="form-group">
				<div class="col-sm-4">
					{!! Form::label('autor','Autor:')!!}
				</div>
				<div class="col-sm-6">
					{!! Form::text('autor',Auth::user()->name,['class'=>'form-control','id'=>'autor'])!!}
				</div>
			</div>
			
			{{ csrf_field() }}
			<div class="input-group">
				<br/>
				<div class="col-sm-6">
					{!! Form::file('adres',['id'=>'image','onchange'=>'previewFile()'])!!}
				</div>
				<div class="col-sm-2">
					{!! Form::submit('Zapisz album',['class'=>'btn btn-primary'])!!}
				</div>
			</div>
			{!! Form::close()!!}
		</div>
	</div>
	<!-- row -->
</div>
</div>
<script type="text/javascript">
	function previewFile() {
var preview = document.querySelector('#album_image');
var file = document.querySelector('input[type=file]').files[0];
var reader = new FileReader();
reader.addEventListener("load", function () {
preview.src = reader.result;
}, false);
if (file) {
reader.readAsDataURL(file);
};
};
$(function(){
	$('#name ,#opis ,#autor').on('keyup ,keydown',function(){
		$('#h_name').text($('#name').val());
		$('#p_opis').text($('#opis').val());
		$('#p_autor').text($('#autor').val());
	});
});
</script>
@endsection