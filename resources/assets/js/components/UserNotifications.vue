<template>
    <li class="dropdown notifications-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
            <i class="fa fa-bell-o"></i>
            <span class="label label-warning" >10</span>
        </a>
        <ul class="dropdown-menu">
            <li class="header">You have 10 notifications</li>
            <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                    <li>
                        <a href="#">
                            <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                            page and may cause design problems
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-users text-red"></i> 5 new members joined
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-user text-red"></i> You changed your username
                        </a>
                    </li>
                </ul>
            </li>
            <li class="footer"><a href="#">View all</a></li>
        </ul>
    </li>
    <!--<li class="dropdown" v-if="notifications.length">-->
    <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
    <!--<span class="glyphicon glyphicon-bell"></span>-->
    <!--</a>-->
    <!--<ul class="dropdown-menu">-->
    <!--<li v-for="notification in notifications">-->
    <!--<a :href="notification.data.link" v-text="notification.data.message" @click="markAsRead(notification)"></a>-->
    <!--</li>-->
    <!--</ul>-->
    <!--</li>-->
</template>
<script>
  export default {
    name: "user-notifications",
    data() {
      return {notifications: false}
    },

    created() {
      axios.get('/users/' + window.App.user.id + '/notifications')
        .then(response => this.notifications = response.data);
    },

    methods: {
      markAsRead(notification) {
        axios.delete('/profiles/' + window.App.user.name + '/notifications/' + notification.id)
      }
    }
  }
</script>
<style scoped></style>
