{{-- @if (count($property) > 0) --}}
@foreach ($property as $list)
<div class="col" id="listItems">

    <p style="display:none;" class="myid">{{$list->id}}</p>
    <p style="display:none;" class="address">{{$list->address}}</p>
    <p style="display:none;" class="mytype">{{str_replace(' ',' ',ucwords(str_replace('-',' ',$list->saleRent)))}}</p>
    <p style="display:none;" class="mycat">{{str_replace(' ',' ',ucwords(str_replace('-',' ',$list->category)))}}</p>
    <p style="display:none;" class="mytown">{{$list->township}}</p>
    <p style="display:none;" class="otherImg">{{$list->otherImage}}</p>
    <p style="display:none;" class="mymainImg">{{$list->mainImage}}</p>
    <p style="display:none;" class="myTaken">{{$list->taken}}</p>
    <p style="display:none;" class="des">{{strip_tags($list->description)}}</p>
    <p></p>
    <div class="list-bg" style="background-image:url({{asset('public/adminUploads/'.$list->mainImage)}})">
        <span>{{$list->created_at->diffForHumans()}}</span>
    </div>
    <div class="info">
        <h4 class="price"><?php
                                    if ($list->money == 'mmk' AND $list->saleRent == 'for-rent') {
                                    ?>
            <span id="sortPrice">{{$list->price}}</span> {{$list->money}} <span id="perMonth">/mo</span>
            <?php
                                    }else if($list->money == 'mmk' AND $list->saleRent == 'for-sale'){
                                    ?>
            <span id="sortPrice">{{$list->price}}</span> {{$list->money}}
            <?php
                                    }else if($list->money == '$' AND $list->saleRent == 'for-rent'){
                                    ?>
            {{$list->money}} <span id="sortPrice">{{$list->price}}</span> <span id="perMonth">/mo</span>
            <?php
                                    }else if($list->money == '$' AND $list->saleRent == 'for-sale'){
                                    ?>
            {{$list->money}} <span id="sortPrice">{{$list->price}}</span>
            <?php
                                    }else{
                                    ?>
            {{$list->money}} {{$list->price}}
            <?php
                                    }
                                    ?>
        </h4>
        <p class="rooms"><span class="bed">
            <?php
                if($list->bedrooms != ''){
            ?>
            {{$list->bedrooms .' Bedrooms | '}}
            <?php
                }
            ?>
            <?php
                if($list->bathrooms != ''){
            ?>
            {{  $list->bathrooms .' Bathrooms | '}}
            <?php
                }
            ?>
            <?php
                if($list->floor != ''){
            ?>
            {{$list->floor .' | '}}
            <?php
                }
            ?>

            <?php
                if($list->square_feet != ''){
            ?>
            {{$list->square_feet . ' sqrft '}}
            <?php
                }
            ?>

            <?php
                if($list->carpark != ''){
            ?>
            {{$list->carpark .' Carpark '}}
            <?php
                }
            ?>
        </span> </p>
        <p class='types'><span class="listType1">{{str_replace('-',' ',$list->category)}}</span> <span
                class="listType2"> {{str_replace('-',' ',$list->saleRent)}}</span></p>
    </div>
</div>
@endforeach
{{-- @else
<div class="notfound">
    <h3>No Listings Found</h3>
    <a href="{{route('home')}}">Go back to home</a>
</div>
@endif --}}