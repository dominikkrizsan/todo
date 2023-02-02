//create
$(document).ready(function() {
    $("#saveBtn").click(function(e) {
        e.preventDefault();
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //var formData = $("#taskForm").serialize();
        $.ajax({
                method    :   "POST",
                url     :   "/task/store",
                data    :   {
                    title: $('#task_title').val(),
                    description: $('#description').val(),
                },

                success: function(res) { 
                    if(res.status == "success") {
                        var result = $("#result").html("<div class='alert alert-success mt-3'>" + res.message + "</div>");
                        setTimeout(result, 2000)
                        window.location.reload();
                     }
                     
                    else if(res.status == "failed") {
                        $("#result").html("<div class='alert alert-danger'>" + res.message + "</div>");
                        console.log('prob')
                    }
                }                   
        });
    });        
});