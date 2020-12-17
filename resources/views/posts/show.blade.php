@extends('layouts.app')

@section('title', 'Post Detail')

@section('content')

<main class="container">
    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <div class="d-flex justify-content-between border-bottom">
            <h2 class="pb-2 mb-0">{{ $post->user->name }} &middot {{ $post->created_at->diffForHumans() }}</h2>
            <div class="p-1">
                <!--Admins, moderators and the post owner can delete the post-->
                @if($post->user->id == Auth::user()->id)
                    <form method="POST" action="{{ route('posts.destroy', $post)}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-primary" type="submit">Delete</button>
                    </form>
                @elseif(Auth::user()->profile->profileable_type == App\Admin::class)
                    <form method="POST" action="{{ route('posts.destroy', $post)}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-primary" type="submit">Delete</button>
                    </form>
                @elseif(Auth::user()->profile->profileable_type == App\Moderator::class)
                    <form method="POST" action="{{ route('posts.destroy', $post)}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-primary" type="submit">Delete</button>
                    </form>
                @endif

                <!--Admins and the post owner can edit the post-->
            </div>
        </div>
        <div class="d-flex text-muted pt-3">
            <div>
                <h4 class="d-block">{{ $post->title }}</h4>
                <h6 class="d-block">{{ $post->content }}</h6>
                @if($post->image_name != null)
                    <img src="{{ route('image.displayImage',$post->image_name) }}" alt="Post Image" title="Post Image">
                @endif
            </div>
        </div>
    </div>
</main>

<main class="container">
    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <div class="d-flex border-bottom">
            <h2 class="pb-2 mb-0">Comments</h2>
        </div>

        <div class="input-group mt-3">
            <input type="text" id="input" v-model="newCommentContent" class="form-control" placeholder="Comment" aria-label="Add Comment" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button @click="createComment" class="btn btn-primary" type="button">Post</button>
            </div>
        </div>

        <div v-for="comment in comments" class="d-flex text-muted pt-3">
            <img class="me-3 p-2" src="{{ route('image.displayImage',"pokeball.png") }}" alt width="40" height="40">
            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                <div class="d-flex justify-content-between">
                        <p>
                            <strong class="text-dark">@{{ comment.user.name }} @{{ comment.id }}</strong>
                            <strong>&middot @{{ comment.updated_at }}</strong>
                        </p>
                        <p>
                            <!--Admins, moderators and the comment owner can delete the comment-->
                            <button @click="deleteComment(comment.id)" class="btn btn-primary" type="button">Delete</button>


                            <!--Admins and the comment owner can edit the comment-->
                            <strong v-if="{{ Auth::user()->profile->profileable_type == App\Admin::class }}">&middot Edit</strong>
                            <strong v-else-if="comment.user_id == {{ Auth::user()->id }}">&middot Edit</strong>

                        </p>
                </div>
                <span class="d-block">@{{ comment.content }}</span>
            </div>
        </div>
    </div>
</main>

    <div class="d-flex justify-content-center">
        <a href="{{ URL::route('posts.index') }}" class="btn btn-primary">Back</a>

        <form method="POST" action="{{ route('comments.destroy', 1)}}">
            @csrf
            @method('DELETE')
            <button class="btn btn-primary" type="submit">Delete Comment 1</button>
        </form>
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
                        this.newCommentContent = '';
                    })
                    .catch(response => {
                        console.log(response);
                    })
                },
                deleteComment: function(id){
                    axios.delete("{{ route('comments.destroy', 1) }}")
                    .then(response => {
                        this.comments.splice(1, 1)
                    });
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
