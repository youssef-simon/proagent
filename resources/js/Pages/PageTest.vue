<template>
  <div>
<h1>{{  aaa  }}</h1>
  </div>
</template>

<script>
export default {
  props: {
    aaa: {
      type: String,
      required: true,
    },
  },
};
</script>