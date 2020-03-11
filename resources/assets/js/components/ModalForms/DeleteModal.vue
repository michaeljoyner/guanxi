<template>
    <span>
        <button @click="showDeleteForm = true" class="dd-btn btn-red">Delete</button>
        <modal :show="showDeleteForm" @close="showDeleteForm = false">
            <form method="post" :action="deleteUrl" class="w-scree max-w-md p-4">
                <input type="hidden" value="DELETE" name="_method">
                <input type="hidden" :value="token" name="_token">
                <p class="text-xl text-danger mb-6">Are you sure?</p>
                <p>Are you sure you would like to delete {{ item }}? It may just be irreversible.</p>
                <div class="my-6 flex justify-end">
                    <button type="button" @click="showDeleteForm = false" class="dd-btn btn-grey">Cancel</button>
                    <button type="submit" class="dd-btn btn-red ml-4">Yes, I am sure!</button>
                </div>
            </form>
        </modal>
    </span>
</template>

<script type="text/babel">
    export default {
        props: ['delete-url', 'item'],

        data() {
            return {
                showDeleteForm: false,
                token: window.Laravel.csrfToken
            };
        }
    }
</script>