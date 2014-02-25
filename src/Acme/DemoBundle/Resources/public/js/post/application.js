
Ember.LOG_BINDINGS = true;
window.Posts = Ember.Application.create({
    // Basic logging, e.g. "Transitioned into 'post'"
    LOG_TRANSITIONS: true,
    LOG_TRANSITIONS_INTERNAL: true,
    LOG_VIEW_LOOKUPS: true,
    LOG_ACTIVE_GENERATION: true
});

Posts.ApplicationAdapter  = DS.RESTAdapter.extend({
    namespace: 'app_dev.php/api' //Comment faire pour garder le app_dev.php si
});

Posts.ApplicationSerializer = DS.RESTSerializer.extend({
    normalizePayload: function(type, payload) {
        //Transforme entity (de php) avec le bon type
        var root = Ember.String.decamelize(type.typeKey);
        var newPayload = {};
        newPayload[root] = payload.entity;
        return newPayload;
    }
});