@extends('Admin.layout.app')
@section('title','OT')
@section('content')



<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
        
            <!-- start page title -->
            <div class="row">
                <div class="col-12 breadcrum mb-3">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h5 class="mb-sm-0 font-size-18">OT Booking</h5>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">OT</a></li>
                                <li class="breadcrumb-item active">Update</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>       

            <div class="row">
                <div class="col form-background p-3">
                    <div class="card mx-auto" style="width: 80%;">
                        <div class="card-body">
                            <!--  Switch Button For IPD  Booking Form -->
                            <!-- <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" value="New" checked> 
                            </div> -->
                            
                            <form   action="{{route('OT.otupdate')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 row">                                  
                                    <h5><span>OT booking Update</span></h5>                                    
                    
                                    <div class="col-sm-6 mt-3">
                                    <input class="form-control" type="hidden" name="id"  value="{{$data->id}}"  >                        
                                        <input class="form-control" type="text" name="patient"  value="{{$data->patient}}" placeholder="Enter Patient name" >                        
                                        <span class="text-danger"> @error('patient') {{$message}}  @enderror  </span>  
                                    </div>

                                    <div class="col-sm-6 mt-3">
                                        <select class="form-control" name="doctor" id=""  required>
                                            <option value="">Select Doctor</option>
                                            @foreach($doctor as $doctor_data)
                                              <option value="{{$doctor_data->doctor_id}}" {{isset($data->doctor) && ($doctor_data->doctor_id == $data->doctor) ? 'selected' : ''}}>{{$doctor_data->doctor_name}}</option>
                                            @endforeach
                                            
                                        </select>   
                                        <span class="text-danger"> @error('doctor') {{$message}}  @enderror  </span>                        
                                    </div>
                                    
                                    
                                    <div class="col-sm-6  mt-3">
                                           <select name="ot_number" id="OTNumber" class="form-control"  required>
                                                   <option value="">Select OT</option>
                                                   @foreach($list as $list_data)
                                                   <option value="{{$list_data->id}}" {{isset($data->ot_number) && ($list_data->id == $data->ot_number) ? 'selected' : ''}}>{{$list_data->OT_number}}</option>
                                                   @endforeach
                                            </select>
                                            <span class="text-danger"> @error('ot_number') {{$message}}  @enderror  </span>
                                    </div>

                                    <div class="col-sm-6  mt-3">
                                      <input class="form-control" type="text" name="ot_price" id="OTPrice" value="{{$data->ot_price}}" >
                                      <span class="text-danger"> @error('ot_price') {{$message}}  @enderror  </span>
                                    </div>
                                    <div class="col-sm-6  mt-3">
                                      <input class="form-control" type="text" name="requested_by"  value="{{$data->requested_by}}" placeholder="Referd by">
                                      <span class="text-danger"> @error('requested_by') {{$message}}  @enderror  </span>
                                    </div>
                                    <div class="col-sm-6 mt-3">
                                        <input type="text" class="form-control" id="date" name="date" value="{{$data->booking_date}}" placeholder="Date of OT booking" >
                                        <span class="text-danger"> @error('date') {{$message}}  @enderror  </span>
                                    </div>
                                   
                                       <!-- time show -->
                                    <div  class="col-12">
                                        <label for=""> time show</label>
                                        <div  class="col-sm-12 mt-3" id="time">
                                        </div>
                                    <input type="hidden" id="timeInput" name="booking_time" value="{{$data->booking_time}}">
                                    <span class="text-danger"> @error('booking_time') {{$message}}  @enderror  </span>
                                    </div>
                                                            
                                    <div class="box-footer mt-3">
                                            <a href="{{route('OT.otlist')}}">
                                                <button type="button" class="btn cwc-btn-warning me-1">
                                                    <i class="ti-trash"></i> Cancel
                                                </button>
                                            </a>  

                                        <button type="submit" class="btn cwc-btn-primary" id="submitBtn" >
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





<script>
    
    var token = "{{ csrf_token() }}";
    var List_url = "{{route('OT.otListShow')}}";
    var timetable_url ="{{route('OT.ottimetable')}}";
</script>

<!-- OT number show -->
<script>

    $(document).on('change','#OTNumber',function(){
          var number = $(this).val();
            $.ajax({
                url: List_url,
                type: "POST",
                data: { number :number, _token: token},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $('#OTPrice').val('₹ ' + response.OTlist.OT_price);
                }
            });
    });
