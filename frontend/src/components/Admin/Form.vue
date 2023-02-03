<template>
    <form @submit.prevent="submitForm">
        <div v-for="field in fields" :key="field.name">
            <label>{{ field.label }}</label>
            <input v-model="form[field.name]" :type="field.type" :placeholder="field.placeholder">
        </div>
        <button type="submit">Submit</button>
    </form>
</template>

<script>
import http from '../../common/http-common';
    
export default {
    props : {
        fields: {
            type: Array,
            required: true
        },
        formData: {
            type: Object,
            default: () => {}
        },
        submitApi: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            form: this.formData
        };
    },
    methods: {
        async submitForm() {
            try {
                const method = this.form.id ? "put" : "post";
                const response = await http[method](this.submitApi, this.form);
                this.$emit("submitted", response.data);
            } catch (error) {
                console.error(error);
            }
        }
    }
};
</script>