@extends('admin.adminMaster')

@section('adminStyle')
<link rel="stylesheet" href="{{asset('assets/vendor/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/jquery-datatables-bs3/assets/css/datatables.css')}}" />
<style>
    .panel .returnSMS {
        background-color: cornflowerblue;
        padding: 5px;
        position: relative;
        margin-bottom: 5px;
    }

    .panel .returnSMS p {
        color: #f2f2f2f2;
    }

    .panel .returnSMS span {
        position: absolute;
        top: 2px;
        right: 10px;
        font-size: 26px;
        color: red;
        cursor: pointer;
    }
</style>
@endsection
@section('main-section')
<section class="panel">
    <header class="panel-heading">

        <h2 class="panel-title">User Post Lists</h2>
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
                    <th>Approved Or Not</th>
                    <th>Detail</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($userPost) > 0)
                    @foreach ($userPost as $posts)
                        <tr class="gradeX">
                            <td>{{$loop->index + 1}}</td>
                            <td>{{$posts->saleRent}}</td>
                            <td>{{$posts->address}},{{$posts->township}}</td>
                            <td>
                                <?php
                                if ($posts->approve == 0) {
                                ?>
                                <span class="text-danger">No Approved</span>
                                <?php
                                }else{
                                ?>
                                <span class="text-info">Approved Already</span>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-info" style="padding:1px 2px;font-size:12px;" href="{{route('user-post.show',$posts->id)}}">Detail</a>
                            </td>
                            <td>
                                <form action="{{route('user-post.destroy',$posts->id)}}" method="POST" style="display: none;" id="delete-{{$posts->id}}">
                                @csrf
                                @method('DELETE')
                                </form>
                                <button onclick="if(confirm('are you sure to delete this?')){event.preventDefault();document.getElementById('delete-{{$posts->id}}').submit()}else{event.preventDefault();}" class="btn btn-sm btn-danger" style="padding:1px 2px;font-size:12px;">delete</button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
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