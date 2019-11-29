@extends('layouts.app')

@section('content')
<div class="container-fluid">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <br/><br/><br/>
                    
        <p class="text-center">Teraz masz dostęp do wszystkich albumów i możesz utworzyć swój własny</p>
        <br/>
        <br/>
        <br/>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-11">
                    
                    <?php foreach ($data as $value):?>
                    <div class="col-md-4" style="height: 500px;">
                        <div class="thumbnail">
                            <a href="{{url('album',$value->id)}}" class="thumbnail" style="text-decoration: none;">
                                <img src="{{asset($value->adres)}}" alt="..." width="300" height="300"></a>
                            <div class="caption">
                                <h3>{{  $value->name}}</h3>
                                <p>{{ $value->opis}}</p>
                                <p>{{ $value->autor}}</p>
                               
                                <p>Komentarzy:{{count(App\Comment::get()->where('id_albumu',$value->id))}}</p>
                               
                                <p>Odwiedzin:{{App\Visit::where('pageName',$value->id)->select('counts')->first()['counts']}}</p>
                            </div>
                        </div>
                    </div>
                   <?php endforeach;?>
                   


                    
                
            </div>
            
            <div class="col-sm-1"></div>
        </div>
       

</div>
@endsection
