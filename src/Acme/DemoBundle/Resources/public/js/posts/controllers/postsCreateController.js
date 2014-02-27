Posts.PostsCreateController = Ember.ObjectController.extend({
    actions: {
        save:function(){
            var newPost = this.store.createRecord('post', this.get('model'));
            var controller = this;
            newPost.save().then(
                function(post) {
                    controller.transitionToRoute('post.edit', post);
                },
                function(response) {
                    alert('error while saving');
                }
            );

        }
    }
});