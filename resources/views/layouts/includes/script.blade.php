<script type="text/javascript">

    let csrf_token  = $("meta[name='csrf-token']").attr('content');

    @if(!session()->has('timezone'))
        let timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        $.ajax({
            url: "{{route('timezone')}}",
            type: 'POST',
            data: ({timezone:timezone}),
            beforeSend: function(request) {
                return request.setRequestHeader('X-CSRF-Token', csrf_token);
            }
        })
    @endif




</script>
