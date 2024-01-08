@extends('Admin.layout.app')
@section('title','OT')
@section('content')






<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
        @if(session('success'))                
                <script>
                    window.onload = function() {
                        Swal.fire({
                        width: '400px',
                        title: 'Success!',
                        text: '{{ session('success') }}',
                        icon: 'success'
                        });
                    }
                </script>
            @endif
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h5 class="mb-sm-0 font-size-18">OT Book</h5>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">OT Book</a></li>
                                <li class="breadcrumb-item active">Listing</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row my-2">
                <div class="col-12 form-background p-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-md-12 text-start">
                                  
                                    <a href="{{route('OT.otbook')}}" class="btn cwc-btn-primary waves-effect waves-light bx bx-plus-medical">Add</a>
                                </div>
                            </div>
                            <table id="OTBook" class="table-bordered dt-responsive table-striped w-100">
                                <thead class="table-bordered">
                                    <tr>
                                       <th>S.No</th>
                                        <th>OT Number</th>
                                        <th>OT Price</th>
                                        <th>Doctor</th>
                                        <th>Patient</th>
                                        <th>Requested By</th>
                                        <th>Booking Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                               
                                
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>

    <!-- End Page-content -->
</div>




<script>
    
    var token = "{{ csrf_token() }}";
    var delete_url = "{{route('OT.otdelete')}}";
    var OTBookturl = "{{route('OT.ajaxOTBook')}}";
</script>

<!-- Data show using ajax -->
<script>      
    $(document).ready(function() {
        var table = $('#OTBook').DataTable({
            "pageLength": 20,
            "order": [],
            "ajax": {
                "url": OTBookturl,
                "type": "GET",
            },
            "columnDefs": [{
                "targets": [0],
                "orderable": false
            }]
        });

        $('.toggle-columns').on('click', function() {
            table.columns().visible(!table.columns().visible()[0]);
        });
    });

</script>


<script>
    // Ajax Delete
    $(document).on('click','#deleteOTBook',function () {
        var id = $(this).data('id');
        Swal.fire({
            title: "Are you sure?",
            text: "you want to delete ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'alert_btn mx-2',
            cancelButtonClass: 'alert_btn ',
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel'
        }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: delete_url,
                    dataType:'html',
                    data: { _token:token ,id: id},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function (data) {
                        var arr = jQuery.parseJSON(data);
                        if(arr['status'] == '0'){
                            Swal.fire({ title: arr['message'], confirmButtonColor: "#556ee6" });
                        }else{
                            Swal.fire({ title: arr['message'], confirmButtonColor: "#556ee6" });
                            window.location.reload();
                        }
                    }

                });
            }
            }
        );
    });
</script>

@endsection