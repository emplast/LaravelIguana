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
				<img src="{{asset($front->adres)}}" alt="..."></a>
				<div class="caption">
					<h3><?php echo $album->name;?></h3>
					<p><?php echo $album->opis;?></p>
					<p><?php echo $album->autor;?></p>
					<p>Komentarzy: {{ $comments}}</p>
					<p>Odwiedzin: {{$visits}}</p>
				</div>
				
			</div><br/>
			<h3>Komentarze</h3><br/>
			<?php foreach ($komantarze as $komentarz ):?>
			
			<p><b>{{$komentarz->autor}}</b></p>
			<p><i>{{$komentarz->opis}}</i></p>
			<?php endforeach;?>
			<a href="{{url('comment',['id'=>$id])}}"class="btn btn-info">Dodaj komentarz do albumu</a>
		</div>
		<div class="col-sm-6 col-sm-7">
			{!! Form::open(['url'=>'album/'.$album->id,'class'=>'form-horizontal','enctype'=>'multipart/form-data'])!!}
			<div class="col-md-2" >
				{!! Form::submit('Dodaj oceny ',['class'=>'btn btn-info btn-sm pull-left'])!!}
			</div>
			<?php foreach ($zdjecia as $zdjecie):?>
			<div class=" col-md-2"style="height: 500px;">
				<a href="#" class="thumbnail"style="text-decoration: none;">
					<img src="{{asset($zdjecie->adres)}}" alt="..." style="height: 75px;">
				</a>
				<h3>{{$zdjecie->name}}</h3>
				<p>{{ $zdjecie->opis}}</p>
				<p>{{ $zdjecie->autor}}</p>
				
				<span id="a_1_{{$zdjecie->id}}" class="glyphicon glyphicon-star-empty" aria-hidden="true" style="margin-bottom: 2px; color:#ff9900"></span>&nbsp;
				<span id="a_2_{{$zdjecie->id}}" class="glyphicon glyphicon-star-empty" aria-hidden="true" style="margin-bottom: 2px; color:#ff9900"></span>&nbsp;
				<span id="a_3_{{$zdjecie->id}}" class="glyphicon glyphicon-star-empty" aria-hidden="true" style="margin-bottom: 2px; color:#ff9900"></span>&nbsp;
				<span id="a_4_{{$zdjecie->id}}" class="glyphicon glyphicon-star-empty" aria-hidden="true" style="margin-bottom: 2px; color:#ff9900"></span>&nbsp;
				<span  id="a_5_{{$zdjecie->id}}" class="glyphicon glyphicon-star-empty" aria-hidden="true" style="margin-bottom: 2px; color:#ff9900"></span>&nbsp;
				<br/><br/><hr>
				<?php $names=DB::table('ratings as a')
								->select('a.*','b.name as nameR')
								->leftJoin('users as b','a.id_uzytkownika','=','b.id')
								->where('a.id_zdjecia',$zdjecie->id)
								->where('a.id_albumu',$zdjecie->id_albumu)
								->orderBy('id','desc')->get(); $i=0;foreach($names as $name):
								if($i<2):
								 $i++; ?>
				<p>Ocenił:<b>{{$name->nameR}}</b><p>
				<p>Ocena:<br/>	<?php if($name->ocena==1) {
						
							echo '<span  class="glyphicon glyphicon-star" aria-hidden="true" style="margin-bottom: 2px; color:#ff9900"></span>&nbsp;';
							}
							 if($name->ocena==2)
							{


							echo '<span  class="glyphicon glyphicon-star" aria-hidden="true" style="margin-bottom: 2px; color:#ff9900"></span>&nbsp;<span  class="glyphicon glyphicon-star" aria-hidden="true" style="margin-bottom: 2px; color:#ff9900"></span>&nbsp;';
							
							}
							if($name->ocena==3)
							{
								echo '<span  class="glyphicon glyphicon-star" aria-hidden="true" style="margin-bottom: 2px; color:#ff9900"></span>&nbsp;<span  class="glyphicon glyphicon-star" aria-hidden="true" style="margin-bottom: 2px; color:#ff9900"></span>&nbsp;<span  class="glyphicon glyphicon-star" aria-hidden="true" style="margin-bottom: 2px; color:#ff9900"></span>&nbsp;';
							}
							
							if($name->ocena==4)
							{
								echo '<span  class="glyphicon glyphicon-star" aria-hidden="true" style="margin-bottom: 2px; color:#ff9900"></span>&nbsp;<span  class="glyphicon glyphicon-star" aria-hidden="true" style="margin-bottom: 2px; color:#ff9900"></span>&nbsp;<span  class="glyphicon glyphicon-star" aria-hidden="true" style="margin-bottom: 2px; color:#ff9900"></span>&nbsp;
							<span  class="glyphicon glyphicon-star" aria-hidden="true" style="margin-bottom: 2px; color:#ff9900"></span>&nbsp;';
							}
							
							if($name->ocena==5)
							{
								echo '<span  class="glyphicon glyphicon-star" aria-hidden="true" style="margin-bottom: 2px; color:#ff9900"></span>&nbsp;<span  class="glyphicon glyphicon-star" aria-hidden="true" style="margin-bottom: 2px; color:#ff9900"></span>&nbsp;<span  class="glyphicon glyphicon-star" aria-hidden="true" style="margin-bottom: 2px; color:#ff9900"></span>&nbsp;
							<span  class="glyphicon glyphicon-star" aria-hidden="true" style="margin-bottom: 2px; color:#ff9900"></span>&nbsp;<span  class="glyphicon glyphicon-star" aria-hidden="true" style="margin-bottom: 2px; color:#ff9900"></span>&nbsp;';
							}
							
							
						
					?>
				</p><hr>	
			<?php endif;endforeach;?>
				
				{!! Form::hidden('ocena_'.$zdjecie->id.'','0',['id'=>'ocena_'.$zdjecie->id])!!}
				{!! Form::hidden('id_zdjecia_'.$zdjecie->id,$zdjecie->id)!!}
			</div>
			<?php endforeach;?>

			{!! Form::hidden('id_uzytkownika',Auth::user()->id)!!}
			{!! Form::hidden('id_albumu',$album->id)!!}
			<br/>

			{!! Form::close()!!}
			
		</div>
		<!-- row -->
	</div>
	<script type="text/javascript">
		
		$(function(){

	<?php foreach ($zdjecia as $zdjecie):?>
	$('#a_1_'+<?php echo $zdjecie->id?>).click(function(){
	$('#a_1_'+<?php echo $zdjecie->id?>+', #a_2_'+<?php echo $zdjecie->id ?>+', #a_3_'+<?php echo $zdjecie->id ?>+' ,#a_4_'+<?php echo $zdjecie->id?>+', #a_5_'+<?php echo $zdjecie->id?>).attr('class','glyphicon glyphicon-star-empty');
	$('#a_1_'+<?php echo $zdjecie->id?>).attr('class','glyphicon glyphicon-star');
	$('#ocena_'+<?php echo $zdjecie->id?>).attr('value',1);
	});
	$('#a_2_'+<?php echo $zdjecie->id?>).click(function(){
	$('#a_1_'+<?php echo $zdjecie->id?>+', #a_2_'+<?php echo $zdjecie->id ?>+', #a_3_'+<?php echo $zdjecie->id ?>+' ,#a_4_'+<?php echo $zdjecie->id?>+', #a_5_'+<?php echo $zdjecie->id?>).attr('class','glyphicon glyphicon-star-empty');
	$('#a_1_'+<?php echo $zdjecie->id?>).attr('class','glyphicon glyphicon-star');
	$('#a_2_'+<?php echo $zdjecie->id?>).attr('class','glyphicon glyphicon-star');
	$('#ocena_'+<?php echo $zdjecie->id?>).attr('value','2');
	});
	$('#a_3_'+<?php echo $zdjecie->id?>).click(function(){
	$('#a_1_'+<?php echo $zdjecie->id?>+', #a_2_'+<?php echo $zdjecie->id ?>+', #a_3_'+<?php echo $zdjecie->id ?>+' ,#a_4_'+<?php echo $zdjecie->id?>+', #a_5_'+<?php echo $zdjecie->id?>).attr('class','glyphicon glyphicon-star-empty');
	$('#a_1_'+<?php echo $zdjecie->id?>).attr('class','glyphicon glyphicon-star');
	$('#a_2_'+<?php echo $zdjecie->id?>).attr('class','glyphicon glyphicon-star');
	$('#a_3_'+<?php echo $zdjecie->id?>).attr('class','glyphicon glyphicon-star');
	$('#ocena_'+<?php echo $zdjecie->id?>).attr('value','3');
	});
	$('#a_4_'+<?php echo $zdjecie->id?>).click(function(){
	$('#a_1_'+<?php echo $zdjecie->id?>+', #a_2_'+<?php echo $zdjecie->id ?>+', #a_3_'+<?php echo $zdjecie->id ?>+' ,#a_4_'+<?php echo $zdjecie->id?>+', #a_5_'+<?php echo $zdjecie->id?>).attr('class','glyphicon glyphicon-star-empty');
	$('#a_1_'+<?php echo $zdjecie->id?>).attr('class','glyphicon glyphicon-star');
	$('#a_2_'+<?php echo $zdjecie->id?>).attr('class','glyphicon glyphicon-star');
	$('#a_3_'+<?php echo $zdjecie->id?>).attr('class','glyphicon glyphicon-star');
	$('#a_4_'+<?php echo $zdjecie->id?>).attr('class','glyphicon glyphicon-star');
	$('#ocena_'+<?php echo $zdjecie->id?>).attr('value','4');
	});
	$('#a_5_'+<?php echo $zdjecie->id?>).click(function(){
	$('#a_1_'+<?php echo $zdjecie->id?>+', #a_2_'+<?php echo $zdjecie->id ?>+', #a_3_'+<?php echo $zdjecie->id ?>+' ,#a_4_'+<?php echo $zdjecie->id?>+', #a_5_'+<?php echo $zdjecie->id?>).attr('class','glyphicon glyphicon-star-empty');
	$('#a_1_'+<?php echo $zdjecie->id?>).attr('class','glyphicon glyphicon-star');
	$('#a_2_'+<?php echo $zdjecie->id?>).attr('class','glyphicon glyphicon-star');
	$('#a_3_'+<?php echo $zdjecie->id?>).attr('class','glyphicon glyphicon-star');
	$('#a_4_'+<?php echo $zdjecie->id?>).attr('class','glyphicon glyphicon-star');
	$('#a_5_'+<?php echo $zdjecie->id?>).attr('class','glyphicon glyphicon-star');
	$('#ocena_'+<?php echo $zdjecie->id?>).attr('value','5');
	});
	
	<?php endforeach;?>
	});
	</script>
	@endsection