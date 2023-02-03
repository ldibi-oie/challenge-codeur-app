<template>
<table>
    <thead>
        <tr>
            <th v-for="column in columns" :key="column">{{ column }}</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="row in data" :key="row.id">
            <td v-for="column in columns" :key="column">{{ row[column] }}</td>
            <td>
                <button>Edit</button>
                <button>Delete</button>
            </td>
        </tr>
    </tbody>
</table>
</template>

<script>
import http from '../../common/http-common';

export default {
    name: 'Table',
    props: {
        path: String,
    },
    data() {
        return {
            columns: [],
            data: []
        };
    },
    mounted() {
        this.fetchData();
    },
    methods : {
        async fetchData() {
            const response = await http.get(this.path);
            this.columns = Object.keys(response.data["hydra:member"][0]);
            this.data = response.data["hydra:member"];
        },
    },
};
</script>