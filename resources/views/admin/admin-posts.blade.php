@extends('admin.adminMaster')

@section('adminStyle')
<link rel="stylesheet" href="{{asset('assets/vendor/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/jquery-datatables-bs3/assets/css/datatables.css')}}" />
<style>
    .panel  .returnSMS{
        background-color:cornflowerblue;
        padding:5px;
        position: relative;
        margin-bottom:5px;
    }
    .panel .returnSMS p{
        color:#f2f2f2f2;
    }
    .panel .returnSMS span{
        position: absolute;
        top:2px;
        right:10px;
        font-size:26px;
        color:red;
        cursor: pointer;
    }
</style>
@endsection
@section('main-section')
<section class="panel">
    <header class="panel-heading">

        <h2 class="panel-title">Admin Post Lists</h2>
    </header>
    <div class="panel-body">
        @if (session()->has('delete'))
        <div class="returnSMS">
            <p>{{session()->get('delete')}}</p>
            <span class="closeSMS">&times;</span>
        </div>
        @endif
        
        <table class="table table-bordered table-striped mb-none" id="datatable-tabletools"
            data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>For Sale/Rent</th>
                    <th>Address</th>
                    {{-- <th>Category</th> --}}
                    <th>Uploaded On</th>
                    <th>Detail</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($property) > 0)
                    @foreach ($property as $items)
                        <tr class="gradeX">
                            <td>{{$loop->index +1}}</td>
                            <td>
                                <?php
                                    if ($items->saleRent =="for-rent") {
                                ?>
                                <p class="text-primary">{{$items->saleRent}}</p>
                                <?php
                                    }else{
                                ?>
                                <p class="text-warning">{{$items->saleRent}}</p>
                                <?php
                                    }
                                ?>
                            </td>
                            <td>{{$items->address}}, {{$items->township}}</td>
                            {{-- <td>{{$items->category}}</td> --}}
                            <td>{{$items->created_at->diffForHumans()}}</td>
                            <td>
                                <a style="padding:1px 2px;font-size:12px;" class="btn btn-success btn-sm" href="{{route('dashboard.show',$items->id)}}">Detail</a>
                            </td>
                            <td>
                                <a style="padding:1px 2px;font-size:12px;" class="btn btn-sm btn-warning"
                                    href="{{route('dashboard.edit',$items->id)}}">Edit</a>
                                <form action="{{route('dashboard.destroy',$items->id)}}" method="POST" style="display:none;" id="delete-{{$items->id}}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                
                                <button type="submit" onclick="if(confirm('are you sure to delete this?')){event.preventDefault(); document.getElementById('delete-{{$items->id}}').submit()}else{event.preventDefault();}" class="btn btn-danger btn-sm" style="padding:1px 2px;font-size:12px;">delete</button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="gradeX">
                        <td colspan="6" class="text-center">No Data</td>
                    </tr>
                @endif

            </tbody>
        </table>
    </div>
</section>
@endsection

@section('adminScript')
<script src="{{asset('assets/vendor/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/jquery-datatables/media/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js')}}"></script>
<script src="{{asset('assets/vendor/jquery-datatables-bs3/assets/js/datatables.js')}}"></script>

<script src="{{asset('assets/javascripts/tables/examples.datatables.default.js')}}"></script>
<script src="{{asset('assets/javascripts/tables/examples.datatables.row.with.details.js')}}"></script>
<script src="{{asset('assets/javascripts/tables/examples.datatables.tabletools.js')}}"></script>
<script>
    let closeSMS = document.querySelector('.closeSMS');
    closeSMS.addEventListener('click',function(){
        document.querySelector('.returnSMS').style.display="none";
    });
</script>
@endsection