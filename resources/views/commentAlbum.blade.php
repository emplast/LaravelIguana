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
				<img src="{{asset($photo->adres)}}" alt="..."></a>
				<div class="caption">
					<h3><?php echo $album->name;?></h3>
					<p><?php echo $album->opis;?></p>
					<p><?php echo $album->autor;?></p>
				</div>
				
			</div>
			<?php foreach ($komentarze as $komentarz ):?>
			<h4>{{$komentarz->name}}</h4>
			<p>{{$komentarz->autor}}</p>
			<p>{{$komentarz->opis}}</p>
			<?php endforeach;?>
			
		</div>
		
		<div class="col-sm-2"></div>
		
		{!! Form::open(['url'=>'home/'.$album->id,'class'=>'col-sm-4 form-horizontal'])!!}
		
		
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
			<div class="col-sm-2">
				{!! Form::label('opis','Komentarz:')!!}
			</div>
			<div class="col-sm-6">
				{!! Form::textarea('opis',null,['class'=>'form-control'])!!}
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2">
				{!! Form::label('autor','Autor:')!!}
			</div>
			<div class="col-sm-6">
				{!! Form::text('autor',Auth::user()->name,['class'=>'form-control'])!!}
			</div>
		</div><br/><br/>
		{!!Form::hidden('name','Komentarz')!!}
		{!! Form::hidden('id_uzytkownika',Auth::user()->id)!!}
		{!! Form::hidden('id_albumu',$photo->id_albumu)!!}
		{!! Form::hidden('id_zdjecia','0')!!}
		{!!Form::submit('Zapisz komentarz',['class'=>'btn btn-primary'])!!}
		
		{!! Form::close()!!}
		<!-- row -->
	</div>
</div>
@endsection