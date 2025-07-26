<template>
    <div id="app" class="ui vertical stripe segment">
        <div class="ui container">
            <div id="content" class="ui basic segment">
                <h3 class="ui header">List of Tests</h3>
                <vuetable
                    api-url=this.$config.BASE_URL + "/api/clients"
                    table-wrapper="#content"
                    :fields="columns"
                    :item-actions="itemActions"
                ></vuetable>
            </div>
        </div>
    </div>
</template>
<script>
    import {Vuetable,VuetablePagination,VuetablePaginationDropdown} from 'vuetable-2';
    export default ({
        name: 'clientTest',
        components: {
            Vuetable,
            VuetablePagination,
            VuetablePaginationDropdown,
        },
        data: {
            columns: [
                'name',
                'dob',
                'gender',
                '__actions'
            ],
            itemActions: [
                { name: 'view-item', label: '', icon: 'zoom icon', class: 'ui teal button' },
                { name: 'edit-item', label: '', icon: 'edit icon', class: 'ui orange button'},
                { name: 'delete-item', label: '', icon: 'delete icon', class: 'ui red button' }
            ]
        },
        methods: {

            viewProfile: function(id) {
                console.log('view profile with id:', id)
            },
            /* window.axios.get('/api/cruds').then(({ data }) => {
                data.forEach(crud => {
                    this.cruds.push(new Crud(crud));
                });
                this.mute = false;
            }); */
        },
        events: {
            'vuetable:action': function(action, data) {
                console.log('vuetable:action', action, data)
                if (action == 'view-item') {
                    this.viewProfile(data.id)
                }
            },
            'vuetable:load-error': function(response) {
                console.log('Load Error: ', response)
            }
        }
    })
</script>
