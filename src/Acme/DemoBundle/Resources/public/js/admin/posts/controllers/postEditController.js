AppAdmin.PostEditController = Ember.ObjectController.extend({
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

        },
        close: function(){
            this.transitionToRoute('post');
        }
    }
});