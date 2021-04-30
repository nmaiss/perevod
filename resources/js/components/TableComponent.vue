<template>
    <div>
        <b-table striped hover :items="clients" :fields="fields">
          <template v-slot:cell(name)="row">
            <b-form-input v-model="row.item.name" @input="updateClient(row.item.id, row.item)"/>
          </template>
          <template v-slot:cell(email)="row">
            <b-form-input v-model="row.item.email"/>
          </template>
        </b-table>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
            axios.get('/client').then(response => (this.clients = response.data))
        },
        data() {
            return {
                fields: [
                  {
                    key: 'id',
                  },
                  {
                    key: 'name',
                    label: 'Name',
                  },
                  {
                    key: 'email',
                    label: 'Email',
                  }
                ],
                clients: []
            }
        },
        methods: {
            updateClient: function ($id, $arr){
                axios.post('/client/update/' + $id, $arr);
            }
        }
    }
</script>
