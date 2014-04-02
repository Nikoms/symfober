//Ember.LOG_BINDINGS = true;
//window.Posts = Ember.Application.create({
//    // Basic logging, e.g. "Transitioned into 'post'"
//    LOG_TRANSITIONS: true,
//    LOG_TRANSITIONS_INTERNAL: true,
//    LOG_VIEW_LOOKUPS: true,
//    LOG_ACTIVE_GENERATION: true
//});
window.AppAdmin = Ember.Application.create({
    rootElement:'#admin',
    ready: function () {
        //alert("Avant qu'on remplisse la liste");
    }
});

AppAdmin.ApplicationAdapter  = DS.RESTAdapter.extend({
    namespace: 'app_dev.php/api' //Comment faire pour garder le app_dev.php si
});

AppAdmin.ApplicationSerializer = DS.RESTSerializer.extend({
    normalizePayload: function(type, payload) {
        //Si on a pas d'entity, alors on renvoi directement le payload au risque d'avoir une erreur
        if(undefined === payload.entity){
            return payload;
        }
        //Transforme entity (de php) avec le bon type que emberjs préfère
        var root = Ember.String.decamelize(type.typeKey);
        var newPayload = {};
        newPayload[root] = payload.entity;
        console.log(newPayload);
        return newPayload;
    }
});

//Initialiser avec toute chose (exemple: preloader le store) : http://nerdyworm.com/blog/2013/04/03/ember-initializers/
//Ember.Application.initializer({
//    name: 'api-adapter',
//
//    initialize: function(container, application) {
//        alert('ok');
//    }
//});