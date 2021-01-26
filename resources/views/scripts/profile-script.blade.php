<script>
    $(document).ready(function() {
        
        $("#file_upload").change(function() {
            $("#upload_avatar").submit()
        })

        $("#send_mail").click(function(){
            console.log(document.getElementById('send_mail').checked ? 'on':'off')
        })

        $("#artist_type").change(function(){
            if($(this).val()=="other"){
                $("#addtype").prop( "disabled", false );
                $("#btn_add_type").prop( "disabled", false );
            }else{
                $("#addtype").prop( "disabled", true );
                $("#btn_add_type").prop( "disabled", true );
            }
        })

        $("#btn_add_type").click(function(){
            var addtype = $("#addtype").val()
            console.log(addtype)
            $.ajax({
                url: "{{ route('profile.addtype') }}",
                type: 'POST',
                data: {'_token': '{{ csrf_token() }}', 'addtype': addtype},
                dataType:'json',
                success: function(result) {
                    console.log('result')
                    tata.success('INVIZZ', "Add artist type Success!")
                },
                error: function() {
                    console.log('error');
                    tata.error('INVIZZ', "Add artist type Failed!")
                }
            }) 
        })

        $("#save_profile").click(function() {
            var firstname = $("#firstname").val()
            var lastname = $("#lastname").val()
            var bio = $("#bio").val()
            var address = $("#address").val()
            var zipcode = $("#zipcode").val()
            var dob = $("#dob").val()
            var artist_type = $("#artist_type").val()
            var send_mail = document.getElementById('send_mail').checked ? 'on':'off'
            var hide_age = document.getElementById('hide_age').checked ? 'on':'off'
            var collab_status = document.getElementById('collab_status').checked ? 'on':'off'
            var social_fb = $("#social-fb").val()
            var social_tw = $("#social-tw").val()
            var social_insta = $("#social-insta").val()
            var social_lin = $("#social-lin").val()

            console.log(firstname, lastname, bio, address, zipcode, dob, artist_type, send_mail, hide_age, collab_status, social_fb, social_tw, social_insta, social_lin)
            if($("#artist_type").val()==1) tata.error('INVIZZ', "Please select your artist type!")
            else
            $.ajax({
                url: "{{ route('profile.update',$profile->user_id) }}",
                type: 'PUT',
                data: {'_token': '{{ csrf_token() }}', 'firstname': firstname, 'lastname': lastname, 'bio': bio, 'address': address, 'zipcode': zipcode, 'dob': dob, 'artist_type': artist_type, 'send_mail': send_mail, 'hide_age': hide_age, 'collab_status': collab_status, 'social_fb': social_fb, 'social_tw': social_tw, 'social_insta': social_insta, 'social_lin': social_lin },
                dataType:'json',
                success: function(user_info) {
                    console.log('user_info')
                    tata.success('INVIZZ', "Update information Success!")
                },
                error: function() {
                    console.log('error');
                    tata.error('INVIZZ', "Update information Failed!")
                }
            }) 
            

        })
    })
</script>
