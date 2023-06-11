<script type="text/javascript">
    const NOTIFICATION_TYPES = {
        newAbout: 'App\\Notifications\\NewAbout',
        newUser: 'App\\Notifications\\NewUser',
        newRadio: 'App\\Notifications\\NewRadio',
        newPost: 'App\\Notifications\\NewPost',
        newCity: 'App\\Notifications\\NewCity',
        newState: 'App\\Notifications\\NewState',
        newCountry: 'App\\Notifications\\NewCountry',
        newContinent: 'App\\Notifications\\NewContinent'
    };

    var notifications = [];

    $(document).ready(function() {
        var url = "{{asset('')}}";
        // check if there's a logged in user
        if (Laravel.userId) {
            // load notifications from database
            $.get(url + 'notifications', function(data) {
                addNotifications(data, "#notifications");
            });
        }
    });

    // add new notifications
    function addNotifications(newNotifications, target) {
        notifications = _.concat(notifications, newNotifications);
        // show only last 5 notifications
        notifications.slice(0, 5);
        showNotifications(notifications, target);
    }

    // show notifications
    function showNotifications(notifications, target) {
        if (notifications.length) {
            var htmlElements = notifications.map(function(notification) {
                return makeNotification(notification);
            });
            $(target + 'Menu').html(htmlElements.join(''));
            $('#mobilenotificationsMenu').html(htmlElements.join(''));
            $('#countno').attr("data-count", notifications.length); //setter
            $('#mobilecountno').attr("data-count", notifications.length); //setter
        } else {
            $(target + 'Menu').html('<li class="dropdown-header">No notifications</li>');
        }
    }

    // create a notification li element
    function makeNotification(notification) {
        var to = routeNotification(notification);
        var notificationText = makeNotificationText(notification);
        var notificationTime = makeNotificationTime(notification);
        var notificationImg = makeNotificationImg(notification);

        return `<div class="row" style="border-bottom:1px solid  #4980b5;padding:5px">
	          <div class="col-md-3">
	               <img align="right" src="${notificationImg}" class="nav-link dropdown-toggle" style="width:50px;height:50px;border-radius:50%">
	          </div>
	          <div class="col-md-9" style="padding:2px">
	           <li style=""><a href="${to}" class="text-muted" style="font-size:0.8rem">${notificationText}</a></li>
						 <span class="text-muted" style="font-size:0.7rem">${notificationTime}</span>
						</div>
					</div>`;
    }

    // get the notification route based on it's type
    function routeNotification(notification) {
        var to = `?read=${notification.id}`;
        if (notification.type === NOTIFICATION_TYPES.newUser) {
            to = 'users' + to;
        } else if (notification.type === NOTIFICATION_TYPES.newProperty) {
            const propertyId = notification.data.property_id;
            to = `view/` + propertyId + to;
        } else if (notification.type === NOTIFICATION_TYPES.newPost) {
            const postSlug = notification.data.slug;
            to = `blog/` + postSlug + to;
        }
        return to;
    }

    // get the notification text based on it's type
    function makeNotificationText(notification) {
        var text = '';
        const name = notification.data.added_user_name;
        if (notification.type === NOTIFICATION_TYPES.newAbout) {
            text += `<strong>${name}</strong> added a about`;
        } else if (notification.type === NOTIFICATION_TYPES.newCity) {
            text += `<strong>${name}</strong> added a city`;
        } else if (notification.type === NOTIFICATION_TYPES.newContinent) {
            text += `<strong>${name}</strong> added a continent`;
        } else if (notification.type === NOTIFICATION_TYPES.newCountry) {
            text += `<strong>${name}</strong> added a country`;
        } else if (notification.type === NOTIFICATION_TYPES.newPost) {
            text += `<strong>${name}</strong> added a post`;
        } else if (notification.type === NOTIFICATION_TYPES.newRadio) {
            text += `<strong>${name}</strong> added a radio`;
        } else if (notification.type === NOTIFICATION_TYPES.newState) {
            text += `<strong>${name}</strong> added a state`;
        } else if (notification.type === NOTIFICATION_TYPES.newUser) {
            text += `<strong>${name}</strong> added a user`;
        }
        return text;
    }

    function makeNotificationTime(notification) {
        var time = '';
        const name = notification.created_at;
        time += `${name}`;
        return time;
    }

    function makeNotificationImg(notification) {
        var img = '';
        const name = notification.data.added_user_img;
        img += `${name}`;

        return img;
    }
</script>