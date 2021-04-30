<style>
    td, th{
        text-align: center!important;
    }
</style>

<template>
    <div>

        <b-card no-body>
          <b-tabs card>
            <b-tab title="Заказы" active>
              <b-card-text>
                  <b-table striped hover :items="orders" :fields="order_fields">
                    <template slot="top-row" slot-scope="{ fields }">
                      <td v-for="field in fields" :key="field.key">
                        <input class="form-control" v-if="field.key == 'email'" v-model="newOrderEmail">
                        <input class="btn btn-primary" type="button" v-if="field.key == 'add'" value="Добавить" v-on:click="addOrder()">
                      </td>
                    </template>
                    <template v-slot:cell(name)="row">
                      <b-form-input v-model="row.item.name" @input="updateClient(row.item.id, row.item)"/>
                    </template>
                    <template v-slot:cell(email)="row">
                      <b-form-input v-model="row.item.email" @input="updateClient(row.item.id, row.item)"/>
                    </template>
                  </b-table>
              </b-card-text>
            </b-tab>
            <b-tab title="Заказчики">
              <b-card-text>
                  <b-table striped hover :items="clients" :fields="client_fields">
                    <template slot="top-row" slot-scope="{ fields }">
                        <td v-for="field in fields" :key="field.key">
                            <input class="form-control" v-if="field.key == 'email'" v-model="newClientEmail">
                            <input class="form-control" v-if="field.key == 'name'" v-model="newClientName">
                            <input class="btn btn-primary" type="button" v-if="field.key == 'add'" value="Добавить" v-on:click="addClient()">
                        </td>
                    </template>
                    <template v-slot:cell(name)="row">
                      <b-form-input v-model="row.item.name" @input="updateClient(row.item.id, row.item)"/>
                    </template>
                    <template v-slot:cell(email)="row">
                      <b-form-input v-model="row.item.email" @input="updateClient(row.item.id, row.item)"/>
                    </template>
                    <template v-slot:cell(orders)="row">
                        <a href="/orders">Заказы</a>
                    </template>
                  </b-table>
              </b-card-text>
            </b-tab>
          </b-tabs>
        </b-card>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
            axios.get('/client').then(response => (this.clients = response.data))
            axios.get('/order').then(response => (this.orders = response.data))
        },
        data() {
            return {
                newOrderEmail: '',
                newClientEmail: '',
                newClientName: '',
                client_fields: [
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
                  },
                  {
                    key: 'orders',
                    label: '',
                  },
                  {
                    key: 'add',
                    label: '',
                  }
                ],
                order_fields: [
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
                  },
                  {
                    key: 'add',
                    label: '',
                  }
                ],
                clients: [],
                orders: [],
            }
        },
        methods: {
            updateClient: function ($id, $arr){
                axios.post('/client/update/' + $id, $arr);
            },

            addClient: function(){
                let client = new FormData ();
                client.set('name', this.newClientName);
                client.set('email', this.newClientEmail);
                axios.post('/order/store/', client);
                axios.get('/client').then(response => (this.clients = response.data));
                axios.get('/order').then(response => (this.orders = response.data));
            },

            addOrder: function(){
                axios.post('/order/store/' + this.newOrderEmail);
                axios.get('/order').then(response => (this.orders = response.data));
            }
        }
    }
</script>
