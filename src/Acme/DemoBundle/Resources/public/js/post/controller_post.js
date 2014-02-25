Posts.PostsCreateController = Ember.ObjectController.extend({
    needs: ['post'],
    actions: {
        save:function(){
            // create a new user and save it
            console.log(this.get('model'));
            var newPost = this.store.createRecord('post', this.get('model'));
            var controller = this;
            newPost.save().then(
                function(post) {
                    // redirects to the user itself
                    console.log(post);
                    console.log(newPost);
                    controller.transitionToRoute('post.edit', post);
                },
                function(response) {
                    alert('error while saving');
                    console.error('onfail de acceptChanges');
                    //CA CA FONCTIONNE :)
                    model.rollback();
                    console.error(response);
                }
            );

        }
    }
});

Posts.PostController = Ember.ObjectController.extend({
    actions: {
        dd:function(){
            alert('PostController');
        },
        editMode: function() {
            this.set('isEditing', true);
        },
        save: function() {
            var model = this.get('model');
            this.set('isEditing', false);

            if (Ember.isEmpty(this.get('model.title'))) {
                this.send('removePost');
            } else {
                this.get('model').save().then(
                    function(post) {
                        console.log('Tout va bien (acceptChanges) :)');
                        console.log(post);
                    },
                    function(response) {
                        console.error('onfail de acceptChanges');
                        //CA CA FONCTIONNE :)
                        model.rollback();
                        console.error(response);
                    }
                );
            }
        },
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
                    todo.rollback();
                    //Comment le faire reapparaitre dans la liste?
                });


        },
        edit:function(){ //pour tester transitionToRoute
            var model = this.get('model');
            this.transitionToRoute('post.edit', model);
        },
        update: function(post){
            console.log(post);
            var model = this.get('model');
            // this will tell Ember-Data to save/persist the new record
            model.save().then(
                function(post) {
                    console.log('Tout va bien (update) :)');
                    console.log(post);
                },
                function(response) {
                    console.error('onfail de update');
                    model.rollback();
                    console.error(response);
                }
            );
            // then transition to the current user
            this.transitionToRoute('post', model);
        }
    },

    isEditing: false
});