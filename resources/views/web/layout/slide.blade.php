<div class="row carousel-holder">
    <div class="col-md-12">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @for($i = 0; $i < count($slide); $i++)
                    <li data-target="#carousel-example-generic" data-slide-to="{{$i}}" 
                    class="@if($i == 0) {{'active'}} @endif"></li>
                @endfor
            </ol>
            <div class="carousel-inner">
                @for($i = 0; $i < count($slide); $i++)
                    <div class="item @if($i == 0) {{'active'}} @endif">
                        <img class="slide-image" src="upload/slide/{{$slide[$i]->Hinh}}" alt="{{$slide[$i]->NoiDung}}">
                    </div>
                @endfor
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
    </div>
</div>