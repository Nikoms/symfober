window.Posts = Ember.Application.create();

Posts.ApplicationAdapter  = DS.RESTAdapter.extend({
    namespace: 'app_dev.php/api' //Comment faire pour garder le app_dev.php si
});

Posts.ApplicationSerializer = DS.RESTSerializer.extend({
    normalizePayload: function(type, payload) {
        return {posts:payload.entities};
    }
});