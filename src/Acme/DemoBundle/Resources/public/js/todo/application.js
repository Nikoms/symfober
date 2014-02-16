window.Posts = Ember.Application.create();

Posts.ApplicationAdapter  = DS.RESTAdapter.extend({
    namespace: 'app_dev.php/api' //Comment faire pour garder le app_dev.php si
});

Posts.ApplicationSerializer = DS.RESTSerializer.extend({
    extractArray: function(store, type, payload, id, requestType) {
        return this._super(store, type, {posts:payload.entities}, id, requestType);
    }
});