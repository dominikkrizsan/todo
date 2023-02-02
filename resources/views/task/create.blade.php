@extends ('layouts.app')

    @section ('content')

    <div class="row mt-3">
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 m-auto ">

            <div class="card shadow">
                <div class="card-header card-header-self">
                    <div class="card-title font-weight-bold text-white">Add A Task ToDo</div>
                </div>

                <form id="taskForm">
                    <div class="card-body">
                    @if(Session::has('success'))
                        <div class='alert alert-success'>
                            {{ Session::get('success') }}
                            @php 
                                Session::forget('success')
                            @endphp
                        </div>
                    @endif
                        <div class="form-group">
                            <label for="task_title">Task Title</label>
                            <input id="task_title" type="text" class="form-control" name="task_title" id="task_title" placeholder="Task Title">
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <input id="description" type="text" class="form-control" name="description" placeholder="Description">
                        </div>
                        <button type="button" id="saveBtn" class="add-t-btn">Save Task</button>
                    <div id="result"></div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $("#saveBtn").click(function(e) {
            e.preventDefault();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                    method    :   "POST",
                    url     :   "/task/store",
                    data    :   {
                        title: $('#task_title').val(),
                        description: $('#description').val(),
                    },

                    success: function(res) { 
                        if(res.status == "success") {
                            $("#result").html("<div class='alert alert-success mt-3'>" + res.message + "</div>");
                            setTimeout(window.location.href="/", 2000);
                         }
                         
                        else if(res.status == "failed") {
                            $("#result").html("<div class='alert alert-danger'>" + res.message + "</div>");
                            console.log('prob')
                        }
                    }                   
            });
        });        
    });
</script>