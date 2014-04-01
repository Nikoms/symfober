Pages.PagesCreateController = Ember.ObjectController.extend({
    actions: {
        save:function(){
            var newPage = this.store.createRecord('page', this.get('model'));
            var controller = this;
            newPage.save().then(
                function(page) {
                    controller.transitionToRoute('page.edit', page);
                },
                function(response) {
                    alert('error while saving');
                }
            );

        }
    }
});