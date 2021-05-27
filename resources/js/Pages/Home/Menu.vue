<template>
  <home-layout>
    <div class="card-columns">
      <div v-for="category in menu" class="menu">
        <div v-if="category.dishes.length > 0">
          <h5>{{ category.name }}</h5>
          <div v-for="dish in category.dishes">
            <div class="menu-item">
              <span>{{ dish.number }}</span>
              <span v-if="dish.addition">{{ dish.addition }}</span>
              <span>. {{ dish.name }}</span>
              <span class="dotted"></span>
              <span>&euro; {{ dish.price }}</span>
            </div>
            <span v-if="dish.description" class="font-italic small">({{ dish.description }})</span>
          </div>
          <br/>
        </div>
      </div>
    </div>
  </home-layout>
</template>

<script>
import HomeLayout from '@/Layouts/HomeLayout';

export default {
  components: {
    HomeLayout
  },
  props: {
    menu: Array
  }
}
</script>
