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
		<div class="col-sm-2">
			<a href="{{url('userAlbum/'.$album->id.'/delete')}}" class="btn btn-danger">Usuń album</a>
		</div>
		<div class="col-sm-3">
			<div class="thumbnail">
				
				<a href="#" class="thumbnail" style="text-decoration: none;">
				<img src="{{asset($front->adres)}}" alt="..." ></a>
				<div class="caption">
					<h3>{{$album->name}}</h3>
					<p>{{$album->opis}}</p>
					<p>{{$album->autor}}</p>
					<p>Komentarzy:{{count(App\Comment::get()->where('id_albumu',$album->id))}}</p>
					<p>Odwiedzin:{{App\Visit::where('pageName',$album->id)->select('counts')->first()['counts']}}</p>
				</div>
				
			</div><br/>
			
			{!! Form::open(['url'=>'userAlbum/'.$album->id.'','class'=>'form-horizontal','enctype'=>'multipart/form-data'])!!}
			<h4>Dodawanie nowego zdjęcia do albumu</h4>
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
				<div class="col-sm-3">
					{!! Form::label('name','Tytuł:')!!}
				</div>
				<div class="col-sm-8">
					{!! Form::text('name',null,['class'=>'form-control','id'=>'name'])!!}
				</div>
			</div><br/><br/>
			<div class="form-group">
				<div class="col-sm-3">
					{!! Form::label('opis','Opis:')!!}
				</div>
				<div class="col-sm-8">
					{!! Form::text('opis',null,['class'=>'form-control','id'=>'opis'])!!}
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
				<div class="col-sm-8">
					{!! Form::file('adres',['id'=>'image','onchange'=>'previewFile()'])!!}
				</div>
				<div class="col-sm-2">
					{!! Form::submit('Zapisz zdjęcie',['class'=>'btn btn-primary'])!!}
				</div>
			</div>
			{!! Form::close()!!}
			
			<br/><br/><br/>
		</div>
		<div class="col-md-7">
			<?php $i=0;foreach($photos as $photo):?>
			<?php $i=$i+1;if($i>1):?>
			<div class=" col-md-2" style="height: 250px">
				<a href="{{url('userAlbum',['id'=>$photo->id_albumu,'id_photo'=>$photo->id])}}" class="thumbnail"style="text-decoration: none;">
					<img src="{{asset($photo->adres)}}" alt="...">
				</a>
				<h3>{{ $photo->name }}</h3>
				<p>{{ $photo->opis }}</p>
				<p>{{ $photo->autor}}</p>
			</div>
			<?php ;endif;endforeach;?>
			
			<div class=" col-md-2">
				<a href="#" class="thumbnail"style="text-decoration: none;">
					<img src="{{asset('upload/image.png')}}" alt="..."id="album_image">
				</a>
				<h3 id="h_name"></h3>
				<p id="p_opis"></p>
				<p id="p_autor"></p>
			</div>
			
		</div>
	</div>
	<!-- row -->
</div>
<!-- container-fluid -->
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