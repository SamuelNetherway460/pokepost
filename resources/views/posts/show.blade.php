@extends('layouts.app')

@section('title', 'Post Detail')

@section('content')

<main class="container">
    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <div class="d-flex justify-content-between border-bottom">
            @if($post->updated_at > $post->created_at)
                <h3 class="pb-2 mb-0 text-info">{{ $post->user->name }} &middot {{ $post->created_at->diffForHumans() }} &middot updated {{ $post->updated_at->diffForHumans() }}</h3>
            @else
                <h3 class="pb-2 mb-0">{{ $post->user->name }} &middot {{ $post->created_at->diffForHumans() }}</h3>
            @endif
            <div class="p-1">
                <!--Admins, moderators and the post owner can delete the post-->
                @if($post->user->id == Auth::user()->id)
                    <form method="POST" action="{{ route('posts.destroy', $post)}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-primary" type="submit">Delete</button>
                    </form>
                    <a href="{{ URL::route('posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                @elseif(Auth::user()->profile->profileable_type == App\Admin::class)
                    <form method="POST" action="{{ route('posts.destroy', $post)}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-primary" type="submit">Delete</button>
                    </form>
                    <a href="{{ URL::route('posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
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
                <div id="app" class="d-flex justify-content-between">
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
                        @else
                            <button v-if="comment.user_id == {{ Auth::user()->id }}" @click="deleteComment(comment.id)" class="btn btn-link" type="button">Delete</button>
                        @endif

                        <!--Admins and the comment owner can edit the comment-->
                        @if(Auth::user()->profile->profileable_type == App\Admin::class)
                            <button v-on:click="editComment(comment.id, comment.content)" class="btn btn-link" type="button" v-if="edit != comment.id">Edit</button>
                            <button v-on:click="updateComment(comment.id)" class="btn btn-link" type="button" v-if="edit == comment.id">Update</button>
                            <button v-on:click="cancelCommentEdit" class="btn btn-link" type="button" v-if="edit == comment.id">Cancel</button>
                        @else
                            <button v-on:click="editComment(comment.id, comment.content)" class="btn btn-link" type="button" v-if="comment.user_id == {{ Auth::user()->id }} && edit != comment.id">Edit</button>
                            <button v-on:click="updateComment(comment.id)" class="btn btn-link" type="button" v-if="edit == comment.id">Update</button>
                            <button v-on:click="cancelCommentEdit" class="btn btn-link" type="button" v-if="edit == comment.id">Cancel</button>
                        @endif
                    </p>
                </div>
                <div id="app">
                    <span v-if="edit != comment.id" class="d-block">@{{ comment.content }}</span>
                    <span v-if="edit == comment.id" class="d-block">
                        <textarea v-model="updatedCommentContent" name="content" class="form-control" aria-label="With textarea" aria-describedby="inputGroup-sizing-lg" placeholder="Content"></textarea>
                    </span>
                </div>
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
                edit: -1,
                updatedCommentContent: ''
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
                },
                editComment: function(id, currentCommentContent){
                    this.edit = id
                    this.updatedCommentContent = currentCommentContent
                },
                updateComment: function(id){
                    axios.post("{{ route('api.comments.update') }}",
                    {
                        comment_id: id,
                        content: this.updatedCommentContent,
                    })
                    .then(response => {
                        for (i = 0; i < this.comments.length; i++) {
                            if (this.comments[i].id == id) {
                                this.comments.splice(i, 1);
                            }
                        }
                        this.comments.unshift(response.data);
                        this.newCommentContent = '';
                        this.edit = -1;
                    })
                    .catch(response => {
                        console.log(response);
                    })
                },
                cancelCommentEdit: function(){
                    this.edit = -1;
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
