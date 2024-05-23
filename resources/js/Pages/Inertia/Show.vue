<script setup>
import { Inertia } from '@inertiajs/inertia';

defineProps({
    id : String,
    blog: Object
})

const deleteConfirm = id => {
    Inertia.delete(`/inertia/${id}`, {
        onBefore: () => confirm('本当に削除しますか？')
    })
}
</script>

<template>
{{ id }}<br>
件名：{{ blog.title }} 本文：{{ blog.content }}
<button @click="deleteConfirm(blog.id)">削除</button>
</template>