<script>
    $(document).ready(function(event) {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $("#loginForm").on('submit', function(event) {
            event.preventDefault();
            
            $.ajax({
                url: "{{ route('login') }}",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(data) {
                    var html = '';
                    if (data.errors) {
                        console.log(data.errors);
                    }
                    if (data.success) {
                        $('#loginForm')[0].reset();
                        result = data.success;
                        getPage(result);
                    }
                    $('#form_result').html(html);
                }
            })
        });

        function getPage(result){
            if(result == 'superadmin'){
                window.location.href = ('/dashboard');
            }
            else{
                window.location.href = ('/dashboard');
            }
        };
    });

</script>