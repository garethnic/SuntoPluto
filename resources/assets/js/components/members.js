var VueRouter = require('vue-router');
var router = new VueRouter();

module.exports = {
    data: function () {
        return {
            members: [],
            newMember: ''
        }
    },

    ready: function () {
        $('#add_member').parsley();
        var board = getValueAtIndex(4);

        $('#add_member').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
                $('.bs-callout-info').toggleClass('hidden', !ok);
                $('.bs-callout-warning').toggleClass('hidden', ok);
            })
            .on('form:success', function() {
                var member = document.querySelector("[name='email']").value;
                var board = getValueAtIndex(4);

                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') } });

                $.ajax({
                        url: "/boards/add-new-member",
                        method: "POST",
                        data: { email: member, board: board},
                        dataType: "json"
                    })
                    .done(function () {
                        window.location.href = '/boards/'+board+'/tasks';
                    });
            });

        var users = this.$http.post('/members', {board: board}).then(function (response) {
            this.$set('members', response.data);
        });
    },

    template: require('../templates/members.html'),
}

function getValueAtIndex(index) {
    var str = window.location.href;
    return str.split("/")[index];
}