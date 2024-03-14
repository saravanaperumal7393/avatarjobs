<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Records</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
          
            $('.editBtn').click(function(){
                
                var jobId = $(this).data('id');
                $('#editPopup').show();
                $('#jobId').val(jobId);
            });

            $('#saveBtn').click(function(){
                var jobId = $('#jobId').val();
                var newNotes = $('#newNotes').val();
                
                $.ajax({
                    url: 'update.php',
                    type: 'post',
                    data: {jobId: jobId, newNotes: newNotes},
                    success: function(response){
                        $('#editPopup').hide();
                        // Assuming you have a function to refresh the table data
                        refreshTable();
                    }
                });
            });
        });

        function refreshTable() {
            $.ajax({
                url: 'fetch.php',
                type: 'get',
                success: function(response){
                    $('#jobTable').html(response);
                }
            });
        }
    </script>
</head>
<body>
    <table id="jobTable">
    <tr>
        <td class="jobId">1</td>
        <td class="jobName">Job 1</td>
        <td class="date">2024-02-24</td>
        <td class="notes">Notes for Job 1</td>
        <td><button class="edit">Edit</button></td>
    </tr>
    </table>

    <div id="editPopup" style="display: none;">
        <input type="hidden" id="jobId">
        <textarea id="newNotes"></textarea>
        <button id="saveBtn">Save</button>
    </div>
</body>
</html>
