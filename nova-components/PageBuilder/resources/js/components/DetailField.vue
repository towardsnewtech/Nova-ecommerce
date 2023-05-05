<template>
  <!-- <PanelItem :index="index" :field="field" /> -->
  <div v-html="field.value" class="w-3/4 py-4"></div>
</template>

<script>
export default {
  props: ['index', 'resource', 'resourceName', 'resourceId', 'field'],
}
</script>
