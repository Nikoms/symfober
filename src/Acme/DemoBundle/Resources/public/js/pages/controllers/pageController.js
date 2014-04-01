Pages.PageController = Ember.ObjectController.extend({
    actions: {
        remove: function(){
            var model = this.get('model');
            model.deleteRecord();
            var controller = this;
            model.save().then(
                function(model) {
                    controller.transitionToRoute('pages');
                },
                function() {
                    console.error('removePage failed');
                });
        }
    }
});