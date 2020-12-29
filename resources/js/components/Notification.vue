<template>
    <div class="warp">
        <hr>
        <p>{{ unread.data.user.name }} deleted your post {{ unread.data.post.title }}</p>
    </div>
</template>

<script>
    export default {
        props: ['unread']
    }
</script>
