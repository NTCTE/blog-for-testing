@include('services.head')


    <style>
        .blog-post {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            list-style: none;
        }

        .blog-post h2 {
            margin-top: 0;
        }

        .blog-post .likes {
            color: green;
            font-weight: bold;
            margin-right: 10px;
        }

        .blog-post .comments {
            color: blue;
            font-weight: bold;
            margin-right: 10px;
        }

        .blog-post .draft {
            color: orange;
            font-weight: bold;
            margin-right: 10px;
        }

        .blog-post .paid {
            color: red;
            font-weight: bold;
            margin-right: 10px;
        }
    </style>
    <a href="/blog/add">Add a post</a>
    <ul>
        @foreach (Auth::user() -> posts as $post)
            <li class="blog-post">
                <h2>{{ $post -> heading }}</h2>
                <span class="likes">{{ $post -> likes() -> count() }} likes</span>
                <span class="comments">{{ $post -> comments() -> count() }} comments</span>
                <span class="draft">{{ $post -> is_draft ? 'Draft' : 'Isn\'t draft' }}</span>
                <span class="paid">{{ $post -> is_paid ? 'Paid' : 'Isn\'t paid' }}</span>
                @if (!empty($post -> amount))
                    <p>Cost: <b>{{ $post -> amount }}</b></p>
                @endif
                <p><a href="{{ route('blog.edit', ['id' => $post -> id]) }}">Edit</a> <a href="{{ route('blog.actions.delete', ['id' => $post -> id]) }}">Delete</a></p>
            </li>
        @endforeach
    </ul>

@include('services.footer') 