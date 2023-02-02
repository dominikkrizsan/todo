@extends ('layouts.app')

    @section ('content')
<div class="main-container">
    <div class="top-container">
        <h1>Your Tasks</h1>
        <a href="{{ url('task/create') }}" class="add-t-btn"> Add New Task </a>
    </div>
        @forelse($tasks as $task)
        <div class="task-container">
            <div class="task-container-iner">
                <input class="deleteRecord" type="radio" data-id="{{ $task->id }}">
                <li>{{ $task->task_title }}</li>
                <li>{{ $task->description }}</li>
            </div>
            <div>
                <a class="edit" href="{{ url('task/edit/'.$task->id) }}">edit</a>
            </div>
        </div>
        @empty
        <div class="no-task-container d-flex align-items-center justify-content-center mt-5">
            <li>You don't have any tasks</li>
            <li class="p-2"><i class="fa-solid fa-circle-check"></i></li>
        </div>
        @endforelse
    </div>
    <script>
        $(".deleteRecord").change(function(){
            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax(
            {
                url: "task/"+id,
                type: 'DELETE',
                data: {
                    "id": id,
                    "_token": token,
                },
                success: function (){
                    window.location.reload();
                }
            });
    
        });
    </script>
@endsection