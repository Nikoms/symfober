AppAdmin.PostController = Ember.ObjectController.extend({
    actions: {
        remove: function(){
            var model = this.get('model');
            model.deleteRecord();
            var controller = this;
            model.save().then(
                function(model) {
                    console.log('Tout va bien. (removePost) :)');
                    console.log(model);
                    controller.transitionToRoute('posts');
                },
                function() {
                    console.error('removePost failed');
                    console.log(model);
                    model.rollback();
                    //Comment le faire reapparaitre dans la liste?
                });
        }
    }
});