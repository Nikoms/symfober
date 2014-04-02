AppAdmin.Router.map(function () {
    this.resource('pages', { path: '/admin/pages' }, function () {
        this.route('create');
        this.resource('page', {path:'/page/:id'}, function(){
            this.route('edit');
        });
    });
});
