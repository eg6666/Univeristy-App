<template>
  <page-template-13 :data="data"> </page-template-13>
</template>

<script>
import PageTemplate13 from '../templates/page-template-13';
import data from './Doktoratura.js';
export default {
  name: 'Doktoratura',
  components: {
    PageTemplate13,
  },
  data() {
    return {
      data: data,
    };
  },
};
</script>
