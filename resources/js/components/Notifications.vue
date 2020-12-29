<template>
    <li class="dropdown" id="markasread">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Notifications <span class="badge badge-danger">{{ unreadNotifications.length }}</span>
        </a>
        <ul class="dropdown-menu notify-drop">
            <div class="drop-content ml-3 mr-3 mt-1">
                <notification v-for="unread in unreadNotifications" v-bind:key="unread" :unread="unread"></notification>
                <hr>
            </div>
        </ul>
    </li>
</template>

<script>
    import Notification from './Notification.vue';
    export default {
        props:['unreads', 'userid'],
        components: {Notification},
        data(){
            return {
                unreadNotifications: this.unreads
            }
        },
        mounted() {
            console.log('Component mounted.');
            console.log(this.userid);

            Echo.private('App.User.' + this.userid)
                .notification((notification) => {
                    console.log(notification);
                    let newUnreadNotifications = {
                        data: {
                            post: notification.post,
                            user: notification.user
                        }
                    };
                    this.unreadNotifications.push(newUnreadNotifications);
                });
        }
    }
</script>
