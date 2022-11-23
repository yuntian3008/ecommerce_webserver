<script setup>
import { reactive, ref, watch } from 'vue'
import {
    RadioGroup,
    RadioGroupLabel,
    RadioGroupDescription,
    RadioGroupOption,
} from '@headlessui/vue'

import DialogModal from '@/Components/DialogModal.vue'
import axios from 'axios'
import { useToast } from 'vue-toastification'

const data = reactive({
    addState: false,
    addStateLoading: false,
})

const toast = useToast()

const props = defineProps({
    addresses: Array,
})

const emit = defineEmits(['choose'])

const addresses = ref(props.addresses)

const newA = reactive({
    address: '',
    province: '',
    country: '',
    phone_number: '',
})

const storeAddress = async () => {
    data.addStateLoading = true
    try {

        const result = await axios.post(route('address.store'), newA);

        newA.address = ''
        newA.province = '',
        newA.country = '',
        newA.phone_number = '',
        addresses.value.push(result.data)
        toast.success(`Đã thêm 1 địa chỉ mới`)
        data.addState = false
    }
    catch (e) {
        console.log(e)
        if (e.response && e.response.status == 422)
            for (const [key, value] of Object.entries(e.response.data.errors)) {
                await new Promise(resolve => setTimeout(resolve, 700));
                toast.error(`${value}`)
            }

    } finally {
        data.addStateLoading = false
    }

}



