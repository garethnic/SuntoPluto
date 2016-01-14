var VueRouter = require('vue-router');
var router = new VueRouter();

module.exports = {
    data: function () {
        return {
            members: []
        }
    },

    ready: function () {
        var board = getValueAtIndex(4);

        var users = this.$http.post('/members', {board: board}).then(function (response) {
            this.$set('members', response.data);
        });
    },

    template: require('../templates/assign_members.html'),

    methods: {
        assignMember: function(task, user) {
            var assign = this.$http.post('/tasks/assign-task', {task: task, user: user}).then(function (response) {
                router.go('/tasks');
            });
        }
    }
}

function getValueAtIndex(index) {
    var str = window.location.href;
    return str.split("/")[index];
}