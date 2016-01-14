module.exports = {
    data: function () {
        return {
            tasks: [],
            task: '',
        }
    },

    ready: function () {
        this.refreshBoard();
    },

    template: require('../templates/tasks.html'),

    methods: {
        addTask: function () {
            this.$http.post('/tasks/add-task', {task: this.$data.task}).then(function (response) {
                this.task = '';
                this.refreshBoard();
            });
        },
        refreshBoard: function () {
            var board = this.getValueAtIndex(4);

            var tasks = this.$http.post('/tasks/all_json', {board: board}).then(function (response) {
                this.$set('tasks', response.data);
            });
        },
        removeTask: function (task) {
            this.$http.delete('/tasks/remove-task', {task: task}).then(function (response) {
                this.refreshBoard();
            });
        },
        completeTask: function (task) {
            this.$http.post('/tasks/complete-task', {task: task}).then(function (response) {
                this.refreshBoard();
            });
        },
        getValueAtIndex: function (index) {
            var str = window.location.href;
            return str.split("/")[index];
        }
    },
}