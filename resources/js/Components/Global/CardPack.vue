<template>
  <div
    :class="cardClasses"
    class="w-full max-w-sm rounded-3xl p-8 transform transition-transform duration-300"
  >
    <div v-if="cardData.bestChoice" class="absolute -top-6 -right-6 bg-yellow-400 p-2 rounded-full transform rotate-12">
      <svg class="w-6 h-6 text-yellow-800" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M11.332 3.193a1 1 0 011.594.496l1.246 3.116a1 1 0 00.758.552l3.393.493a1 1 0 01.554 1.706l-2.459 2.398a1 1 0 00-.287.886l.58 3.377a1 1 0 01-1.451 1.054l-3.037-1.597a1 1 0 00-.936 0l-3.037 1.597a1 1 0 01-1.451-1.054l.58-3.377a1 1 0 00-.287-.886L3.08 9.497a1 1 0 01.554-1.706l3.393-.493a1 1 0 00.758-.552l1.246-3.116a1 1 0 011.594-.496z" clip-rule="evenodd"></path>
      </svg>
    </div>

    <h3 :class="titleClasses" class="text-xl font-semibold">{{ cardData.title }}</h3>
    <p :class="subtitleClasses" class="text-sm mb-6">{{ cardData.subtitle }}</p>

    <div class="flex items-start mb-6">
        <span :class="periodClasses" class="text-xl mt-2">Rp.</span>
      <span :class="priceClasses" class="text-4xl font-bold">{{ cardData.price }}</span>
    </div>

    <p v-if="cardData.bestChoice" class="text-sm mb-6">Best choice</p>

    <button :class="buttonClasses" class="w-full py-3 rounded-full font-medium transition-colors duration-300 mb-6">
      Get started
    </button>

    <ul class="space-y-4">
      <li v-for="(feature, index) in cardData.features" :key="index" class="flex items-center">
        <svg :class="iconClasses" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
        </svg>
        <span :class="textClasses">{{ feature }}</span>
      </li>
    </ul>

    <a :class="linkClasses" href="#" class="hover:underline mt-6 block">Learn more</a>
  </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  cardData: {
    type: Object,
    required: true,
  },
});

const cardClasses = computed(() => {
  if (props.cardData.type === 'pro') {
    return 'relative bg-blue-600 text-white shadow-2xl scale-110 md:scale-100 md:hover:scale-110';
  } else {
    return 'bg-white text-gray-800 shadow-lg hover:scale-105';
  }
});

const titleClasses = computed(() => {
  return props.cardData.type === 'pro' ? '' : 'text-gray-800';
});

const subtitleClasses = computed(() => {
  return props.cardData.type === 'pro' ? 'opacity-80' : 'text-gray-500';
});

const priceClasses = computed(() => {
  return props.cardData.type === 'pro' ? '' : 'text-gray-900';
});

const periodClasses = computed(() => {
  return props.cardData.type === 'pro' ? 'opacity-80' : 'text-gray-500';
});

const buttonClasses = computed(() => {
  if (props.cardData.type === 'pro') {
    return 'bg-white text-blue-600 hover:bg-gray-100';
  } else {
    return 'bg-blue-500 text-white hover:bg-blue-600';
  }
});

const iconClasses = computed(() => {
  return props.cardData.type === 'pro' ? 'text-white opacity-80' : 'text-green-500';
});

const textClasses = computed(() => {
  return props.cardData.type === 'pro' ? 'opacity-80' : 'text-gray-600';
});

const linkClasses = computed(() => {
  return props.cardData.type === 'pro' ? 'text-white opacity-80' : 'text-blue-500';
});
</script>
