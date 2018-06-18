  <li>{{ fullname($user['user_id']) }} {{ $user['level'] == '1' ? '(L)' : '(R)' }} ( {{ user_data($user['user_id'])['driver_num'] }} )
	@if (isset($user['children']) and count($user['children']) > 0)
	    <ul>
	    @foreach($user['children'] as $user)
	        @include('admin.tree.recursive', $user)
	    @endforeach
	    </ul>
</li>
@endif
