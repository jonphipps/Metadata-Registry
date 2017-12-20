<template>
    <li class="dropdown notifications-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
            <i class="fa fa-bell-o"></i>
            <span class="label label-warning">{{ notifications.length }}</span>
        </a>
        <ul class="dropdown-menu">
            <li class="header">You have {{ notifications.length === 1 ? notifications.length + 'notification' : notifications.length + 'notifications'}}</li>
            <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                    <li v-for="notification in notifications">
                        <a href="#">
                            <i class="fa fa-warning text-yellow"></i> {{ notification }}
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
      return {
        notifications: [
          '5 new members joined today',
          'Very long description here that may not fit into the page and may cause design problems',
          '5 new members joined',
          '25 sales made',
          'You changed your username'
        ]
      }
    },

    // created() {
    //   axios.get('/users/' + window.App.user.id + '/notifications')
    //     .then(response => this.notifications = response.data);
    // },
    //
    // methods: {
    //   markAsRead(notification) {
    //     axios.delete('/profiles/' + window.App.user.name + '/notifications/' + notification.id)
    //   }
    //}
  }
</script>
<style scoped></style>
