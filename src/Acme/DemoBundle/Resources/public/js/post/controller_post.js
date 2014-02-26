Posts.PostEditController = Ember.ObjectController.extend({
    actions: {
        save: function(){
            // create a new user and save it
            var post = this.get('model');
            var controller = this;
            post.save().then(
                function() {
                    controller.transitionToRoute('posts');
                },
                function(response) {
                    post.rollback();
                    alert('error while saving');
                }
            );

        }
    }
});

Posts.PostController = Ember.ObjectController.extend({
    actions: {
        remove: function(){
            var model = this.get('model');
            model.deleteRecord();
            model.save().then(
                function(model) {
                    console.log('Tout va bien. (removePost) :)');
                    console.log(model);
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