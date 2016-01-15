module.exports = {
    data: function () {
        return {
            tasks: [],
            task: '',
        }
    },

    ready: function () {
        $('#add_task').parsley();

        $('#add_task').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
                $('.bs-callout-info').toggleClass('hidden', !ok);
                $('.bs-callout-warning').toggleClass('hidden', ok);
            })
            .on('form:success', function() {
                var task = document.querySelector("[name='task']").value;
                var board = getValueAtIndex(4);

                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') } });

                $.ajax({
                    url: "/tasks/add-task",
                    method: "POST",
                    data: { task: task, board: board },
                    //dataType: "json"
                })
                .done(function () {
                    $("[name='task']").val('');
                    window.location.href = '/boards/'+board+'/tasks';
                });
            });

        this.refreshBoard();
    },

    template: require('../templates/tasks.html'),

    methods: {
        addTask: function (e) {
            this.refreshBoard();
        },
        refreshBoard: function () {
            var board = getValueAtIndex(4);

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

function getValueAtIndex(index) {
    var str = window.location.href;
    return str.split("/")[index];
}