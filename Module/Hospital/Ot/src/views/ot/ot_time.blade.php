@extends('Admin.layout.app')
@section('title','OT')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
       
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h5 class="mb-sm-0 font-size-18">OT</h5>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">OT</li>
                                <li class="breadcrumb-item active">Working Hours</li>
                                
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row mt-3">
                <div class="col-12 form-background p-3">
                    <div class="card mx-auto" style="width: 85%;">
                        <div class="card-body"> 
                            
                            <div class="row">               
                                <div class="col-md-11">
                                    <ul class="nav nav-tabs">
                                      
                                                                          
                                            
                                    </ul>                                    
                                </div>
                            </div>
                            <form class="mt-2" action="{{route('OT.time')}}" method="post"  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{$id}}"/>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Day</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $arr = [__('Monday'), __('Tuesday'), __('Wednesday'), __('Thursday'), __('Friday'), __('Saturday'), __('Sunday')]; ?>

                                        <?php $i = 0; ?>

                                        @if(count($working)>0)

                                        @foreach($working as $work)

                                        <tr>


                                            <td><input type="hidden" name="day[]" id="day{{$i}}" readonly="" value="{{$i+1}}" class="form-control" />

                                                @if(($i+1)==1)

                                                <span>{{$arr[0]}}</span>

                                                @elseif(($i+1)==2)

                                                <span> {{$arr[1]}}</span>

                                                @elseif(($i+1)==3)

                                                <span>{{$arr[2]}}</span>

                                                @elseif(($i+1)==4)

                                                <span> {{$arr[3]}}</span>

                                                @elseif(($i+1)==5)

                                                <span> {{$arr[4]}}</span>

                                                @elseif(($i+1)==6)

                                                <span> {{$arr[5]}}</span>

                                                @else

                                                <span> {{$arr[6]}}</span>

                                                @endif

                                            </td>

                                            <td><input type="time" required name="from[]" id="from{{$i}}" class="form-control" value="<?= isset($work->from) ? $work->from : "" ?>" /></td>

                                            <td><input type="time" required name="to[]" id="to{{$i}}" value="<?= isset($work->to) ? $work->to : "" ?>" class="form-control" onchange="checktime(this.value,'{{$i}}')" /></td>

                                            @if($work->status == 0)        
                                                <td><button type="button" data-id="{{$work->time_id}}" data-status="1" class="btn cwc-btn-primary statuschange">Active</button></td>
                                                
                                            @else
                                                <td><button type="button" data-id="{{$work->time_id}}" data-status="0" class="btn btn-danger statuschange">Inactive</button></td>

                                            @endif


                                        </tr>

                                        <?php $i++; ?>

                                        @endforeach  

                                        @else

                                        @foreach($arr as $a)

                                        <tr>


                                            <td><input type="hidden" name="day[]" id="day{{$i}}" readonly="" value="{{$i+1}}" class="form-control" />

                                                <span>{{$a}}</span>

                                            </td>

                                            <td><input type="time" required name="from[]" id="from{{$i}}" class="form-control" value="{{time()}}"  /></td>

                                            <td><input type="time" required name="to[]" id="to{{$i}}" value="" class="form-control" onchange="checktime(this.value,'{{$i}}')"  /></td>

                                        </tr>

                                        <?php $i++; ?>

                                        @endforeach 

                                        @endif

                                    </tbody>

                                    </table>

                                </div>
                              
                                <div class="box-footer mt-3">
                                    <a href="{{route('OT.list')}}"><button type="button" class="btn cwc-btn-warning me-1"> Cancel </button></a>    
                                    <button type="submit" class="btn cwc-btn-primary" >
                                        Submit
                                    </button>
                                </div> 
                                            
                            </form>
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
    var status_url = "{{route('OT.otstatus')}}";
</script>
<script>
    // Ajax for  Time Status Change

    $(document).on('click', '.statuschange', function () {
        var id = $(this).data('id');
        var value = $(this).data('status');
            Swal.fire({ 
                title: "Are you sure?", 
                text: "you want to change status?", 
                icon: "warning", showCancelButton: !0, 
                confirmButtonColor: "#34c38f", 
                cancelButtonColor: "#f46a6a", 
                confirmButtonText: "Yes!",
                cancelButtonText: "Cancel"

            }).then( function (result) {       
                if (result.isConfirmed) {
                    $.ajax({
                    type: "POST",
                    url: status_url,
                    dataType:'html',
                    data: { _token:token ,id: id,value: value },
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
            
        });
        
    });
</script>


@endsection