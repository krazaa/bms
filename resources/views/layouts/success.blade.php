 @if(Session::has('success'))
<b-notification type="is-success" >
             <strong>Success! </strong>{{Session::get('success')}}</div>
        </b-notification>
@endif