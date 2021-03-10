<template>
  <div id="app">
    <notifications
      class="mt-2"
      group="error"
      position="top center"
      :max="3"
      :width="400"
    />
    <notifications
      class="mt-2"
      group="success"
      position="top center"
      :max="3"
      :width="400"
    />

    <Header />
    <transition mode="out-in" enter-active-class="animate__animated animate__fadeIn">
      <router-view :key="$route.path"></router-view>
    </transition>
    <Footer />
  </div>
</template>

<script>
import Header from "@/components/Header/Header.vue";
import Footer from "@/components/Footer/Footer.vue";

export default {
  name: "App",
  components: {
    Header,
    Footer,
  },
};
</script>