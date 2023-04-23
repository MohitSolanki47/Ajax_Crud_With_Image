<style>
table, th, td {
  border: 1px solid black;
}
</style>

<!DOCTYPE html>
<html>
<head>
    <title>View Data and Images</title>
</head>
<body>
    <div >
        <table >
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody id="container">

            </tbody>

        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="script.js"></script> -->
</body>
</html>

<script>
    $(document).ready(function() {
    $.ajax({
        url: 'get_data.php',
        dataType: 'json',
        cache:false,
        success: function(data) {
            var container = $('#container');
            $.each(data, function(index, product) {
                // alert(data);
                // $('#container').html(data); 
                var User_name = '<td>' + product.User_name + '</td>';
                var id = '<td>' + product.id + '</td>';
                var User_Email = '<td>' + product.User_Email + '</td>';
                var File_Path = '<td><img  height="100px" weghit="100px" src="data:image/png;base64,' + product.File_Path + '" /></td>';
                container.append('<tr>' + id + File_Path + User_name + User_Email + '</tr>');
            });
        }
    });
});

</script>