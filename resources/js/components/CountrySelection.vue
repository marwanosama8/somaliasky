<template>
    <div>
        <button id="states-button" data-dropdown-toggle="dropdown-states"
            class="tw-flex-shrink-0 tw-z-10 tw-inline-flex tw-twitems-center tw-py-2.5 tw-px-4 tw-text-sm tw-font-medium tw-text-center tw-text-gray-500 tw-bg-gray-100 tw-border tw-border-gray-300 tw-rounded-l-lg hover:tw-bg-gray-200 focus:tw-ring-4 focus:outline-none focus:tw-ring-gray-100 dark:tw-bg-gray-700 dark:hover:tw-bg-gray-600 dark:focus:tw-ring-gray-700 dark:tw-text-white dark:tw-border-gray-600"
            type="button">
            <div class="tw-inline-flex tw-twitems-center">
                <div class="tw-h-3.5 tw-mb-2 tw-w-3.5 tw-rounded-full tw-mr-2">
                    <country-flag :country='selectedCode' size='small' />
                </div>
                {{ selectedName }}
                <span class="code-text">({{selectedPhone}})</span>

            </div>
        </button>

        <input type="hidden" :value="selectedCode" name="code">
        <div id="dropdown-states"
            class="tw-hidden tw-z-10 tw-w-auto tw-bg-white tw-rounded tw-divide-y tw-divide-gray-100 tw-shadow dark:tw-bg-gray-700"
            data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom"
            style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 10px); overflow: auto; max-height: 150px;">
            <ul class="tw-py-1 tw-text-sm tw-text-gray-700 dark:tw-text-gray-200" aria-labelledby="states-button">
                <li v-for="country in countries" :key="country.id">

                    <button @click="selectCountry(country.name_en, country.code, country.phone)" type="button"
                        class="tw-inline-flex tw-py-2 tw-px-4 tw-w-full tw-text-sm tw-text-gray-700 hover:tw-bg-gray-100 dark:tw-text-gray-400 dark:hover:tw-bg-gray-600 dark:hover:tw-text-white">
                        <div class="tw-inline-flex tw-twitems-center">
                            <div class="tw-h-3.5 tw-w-3.5 tw-rounded-full tw-mr-2">
                                <country-flag :country='country.code' size='small' />
                            </div>
                            {{ country.name_en }}
                        </div>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import CountryFlag from 'vue-country-flag-next'

export default {
    name: 'CountrySelection',
    data() {

        return {
            // countries: {},
            selectedName: "Andorra",
            selectedCode: "ad",
            selectedPhone: "+376",


        }
    },
    components: {
        CountryFlag
    },
    computed: {
        //
    },
    props: [
        'countries'
    ],
    methods: {
        callCountries() {
            let res = axios.get('api/v1/countries').then((response) => this.countries = response.data.data).catch(() => console.log('Countries not loaded'))
        },
        selectCountry(name, code, phone) {
            this.selectedName = name;
            this.selectedPhone = phone;
            this.selectedCode = code;
        }
    },
    mounted() {
        console.log('Component mounted.');
        // this.callCountries();

    }
}
</script>

<style scoped>
.code-text{
    color: #787878;
    font-size: small;
    margin: 0 10px 0 10px;
    text-align: center;
    display: flex;
    align-items: center;
}
</style>