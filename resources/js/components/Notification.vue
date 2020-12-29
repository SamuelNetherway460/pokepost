<template>
    <div class="warp">
        <hr>
        <p v-if="unread.data.type == 'App\\Notifications\\PostDeleted'">{{ unread.data.user.name }} deleted your post "{{ unread.data.post.title }}"</p>
        <p v-if="unread.data.type == 'App\\Notifications\\CommentDeleted'">{{ unread.data.user.name }} deleted your comment "{{ unread.data.comment.content }}"</p>
        <p v-if="unread.data.type == 'App\\Notifications\\NewPostComment'">{{ unread.data.user.name }} commented on your post "{{ unread.data.post.title }}"</p>
    </div>
</template>

<script>
    export default {
        props: ['unread']
    }
</script>
