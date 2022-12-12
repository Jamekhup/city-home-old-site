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

        <h2 class="panel-title">User Accounts</h2>
    </header>
    <div class="panel-body">
        @if (session()->has('deleteUser'))
        <div class="returnSMS">
            <p>{{session()->get('deleteUser')}}</p>
            <span class="closeSMS">&times;</span>
        </div>
        @endif
      <table class="table table-bordered table-striped mb-none" id="datatable-tabletools"
        data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
        <thead>
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>Email Address</th>
                <th>Verified Or Not</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (count($user) > 0)
                @foreach ($user as $users)
                    <tr class="gradeX">
                        <td>{{$loop->index + 1}}</td>
                        <td>{{$users->name}}</td>
                        <td>{{$users->email}}</td>
                        <td>
                            <?php
                            if ($users->email_verified_at != null) {
                            
                            ?>
                            <span class="text-info">Verified User</span>
                            <?php
                            }else{
                            ?>
                            <span class="text-danger">Not Verified User</span>
                            <?php
                            }
                            ?>
                        </td>
                        <td>
                            <form action="{{route('deleteUser',$users->id)}}" method="POST" style="display: none;" id="delete-{{$users->id}}">
                                @csrf
                                
                            </form>
                            <button onclick="if(confirm('are your sure to delete this user?')){event.preventDefault();document.getElementById('delete-{{$users->id}}').submit();}else{event.preventDefault();}" class="btn btn-sm btn-danger">Delete User</button>
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