<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	</div>
<form id="myForm" enctype="multipart/form-data">
  <input type="text" name="name" id="name" placeholder="Name"><br><br>
  <input type="text" name="email" id="email" placeholder="Email"><br><br>
  <input type="file" name="image" id="image"><br><br>
  <button type="submit">Submit</button>
</form>
<br><br><br><br><br>

<div id="container"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="script.js"></script>
<script>
    $(document).ready(function() {
    $('#myForm').submit(function(e) {
        e.preventDefault(); // prevent default form submit
        
        // get form data
        var formData = new FormData($(this)[0]);
        var name = $('#name').val();
        var email = $('#email').val();
        var image = $('#image').val();
        if(name!="" && email!=""  && image!="")
        {
            // send AJAX request
            $.ajax({
            url: 'insert.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) 
            {
                // handle success response
                // alert(response);
                $('#myForm').find('input:text').val('');
                $('#myForm').find('input:file').val('');
                $("#success").show();
				$('#success').html('Data added successfully !'); 
            },
            error: function(xhr, status, error) 
            {
                // handle error response
            }
            });
        }
        else
        {
		    alert('Please fill all the field !');
	    }
    });
    });

</script>


<script>
    $(document).ready(function() {
    $.ajax({
        url: 'get_data.php',
        dataType: 'json',
        success: function(data) {
            var container = $('#container');
            $.each(data, function(index, product) {
                // alert(data); return false;
                var image = '<img src="data:image/png;base64,' + product.File_Path + '" />';
                var name = '<h3>' + product.User_name + '</h3>';
                var price = '<p>' + product.User_Email + '</p>';
                container.append('<div>' + File_Path + User_name + User_Email + '</div>');
            });
        }
    });
});

</script>
