@extends('Admin.layout.app')
@section('title','Department Add')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
        
            <!-- start page title -->
            <div class="row">
                <div class="col-12 breadcrum mb-3">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h5 class="mb-sm-0 font-size-18">OT</h5>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">OT</a></li>
                                <li class="breadcrumb-item active">Add</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>       

            <div class="row">
    <div class="col form-background p-3">
        <div class="card mx-auto" style="width: 80%;">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title">Add</h5>
                    </div>
                </div>
                
                <form action="{{route('OT.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row">
                        <div class="col-md-12 mt-3">

                                <lable class="required" >OT Number</lable>
                                <input class="form-control" type="text" value="{{old('ot_number')}}"  placeholder="Enter OT number " name="ot_number" required> 
                                <span class="text-danger"> @error('ot_number') {{$message}}  @enderror  </span>
                        </div>  
                       
                        <div class="col-md-12 mt-3" >
                                <lable class="required">Price</lable>
                                <input class="form-control" type="text" value="" placeholder="Enter Price" name="ot_price" required>
                             <span class="text-danger"> @error('ot_price') {{$message}}  @enderror  </span>
                        </div>                                            
                       
                       
                        <div class="box-footer" style="margin-top:20px">
                            <a href="{{route('OT.list')}}">
                                <button type="button" class="btn cwc-btn-warning me-1">
                                    <i class="ti-trash"></i> Cancel
                                </button>
                            </a>    
                            <button type="submit" class="btn cwc-btn-primary" >
                                <i class="ti-save-alt"></i> Submit
                            </button>
                        </div>  
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

@endsection


