@extends('layouts.app')
@section('content')
<!-- <script type="text/javascript" src="{{asset('dist/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dist/js/dataTables.bootstrap.min.js')}}"></script> -->
<div class="container-fluid">
	@if (session('status'))
	<div class="alert alert-success">
		{{ session('status') }}
	</div>
	@endif
	<br/><br/><br/>
	<div class="row">
		<div class="col-sm-6">
			<h3 class="text-center">Tabela Albumów</h3>
			<br/><br/><br/>
			<div class="col-md-2"></div>
			{!!Form::open(['url'=>'panel','class'=>'form-horizontal','enctype'=>'multipart/form-data'])!!}
			<table id="album" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Nazwa</th>
						<th>Autor</th>
						<th>Opis</th>
						<th>Użytkownik</th>
						<th>Zdjęcie</th>
						<th>Usuń</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($albums as $album):?>
					<tr>
						<td>{{ $album->name}}</td>
						<td>{{$album->autor}}</td>
						<td>{{ $album->opis}}</td>
						<td>{{$album->nazwisko}}</td>
						<td><img src="{{$album->adres}}" width="40px" height="40px"/></td>
						<td><input type="checkBox" name="checkbox_{{$album->id}}" id="checkbox_{{$album->id}}"></td>
					</tr>
					<?php endforeach;?>
				</tbody>
				
			</table>
			
			{!! Form::submit('Usuń albumy',['class'=>'btn btn-primary'])!!}
			{!! Form::close()!!}
		</div>
		<div class="col-sm-6">
		<div class="col-md-2"></div>
		<h3 class="text-center">Tabela Zdjęć</h3>
			<br/><br/><br/>
			<div class="col-md-2"></div>
{!!Form::open(['url'=>'panel/deletePhoto','class'=>'form-horizontal','enctype'=>'multipart/form-data'])!!}
			<table id="album_1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Nazwa</th>
						<th>Autor</th>
						<th>Opis</th>
						<th>Użytkownik</th>
						<th>Zdjęcie</th>
						<th>Usuń</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($photos as $photo):?>
						<?php if($photo->id!=$photo->id_zdjecia_c):?>
					<tr>
						<td>{{$photo->name}}</td>
						<td>{{$photo->autor}}</td>
						<td>{{ $photo->opis}}</td>
						<td>{{$photo->nazwisko}}</td>
						<td><img src="{{$photo->adres}}" width="40px" height="40px"></td>
						<td><input type="checkBox" name="checkbox_a_{{$photo->id}}" id="checkbox_a_{{$photo->id}}">
					</tr>
				<?php endif;endforeach;?>
				</tbody>
				
			</table>
			{!! Form::submit('Usuń zdjęcia',['class'=>'btn btn-primary pull-right'])!!}
			{!! Form::close()!!}
		</div>
	</div>
	<div class="row">
		<br/><br/><br/>
		<div class="col-md-3"></div>
		<div class="col-md-6">
		<h3 class="text-center">Tabela Komentarzy i tabela urzytkowników</h3>
		<br/><br/><br/>
	</div>
	<div class="col-md-3"></div>
	</div>
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-6">
			{!!Form::open(['url'=>'panel/deleteComment','class'=>'form-horizontal','enctype'=>'multipart/form-data'])!!}
			<table id="album_2" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Nazwa</th>
						<th>Autor</th>
						<th>Opis</th>
						<th>Użytkownik</th>
						<th>Zdjęcie</th>
						<th>Usuń</th>
					</tr>
				</thead>
				<tbody>
					<?php  foreach($comments as $comment):?>
					<tr>
						<td>{{$comment->name}}</td>
						<td>{{$comment->autor}}</td>
						<td>{{$comment->opis}}</td>
						<td>{{$comment->nazwisko}}</td>
						<td><img src="{{$comment->adres}}" width="40px" height="40px"></td>
						<td><input type="checkBox" name="checkbox_b_{{$comment->id}}" id="checkbox_b_{{$comment->id}}"></td>	
					</tr>
				<?php  endforeach;?>
				</tbody>
				
			</table>
			{!! Form::submit('Usuń komentarze',['class'=>'btn btn-primary pull-right'])!!}
			{!! Form::close()!!}
		</div>
<div class="col-md-4">
			{!!Form::open(['url'=>'panel/deleteUsers','class'=>'form-horizontal','enctype'=>'multipart/form-data'])!!}
			<table id="album_3" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Id</th>
						<th>e-mail</th>
						<th>Nazwa</th>
						<th>Usuń</th>
						
					</tr>
				</thead>
				<tbody>
					<?php  foreach($users as $user):?>
					<tr>
						<td>{{$user->id}}</td>
						<td>{{$user->email}}</td>
						<td>{{$user->name}}</td>
						<td><input type="checkBox" name="checkbox_c_{{$user->id}}" id="checkbox_c_{{$user->id}}"></td>	
					</tr>
				<?php  endforeach;?>
				</tbody>
				
			</table>
			{!! Form::submit('Usuń użytkowników',['class'=>'btn btn-primary pull-right'])!!}
			{!! Form::close()!!}
		</div>
	</div>
	<br/><br/><br/><br/>
	
	<!-- container-fluid -->
</div>
<script  type="text/javascript">
$(function () {

$("#album").DataTable({

"language": {
"url": "{{asset('dist/json/pl.json')}}"
}
});
$("#album_1").DataTable({

"language": {
"url": "{{asset('dist/json/pl.json')}}"
}

});


$("#album_2").DataTable({

"language": {
"url": "{{asset('dist/json/pl.json')}}"
}

});

$("#album_3").DataTable({

"language": {
"url": "{{asset('dist/json/pl.json')}}"
}

});
});
</script>

@endsection