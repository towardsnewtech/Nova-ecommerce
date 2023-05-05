<template>
  <!-- <DefaultField :field="field" :errors="errors" :show-help-text="showHelpText" :full-width-content="fullWidthContent">
    <template #field> -->
      <!-- <input :id="field.attribute" type="text" class="w-full form-control form-input form-input-bordered"
        :class="errorClasses" :placeholder="field.name" v-model="value" /> -->
      <div :id="containerId"></div>
    <!-- </template>
  </DefaultField> -->
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'
import grapesjs from 'grapesjs'
import pluginNavbar from 'grapesjs-navbar';
import pluginBlocksBasic from 'grapesjs-blocks-basic';
import pluginBlocksFlexbox from 'grapesjs-blocks-flexbox';
import pluginPresetWebpage from 'grapesjs-preset-webpage';

import 'grapesjs/dist/css/grapes.min.css'


export default {
  mixins: [FormField, HandlesValidationErrors],

  props: ['resourceName', 'resourceId', 'field'],

  data() {
    return {
      editor: null,
      containerId: 'editor-' + Math.random().toString(36).substr(2, 5),
    }
  },

  methods: {
    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      this.value = this.field.value || ''
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      let newValue = '<style>' + this.editor.getCss() + '</style>'
        + this.editor.getHtml()
        + '<script>' + this.editor.getJs() + '<\/script>';
      formData.append(this.field.attribute, newValue || '')
    },
  },

  mounted() {
    this.setInitialValue();
    
    // initialize grapejs
    var editor = grapesjs.init({
      container: '#' + this.containerId,
      allowScripts: 1,
      storageManager: { autoload: 0 },
      width: '100%',
      plugins: [
        pluginNavbar,
        pluginBlocksBasic,
        pluginBlocksFlexbox,
        pluginPresetWebpage
      ],
      styleManager: {
        sectors: [
          {
            name: 'General',
            open: false,
            buildProps: ['float', 'display', 'position', 'top', 'right', 'left', 'bottom']
          }, {
            name: 'Dimension',
            open: false,
            buildProps: ['width', 'height', 'max-width', 'min-height', 'margin', 'padding'],
          }, {
            name: 'Typography',
            open: false,
            buildProps: ['font-family', 'font-size', 'font-weight', 'letter-spacing', 'color', 'line-height', 'text-shadow'],
          }, {
            name: 'Decorations',
            open: false,
            buildProps: ['border-radius-c', 'background-color', 'border-radius', 'border', 'box-shadow', 'background'],
          }
        ],
      },
    });

    editor.setComponents(this.value);
    this.editor = editor;
    console.log(this.value)
  },
  
}
</script>
