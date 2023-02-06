<template>
    <div>
        <ul>
            <li v-for="item in Object.keys(data).slice(3)" :key="item">
                <button v-on:click="_handleClick(data[item])">
                    {{ item }} : {{ data[item] }}
                </button>
            </li>
        </ul>
    </div>
</template>

<script>
import http from '../../common/http-common'

export default {
    data() {
        return {
            data: []
        }
    },

    mounted() {
        this.test()
        this._handleClick()
    },

    methods: {
        async test() {
            http
                .get("/api")
                .then(response => {
                    this.data = response.data
                })
                .catch(e => {
                    console.log(e)
                })
        },
        async _handleClick(item) {
            console.log(item)
        }
    },

}
</script>