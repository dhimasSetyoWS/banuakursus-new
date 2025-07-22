<template>
    <a :href="href">
        <div class="interactive-card category-card">
            <img v-if="img" alt="icon" class="w-14 h-14" height="56"
                :src="img" width="56" loading="lazy" />
            <div class="category-text select-none font-bold">
                {{name}}
            </div>
        </div>
    </a>
</template>

<script setup>
defineProps({
    href : String,
    img : String,
    name : String,
})
</script>

<style scoped>
/* Popular Category & Tools base style */
.interactive-card {
    background-color: #f6fafa;
    /* very light blue-white */
    border-radius: 1rem;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    border: 2px solid #1e293b;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}

.interactive-card:hover,
.interactive-card:focus-visible {
    border-color: #2563eb;
    box-shadow: 0 8px 20px rgba(37, 99, 235, 0.15);
    outline: none;
}

/* Popular Category and Tools inner spacing */
.category-card,
.tool-card {
    padding: 1.5rem 1.75rem;
    display: flex;
    align-items: center;
    gap: 1.25rem;
}

/* Text styling */
.category-text,
.tool-text {
    font-weight: 600;
    font-size: 1.125rem;
    /* text-lg */
    line-height: 1.3;
    color: #1e293b;
    user-select: none;
}

</style>
