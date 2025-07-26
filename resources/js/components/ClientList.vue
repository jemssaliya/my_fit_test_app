<template>
    <table class="table client-list">
        <thead>
        <tr class="bg-light client-list-heading">
            <th scope="col">My Clients</th>
            <th scope="col" class="text-center"><i class="fa fa-plus-circle"></i></th>
        </tr>
        </thead>
        <tbody>
        <tr class="bg-light">
            <td class="td-client-list" colspan="2">
                <p class="client-name p-l-2">Mark</p>
                <p class="d-inline p-l-2">male</p>
                <p class="d-inline p-l-2">27 years old</p>
            </td>
        </tr>
        <tr class="bg-light">
            <td class="td-client-list" colspan="2">
                <p class="client-name p-l-2">{{myName}}</p>
                <p class="d-inline p-l-2">male</p>
                <p class="d-inline p-l-2">27 years old</p>
            </td>
        </tr>
        <tr class="bg-light">
            <td class="td-client-list" colspan="2">
                <p class="client-name p-l-2">{{myName}}</p>
                <p class="d-inline p-l-2">male</p>
                <p class="d-inline p-l-2">27 years old</p>
            </td>
        </tr>
        </tbody>
    </table>
</template>
<script>
    export default {
        name: "clientList",
        props: {
            myName: {
                type: String,
                required: true
            }
        },
        computed: {
            // a computed getter
            reversedMessage: function () {
                // `this` points to the vm instance
                return this.message.split('').reverse().join('')
            }
        }
        /* items = items.filter(function(item) {
        return item.Title && item.Specifications.some(function(specification) {
             return specification.Name === "Watt";
        });
    }); */
    }
</script>

<style scoped>

    .client-list {
        border-collapse: separate;
        border-spacing: 0em 0.5em;
    }

    .td-client-list {
        border: 0.2em solid transparent;
    }

    .td-client-list:hover {
        border: 0.2em solid #5abf5a !important;
        border-style: groove;
        border-color: aqua;
    }

    .client-name {
        font-size: 1.1rem;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .client-list-heading {
        font-size: 1.2rem !important;
    }

    .p-l-2 {
        padding-left: 0.5rem !important;
    }

    /* .tr:hover {
        border-top:4px solid green;
        border-bottom:4px solid green;
    } */

</style>

{{-- <a href="{{route('clients.create')}}"> --}}
