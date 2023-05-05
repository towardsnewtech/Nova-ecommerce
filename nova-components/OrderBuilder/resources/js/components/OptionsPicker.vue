<template>
    <button @click="showOptionsModal" class="flex-shrink0 shadow rounded focus:outline-none ring-primary-200 dark:ring-gray-600 focus:ring bg-primary-500 hover:bg-primary-400 active:bg-primary-600 text-white dark:text-gray-800 inline-flex items-center font-bold px-4 h-9 text-sm flex-shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
        </svg>
    </button>
    <transition name="fade"  >
        <modal :show="showModal" @close="showModal = false">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">                
                <modal-header class="bg-white">
                    <h3>Options</h3>
                </modal-header>
            
                <div class="flex bg-white">
                    <ul class="pl-5 py-5 flex-auto"> 
                        <li v-if="item.optionGroups.length == 0">
                            <div class="flex flex-row py-2">
                                <div class="pr-5 font-bold">No options available</div>
                            </div>
                        </li>
                        <li v-else v-for="group in item.optionGroups">
                            <div class="flex flex-row py-2">
                                <div class="pr-5 font-bold"><span v-if="group.required" class="text-red-500">*</span>&nbsp;{{ group.name }}</div>
                                <div v-if="group.multiple">
                                    <ul>
                                        <li class="py-1" v-for="option in group.options">
                                            <!-- <input type="checkbox" :id="option.id" :value="option.id" @change="updateSelected(group.id,option.id)"> -->
                                            <input type="checkbox" :id="option.id" :value="option.id" v-model="checkboxes[option.id]" :checked="item.options.find(itemOption => itemOption.id == option.id)" />
                                            <label :for="option.id">{{ option.name }} <span v-if="(option.price>0)">(+{{option.price}})</span></label>
                                        </li>
                                    </ul>
                                </div>
                                <div v-else>
                                    <ul>
                                        <li class="py-1" v-for="option in group.options">
                                            <!-- <input type="radio" :id="option.id" :value="option.id" :name="group.name" @change="updateSelected(group.id,option.id, true)"> -->
                                            <input type="radio" :id="option.id" :value="option.id" :name="group.name" v-model="radiobuttons[group.id]"  :checked="item.options.find(itemOption => itemOption.id == option.id)" />
                                            <label :for="option.id">{{ option.name }} <span v-if="(option.price>0)">(+{{option.price}})</span></label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <modal-footer class="bg-white">
                    <button @click="save" class="flex-shrink0 shadow rounded focus:outline-none ring-primary-200 dark:ring-gray-600 focus:ring bg-primary-500 hover:bg-primary-400 active:bg-primary-600 text-white dark:text-gray-800 inline-flex items-center font-bold px-4 h-9 text-sm flex-shrink-0">Save</button>
                    <button @click="showModal = false" class="shadow rounded focus:outline-none ring-primary-200 dark:ring-gray-600 focus:ring bg-primary-500 hover:bg-primary-400 active:bg-primary-600 text-white dark:text-gray-800 inline-flex items-center font-bold px-4 h-9 text-sm flex-shrink-0">Close</button>
                </modal-footer>
            </div>
        </modal>
    </transition>
</template>

<script>


export default {
    props: ["item"],
    data() {
        return {
            showModal: false,
            checkboxes: {},
            radiobuttons: {},
        }
    },
    mounted() {
        for (const option of this.item.options) {
            if (option.option_group.multiple) {
                this.checkboxes[option.id] = true;
            } else {
                this.radiobuttons[option.option_group.id] = option.id;
            }
        }
    },
    methods: {
        showOptionsModal() {
            this.showModal = true;
        },
        save(){
            const selected = []
            for (const [key, value] of Object.entries(this.checkboxes)) {
                if(!value){
                    delete this.checkboxes[key];
                }
                else
                {
                    selected.push(parseInt(key));
                }
            }

            for (const [key, value] of Object.entries(this.radiobuttons)) {
                if(value){
                    selected.push(parseInt(value));
                }
            }

            console.log(selected);
            this.item.options = selected;
            this.$emit('update', this.item);

        }
    },
}
</script>
