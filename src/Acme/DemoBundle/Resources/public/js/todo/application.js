window.Posts = Ember.Application.create();

Posts.ApplicationAdapter  = DS.RESTAdapter.extend({
    namespace: 'app_dev.php/api', //Comment faire pour garder le app_dev.php si
    ajaxError: function(jqXHR) {
        var error = this._super(jqXHR);
        console.error('Je suis dans ajaxError!');
//        if (jqXHR && jqXHR.status === 422) {
//            var jsonErrors = Ember.$.parseJSON(jqXHR.responseText)["errors"];
//
//            return new DS.InvalidError(jsonErrors);
//        } else {
//            return error;
//        }
    },
    deleteRecord: function(store, type, record){
        console.log('deleteRecord');
        console.log(record);
        return this._super(store, type, record);
    }
});

Posts.ApplicationSerializer = DS.RESTSerializer.extend({
    extractArray: function(store, type, payload, id, requestType) {
        return this._super(store, type, {posts:payload.entities}, id, requestType);
    }/*,
    extractDeleteRecord: function(store, type, payload){
        console.log("extractDeleteRecord après l'appel au delete");
        return this._super(store, type, payload);
    }*/
});