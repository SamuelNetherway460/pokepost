<template>
    <li class="dropdown" id="markasread">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Notifications <span class="badge badge-danger">{{ unreads.length }}</span>
        </a>
        <ul class="dropdown-menu notify-drop">
            <div class="drop-content ml-3 mr-3 mt-1">
                <hr>
            </div>
        </ul>
    </li>
</template>

<script>
    export default {
        props:['unreads', 'userid'],
        mounted() {
            console.log('Component mounted.');
            console.log(this.userid);

            Echo.private('App.User.' + this.userid)
                .notification((notification) => {
                    console.log(notification);
                });
        }
    }
</script>
