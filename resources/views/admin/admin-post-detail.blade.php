@extends('admin.adminMaster')

@section('main-section')

<div class="row">

    <div class="col-md-6 col-lg-12 col-xl-6">
        @if (session()->has('updateTaken'))
        <p class="text-light bg-success">{{session()->get('updateTaken')}}</p>
        @endif
        @foreach ($detail as $details)
            <h5>Post Detail of {{str_replace(' ',' ',ucwords(str_replace('-',' ',$details->category)))}}, {{str_replace(' ',' ',ucwords(str_replace('-',' ',$details->saleRent)))}}</h5>
            <div class="row">
                <div class="col-md-6">
                    <h5>Post ID - {{$details->id}}</h5>
                </div>
                <div class="col-md-6">
                    <?php
                        if ($details->taken == 0) {
                    ?>
                        <form action="{{route('updateTaken',$details->id)}}" method="POST">
                            @csrf
                            <input type="hidden" name="taken" value="1">
                            <button name="submit" type="submit" class="btn btn-success btn-sm">Sold Out or Taken</button>
                        </form>
                    <?php
                        }else{
                    ?>
                        <button class="btn btn-dark btn-sm">Already Sold out or Taken</button>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <p>Address- {{$details->address}}, {{$details->township}}</p>
                </div>
                <div class="col-md-4">
                    <p>Price - {{$details->money}} {{$details->price}}</p>
                </div>
                <div class="col-md-4">
                    <p>
                        <?php
                        if ($details->bedrooms != '') {
                        ?>
                            {{$details->bedrooms .' Bedrooms | '}}
                            <?php
                            }
                            ?>
                            
                            <?php
                            if ($details->bathrooms != '') {
                            ?>
                            {{$details->bathrooms .' Bathrooms | '}}
                            <?php
                            }
                            ?>
                            
                            <?php
                                if ($details->floor != '') {
                            ?>
                            {{$details->floor}}
                            <?php
                                }
                            ?>
                            
                            <?php
                                if ($details->square_feet != '') {
                            ?>
                            {{$details->square_feet .' Sqrft | '}}
                            <?php
                                }
                            ?>
                            <?php
                                if ($details->carpark != '') {
                            ?>
                            {{$details->carpark .' Carpark '}}
                            <?php
                                }
                            ?>
                    </p>
                </div>
            </div>
            <h5 class="text-warning">Description</h5>
            <p>{{$details->description}}</p>
            <p class="text-warning">Main Image</p>
            <img src="{{asset('storage/adminUploads/'.$details->mainImage)}}" class="img-thumbnail" alt="">
            <p>Other Image</p>
            <div class="row">
                @php
                    $loopImg = explode('|',$details->otherImage);
                @endphp
                @foreach ($loopImg as $otherImg)
                    <div class="col-md-3" style="margin-bottom:15px;">
                        <img style="height:140px;" src="{{asset($otherImg)}}" class="img-thumbnail" alt="">
                    </div>
                @endforeach
            </div>
            <button onclick="window.history.back()" class="btn btn-sm btn-dark">Back</button>
        @endforeach
        
    </div>
</div>
@section('adminScript')
<script>
    let closeSMS = document.querySelector('.closeSms');
    closeSMS.addEventListener('click',function(){
        document.querySelector('.pop').style.display="none";
    });
</script>
@endsection
@endsection