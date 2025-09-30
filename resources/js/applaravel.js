import './bootstrap';
import 'flowbite';

import { createApp } from 'vue';
import mainVue from './app.vue'
import router from './router';



import header from './components/Header.vue'
import sidebar from './components/SideBar.vue'
import title from './components/Title.vue'
import dinamictable from './components/DynamicTable.vue'
import modal from './components/Modal.vue';
import promotionform from './forms/PromotionForm.vue';
import offerttable from './components/OffertTable.vue';
import mainstatistics from './components/home/MainStatistics.vue';
import specareaform from './forms/SpecAreaForm.vue';
import specareatable from './components/specarea/SpecAreaTable.vue';
import categoryform from './forms/CategoryForm.vue';
import categoriestable from './components/category/CategoriesTable.vue';
import categoriessection from './components/category/CategoriesSection.vue';
import catalogsection from './components/category/CatalogSection.vue';
import catalogsectionform from './forms/CatalogSectionForm.vue';
import navsections from './components/enterprise/NavSections.vue';
import alliancestable from './components/enterprise/AlliancesTable.vue';
import brandtable from './components/enterprise/BrandTable.vue';
import pdfaccesorytable from './components/enterprise/PdfAccesoryTable.vue';
import pdfmanualtable from './components/enterprise/PdfManualTable.vue'
import servicestable from './components/enterprise/ServicesTable.vue';
import allianceform from './forms/AllianceForm.vue';
import brandform from './forms/BrandForm.vue';
import serviceform from './forms/ServiceForm.vue';
import accesorypdfform from './forms/AccesoryPdfForm.vue';
import enterpriseform from './forms/EnterpriseForm.vue';
import producttable from './components/product/ProductTable.vue';
import updatespecareaform from './forms/UpdateSpecAreaForm.vue';
import specproducttable from './components/specarea/SpecProductTable.vue';
import flipbook from './components/FlipBook.vue';
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import '@vueup/vue-quill/dist/vue-quill.bubble.css';


const laravelapp = createApp({})
laravelapp.component('flipbook-container', flipbook)
// laravelapp.component('Title', title);

laravelapp.mount('#appFlipbook')
