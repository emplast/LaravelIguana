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
		<div class="col-md-2"></div>
		<div class="col-md-4">
			<div class="thumbnail">
				<a href="#" class="thumbnail" style="text-decoration: none;">
				<img src="{{asset($photo->adres)}}" alt="..." id="album_image"></a>
				<div class="caption">
					<h3 id="h_name">{{ $photo->name}}</h3>
					<p id="p_opis">{{ $photo->opis}}</p>
					<p id="p_autor">{{ $photo->autor}}</p>
				</div>
			</div><br/>
		</div>
		<div class="col-md-4">
			{!! Form::open(['url'=>'userAlbum/'.$id.'/'.$id_photo.'','class'=>'form-horizontal','enctype'=>'multipart/form-data'])!!}
			<h4>Edycja zdjęcia i opisu</h4>
			<br/>
			<br/>
			<div class="form-group">
				<div class="col-sm-3">
					{!! Form::label('name','Tytuł:')!!}
				</div>
				<div class="col-sm-8">
					{!! Form::text('name',$photo->name,['class'=>'form-control','id'=>'name'])!!}
				</div>
			</div><br/><br/>
			<div class="form-group">
				<div class="col-sm-3">
					{!! Form::label('opis','Opis:')!!}
				</div>
				<div class="col-sm-8">
					{!! Form::text('opis',$photo->opis,['class'=>'form-control','id'=>'opis'])!!}
				</div>
			</div><br/><br/>
			
			<div class="form-group">
				<div class="col-sm-3">
					{!! Form::label('autor','Autor:')!!}
				</div>
				<div class="col-sm-8">
					{!! Form::text('autor',Auth::user()->name,['class'=>'form-control','id'=>'autor'])!!}
				</div>
			</div>
			
			{{ csrf_field() }}
			<div class="input-group">
				<br/>
				<div class="col-sm-7">
					
				</div>
				<div class="col-sm-4">
					{!! Form::submit('Edytuj zdjęcie',['class'=>'btn btn-primary pull-right '])!!}
					<br/><br/><br/><br/>
			
			<a href="{{url('deletePhoto/'.$id.'/'.$id_photo.'')}}" class="btn btn-danger pull-right" style="margin-left: 25px">Usuń zdjęcie  </a>
				</div>
			</div>
			{!! Form::close()!!}
			
		</div>
		<!-- row -->
	</div>
	<!-- container-fluid -->
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