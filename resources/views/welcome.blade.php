<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Live Search Vue.js - Laravel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.0/css/bulma.min.css">
</head>
<body>
    <div id="app">
        <section class="section">
            <div class="container">
                <div class="field">
                    <input v-model="search" type="search" class="input" placeholder="Cari user">
                </div>
                <div class="content mt-6">
                    <div class="columns is-centered is-multiline">
                        <div v-for="(user, index) in users" v-bind:key="index" class="column is-3">
                            <div class="card">
                                <div class="card-content has-text-centered">
                                    <h1 class="title is-4">@{{ user.name }}</h1>
                                    <h2 class="title is-6 is-subtitle">@{{ user.email }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.10.2/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    <script>
        new Vue({
            el: '#app',
            
            data: {
                search: '',
                users: []
            },

            mounted() {
                this.fetchUsers()
            },

            methods: {
                fetchUsers() {
                    let param = _.isEmpty(this.search) ? 'all' : this.search

                    axios.get('users/' + param).then(({ data }) => {
                        this.users = data
                    })
                }
            },

            watch: {
                search: _.debounce( function() {
                    this.fetchUsers()
                }, 500)
            }
        })
    </script>
</body>
</html>