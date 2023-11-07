@include('services.head')

<ul style="list-style-type: none; padding: 0;">
    @foreach (\App\Models\User::all() as $user)
        <li style="background-color: #f2f2f2; padding: 10px; margin-bottom: 10px;">
            <h3 style="margin-top: 0;">{{ $user -> name }}</h3>
            <p style="margin-bottom: 0;">{{ $user -> bio }}</p>
            <p style="margin-bottom: 0;"><a href="{{ route('blog.personal', ['user_id' => $user -> id]) }}">Visit my personal blog</a></p>
        </li>
    @endforeach
</ul>

<div style="display: flex; justify-content: center; align-items: center;">
    <ul style="list-style-type: none; display: flex; justify-content: center; align-items: center; padding: 0;">
        <li style="margin-right: 10px;"><a href="#">1</a></li>
        <li style="margin-right: 10px;"><a href="#">2</a></li>
        <li style="margin-right: 10px;"><a href="#">3</a></li>
        <li style="margin-right: 10px;"><a href="#">4</a></li>
        <li style="margin-right: 10px;"><a href="#">5</a></li>
    </ul>
</div>


@include('services.footer')