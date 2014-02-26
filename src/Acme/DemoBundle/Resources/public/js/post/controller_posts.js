//Posts.PostsController = Ember.ArrayController.extend({
//    actions: {
//        create: function() {
//            // Get the post title set by the "New Post" text field
//            var title = this.get('newTitle');
//            if (!title.trim()) { return; }
//
//            // Create the new Post model
//            var post = this.store.createRecord('post', {
//                title: title,
//                body: 'Body of ' + title
//            });
//
//            // Clear the "New Post" text field
//            this.set('newTitle', '');
//
//            // Save the new model
//            post.save();
//        }
//    }
//});

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