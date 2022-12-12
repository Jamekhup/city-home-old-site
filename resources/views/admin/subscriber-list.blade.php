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

        <h2 class="panel-title">Admin Post Lists</h2>
    </header>
    <div class="panel-body">
        @if (session()->has('deleteSub'))
        <div class="returnSMS">
            <p>{{session()->get('deleteSub')}}</p>
            <span class="closeSMS">&times;</span>
        </div>
        @endif
        <table class="table table-bordered table-striped mb-none" id="datatable-tabletools"
            data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email Address</th>
                    <th>Verify or Not</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              @if (count($sub) > 0)
                  @foreach ($sub as $subs)
                      <tr class="gradeX">
                        <td>{{$loop->index +1}}</td>
                        <td>{{$subs->email}}</td>
                        <td>
                            <?php
                                if($subs->token != "" AND $subs->email_verify == null){
                            ?>
                                <span class="text-danger">Not Verify</span>
                            <?php
                                }else{
                            ?>
                                <span>Verified Already</span>
                            <?php
                                }
                            ?>
                        </td>
                        <td>
                            <form action="{{route('deleteSubscriber',$subs->id)}}" method="POST" style="display: none;" id="delete-{{$subs->id}}">
                                @csrf
                            </form>
                            <button onclick="if(confirm('are you sure to delete this?')){event.preventDefault();document.getElementById('delete-{{$subs->id}}').submit();}else{event.preventDefault();}" class="btn btn-sm btn-danger">Delete This Subscriber</button>
                        </td>
                    </tr>
                  @endforeach
              @else
                  
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