</script>

<!-- OT booking Time show-->
<script>
  

  $(document).ready(function () {
        // Initialize a variable to store the selected time
        let selectedTime = "";
        let startTime = null;
        let endTime = null;
        function updateTimeTable() {
            var id = $('#OTNumber').val();
            var date = $('#date').val();
             // Check if the doctor value is not empty before making the AJAX request
             if (id !== "") {
                $.ajax({
                    url: timetable_url,
                    type: "POST",
                    dataType: 'json',
                    data: {
                        _token: token,
                        id: id,
                        date: date
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        // Get the 'status' value
                       
                        const status = response.status;
                        let selectedTimes = [];
                        if (status === "1") {
                            const from = response.timesloat.from;
                            const to = response.timesloat.to;
                            const booktimed = response.booktimed;
         
                            // Divide the time into 15-minute intervals
                            const timeSlots = [];
                            let currentTime = from;
                            while (currentTime < to) {
                             
                                timeSlots.push(currentTime);
                                // Increment currentTime by 15 minutes
                                const [hours, minutes] = currentTime.split(":").map(Number);
                                const newMinutes = (minutes + 30) % 60;
                                const newHours = hours + Math.floor((minutes + 30) / 60);
                                currentTime = `${String(newHours).padStart(2, "0")}:${String(newMinutes).padStart(2, "0")}`;
                            }

                            // Display time slots as toggle buttons
                            const timeDiv = $('#time');
                            timeDiv.html(timeSlots.map((slot, index) => {
                                // Check if the current slot is in booktimed
                                const isBooked = booktimed.includes(slot);
                                // Add 'active' class to booked slots and disable them
                                const buttonClass = isBooked ? 'toggle-button active disabled' : 'toggle-button';
                                // Add 'data-slot' attribute with the slot value
                                return `<button id="timeSlot${index}" class="${buttonClass} m-2 btn " data-slot="${slot}" ${isBooked ? 'disabled' : ''}>${slot}</button>`;
                            }).join(""));
                           
     
                          
                            
                            // Initialize start and end times based on existing data
                            var existingData = $('#timeInput').val();
                            if (existingData) {
                                const [start, end] = existingData.split(" - ");
                                startTime = start;
                                endTime = end;
                            }
                            //check if time alredy save
                            function updateButtons() {
                                $('.toggle-button').each(function () {
                                    var slot = $(this).data('slot');
                                    if (slot >= startTime && slot <= endTime) {
                                        $(this).addClass('active');
                                    } else {
                                        $(this).removeClass('active');
                                    }
                                });
                            }

                           // Set start time
                            $('.toggle-button').on('click', function (event) {
                                if (!$(this).hasClass('disabled')) {
                                    event.preventDefault();

                                    var clickedTime = $(this).data('slot');

                                    if (startTime === null) {
                                        // Set start time on the first click
                                        startTime = clickedTime;
                                        $(this).addClass('active');
                                    } else {
                                        // Determine start and end times
                                        endTime = clickedTime > startTime ? clickedTime : startTime;
                                        startTime = clickedTime > startTime ? startTime : clickedTime;

                                        // Toggle 'active' class based on the selected range
                                        $('.toggle-button').removeClass('active');
                                        $('.toggle-button').each(function () {
                                            var slot = $(this).data('slot');
                                            if (slot >= startTime && slot <= endTime) {
                                                $(this).addClass('active');
                                            }
                                        });

                                        // Set the value of the hidden input field with the name 'time'
                                        $('#timeInput').val(startTime + (startTime !== endTime ? ' - ' + endTime : ''));

                                        // Reset start and end times for the next selection
                                        startTime = null;
                                        endTime = null;
                                    }
                                }
                            });

                            updateButtons();


                        } else if (status === "0") {
                            // Display a message if status is '0' without red color
                            const messageDiv = $('#time');
                            messageDiv.html("This Date Doctor not Available. Please select another date.");
                            messageDiv.addClass('error-message');
                        }
                    }
                });
            }; 
        };
        // Attach change event handlers to both date and doctor fields
        $('#date, #OTNumber').on('change', function () {
            // Call the function to update the doctor's timetable
            updateTimeTable();
        });
 
        // Initialize by calling the function when the page loads
        updateTimeTable();

    });

</script>

@endsection