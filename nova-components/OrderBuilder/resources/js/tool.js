import Tool from './components/Tool'
import vSelect from "vue-select";

Nova.booting((app, store) => {
  app.component('v-select', vSelect);
  app.component('order-builder', Tool)
})
 