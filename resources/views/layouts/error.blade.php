 @if (count($errors) > 0)
<b-notification type="is-danger" >
             <strong>Whoops!</strong> There were some problems with your input.<br><br></div>
             @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
        </b-notification>
@endif

 