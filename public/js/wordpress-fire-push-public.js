(function( $ ) {
    'use strict';

    // Create the defaults once
    var pluginName = "fire_push",
        defaults = {
            apiKey : "",
            authDomain : "",
            databaseURL : "",
            projectId : "",
            storageBucket : "",
            messagingSenderId : "",
        };

    // The actual plugin constructor
    function Plugin ( element, options ) {
        this.element = element;
        this.settings = $.extend( {}, defaults, options );
        this._defaults = defaults;

        this._name = pluginName;

        if(!this.settings.messagingSenderId || this.settings.messagingSenderId == "") {
            return false;
        }

        this.init();
        this.popup();
        this.welcomeNotification();
    }

    // Avoid Plugin.prototype conflicts
    $.extend( Plugin.prototype, {
        init: function() {
            var that = this;
            this.window = $(window);
            this.documentHeight = $( document ).height();
            this.windowHeight = this.window.height();

            if ('serviceWorker' in navigator) {
                try {
                    this.initFirebase();
                } catch (e) {
                    console.log('Unable to Instantiate Firebase Messaging. Browser not supported.', e);
                }
            }
        },
        initFirebase : function() {

            var config = {
                apiKey: this.settings.apiKey,
                authDomain: this.settings.authDomain,
                databaseURL: this.settings.databaseURL,
                projectId: this.settings.projectId,
                storageBucket: this.settings.storageBucket,
                messagingSenderId: this.settings.messagingSenderId,
            };
            this.firebase = firebase.initializeApp(config);            
        },
        popup : function() {
            var that = this;

            if ('Notification' in window) {
                var popupAction = that.getCookie('fire_push_popup');
                if(Notification.permission == 'default' || Notification.permission == 'denied' && (popupAction !== "declined")) {
                        
                    var popupContainer = $('.wordpress-fire-push-popup-container');
                    popupContainer.show();

                    $('.wordpress-fire-push-popup-agree').on('click', function(e) {
                        e.preventDefault();

                        Notification.requestPermission(function (p) {
                            if (p !== 'denied') {
                                that.createCookie('fire_push_popup', 'agreed', 999999999);
                                popupContainer.fadeOut();

                                that.initMessaging();
                            } else {
                                alert(that.settings.deniedText);
                            }
                        })
                    });

                    $('.wordpress-fire-push-popup-decline').on('click', function(e) {
                        e.preventDefault();

                        that.createCookie('fire_push_popup', 'declined', 999999999);

                        popupContainer.fadeOut();
                    });

                    $('.wordpress-fire-push-popup-close').on('click', function(e) {
                        e.preventDefault();

                        popupContainer.fadeOut();
                    });
                    

                } else if (Notification.permission == 'granted') {
                    that.initMessaging();
                }
            }
        },
        welcomeNotification : function() {

            var that = this;

            $('.wordpress-fire-push-send-welcome-notification').on('click', function(e) {
                e.preventDefault();

                if(Notification.permission !== "granted") {
                    alert('Notifications not allowed');
                } else {
                    var title = that.settings.welcomeTitle;
                    var options = {
                        body: that.settings.welcomeBody,
                        icon: that.settings.welcomeIcon,        
                    };
                    var url = that.settings.welcomeURL;
                    that.createNotification(title, options, url);
                }
            }); 

        },
        initMessaging : function() {

            var that = this;
            const messaging = this.firebase.messaging();

            navigator.serviceWorker.register(this.settings.wpContentURL + '/plugins/wordpress-fire-push/public/js/firebase-messaging-sw.js?messagingSenderId=' + that.settings.messagingSenderId)
            .then((registration) => {

                messaging.useServiceWorker(registration);
                
                messaging.requestPermission()

                // Notification permission granted.
                .then(function() {
                    return messaging.getToken();
                })

                // Send Token to Save
                .then(function(token) {

                    var response = {};
                    var tokenSent = window.localStorage.getItem('firePushToken');

                    if(tokenSent === token) {
                        response.tokenExists = true;
                    } else {
                        window.localStorage.setItem('firePushToken', token);
                        response = that.updateToken(token);
                    }

                    return response;
                })

                // Maybe send Welcome
                .then(function(response) {
                    if(response.tokenExists == false) {
                        var title = that.settings.welcomeTitle;
                        var options = {
                            body: that.settings.welcomeBody,
                            icon: that.settings.welcomeIcon,        
                        };
                        var url = that.settings.welcomeURL;
                        that.createNotification(title, options, url);
                    }
                })

                // Permission denied
                .catch(function(err) { // Happen if user deney permission
                    console.log('Unable to get permission to notify.', err);
                });

                // Fetch Messages
                messaging.onMessage(function(payload){

                    var title = payload.notification.title;
                    var options = {
                        body: payload.notification.body,
                        icon: payload.notification.icon,        
                    };

                    that.createNotification(title, options, payload.notification.click_action, payload.multicast_id);

                })
            });
        },
        createNotification : function(title, options, url, notification_id) {

            if (!("Notification" in window)) {
                console.log("This browser does not support system notifications");
            }
            // Notification permissions granted
            else if (Notification.permission === "granted") {

                var notification = new Notification(title, options);
                notification.onclick = function(e) {
                    e.preventDefault();
                    window.open(url , '_blank');

                    if(notification_id !== "") {
                        that.updateNotificationClicked(notification_id);
                    }

                    notification.close();
                }
            }
        },
        updateToken : function(token) {

            var that = this;

            return $.ajax({
                url: that.settings.ajax_url,
                type: 'post',
                dataType: 'JSON',
                data: {
                    action: 'update_token',
                    token: token,
                },
            });
        },
        updateNotificationClicked : function(notification_id) {

            var that = this;

            return $.ajax({
                url: that.settings.ajax_url,
                type: 'post',
                dataType: 'JSON',
                data: {
                    action: 'update_notification_clicked',
                    multicast_id: notification_id,
                },
            });
        },
        // desktopNotifications : function () {

        //     var that = this;
        //     var showWelcome = that.getCookie('desktopNotificationsShowWelcome');

        //     if(that.isEmpty(showWelcome)) {
        //         Push.create(that.settings.desktopNotificationsWelcomeTitle, {
        //                 body: that.settings.desktopNotificationsWelcomeText,
        //                 icon: that.settings.desktopNotificationsIcon,
        //                 timeout: that.settings.desktopNotificationsTimeout,
        //         });
        //         that.createCookie('desktopNotificationsShowWelcome', 'false', that.settings.desktopNotificationsWelcomeTimeout);
        //     }

        //     $.ajax( {
        //         type: 'post',
        //         url: that.settings.ajax_url,
        //         dataType: 'json',
        //         data: {
        //             action : 'desktop_notifications_get_comment_ids',
        //         },
        //         success: function( response ) {
        //             if(response.message == "Not logged in") {
        //                 return false;
        //             }
        //             that.desktopNotifications.comment_ids = that.desktopNotifications.comment_ids.concat(response.comment_ids)
        //             that.desktopNotificationsInterval = setInterval(function(){ that.desktopNotificationsCheck() }, that.settings.desktopNotificationsAJAXInterval);
        //         },
        //         error: function(jqXHR, textStatus, errorThrown) {
        //             console.log('An Error Occured: ' + jqXHR.status + ' ' + errorThrown + '! Please contact System Administrator!');
        //         }
        //     } );
            
        // },
        // desktopNotificationsCheck : function() {

        //     var that = this;
        //     $.ajax( {
        //         type: 'post',
        //         url: that.settings.ajax_url,
        //         dataType: 'json',
        //         data: {
        //             comment_ids : that.desktopNotifications.comment_ids,
        //             action : 'desktop_notifications_get_new_comments',
        //         },
        //         success: function( response ) {
        //             if(response.status == "false") {
        //                 return;
        //             }
        //             that.desktopNotifications.comment_ids.desktop(response.comment_id);

        //             Push.create(response.title, {
        //                 body: response.body,
        //                 link: response.link,
        //                 icon: that.settings.desktopNotificationsIcon,
        //                 timeout: that.settings.desktopNotificationsTimeout,
        //             });
        //         },
        //         error: function(jqXHR, textStatus, errorThrown) {
        //             console.log('An Error Occured: ' + jqXHR.status + ' ' + errorThrown + '! Please contact System Administrator!');
        //         }
        //     } );
        // },
        //////////////////////
        ///Helper Functions///
        //////////////////////
        isEmpty: function(obj) {

            if (obj == null)        return true;
            if (obj.length > 0)     return false;
            if (obj.length === 0)   return true;

            for (var key in obj) {
                if (hasOwnProperty.call(obj, key)) return false;
            }

            return true;
        },
        sprintf: function parse(str) {
            var args = [].slice.call(arguments, 1),
                i = 0;

            return str.replace(/%s/g, function() {
                return args[i++];

            });
        },
        getCookie: function(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for(var i=0; i<ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1);
                if (c.indexOf(name) === 0) return c.substring(name.length, c.length);
            }
            return "";
        },
        createCookie: function(name, value, minutes) {
            var expires = "";

            if (minutes) {
                var date = new Date();
                date.setTime(date.getTime()+(minutes * 60 * 1000));
                var expires = "; expires="+date.toGMTString();
            }

            document.cookie = name + "=" + value+expires + "; path=/";
        },
        deleteCookie: function(name) {
            this.createCookie(name, '', -10);
        }
    } );

    // Constructor wrapper
    $.fn[ pluginName ] = function( options ) {
        return this.each( function() {
            if ( !$.data( this, "plugin_" + pluginName ) ) {
                $.data( this, "plugin_" +
                    pluginName, new Plugin( this, options ) );
            }
        } );
    };

    $(document).ready(function() {

        $( "body" ).fire_push( 
            fire_push_options
        );

    } );

})( jQuery );