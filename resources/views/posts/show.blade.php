@extends('layouts.app')

@section('title', 'Post Detail')

@section('content')

    <h2>{{ $post->user->name }} at {{ $post->created_at }}</h2>
    <h2>Title: {{$post->title}}</h2>
    @if($post->image_name != null)
        <img src="{{ route('image.displayImage',$post->image_name) }}" alt="Post Image" title="Post Image">
    @endif
    <p>Content: {{$post->content}}</p>
    @if ($post->updated_at > $post->created_at)
        <p>Changed: {{$post->updated_at}}</p>
    @endif

    <a href="{{ route('posts.index') }}">Back</a>

    @if($post->user->id == Auth::user()->id)
        <form method="POST" action="{{ route('posts.destroy', $post)}}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    @elseif(Auth::user()->profile->profileable_type == App\Admin::class)
        <form method="POST" action="{{ route('posts.destroy', $post)}}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    @elseif(Auth::user()->profile->profileable_type == App\Moderator::class)
        <form method="POST" action="{{ route('posts.destroy', $post)}}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    @endif

    <h2>Comments:</h2>
    @php $comments = $post->comments @endphp
    @foreach ($comments as $comment)
        <b>{{$comment->user->name}} at {{$comment->created_at}}</b>
        <p>{{$comment->content}}</p>
    @endforeach

    <div id="app">
        <ul>
            <li v-for="comment in comments">@{{ comment.content }}</li>

            <h2>Write Comment</h2>
            Content: <input type="text" id="input" v-model="newCommentContent">
            <button @click="createComment">Post</button>
        </ul>
    </div>

    <script>
        var app = new Vue({
            el: '#app',
            data: {
                comments: [],
                newCommentContent: '',
            },
            methods: {
                createComment: function(){
                    axios.post("{{ route('api.comments.store', $post) }}",
                    {
                        content: this.newCommentContent,
                        post_id: {{ $post->id }},
                        user_id: {{ Auth::user()->id }},
                    })
                    .then(response => {
                        this.comments.push(response.data);
                        this.newCommentContent = ''
                    })
                    .catch(response => {
                        console.log(response);
                    })
                }
            },
            mounted(){
                axios.get("{{ route('api.comments.index', $post) }}")
                .then( response => {
                    this.comments = response.data;
                })
                .catch(response => {
                    console.log(response);
                })
            },
        });
    </script>

@endsection