const countries = reactive({
    Andorra_AD: "Andorra",
    united_arab_emirates_ae: "Các Tiểu vương quốc Ả Rập Thống nhất",
    Afghanistan_AF: "Afghanistan",
    antigua_and_barbuda_ag: "Antigua và Barbuda",
    Anguilla_AI: "Anguilla",
    Albania_AL: "Albania",
    Armenia_AM: "Armenia",
    Angola_AO: "Angola",
    Antarctica_AQ: "Châu Nam Cực",
    Argentina_AR: "Argentina",
    american_samoa_as: "Samoa thuộc Mỹ",
    Austria_AT: "Áo",
    Australia_AU: "Úc",
    Aruba_AW: "Aruba",
    aland_islands_ax: "Åland",
    Azerbaijian_AZ: "Azerbaijan",
    bosnia_and_herzegovina_ba: "Bosna và Hercegovina",
    Barbados_BB: "Barbados",
    Bangladesh_BD: "Bangladesh",
    Belgium_BE: "Bỉ",
    burkina_faso_bf: "Burkina Faso",
    Bulgaria_BG: "Bulgaria",
    Bahrain_BH: "Bahrain",
    Burundi_BI: "Burundi",
    Benin_BJ: "Bénin",
    saint_barthelemy_bl: "Saint_Barthélemy",
    Bermuda_BM: "Bermuda",
    brunei_darussalam_bn: "Brunei",
    bolivia_plurinational_state_of_bo: "Bolivia",
    bonaire_sint_eustatius_and_saba_bq: "Caribe thuộc Hà Lan",
    Brazil_BR: "Brasil",
    Bahamas_BS: "Bahamas",
    Bhutan_BT: "Bhutan",
    Botswana_BW: "Botswana",
    Belarus_BY: "Belarus",
    Belize_BZ: "Belize",
    CanadaA: "Canada",
    cocos_keeling_islandsc: "Quần đảo Cocos (Keeling)",
    congo_the_democratic_republic_of_thed: "Cộng hòa Dân chủ Congo",
    central_african_republicf: "Cộng hòa Trung Phi",
    CongoG: "Congo",
    SwitzerlandH: "Thụy Sĩ",
    cote_divoirei: "Bờ Biển Ngà",
    cook_islandsk: "Quần đảo Cook",
    ChileL: "Chile",
    CameroonM: "Cameroon",
    ChinaN: "Trung Quốc",
    ColombiaO: "Colombia",
    costa_ricar: "Costa Rica",
    CubaU: "Cuba",
    cabo_verdev: "Cabo Verde",
    CuracaoW: "Curaçao",
    christmas_islandx: "Đảo Giáng Sinh",
    CyprusY: "Cộng hòa Síp",
    czech_republicz: "Cộng hòa Séc",
    Germany_DE: "Đức",
    Djibouti_DJ: "Djibouti",
    Denmark_DK: "Đan Mạch",
    Dominica_DM: "Dominica",
    dominican_republic_do: "Cộng hòa Dominica",
    Algeria_DZ: "Algérie",
    Ecuador_EC: "Ecuador",
    Estonia_EE: "Estonia",
    Egypt_EG: "Ai Cập",
    western_sahara_eh: "Tây Sahara",
    Eritrea_ER: "Eritrea",
    Spain_ES: "Tây Ban Nha",
    Ethiopia_ET: "Ethiopia",
    Finland_FI: "Phần Lan",
    Fiji_FJ: "Fiji",
    falkland_islands_malvinas_fk: "Quần đảo Falkland",
    micronesia_federated_states_of_fm: "Liên bang Micronesia",
    faroe_islands_fo: "Quần đảo Faroe",
    France_FR: "Pháp",
    Gabon_GA: "Gabon",
    united_kingdom_gb: "Vương quốc Liên hiệp Anh và Bắc Ireland",
    Grenada_GD: "Grenada",
    Georgia_GE: "Georgia (định hướng)",
    french_guiana_gf: "Guyane thuộc Pháp",
    Guernsey_GG: "Guernsey",
    Ghana_GH: "Ghana",
    Gibraltar_GI: "Gibraltar",
    Greenland_GL: "Greenland",
    Gambia_GM: "Gambia",
    Guinea_GN: "Guinée",
    Guadeloupe_GP: "Guadeloupe",
    equatorial_guinea_gq: "Guinea Xích Đạo",
    Greece_GR: "Hy Lạp",
    south_georgia_and_the_south_sandwich_islands_gs: "Nam Georgia và Quần đảo Nam Sandwich",
    Guatemala_GT: "Guatemala",
    Guam_GU: "Guam",
    Guinea_Bissau_GW: "Guiné_Bissau",
    Guyana_GY: "Guyana",
    hong_kong_hk: "Hồng Kông",
    Honduras_HN: "Honduras",
    Croatia_HR: "Croatia",
    Haiti_HT: "Haiti",
    Hungary_HU: "Hungary",
    Indonesia_ID: "Indonesia",
    Ireland_IE: "Đảo Ireland",
    Israel_IL: "Israel",
    isle_of_man_im: "Đảo Man",
    India_IN: "Ấn Độ",
    british_indian_ocean_territory_io: "Lãnh thổ Ấn Độ Dương thuộc Anh",
    Iraq_IQ: "Iraq",
    iran_islamic_republic_of_ir: "Iran",
    Iceland_IS: "Iceland",
    Italy_IT: "Ý",
    Jersey_JE: "Jersey",
    Jamaica_JM: "Jamaica",
    Jordan_JO: "Jordan",
    Japan_JP: "Nhật Bản",
    Kenya_KE: "Kenya",
    Kyrgyzstan_KG: "Kyrgyzstan",
    Cambodia_KH: "Campuchia",
    Kiribati_KI: "Kiribati",
    Comoros_KM: "Comoros",
    saint_kitts_and_nevis_kn: "Saint Kitts và Nevis",
    korea_democratic_peoples_republic_of_kp: "Cộng hòa Dân chủ Nhân dân Triều Tiên",
    korea_republic_of_kr: "Hàn Quốc",
    Kuwait_KW: "Kuwait",
    cayman_islands_ky: "Quần đảo Cayman",
    Kazakhstan_KZ: "Kazakhstan",
    lao_peoples_democratic_republic_la: "Lào",
    Lebanon_LB: "Liban",
    saint_lucia_lc: "Saint Lucia",
    Liechtenstein_LI: "Liechtenstein",
    sri_lanka_lk: "Sri Lanka",
    Liberia_LR: "Liberia",
    Lesotho_LS: "Lesotho",
    Lithuania_LT: "Litva",
    Luxembourg_LU: "Luxembourg",
    Latvia_LV: "Latvia",
    Libya_LY: "Libya",
    Morocco_MA: "Maroc",
    Monaco_MC: "Monaco",
    moldova_republic_of_md: "Moldova",
    Montenegro_ME: "Montenegro",
    saint_martin_french_part_mf: "Saint_Martin",
    Madagascar_MG: "Madagascar",
    marshall_islands_mh: "Quần đảo Marshall",
    macedonia_the_former_yugoslav_republic_of_mk: "Cộng hòa Macedonia",
    Mali_ML: "Mali",
    Myanmar_MM: "Myanmar",
    Mongolia_MN: "Mông Cổ",
    Macao_MO: "Ma Cao",
    northern_mariana_islands_mp: "Quần đảo Bắc Mariana",
    Martinique_MQ: "Martinique",
    Mauritania_MR: "Mauritanie",
    Montserrat_MS: "Montserrat",
    Malta_MT: "Malta",
    Mauritius_MU: "Mauritius",
    Maldives_MV: "Maldives",
    Malawi_MW: "Malawi",
    Mexico_MX: "México",
    Malaysia_MY: "Malaysia",
    Mozambique_MZ: "Mozambique",
    Namibia_NA: "Namibia",
    newaledonia_nc: "Nouvellealédonie",
    Niger_NE: "Niger",
    norfolk_island_nf: "Đảo Norfolk",
    Nigeria_NG: "Nigeria",
    Nicaragua_NI: "Nicaragua",
    Netherlands_NL: "Hà Lan",
    Norway_NO: "Na Uy",
    Nepal_NP: "Nepal",
    Nauru_NR: "Nauru",
    Niue_NU: "Niue",
    new_zealand_nz: "New Zealand",
    Oman_OM: "Oman",
    Panama_PA: "Panama",
    Peru_PE: "Peru",
    french_polynesia_pf: "Polynésie thuộc Pháp",
    papua_new_guinea_pg: "Papua New Guinea",
    Philippines_PH: "Philippines",
    Pakistan_PK: "Pakistan",
    Poland_PL: "Ba Lan",
    saint_pierre_and_miquelon_pm: "Saint_Pierre và Miquelon",
    Pitcairn_PN: "Quần đảo Pitcairn",
    puerto_rico_pr: "Puerto Rico",
    palestine_state_of_ps: "Nhà nước Palestine",
    Portugal_PT: "Bồ Đào Nha",
    Palau_PW: "Palau",
    Paraguay_PY: "Paraguay",
    Qatar_QA: "Qatar",
    Reunion_RE: "Réunion",
    Romania_RO: "România",
    Serbia_RS: "Serbia",
    russian_federation_ru: "Nga",
    Rwanda_RW: "Rwanda",
    saudi_arabia_sa: "Ả Rập Xê Út",
    solomon_islands_sb: "Quần đảo Solomon",
    Seychelles_SC: "Seychelles",
    Sudan_SD: "Sudan",
    Sweden_SE: "Thụy Điển",
    Singapore_SG: "Singapore",
    saint_helena_ascension_and_tristan_daunha_sh: "Saint Helena, Ascension và Tristan da Cunha",
    Slovenia_SI: "Slovenia",
    svalbard_and_jan_mayen_sj: "Svalbard và Jan Mayen",
    Slovakia_SK: "Slovakia",
    sierra_leone_sl: "Sierra Leone",
    san_marino_sm: "San Marino",
    Senegal_SN: "Sénégal",
    Somalia_SO: "Somalia",
    Suriname_SR: "Suriname",
    south_sudan_ss: "Nam Sudan",
    sao_tome_and_principe_st: "São Tomé và Príncipe",
    el_salvador_sv: "El Salvador",
    sint_maarten_dutch_part_sx: "Sint Maarten",
    syrian_arab_republic_sy: "Syria",
    Swaziland_SZ: "Swaziland",
    turks_andaicos_islands_tc: "Quần đảo Turks và Caicos",
    Chad_TD: "Tchad",
    french_southern_territories_tf: "Vùng đất phía Nam và châu Nam Cực thuộc Pháp",
    Togo_TG: "Togo",
    Thailand_TH: "Thái Lan",
    Tajikistan_TJ: "Tajikistan",
    Tokelau_TK: "Tokelau",
    Timor_Leste_TL: "Đông Timor",
    Turkmenistan_TM: "Turkmenistan",
    Tunisia_TN: "Tunisia",
    Tonga_TO: "Tonga",
    Turkey_TR: "Thổ Nhĩ Kỳ",
    trinidad_and_tobago_tt: "Trinidad và Tobago",
    Tuvalu_TV: "Tuvalu",
    taiwan_province_ofhina_tw: "Đài Loan (Trung Quốc)",
    tanzania_united_republic_of_tz: "Tanzania",
    Ukraine_UA: "Ukraina",
    Uganda_UG: "Uganda",
    united_states_minor_outlying_islands_um: "Các tiểu đảo xa của Hoa Kỳ",
    united_states_us: "Hoa Kỳ",
    Uruguay_UY: "Uruguay",
    Uzbekistan_UZ: "Uzbekistan",
    holy_see_va: "Tòa Thánh",
    saint_vincent_and_the_grenadines_vc: "Saint Vincent và Grenadines",
    venezuela_bolivarian_republic_of_ve: "Venezuela",
    virgin_islands_british_vg: "Quần đảo Virgin thuộc Anh",
    virgin_islands_u_s_vi: "Quần đảo Virgin thuộc Mỹ",
    viet_nam_vn: "Việt Nam",
    Vanuatu_VU: "Vanuatu",
    wallis_and_futuna_wf: "Wallis và Futuna",
    Samoa_WS: "Samoa",
    Yemen_YE: "Yemen",
    Mayotte_YT: "Mayotte",
    south_africa_za: "Cộng hòa Nam Phi",
    Zambia_ZM: "Zambia",
    Zimbabwe_ZW: "Zimbabwe",
})

