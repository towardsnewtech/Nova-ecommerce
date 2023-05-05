import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component('index-page-builder', IndexField)
  app.component('detail-page-builder', DetailField)
  app.component('form-page-builder', FormField)
})
