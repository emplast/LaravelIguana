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
			<br/>
			<a href="{{url('addAlbum')}}" class="btn btn-info" style="margin-left: 25px;">Dodaj album</a>
			<br/><br/><br/>	
			<a href="{{url('panel/deleteUser')}}" class="btn btn-danger" style="margin-left: 25px;">Usuń konto</a>
		</div>
		
		<div class="col-sm-10">
			<?php foreach($albums as $album):?>
			<div class=" col-sm-4" style="height: 500px;">
				<div class="thumbnail">
					
					<a href="{{url('userAlbum',$album->id)}}" class="thumbnail" style="text-decoration: none;">
					<img src="{{asset($album->adres)}}" alt="..."></a>
					<div class="caption">
						<h3>{{$album->name}}</h3>
						<p>{{ $album->opis}}</p>
						<p>{{ $album->autor}}</p>
						<p>Komentarzy:{{count(App\Comment::get()->where('id_albumu',$album->id))}}</p>
                        <p>Odwiedzin:{{App\Visit::where('pageName',$album->id)->select('counts')->first()['counts']}}</p>
					</div>
				</div>
			
				
</div>

	<?php endforeach;?>		
			
			
			<div class=" col-md-2">
				<a href="#" class="thumbnail"style="text-decoration: none;">
					<img src="{{asset('storage/upload/uRWl0nnmIVkUqefau0CbT8c4gcmPWc3oCbkHnrv2.png')}}" alt="...">
				</a>
				<h3>Nazwa albumu</h3>
				<p>Opis albumu</p>
				<p>Autor albumu</p>
			</div>
		

		</div><!-- row-->
	</div>
	

	@endsection