const selected = ref(props.addresses[0] ?? null)

watch(
    selected, (value) => {
        emit('choose',value)
    }
, {
    immediate: true
})

</script>

<template>
    <div class="w-full">
        <DialogModal :show="data.addState" @close="data.addState = false">
            <template #title>
                Thêm thông tin giao hàng mới
            </template>
            <template #content>
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Số điện
                            thoại giao hàng</label>
                        <input type="tel" v-model="newA.phone_number" pattern="(84|0[3|5|7|8|9])+([0-9]{8})\b"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Nhập số điện thoại" required="">
                    </div>
                    <div>
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tỉnh /
                            thành phố</label>
                        <input type="text" v-model="newA.province"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Tỉnh / thành phố" required="">
                    </div>
                    <div>
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quốc
                            gia</label>
                        <select id="category" v-model="newA.country"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="" selected>Chọn quốc gia</option>
                            <option v-for="(value, key) in countries" :key="key" :value="value">{{ value }}</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Địa chỉ giao
                            hàng</label>
                        <textarea rows="4" v-model="newA.address"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Nhập địa chỉ cụ thể / tòa nhà / căn hộ"></textarea>
                    </div>
                </div>
            </template>

            <template #footer>
                <button type="submit" @click="storeAddress" :disabled="data.addStateLoading"
                    class="text-white inline-flex items-center gap-x-2 bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg v-if="data.addStateLoading" class="w-6 h-6 text-white animate-spin dark:text-gray-600 fill-yellow-400" viewBox="0 0 100 101" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                    <svg v-else class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Thêm địa chỉ giao hàng
                </button>
            </template>

        </DialogModal>
        <div class="mx-auto w-full max-w-md">
            <RadioGroup v-model="selected">
                <RadioGroupLabel class="sr-only">Server size</RadioGroupLabel>
                <div class="space-y-2">
                    <RadioGroupOption as="template" v-for="(address, i) in props.addresses" :key="i" :value="address"
                        v-slot="{ active, checked }">
                        <div :class="[
                            active
                                ? 'ring-2 ring-white ring-opacity-60 ring-offset-2 ring-offset-orange-300'
                                : '',
                            checked ? 'bg-yellow-900 bg-opacity-75 text-white ' : 'bg-white ',
                        ]" class="relative flex cursor-pointer rounded-lg px-5 py-4 border border-gray-200 focus:outline-none">
                            <div class="flex w-full items-center justify-between">
                                <div class="flex items-center">
                                    <div class="text-sm">
                                        <RadioGroupLabel as="p" :class="checked ? 'text-white' : 'text-gray-900'"
                                            class="font-medium">
                                            Địa chỉ: {{ address.address }}
                                        </RadioGroupLabel>
                                        <RadioGroupDescription as="span"
                                            :class="checked ? 'text-sky-100' : 'text-gray-500'" class="inline">
                                            <span> {{ address.province }} - {{ address.country }}</span>
                                            <span aria-hidden="true"> &middot; </span>
                                            <span>SĐT: {{ address.phone_number }}</span>
                                        </RadioGroupDescription>
                                    </div>
                                </div>
                                <div v-show="checked" class=" absolute right-0 m-4 shrink-0 text-white">
                                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none">
                                        <circle cx="12" cy="12" r="12" fill="#fff" fill-opacity="0.2" />
                                        <path d="M7 13l3 3 7-7" stroke="#fff" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </RadioGroupOption>
                    <div class="relative flex cursor-pointer rounded-lg px-5 py-4 shadow-md focus:outline-none"
                        @click.prevent="data.addState = true">
                        <div class="flex w-full items-center justify-center">
                            <div class="flex items-center justify-center text-center">
                                <div class="flex flex-col text-sm">
                                    <div class="inline-flex justify-center font-medium text-gray-900 text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                    </div>
                                    <span class=" text-gray-500">
                                        <span> Thêm thông tin giao hàng</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </RadioGroup>
        </div>
    </div>
</template>


