<template>
    <li class="dropdown" id="markasread">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Notifications <span class="badge badge-danger">{{ unreadNotifications.length }}</span>
        </a>
        <ul class="dropdown-menu notify-drop">
            <div class="drop-content ml-3 mr-3 mt-1">
                <button v-if="unreadNotifications.length > 0" class="btn btn-danger" @click="markNotificationsAsRead">Dismiss Notifications</button>
                <notification v-for="unread in unreadNotifications" v-bind:key="unread" :unread="unread"></notification>
                <hr v-if="unreadNotifications.length > 0">
                <p v-if="unreadNotifications.length == 0">No Notifications</p>
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
        methods: {
            markNotificationsAsRead() {
                if (this.unreadNotifications.length) {
                    axios.get('/markAsRead');
                    this.unreadNotifications = [];
                }
            }
        },
        mounted() {
            console.log('Component mounted.');
            console.log(this.userid);

            Echo.private('App.User.' + this.userid)
                .notification((notification) => {
                    if (notification.type != 'App\\Notifications\\CommentDeleted') {
                        let newUnreadNotifications = {
                            data: {
                                post: notification.post,
                                user: notification.user,
                                type: notification.type
                            }
                        };
                        this.unreadNotifications.push(newUnreadNotifications);
                    } else {
                        console.log(notification);
                        let newUnreadNotifications = {
                            data: {
                                user: notification.user,
                                comment: notification.comment,
                                type: notification.type
                            }
                        };
                        this.unreadNotifications.push(newUnreadNotifications);
                    }
                });
        }
    }
</script>
