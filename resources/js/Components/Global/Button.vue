<template>
    <button type="button"
        class="px-4 py-2 text-sm font-medium text-white rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2" :class="checkType()">
        {{ text }}
    </button>
</template>

<script setup>
const props = defineProps({
    text: String,
    type: String
});

const blueType = ['bg-blue-600 hover:bg-blue-700 focus:ring-blue-500'];
const greenType = ['bg-green-600 hover:bg-green-700 focus:ring-green-500'];

function checkType() {
    switch (props.type) {
        case 'green':
            return greenType;
        default:
            return blueType;
    }
}

</script>
