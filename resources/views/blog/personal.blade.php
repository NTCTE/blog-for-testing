@include('services.head')

<!-- Example post list -->
<div style="display: flex; flex-direction: column; align-items: center;">
    @foreach ($posts as $post)
        <div style="background-color: #f2f2f2; padding: 10px; margin-bottom: 10px; width: 100%;">
            <h2 style="margin: 0;">{{ $post -> heading }}</h2>
            <p style="margin: 0;">{{ $post -> body }}</p>
            <div style="display: flex; justify-content: space-between; margin-top: 10px;">
                <div style="display: flex; align-items: center;">
                    <span style="margin-right: 5px;">Likes:</span>
                    <span>{{ $post -> likes() -> count() }}</span>
                </div>
                <div style="display: flex; align-items: center;">
                    <span style="margin-right: 5px;">Comments:</span>
                    <span>{{ $post -> comments() -> count() }}</span>
                </div>
            </div>
            <div>
                <a href="{{ route('blog.personal.post', ['post_id' => $post -> id]) }}">Read more</a>
            </div>
        </div>
    @endforeach
</div>


@include('services.footer')