@include('services.head')

<div style="background-color: #f2f2f2; padding: 20px;">
    <h2 style="color: #333;">{{ $post -> heading }}</h2>
    <p style="color: #666;">Written by {{ $post -> author -> name }} on {{ $post -> created_at }}</p>
    <hr style="border: 1px solid #ccc;">
    <p style="color: #333;">{{ $post -> body }}</p>
    <hr style="border: 1px solid #ccc;">
    <div style="display: flex; justify-content: space-between;">
        <div style="display: flex;">
            <a href="{{ route('blog.personal.post.like', ['post_id' => $post -> id]) }}" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px;">Like</a>
            <p style="color: #666; margin-left: 10px;">{{ $post -> likes() -> count() }} likes</p>
        </div>
        <div>
            <a href="#" style="background-color: #f2f2f2; color: #666; padding: 10px 20px; border: none; border-radius: 5px;">Add Comment</a>
        </div>
    </div>
    <hr style="border: 1px solid #ccc;">
    <div style="background-color: #fff; padding: 20px;">
        <h3 style="color: #333;">Comments</h3>
        <hr style="border: 1px solid #ccc;">
        @foreach ($post -> comments as $comment)
            <div style="display: flex; margin-bottom: 20px;">
                <div style="width: 50px; height: 50px; background-color: #ccc; border-radius: 50%;"></div>
                <div style="margin-left: 10px;">
                    <p style="color: #333; font-weight: bold;">{{ $comment -> author -> name }}</p>
                    <p style="color: #666;">{{ $comment -> body }}</p>
                    <p><a href="{{ route('blog.personal.post.comment.like', ['post_id' => $post -> id, 'comment_id' => $comment -> id]) }}">{{ $comment -> likes() -> count() }} likes</a></p>
                </div>
            </div>
        @endforeach
    </div>
    <div style="background-color: #fff; padding: 20px;">
        <h3 style="color: #333;">Add Comment</h3>
        <hr style="border: 1px solid #ccc;">
        <form action="{{ route('blog.personal.post.comment', ['post_id' => $post -> id]) }}" method="POST">
            @csrf
                <label for="body" style="color: #333;">Comment:</label>
                <textarea id="body" name="body" required></textarea>
            </div>
            <button type="submit" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; margin-top: 10px;">Submit</button>
        </form>
    </div>
</div>


@include('services.footer')