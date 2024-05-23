<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import Label from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'

const emitTest = e => console.log(e)
</script>

<template>
<GuestLayout>
    <Label value="件名">タイトル</Label>
    <TextInput 
        modelValue="初期値がいります。"
        @update:modelValue="emitTest"
        ></TextInput>
</GuestLayout>
</template>