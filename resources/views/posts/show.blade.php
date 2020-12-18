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
                    <button class="btn btn-primary" type="submit">Edit</button>
                @elseif(Auth::user()->profile->profileable_type == App\Admin::class)
                    <form method="POST" action="{{ route('posts.destroy', $post)}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-primary" type="submit">Delete</button>
                    </form>
                    <button class="btn btn-primary" type="submit">Edit</button>
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
                @if($post->post_image_name != null)
                    <div class="text-center">
                        <img src="{{ route('image.getPostImage',$post->post_image_name) }}" alt="Post Image" title="Post Image">
                    </div>
                @endif
                <h6 class="d-block">{{ $post->content }}</h6>
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
            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                <div class="d-flex justify-content-between">
                    <p>
                        <strong class="text-dark">@{{ comment.user.name }}</strong>
                        <strong>&middot @{{ comment.updated_at }}</strong>
                    </p>
                    <p>
                        <!--Admins, moderators and the comment owner can delete the comment-->
                        @if(Auth::user()->profile->profileable_type == App\Admin::class)
                            <button @click="deleteComment(comment.id)" class="btn btn-link" type="button">Delete</button>
                        @elseif(Auth::user()->profile->profileable_type == App\Moderator::class)
                            <button @click="deleteComment(comment.id)" class="btn btn-link" type="button">Delete</button>
                        @else(True)
                            <button v-if="comment.user_id == {{ Auth::user()->id }}" @click="deleteComment(comment.id)" class="btn btn-link" type="button">Delete</button>
                        @endif

                        <!--Admins and the comment owner can edit the comment-->
                        @if(Auth::user()->profile->profileable_type == App\Admin::class)
                        <button class="btn btn-link" type="button">Edit</button>
                        @else(True)
                            <button class="btn btn-link" type="button" v-if="comment.user_id == {{ Auth::user()->id }}">Edit</button>
                        @endif
                    </p>
                </div>
                <span class="d-block">@{{ comment.content }}</span>
            </div>
        </div>
    </div>
</main>

    <div class="d-flex justify-content-center">
        <a href="{{ URL::route('posts.index') }}" class="btn btn-primary">Back</a>
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
                        this.comments.unshift(response.data);
                        this.newCommentContent = '';
                    })
                    .catch(response => {
                        console.log(response);
                    })
                },
                deleteComment: function(id){
                    axios.post("{{ route('comments.destroy') }}",
                    {
                        comment_id: id,
                    })
                    .then(response => {
                        for (i = 0; i < this.comments.length; i++) {
                            if (this.comments[i].id == id) {
                                this.comments.splice(i, 1);
                            }
                        }
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
