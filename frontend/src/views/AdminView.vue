<template>
    <div>
        <component :is="Admin" :api-platform-url="'https://localhost:8741/'"/>
    </div>
</template>

<script>
    export default {
        name: 'AdminView',
        data() {
            return {
                // ...
            }
        },
        components: {
            Admin: Component(Admin)
        }
    }
</script>